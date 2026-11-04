<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\RoleSeeder;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RolesAndPermissionsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleSeeder::class);
    }

    public function test_super_admin_has_access_to_all_panels(): void
    {
        $user = User::factory()->create(['status' => 'active']);
        $user->assignRole('super_admin');

        $panels = ['super-admin', 'admin', 'branch', 'tutor', 'student', 'guardian', 'support', 'finance'];

        foreach ($panels as $pId) {
            $panel = Filament::getPanel($pId);
            $this->assertTrue($user->canAccessPanel($panel), "Super admin should access [{$pId}]");
        }
    }

    public function test_tutor_role_can_only_access_tutor_panel(): void
    {
        $user = User::factory()->create(['status' => 'active']);
        $user->assignRole('tutor');

        $tutorPanel = Filament::getPanel('tutor');
        $adminPanel = Filament::getPanel('admin');
        $studentPanel = Filament::getPanel('student');

        $this->assertTrue($user->canAccessPanel($tutorPanel));
        $this->assertFalse($user->canAccessPanel($adminPanel));
        $this->assertFalse($user->canAccessPanel($studentPanel));
    }

    public function test_student_role_can_only_access_student_panel(): void
    {
        $user = User::factory()->create(['status' => 'active']);
        $user->assignRole('student');

        $studentPanel = Filament::getPanel('student');
        $tutorPanel = Filament::getPanel('tutor');
        $adminPanel = Filament::getPanel('admin');

        $this->assertTrue($user->canAccessPanel($studentPanel));
        $this->assertFalse($user->canAccessPanel($tutorPanel));
        $this->assertFalse($user->canAccessPanel($adminPanel));
    }

    public function test_inactive_user_is_denied_access_to_all_panels(): void
    {
        $user = User::factory()->create(['status' => 'inactive']);
        $user->assignRole('super_admin');

        $panel = Filament::getPanel('admin');
        $this->assertFalse($user->canAccessPanel($panel));
    }
}
