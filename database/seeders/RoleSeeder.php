<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $roles = [
            'super_admin' => 'Platform Super Administrator with complete system access.',
            'business_admin' => 'Tutoring business owner/admin managing settings, branches, and staff.',
            'branch_manager' => 'Branch manager managing local staff, schedules, and attendance.',
            'tutor' => 'Independent or institution tutor conducting lessons.',
            'student' => 'Learner booking classes, submitting homework, taking quizzes.',
            'guardian' => 'Parent or legal guardian monitoring and paying for minors.',
            'support_agent' => 'Support representative handling customer tickets and chats.',
            'moderator' => 'Content and dispute resolver reviewing flags and evidence.',
            'finance_manager' => 'Accountant managing payments, payouts, taxes, and ledgers.',
            'content_manager' => 'Content creator managing blog, SEO, and course listings.',
            'academic_coordinator' => 'Curriculum coordinator reviewing syllabus and tutor quality.',
            'institution_admin' => 'Corporate or school buyer managing bulk learners.',
            'affiliate_partner' => 'Affiliate earning commissions for referral enrollments.',
            'guest' => 'Public visitor browsing tutors and courses.',
        ];

        foreach ($roles as $roleName => $desc) {
            Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
        }

        $permissions = [
            'view-admin',
            'manage-modules',
            'manage-settings',
            'manage-branches',
            'view-system-health',
            'manage-users',
            'manage-roles',
            'manage-tutors',
            'manage-students',
            'manage-bookings',
            'manage-classes',
            'manage-payments',
            'manage-payouts',
            'manage-content',
            'view-reports',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'web']);
        }

        // Assign all permissions to super_admin and business_admin
        $superRole = Role::findByName('super_admin', 'web');
        $superRole->givePermissionTo(Permission::all());

        $adminRole = Role::findByName('business_admin', 'web');
        $adminRole->givePermissionTo(Permission::all());
    }
}
