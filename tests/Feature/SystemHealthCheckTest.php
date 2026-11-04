<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Modules\Core\Models\SystemHealthLog;
use App\Services\Health\SystemHealthService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SystemHealthCheckTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_seven_mandatory_packages_and_infra_pass_health_checks(): void
    {
        /** @var SystemHealthService $service */
        $service = app(SystemHealthService::class);

        $health = $service->checkAll(recordLog: true);

        // Overall status should be healthy or warning (if redis is not listening in test env)
        $this->assertContains($health['overall_status'], ['healthy', 'warning']);

        // Check 7 mandatory packages
        $packages = $health['mandatory_packages'];
        $this->assertArrayHasKey('drutogoti', $packages);
        $this->assertArrayHasKey('admin_panel', $packages);
        $this->assertArrayHasKey('ai_catalog', $packages);
        $this->assertArrayHasKey('ai_hub', $packages);
        $this->assertArrayHasKey('attendance_hub', $packages);
        $this->assertArrayHasKey('unicode_pdf', $packages);
        $this->assertArrayHasKey('universal_slug', $packages);

        foreach ($packages as $pkgKey => $pkg) {
            $this->assertTrue($pkg['installed'], "Package {$pkgKey} should be installed");
            $this->assertTrue($pkg['configured'], "Package {$pkgKey} should be configured");
            $this->assertEquals('healthy', $pkg['status'], "Package {$pkgKey} should be healthy");
        }

        // Check system health log was recorded
        $this->assertDatabaseHas('system_health_logs', [
            'check_type' => 'full_system_check',
        ]);
    }
}
