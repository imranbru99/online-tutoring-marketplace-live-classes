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

class ContentPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id("content")
            ->path("content")
            ->login()
            ->brandName("Content & Curriculum Management")
            ->colors([
                "primary" => Color::Rose,
            ])
            ->discoverResources(in: app_path("Filament/Content/Resources"), for: "App\\Filament\\ContentPanelProvider\\Resources")
            ->discoverPages(in: app_path("Filament/Content/Pages"), for: "App\\Filament\\ContentPanelProvider\\Pages")
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path("Filament/Content/Widgets"), for: "App\\Filament\\ContentPanelProvider\\Widgets")
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
