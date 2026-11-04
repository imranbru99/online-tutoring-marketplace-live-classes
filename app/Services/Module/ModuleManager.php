<?php

declare(strict_types=1);

namespace App\Services\Module;

use App\Modules\Core\Models\ModuleState;
use App\Services\Tenancy\TenantContext;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class ModuleManager
{
    protected ?Collection $manifests = null;

    public function __construct(
        protected TenantContext $tenantContext
    ) {}

    /**
     * Discover all module.json manifests from app/Modules.
     *
     * @return Collection<string, array>
     */
    public function all(): Collection
    {
        if ($this->manifests !== null) {
            return $this->manifests;
        }

        $modulesPath = app_path('Modules');
        if (!File::isDirectory($modulesPath)) {
            return $this->manifests = collect();
        }

        $manifests = collect();
        $directories = File::directories($modulesPath);

        foreach ($directories as $dir) {
            $manifestFile = $dir . '/module.json';
            if (File::exists($manifestFile)) {
                $content = json_decode(File::get($manifestFile), true);
                if (is_array($content) && isset($content['key'])) {
                    $manifests->put($content['key'], array_merge([
                        'path' => $dir,
                        'name' => basename($dir),
                        'description' => '',
                        'version' => '1.0.0',
                        'dependencies' => [],
                        'permissions' => [],
                        'settings_schema' => [],
                        'public_pages' => [],
                        'navigation_items' => [],
                        'scheduled_tasks' => [],
                        'demo_seeders' => [],
                        'always_enabled' => false,
                    ], $content));
                }
            }
        }

        return $this->manifests = $manifests;
    }

    public function get(string $key): ?array
    {
        return $this->all()->get($key);
    }

    public function has(string $key): bool
    {
        return $this->all()->has($key);
    }

    /**
     * Check if a module is enabled for a business and optional branch.
     */
    public function isEnabled(string $key, ?int $businessId = null, ?int $branchId = null): bool
    {
        // Core module is always enabled
        if ($key === 'core') {
            return true;
        }

        $manifest = $this->get($key);
        if ($manifest && !empty($manifest['always_enabled'])) {
            return true;
        }

        $bizId = $businessId ?? $this->tenantContext->getBusinessId();
        $brId = $branchId ?? $this->tenantContext->getBranchId();

        $cacheKey = "module_enabled:{$bizId}:{$brId}:{$key}";

        return (bool) Cache::remember($cacheKey, 3600, function () use ($key, $bizId, $brId) {
            // 1. Check branch override
            if ($brId) {
                $branchState = ModuleState::where('branch_id', $brId)
                    ->where('module_key', $key)
                    ->first();
                if ($branchState !== null) {
                    return $branchState->is_enabled;
                }
            }

            // 2. Check business state
            if ($bizId) {
                $bizState = ModuleState::where('business_id', $bizId)
                    ->whereNull('branch_id')
                    ->where('module_key', $key)
                    ->first();
                if ($bizState !== null) {
                    return $bizState->is_enabled;
                }
            }

            // 3. Fallback to platform global default
            $globalState = ModuleState::whereNull('business_id')
                ->whereNull('branch_id')
                ->where('module_key', $key)
                ->first();
            if ($globalState !== null) {
                return $globalState->is_enabled;
            }

            // By default, modules are enabled
            return true;
        });
    }

    /**
     * Enable a module with dependency validation.
     */
    public function enable(string $key, ?int $businessId = null, ?int $branchId = null): array
    {
        $manifest = $this->get($key);
        if (!$manifest) {
            return ['success' => false, 'error' => "Module [{$key}] does not exist."];
        }

        $bizId = $businessId ?? $this->tenantContext->getBusinessId();
        $brId = $branchId ?? $this->tenantContext->getBranchId();

        // Check required dependencies
        $missingDeps = [];
        foreach ($manifest['dependencies'] as $depKey) {
            if (!$this->isEnabled($depKey, $bizId, $brId)) {
                $missingDeps[] = $depKey;
            }
        }

        if (!empty($missingDeps)) {
            return [
                'success' => false,
                'error' => "Cannot enable [{$key}] because required dependencies are disabled: " . implode(', ', $missingDeps),
                'missing_dependencies' => $missingDeps,
            ];
        }

        ModuleState::updateOrCreate(
            [
                'business_id' => $bizId,
                'branch_id' => $brId,
                'module_key' => $key,
            ],
            [
                'is_enabled' => true,
            ]
        );

        $this->clearCache($bizId, $brId, $key);

        return [
            'success' => true,
            'message' => "Module [{$manifest['name']}] enabled successfully.",
        ];
    }

    /**
     * Disable a module with dependency check.
     */
    public function disable(string $key, ?int $businessId = null, ?int $branchId = null): array
    {
        if ($key === 'core') {
            return ['success' => false, 'error' => 'Core module is essential and cannot be disabled.'];
        }

        $manifest = $this->get($key);
        if ($manifest && !empty($manifest['always_enabled'])) {
            return ['success' => false, 'error' => "Module [{$key}] is protected and cannot be disabled."];
        }

        $bizId = $businessId ?? $this->tenantContext->getBusinessId();
        $brId = $branchId ?? $this->tenantContext->getBranchId();

        // Check if any other enabled module depends on this module
        $dependents = [];
        foreach ($this->all() as $otherKey => $otherManifest) {
            if ($otherKey === $key) {
                continue;
            }
            if (in_array($key, $otherManifest['dependencies'] ?? [], true)) {
                if ($this->isEnabled($otherKey, $bizId, $brId)) {
                    $dependents[] = $otherManifest['name'] ?? $otherKey;
                }
            }
        }

        if (!empty($dependents)) {
            return [
                'success' => false,
                'error' => "Cannot disable [{$key}] because active modules depend on it: " . implode(', ', $dependents) . ". Disable them first.",
                'dependents' => $dependents,
            ];
        }

        ModuleState::updateOrCreate(
            [
                'business_id' => $bizId,
                'branch_id' => $brId,
                'module_key' => $key,
            ],
            [
                'is_enabled' => false,
            ]
        );

        $this->clearCache($bizId, $brId, $key);

        return [
            'success' => true,
            'message' => "Module [{$key}] disabled successfully.",
        ];
    }

    /**
     * Get available presets.
     */
    public function getAvailablePresets(): array
    {
        return [
            'solo-tutor' => [
                'name' => 'Solo Tutor',
                'description' => 'Tailored for independent tutors offering 1:1 lessons, availability calendar, and instant booking.',
                'modules' => ['core', 'tutors', 'students', 'calendar', 'bookings', 'live-classroom', 'payments', 'reviews', 'messaging', 'notifications'],
            ],
            'tutoring-marketplace' => [
                'name' => 'Tutoring Marketplace',
                'description' => 'Multi-tutor marketplace with search, discovery, wallets, commission splits, and automated payouts.',
                'modules' => [
                    'core', 'tutors', 'students', 'guardians', 'catalog', 'search', 'calendar', 'bookings', 
                    'live-classroom', 'whiteboard', 'recordings', 'resources', 'payments', 'wallet', 
                    'commissions', 'invoicing', 'promotions', 'disputes', 'messaging', 'notifications', 
                    'reviews', 'referrals', 'blog'
                ],
            ],
            'coaching-center' => [
                'name' => 'Coaching Center',
                'description' => 'For physical or hybrid academies with batches, attendance devices, group classes, and timetables.',
                'modules' => [
                    'core', 'tutors', 'students', 'guardians', 'catalog', 'group-classes', 'timetable', 
                    'attendance', 'assignments', 'quizzes', 'reports', 'payments', 'invoicing', 'staff-hr', 'notifications'
                ],
            ],
            'school-institution' => [
                'name' => 'School / University',
                'description' => 'Complete institutional LMS with multi-section classes, biometric attendance, exams, and grade books.',
                'modules' => [
                    'core', 'tutors', 'students', 'guardians', 'catalog', 'group-classes', 'courses', 
                    'timetable', 'attendance', 'assignments', 'quizzes', 'reports', 'institutions', 
                    'certificates', 'staff-hr', 'support-desk'
                ],
            ],
            'language-academy' => [
                'name' => 'Language Academy',
                'description' => 'Language immersion center with structured levels, interactive whiteboards, and speech/AI practice.',
                'modules' => [
                    'core', 'tutors', 'students', 'catalog', 'courses', 'packages', 'live-classroom', 
                    'whiteboard', 'recordings', 'ai-assistant', 'certificates', 'payments', 'reviews'
                ],
            ],
            'exam-prep' => [
                'name' => 'Exam-Prep Academy (IELTS/SAT/BCS)',
                'description' => 'Test preparation center with question banks, mock exams, AI diagnostic tests, and flashcards.',
                'modules' => [
                    'core', 'tutors', 'students', 'catalog', 'courses', 'quizzes', 'assignments', 
                    'ai-assistant', 'ai-tutor', 'reports', 'certificates', 'payments', 'gamification'
                ],
            ],
            'corporate-training' => [
                'name' => 'Corporate Training',
                'description' => 'Workplace skills training with bulk employee seat licensing, attendance, and compliance certifications.',
                'modules' => [
                    'core', 'tutors', 'students', 'institutions', 'courses', 'live-classroom', 
                    'attendance', 'certificates', 'invoicing', 'analytics'
                ],
            ],
            'full-platform' => [
                'name' => 'Full Enterprise Suite',
                'description' => 'All 50 marketplace, live teaching, fintech, AI, and operations modules unlocked.',
                'modules' => '*', // All modules
            ],
        ];
    }

    /**
     * Apply a preset to a business.
     */
    public function applyPreset(string $presetKey, int $businessId, ?int $branchId = null): array
    {
        $presets = $this->getAvailablePresets();
        if (!isset($presets[$presetKey])) {
            return ['success' => false, 'error' => "Unknown preset [{$presetKey}]."];
        }

        $preset = $presets[$presetKey];
        $allModules = $this->all();

        foreach ($allModules as $key => $manifest) {
            $shouldEnable = ($preset['modules'] === '*' || in_array($key, $preset['modules'], true) || $key === 'core');

            ModuleState::updateOrCreate(
                [
                    'business_id' => $businessId,
                    'branch_id' => $branchId,
                    'module_key' => $key,
                ],
                [
                    'is_enabled' => $shouldEnable,
                ]
            );

            $this->clearCache($businessId, $branchId, $key);
        }

        return [
            'success' => true,
            'message' => "Preset [{$preset['name']}] applied successfully to business.",
        ];
    }

    public function clearCache(?int $businessId = null, ?int $branchId = null, ?string $key = null): void
    {
        $bizId = $businessId ?? $this->tenantContext->getBusinessId();
        $brId = $branchId ?? $this->tenantContext->getBranchId();

        if ($key) {
            Cache::forget("module_enabled:{$bizId}:{$brId}:{$key}");
            Cache::forget("module_enabled:{$bizId}::{$key}");
            Cache::forget("module_enabled:::{$key}");
        }
    }
}
