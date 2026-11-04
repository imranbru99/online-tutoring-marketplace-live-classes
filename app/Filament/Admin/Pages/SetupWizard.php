<?php

declare(strict_types=1);

namespace App\Filament\Admin\Pages;

use App\Facades\Module;
use App\Facades\Setting;
use App\Modules\Core\Models\Business;
use App\Services\Tenancy\TenantContext;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class SetupWizard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static string $view = 'filament.admin.pages.setup-wizard';

    protected static ?string $navigationGroup = 'Settings & Platform';

    protected static ?int $navigationSort = 1;

    protected static ?string $title = 'Business Setup Wizard';

    public int $currentStep = 1;

    // Step 1: Preset selection
    public string $businessType = 'tutoring-marketplace';

    // Step 2: Branding
    public string $businessName = 'EduHub Global';
    public string $contactEmail = 'contact@eduhub.test';
    public string $primaryColor = '#4f46e5';
    public string $defaultCurrency = 'USD';
    public string $defaultTimezone = 'UTC';
    public string $defaultLanguage = 'en';

    // Step 3: Branch info
    public string $mainBranchName = 'Online Global Campus';
    public string $mainBranchCity = 'Dhaka';

    public function mount(): void
    {
        /** @var TenantContext $tenantContext */
        $tenantContext = app(TenantContext::class);
        $business = $tenantContext->getBusiness() ?? Business::first();

        if ($business) {
            $tenantContext->setBusiness($business);
            $this->businessName = $business->name;
            $this->contactEmail = $business->email ?? $this->contactEmail;
            $this->primaryColor = $business->primary_color ?? $this->primaryColor;
            $this->defaultCurrency = $business->default_currency ?? $this->defaultCurrency;
            $this->defaultTimezone = $business->default_timezone ?? $this->defaultTimezone;
            $this->defaultLanguage = $business->default_language ?? $this->defaultLanguage;
        }
    }

    public function getPresetsProperty(): array
    {
        return Module::getAvailablePresets();
    }

    public function nextStep(): void
    {
        if ($this->currentStep === 1) {
            $this->currentStep = 2;
            return;
        }

        if ($this->currentStep === 2) {
            $this->currentStep = 3;
            return;
        }

        if ($this->currentStep === 3) {
            $this->saveAndComplete();
            $this->currentStep = 4;
        }
    }

    public function previousStep(): void
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    public function saveAndComplete(): void
    {
        /** @var TenantContext $tenantContext */
        $tenantContext = app(TenantContext::class);
        $business = $tenantContext->getBusiness() ?? Business::first();

        if (!$business) {
            $business = Business::create([
                'name' => $this->businessName,
                'email' => $this->contactEmail,
                'primary_color' => $this->primaryColor,
                'default_currency' => $this->defaultCurrency,
                'default_timezone' => $this->defaultTimezone,
                'default_language' => $this->defaultLanguage,
                'mode' => 'single',
                'status' => 'active',
            ]);
            $tenantContext->setBusiness($business);
        } else {
            $business->update([
                'name' => $this->businessName,
                'email' => $this->contactEmail,
                'primary_color' => $this->primaryColor,
                'default_currency' => $this->defaultCurrency,
                'default_timezone' => $this->defaultTimezone,
                'default_language' => $this->defaultLanguage,
            ]);
        }

        // Apply preset
        Module::applyPreset($this->businessType, (int) $business->id);

        // Save core settings
        Setting::set('site_name', $this->businessName, 'general', (int) $business->id);
        Setting::set('contact_email', $this->contactEmail, 'general', (int) $business->id);
        Setting::set('default_currency', $this->defaultCurrency, 'localization', (int) $business->id);
        Setting::set('default_timezone', $this->defaultTimezone, 'localization', (int) $business->id);
        Setting::set('setup_completed', true, 'general', (int) $business->id);

        Notification::make()
            ->title('Platform Successfully Initialized!')
            ->body('Preset configured, branding applied, and workspace is ready to go live.')
            ->success()
            ->send();
    }
}
