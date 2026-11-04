<?php

declare(strict_types=1);

namespace App\Services\Settings;

use App\Modules\Core\Models\Setting;
use App\Services\Tenancy\TenantContext;
use Illuminate\Support\Facades\Cache;

class SettingsManager
{
    public function __construct(
        protected TenantContext $tenantContext
    ) {}

    protected function getCacheKey(string $key, ?int $businessId, ?int $branchId): string
    {
        $biz = $businessId ?? $this->tenantContext->getBusinessId() ?? 0;
        $br = $branchId ?? $this->tenantContext->getBranchId() ?? 0;

        return "setting:{$biz}:{$br}:{$key}";
    }

    public function get(string $key, mixed $default = null, ?int $businessId = null, ?int $branchId = null): mixed
    {
        $cacheKey = $this->getCacheKey($key, $businessId, $branchId);

        return Cache::remember($cacheKey, 3600, function () use ($key, $default, $businessId, $branchId) {
            $bizId = $businessId ?? $this->tenantContext->getBusinessId();
            $brId = $branchId ?? $this->tenantContext->getBranchId();

            $query = Setting::query()->where('key', $key);

            if ($brId) {
                $branchSetting = (clone $query)->where('branch_id', $brId)->first();
                if ($branchSetting) {
                    return $branchSetting->typed_value;
                }
            }

            if ($bizId) {
                $bizSetting = (clone $query)->where('business_id', $bizId)->whereNull('branch_id')->first();
                if ($bizSetting) {
                    return $bizSetting->typed_value;
                }
            }

            // Global fallback
            $globalSetting = (clone $query)->whereNull('business_id')->whereNull('branch_id')->first();
            if ($globalSetting) {
                return $globalSetting->typed_value;
            }

            return $default;
        });
    }

    public function set(string $key, mixed $value, string $group = 'general', ?int $businessId = null, ?int $branchId = null, bool $isPublic = false): Setting
    {
        $bizId = $businessId ?? $this->tenantContext->getBusinessId();
        $brId = $branchId ?? $this->tenantContext->getBranchId();

        $type = 'string';
        $stringValue = Setting::setTypedValue($value, $type);

        $setting = Setting::updateOrCreate(
            [
                'business_id' => $bizId,
                'branch_id' => $brId,
                'group' => $group,
                'key' => $key,
            ],
            [
                'value' => $stringValue,
                'type' => $type,
                'is_public' => $isPublic,
            ]
        );

        Cache::forget($this->getCacheKey($key, $bizId, $brId));

        return $setting;
    }

    public function all(?int $businessId = null, ?int $branchId = null): array
    {
        $bizId = $businessId ?? $this->tenantContext->getBusinessId();
        $brId = $branchId ?? $this->tenantContext->getBranchId();

        $query = Setting::query();
        if ($bizId) {
            $query->where('business_id', $bizId);
        }
        if ($brId) {
            $query->where('branch_id', $brId);
        }

        return $query->get()->mapWithKeys(fn (Setting $s) => [$s->key => $s->typed_value])->toArray();
    }
}
