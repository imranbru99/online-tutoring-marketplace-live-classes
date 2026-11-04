<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Facades\Module;
use App\Modules\Core\Models\Business;
use App\Services\Module\ModuleManager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModuleManagerTest extends TestCase
{
    use RefreshDatabase;

    public function test_module_manager_discovers_all_catalog_modules(): void
    {
        $modules = Module::all();

        $this->assertGreaterThanOrEqual(50, $modules->count());
        $this->assertTrue(Module::has('core'));
        $this->assertTrue(Module::has('tutors'));
        $this->assertTrue(Module::has('live-classroom'));
        $this->assertTrue(Module::has('payments'));
    }

    public function test_core_module_is_always_enabled_and_cannot_be_disabled(): void
    {
        $this->assertTrue(Module::enabled('core'));

        $result = Module::disable('core');
        $this->assertFalse($result['success']);
        $this->assertStringContainsString('Core module is essential', $result['error']);

        $this->assertTrue(Module::enabled('core'));
    }

    public function test_can_enable_and_disable_a_standard_module(): void
    {
        $business = Business::create([
            'name' => 'Acme Academy',
            'slug' => 'acme-academy',
        ]);

        // Disable marketing crm
        $disableResult = Module::disable('crm', (int) $business->id);
        $this->assertTrue($disableResult['success']);
        $this->assertFalse(Module::enabled('crm', (int) $business->id));

        // Re-enable marketing crm
        $enableResult = Module::enable('crm', (int) $business->id);
        $this->assertTrue($enableResult['success']);
        $this->assertTrue(Module::enabled('crm', (int) $business->id));
    }

    public function test_cannot_disable_module_if_other_enabled_modules_depend_on_it(): void
    {
        $business = Business::create([
            'name' => 'Apex Tutoring',
            'slug' => 'apex-tutoring',
        ]);

        // Ensure both live-classroom and recordings are enabled
        Module::enable('live-classroom', (int) $business->id);
        Module::enable('recordings', (int) $business->id);

        // Attempt to disable live-classroom while recordings depends on it
        $result = Module::disable('live-classroom', (int) $business->id);
        $this->assertFalse($result['success']);
        $this->assertStringContainsString('active modules depend on it', $result['error']);

        // live-classroom should remain enabled
        $this->assertTrue(Module::enabled('live-classroom', (int) $business->id));
    }

    public function test_presets_can_be_applied_to_a_business(): void
    {
        $business = Business::create([
            'name' => 'Solo Math Expert',
            'slug' => 'solo-math-expert',
        ]);

        $result = Module::applyPreset('solo-tutor', (int) $business->id);
        $this->assertTrue($result['success']);

        // Solo tutor includes tutors, calendar, bookings
        $this->assertTrue(Module::enabled('tutors', (int) $business->id));
        $this->assertTrue(Module::enabled('calendar', (int) $business->id));
        $this->assertTrue(Module::enabled('bookings', (int) $business->id));

        // Solo tutor preset does not enable group-classes or institutions
        $this->assertFalse(Module::enabled('group-classes', (int) $business->id));
        $this->assertFalse(Module::enabled('institutions', (int) $business->id));
    }
}
