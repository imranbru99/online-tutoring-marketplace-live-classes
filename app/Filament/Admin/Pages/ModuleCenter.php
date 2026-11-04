<?php

declare(strict_types=1);

namespace App\Filament\Admin\Pages;

use App\Facades\Module;
use App\Services\Module\ModuleManager;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ModuleCenter extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-puzzle-piece';

    protected static string $view = 'filament.admin.pages.module-center';

    protected static ?string $navigationGroup = 'Settings & Platform';

    protected static ?int $navigationSort = 10;

    protected static ?string $title = 'Module Center';

    public string $selectedPreset = 'tutoring-marketplace';

    public string $searchQuery = '';

    public function mount(): void
    {
        // default initialization
    }

    public function getModulesProperty(): array
    {
        /** @var ModuleManager $manager */
        $manager = app(ModuleManager::class);
        $modules = $manager->all()->toArray();

        if ($this->searchQuery !== '') {
            $query = strtolower($this->searchQuery);
            $modules = array_filter($modules, function ($m) use ($query) {
                return str_contains(strtolower($m['name']), $query) 
                    || str_contains(strtolower($m['key']), $query)
                    || str_contains(strtolower($m['description']), $query);
            });
        }

        foreach ($modules as $key => &$mod) {
            $mod['is_enabled'] = $manager->isEnabled($key);
        }

        return $modules;
    }

    public function getPresetsProperty(): array
    {
        return Module::getAvailablePresets();
    }

    public function toggleModule(string $key): void
    {
        /** @var ModuleManager $manager */
        $manager = app(ModuleManager::class);

        $currentlyEnabled = $manager->isEnabled($key);

        if ($currentlyEnabled) {
            $result = $manager->disable($key);
        } else {
            $result = $manager->enable($key);
        }

        if ($result['success']) {
            Notification::make()
                ->title($result['message'])
                ->success()
                ->send();
        } else {
            Notification::make()
                ->title('Action Blocked')
                ->body($result['error'])
                ->danger()
                ->send();
        }
    }

    public function applySelectedPreset(): void
    {
        /** @var ModuleManager $manager */
        $manager = app(ModuleManager::class);
        $tenantId = app(\App\Services\Tenancy\TenantContext::class)->getBusinessId() ?? 1;

        $result = $manager->applyPreset($this->selectedPreset, $tenantId);

        if ($result['success']) {
            Notification::make()
                ->title($result['message'])
                ->success()
                ->send();
        } else {
            Notification::make()
                ->title('Preset Error')
                ->body($result['error'])
                ->danger()
                ->send();
        }
    }
}
