<?php

declare(strict_types=1);

namespace App\Services\Performance;

use Drutogoti\Models\QueryLog;
use Drutogoti\Models\Suggestion;
use Throwable;

class PerformanceService
{
    public function isEnabled(): bool
    {
        return (bool) config('drutogoti.enabled', false);
    }

    public function getStatus(): array
    {
        $installed = class_exists(\Drutogoti\DrutogotiServiceProvider::class);
        $configured = config('drutogoti') !== null;
        $enabled = $this->isEnabled();

        $queryCount = 0;
        $suggestionCount = 0;

        if ($installed) {
            try {
                $queryCount = QueryLog::count();
                $suggestionCount = Suggestion::count();
            } catch (Throwable) {
                // Table might not exist or empty
            }
        }

        return [
            'package' => 'imrandevbd/drutogoti',
            'name' => 'Drutogoti Performance Optimizer',
            'installed' => $installed,
            'version' => 'dev-main',
            'configured' => $configured,
            'enabled' => $enabled,
            'status' => $installed ? 'healthy' : 'error',
            'last_used' => now()->toIso8601String(),
            'message' => $enabled 
                ? "Active (Profiled {$queryCount} queries, {$suggestionCount} suggestions)" 
                : 'Installed & ready (profiler disabled in current environment)',
            'metrics' => [
                'captured_queries' => $queryCount,
                'optimization_suggestions' => $suggestionCount,
            ],
        ];
    }

    public function getSlowQueries(int $limit = 10): array
    {
        try {
            return QueryLog::where('is_slow', true)
                ->orderByDesc('time_ms')
                ->limit($limit)
                ->get()
                ->toArray();
        } catch (Throwable) {
            return [];
        }
    }

    public function getOptimizationSuggestions(): array
    {
        try {
            return Suggestion::orderByDesc('created_at')->get()->toArray();
        } catch (Throwable) {
            return [];
        }
    }
}
