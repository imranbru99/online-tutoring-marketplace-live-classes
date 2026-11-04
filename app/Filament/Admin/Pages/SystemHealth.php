<?php

declare(strict_types=1);

namespace App\Filament\Admin\Pages;

use App\Services\Health\SystemHealthService;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class SystemHealth extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-heart';

    protected static string $view = 'filament.admin.pages.system-health';

    protected static ?string $navigationGroup = 'Settings & Platform';

    protected static ?int $navigationSort = 99;

    protected static ?string $title = 'System Health & Integrations';

    public array $healthData = [];

    public function mount(SystemHealthService $healthService): void
    {
        $this->refreshStatus($healthService);
    }

    public function refreshStatus(SystemHealthService $healthService): void
    {
        $this->healthData = $healthService->checkAll(true);

        Notification::make()
            ->title('System health updated')
            ->success()
            ->send();
    }
}
