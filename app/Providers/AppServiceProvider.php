<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\AdminPanel\AdminPanelService;
use App\Services\Ai\AiService;
use App\Services\Attendance\AttendanceService;
use App\Services\Catalog\CatalogScraperService;
use App\Services\Health\SystemHealthService;
use App\Services\Localization\LocalizationService;
use App\Services\Module\ModuleManager;
use App\Services\Pdf\PdfService;
use App\Services\Performance\PerformanceService;
use App\Services\Settings\SettingsManager;
use App\Services\Slug\SlugService;
use App\Services\Tenancy\TenantContext;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Core singletons
        $this->app->singleton(TenantContext::class);
        $this->app->singleton(ModuleManager::class);
        $this->app->singleton(SettingsManager::class);
        $this->app->singleton(LocalizationService::class);

        // Mandatory Package Adapters
        $this->app->singleton(PerformanceService::class);
        $this->app->singleton(AdminPanelService::class);
        $this->app->singleton(CatalogScraperService::class);
        $this->app->singleton(AiService::class);
        $this->app->singleton(AttendanceService::class);
        $this->app->singleton(PdfService::class);
        $this->app->singleton(SlugService::class);

        // System Health Gateway
        $this->app->singleton(SystemHealthService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
