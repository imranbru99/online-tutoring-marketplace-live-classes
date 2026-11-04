<?php

declare(strict_types=1);

namespace App\Services\Catalog;

use ImranDevBd\AiCatalog\Facades\AiCatalog;
use ImranDevBd\AiCatalog\Models\CatalogGeneration;
use Throwable;

class CatalogScraperService
{
    public function generateFromKeyword(string $keyword): mixed
    {
        return AiCatalog::fromKeyword($keyword);
    }

    public function generateFromUrl(string $url): mixed
    {
        return AiCatalog::fromUrl($url);
    }

    public function generateFromText(string $text): mixed
    {
        return AiCatalog::fromText($text);
    }

    public function getLatestGenerations(int $limit = 10): array
    {
        try {
            return CatalogGeneration::orderByDesc('created_at')
                ->limit($limit)
                ->get()
                ->toArray();
        } catch (Throwable) {
            return [];
        }
    }

    public function getStatus(): array
    {
        $installed = class_exists(\ImranDevBd\AiCatalog\AiCatalogServiceProvider::class);
        $configured = config('ai-catalog') !== null;
        $count = 0;

        if ($installed) {
            try {
                $count = CatalogGeneration::count();
            } catch (Throwable) {
            }
        }

        return [
            'package' => 'imrandevbd/laravel-ai-catalog',
            'name' => 'AI Catalog & Curriculum Scraper',
            'installed' => $installed,
            'version' => 'dev-main',
            'configured' => $configured,
            'enabled' => true,
            'status' => $installed ? 'healthy' : 'error',
            'last_used' => now()->toIso8601String(),
            'message' => "AI Catalog scraper ready ({$count} generations logged)",
            'metrics' => [
                'total_generations' => $count,
            ],
        ];
    }
}
