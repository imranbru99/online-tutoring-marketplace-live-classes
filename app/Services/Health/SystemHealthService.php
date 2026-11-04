<?php

declare(strict_types=1);

namespace App\Services\Health;

use App\Modules\Core\Models\SystemHealthLog;
use App\Services\AdminPanel\AdminPanelService;
use App\Services\Ai\AiService;
use App\Services\Attendance\AttendanceService;
use App\Services\Catalog\CatalogScraperService;
use App\Services\Pdf\PdfService;
use App\Services\Performance\PerformanceService;
use App\Services\Slug\SlugService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Throwable;

class SystemHealthService
{
    public function __construct(
        protected PerformanceService $performance,
        protected AdminPanelService $adminPanel,
        protected CatalogScraperService $catalogScraper,
        protected AiService $ai,
        protected AttendanceService $attendance,
        protected PdfService $pdf,
        protected SlugService $slug
    ) {}

    public function checkAll(bool $recordLog = false): array
    {
        $packages = [
            'drutogoti' => $this->performance->getStatus(),
            'admin_panel' => $this->adminPanel->getStatus(),
            'ai_catalog' => $this->catalogScraper->getStatus(),
            'ai_hub' => $this->ai->getStatus(),
            'attendance_hub' => $this->attendance->getStatus(),
            'unicode_pdf' => $this->pdf->getStatus(),
            'universal_slug' => $this->slug->getStatus(),
        ];

        $infrastructure = [
            'database' => $this->checkDatabase(),
            'redis' => $this->checkRedis(),
            'cache' => $this->checkCache(),
            'storage' => $this->checkStorage(),
        ];

        $overallStatus = 'healthy';
        foreach (array_merge($packages, $infrastructure) as $item) {
            if ($item['status'] === 'error') {
                $overallStatus = 'error';
                break;
            }
            if ($item['status'] === 'warning' && $overallStatus !== 'error') {
                $overallStatus = 'warning';
            }
        }

        $result = [
            'overall_status' => $overallStatus,
            'checked_at' => now()->toIso8601String(),
            'mandatory_packages' => $packages,
            'infrastructure' => $infrastructure,
        ];

        if ($recordLog) {
            try {
                SystemHealthLog::create([
                    'check_type' => 'full_system_check',
                    'status' => $overallStatus,
                    'metrics' => $result,
                    'message' => "System health check finished with status: {$overallStatus}",
                ]);
            } catch (Throwable) {
            }
        }

        return $result;
    }

    protected function checkDatabase(): array
    {
        $start = microtime(true);
        try {
            DB::connection()->getPdo();
            $latency = round((microtime(true) - $start) * 1000, 2);

            return [
                'name' => 'Database',
                'status' => 'healthy',
                'connection' => DB::getDefaultConnection(),
                'latency_ms' => $latency,
                'message' => "Connected successfully ({$latency}ms)",
            ];
        } catch (Throwable $e) {
            return [
                'name' => 'Database',
                'status' => 'error',
                'connection' => DB::getDefaultConnection(),
                'latency_ms' => null,
                'message' => 'Connection failed: ' . $e->getMessage(),
            ];
        }
    }

    protected function checkRedis(): array
    {
        $start = microtime(true);
        try {
            Redis::ping();
            $latency = round((microtime(true) - $start) * 1000, 2);

            return [
                'name' => 'Redis',
                'status' => 'healthy',
                'latency_ms' => $latency,
                'message' => "PONG ({$latency}ms)",
            ];
        } catch (Throwable $e) {
            return [
                'name' => 'Redis',
                'status' => 'warning',
                'latency_ms' => null,
                'message' => 'Redis unreachable: ' . $e->getMessage(),
            ];
        }
    }

    protected function checkCache(): array
    {
        $key = '__health_check_' . uniqid();
        try {
            Cache::put($key, 'ok', 10);
            $val = Cache::get($key);
            Cache::forget($key);

            $ok = ($val === 'ok');

            return [
                'name' => 'Cache Store',
                'status' => $ok ? 'healthy' : 'error',
                'store' => config('cache.default'),
                'message' => $ok ? 'Read/write operational' : 'Read/write verification failed',
            ];
        } catch (Throwable $e) {
            return [
                'name' => 'Cache Store',
                'status' => 'error',
                'store' => config('cache.default'),
                'message' => 'Cache failed: ' . $e->getMessage(),
            ];
        }
    }

    protected function checkStorage(): array
    {
        try {
            $disk = Storage::disk('local');
            $testFile = '__health_test_' . uniqid() . '.txt';
            $disk->put($testFile, 'health check');
            $disk->delete($testFile);

            return [
                'name' => 'Local Storage',
                'status' => 'healthy',
                'message' => 'Storage disk is writable and readable',
            ];
        } catch (Throwable $e) {
            return [
                'name' => 'Local Storage',
                'status' => 'error',
                'message' => 'Storage test failed: ' . $e->getMessage(),
            ];
        }
    }
}
