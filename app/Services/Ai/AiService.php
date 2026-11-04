<?php

declare(strict_types=1);

namespace App\Services\Ai;

use ImranDevBd\AiHub\Facades\AIHub;
use ImranDevBd\AiHub\Models\AiHubRequestLog;
use Throwable;

class AiService
{
    public function prompt(string $prompt, ?string $provider = null, ?string $model = null): mixed
    {
        $req = $provider ? AIHub::provider($provider) : AIHub::pending();
        if ($model) {
            $req = $req->model($model);
        }

        return $req->prompt($prompt);
    }

    public function chat(?string $provider = null, ?string $model = null): mixed
    {
        return AIHub::chat($provider, $model);
    }

    public function fake(array $responses = []): mixed
    {
        return AIHub::fake($responses);
    }

    public function getStatus(): array
    {
        $installed = class_exists(\ImranDevBd\AiHub\AiHubServiceProvider::class);
        $configured = config('ai-hub') !== null;
        $logCount = 0;

        if ($installed) {
            try {
                $logCount = AiHubRequestLog::count();
            } catch (Throwable) {
            }
        }

        return [
            'package' => 'imrandevbd/laravel-ai-hub',
            'name' => 'AI Hub (Multi-Provider AI Gateway)',
            'installed' => $installed,
            'version' => 'v1.7.3',
            'configured' => $configured,
            'enabled' => true,
            'status' => $installed ? 'healthy' : 'error',
            'last_used' => now()->toIso8601String(),
            'message' => "AI Hub active with dynamic provider routing ({$logCount} AI requests logged)",
            'metrics' => [
                'default_provider' => config('ai-hub.default_provider', 'gemini'),
                'total_ai_requests' => $logCount,
            ],
        ];
    }
}
