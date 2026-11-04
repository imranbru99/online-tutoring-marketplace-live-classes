<?php

declare(strict_types=1);

namespace App\Services\Slug;

use ImranDev\UniversalSlug\Facades\UniversalSlug;
use ImranDev\UniversalSlug\Models\SlugHistory;
use Throwable;

class SlugService
{
    public function generate(string $title, ?string $separator = '-', ?string $language = null, array $options = []): string
    {
        return UniversalSlug::generate($title, $separator, $language, $options);
    }

    public function of(?string $title): mixed
    {
        return UniversalSlug::of($title);
    }

    public function getStatus(): array
    {
        $installed = class_exists(\ImranDev\UniversalSlug\UniversalSlugServiceProvider::class);
        $configured = config('universal-slug') !== null;
        $historyCount = 0;

        if ($installed) {
            try {
                $historyCount = SlugHistory::count();
            } catch (Throwable) {
            }
        }

        return [
            'package' => 'imrandevbd/laravel-universal-slug',
            'name' => 'Universal Unicode Slug Generator',
            'installed' => $installed,
            'version' => 'dev-main',
            'configured' => $configured,
            'enabled' => true,
            'status' => $installed ? 'healthy' : 'error',
            'last_used' => now()->toIso8601String(),
            'message' => "Universal Slug engine ready with 301 history tracking ({$historyCount} histories stored)",
            'metrics' => [
                'tracked_slug_histories' => $historyCount,
                'default_separator' => config('universal-slug.separator', '-'),
            ],
        ];
    }
}
