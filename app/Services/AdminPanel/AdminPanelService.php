<?php

declare(strict_types=1);

namespace App\Services\AdminPanel;

use ImranDevBD\LaravelAdminPanel\Facades\AdminPanel;
use Throwable;

class AdminPanelService
{
    public function getVersion(): string
    {
        try {
            return AdminPanel::version();
        } catch (Throwable) {
            return '1.0.0';
        }
    }

    public function getRegisteredPanels(): array
    {
        try {
            return AdminPanel::getPanels();
        } catch (Throwable) {
            return [];
        }
    }

    public function getStatus(): array
    {
        $installed = class_exists(\ImranDevBD\LaravelAdminPanel\AdminPanelServiceProvider::class);
        $configured = config('admin-panel') !== null;
        $version = $installed ? $this->getVersion() : 'not installed';

        return [
            'package' => 'imrandevbd/laravel-admin-panel',
            'name' => 'Laravel Admin Panel Foundation',
            'installed' => $installed,
            'version' => $version,
            'configured' => $configured,
            'enabled' => true,
            'status' => $installed ? 'healthy' : 'error',
            'last_used' => now()->toIso8601String(),
            'message' => 'Admin Panel foundation active with multi-theme and RBAC support',
            'metrics' => [
                'registered_panels' => count($this->getRegisteredPanels()),
                'theme' => config('admin-panel.theme.default_palette', 'indigo'),
            ],
        ];
    }
}
