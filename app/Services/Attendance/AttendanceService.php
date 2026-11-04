<?php

declare(strict_types=1);

namespace App\Services\Attendance;

use ImranDevBd\AttendanceHub\Facades\AttendanceHub;
use ImranDevBd\AttendanceHub\Models\AttendanceDevice;
use ImranDevBd\AttendanceHub\Models\AttendanceLog;
use Throwable;

class AttendanceService
{
    public function catalog(): mixed
    {
        return AttendanceHub::catalog();
    }

    public function fake(array $initialPunches = []): mixed
    {
        return AttendanceHub::fake($initialPunches);
    }

    public function sync(AttendanceDevice|int|string $device): mixed
    {
        return AttendanceHub::sync($device);
    }

    public function autoDetect(string $ip, int $timeout = 3): mixed
    {
        return AttendanceHub::autoDetect($ip, $timeout);
    }

    public function getStatus(): array
    {
        $installed = class_exists(\ImranDevBd\AttendanceHub\AttendanceHubServiceProvider::class);
        $configured = config('attendance-hub') !== null;
        $deviceCount = 0;
        $punchCount = 0;

        if ($installed) {
            try {
                $deviceCount = AttendanceDevice::count();
                $punchCount = AttendanceLog::count();
            } catch (Throwable) {
            }
        }

        return [
            'package' => 'imrandevbd/laravel-attendance-hub',
            'name' => 'Attendance Hub (Biometric / Hardware Gateway)',
            'installed' => $installed,
            'version' => 'dev-main',
            'configured' => $configured,
            'enabled' => true,
            'status' => $installed ? 'healthy' : 'error',
            'last_used' => now()->toIso8601String(),
            'message' => "Attendance Hub ready ({$deviceCount} devices registered, {$punchCount} punches recorded)",
            'metrics' => [
                'registered_devices' => $deviceCount,
                'total_punches' => $punchCount,
            ],
        ];
    }
}
