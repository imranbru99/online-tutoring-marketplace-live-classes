<?php

declare(strict_types=1);

namespace App\Providers\Filament;

use App\Http\Middleware\TenantMiddleware;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class FinancePanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id("finance")
            ->path("finance")
            ->login()
            ->brandName("Finance & Accounting")
            ->colors([
                "primary" => Color::Green,
            ])
            ->discoverResources(in: app_path("Filament/Finance/Resources"), for: "App\\Filament\\FinancePanelProvider\\Resources")
            ->discoverPages(in: app_path("Filament/Finance/Pages"), for: "App\\Filament\\FinancePanelProvider\\Pages")
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path("Filament/Finance/Widgets"), for: "App\\Filament\\FinancePanelProvider\\Widgets")
            ->widgets([
                Widgets\AccountWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                TenantMiddleware::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
