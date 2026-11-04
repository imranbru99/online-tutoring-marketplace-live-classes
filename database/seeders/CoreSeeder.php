<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Facades\Module;
use App\Facades\Setting;
use App\Models\User;
use App\Modules\Core\Models\Branch;
use App\Modules\Core\Models\Business;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CoreSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        // 1. Create Default Flagship Business
        $business = Business::firstOrCreate(
            ['slug' => 'eduhub-global'],
            [
                'name' => 'EduHub Global Academy',
                'domain' => 'eduhub.test',
                'subdomain' => 'global',
                'email' => 'admin@eduhub.test',
                'phone' => '+8801700000000',
                'primary_color' => '#4f46e5',
                'default_language' => 'en',
                'default_currency' => 'USD',
                'default_timezone' => 'UTC',
                'mode' => 'single',
                'status' => 'active',
            ]
        );

        // 2. Create Branches
        $mainBranch = Branch::firstOrCreate(
            ['business_id' => $business->id, 'slug' => 'online-global'],
            [
                'name' => 'Online Global Campus',
                'code' => 'BR-GLOBAL-01',
                'email' => 'global@eduhub.test',
                'phone' => '+8801700000001',
                'city' => 'Virtual Campus',
                'country' => 'Global',
                'timezone' => 'UTC',
                'is_main' => true,
                'status' => 'active',
            ]
        );

        $dhakaBranch = Branch::firstOrCreate(
            ['business_id' => $business->id, 'slug' => 'dhaka-campus'],
            [
                'name' => 'Dhaka Tech & Language Center',
                'code' => 'BR-DHK-01',
                'email' => 'dhaka@eduhub.test',
                'phone' => '+8801700000002',
                'address' => 'Gulshan 2, Road 45',
                'city' => 'Dhaka',
                'country' => 'BD',
                'timezone' => 'Asia/Dhaka',
                'is_main' => false,
                'status' => 'active',
            ]
        );

        $londonBranch = Branch::firstOrCreate(
            ['business_id' => $business->id, 'slug' => 'london-campus'],
            [
                'name' => 'London STEM Academy',
                'code' => 'BR-LON-01',
                'email' => 'london@eduhub.test',
                'phone' => '+442079460991',
                'address' => 'Holborn Street, Central London',
                'city' => 'London',
                'country' => 'GB',
                'timezone' => 'Europe/London',
                'is_main' => false,
                'status' => 'active',
            ]
        );

        // 3. Apply default preset to business
        Module::applyPreset('tutoring-marketplace', (int) $business->id);

        // 4. Configure core settings
        Setting::set('site_name', 'EduHub Global Academy', 'general', (int) $business->id);
        Setting::set('site_tagline', 'Premier Online Tutoring Marketplace & Live Classes', 'general', (int) $business->id);
        Setting::set('contact_email', 'admin@eduhub.test', 'general', (int) $business->id);
        Setting::set('contact_phone', '+8801700000000', 'general', (int) $business->id);
        Setting::set('default_currency', 'USD', 'localization', (int) $business->id);
        Setting::set('default_timezone', 'UTC', 'localization', (int) $business->id);
        Setting::set('default_language', 'en', 'localization', (int) $business->id);

        // 5. Seed Core Demo Accounts for all user roles (Section 7)
        $password = Hash::make('password');

        $users = [
            [
                'email' => 'superadmin@demo.test',
                'name' => 'Alex Vance (Super Admin)',
                'role' => 'super_admin',
                'business_id' => null, // Super Admin is platform global
                'branch_id' => null,
            ],
            [
                'email' => 'owner@demo.test',
                'name' => 'Sarah Jenkins (Business Owner)',
                'role' => 'business_admin',
                'business_id' => $business->id,
                'branch_id' => $mainBranch->id,
            ],
            [
                'email' => 'branch@demo.test',
                'name' => 'Farhan Ahmed (Branch Manager)',
                'role' => 'branch_manager',
                'business_id' => $business->id,
                'branch_id' => $dhakaBranch->id,
            ],
            [
                'email' => 'tutor1@demo.test',
                'name' => 'Dr. Elena Rostova (Math & Physics Tutor)',
                'role' => 'tutor',
                'business_id' => $business->id,
                'branch_id' => $mainBranch->id,
            ],
            [
                'email' => 'student1@demo.test',
                'name' => 'David Kim (Student)',
                'role' => 'student',
                'business_id' => $business->id,
                'branch_id' => $mainBranch->id,
            ],
            [
                'email' => 'guardian1@demo.test',
                'name' => 'Rachel Kim (Parent / Guardian)',
                'role' => 'guardian',
                'business_id' => $business->id,
                'branch_id' => $mainBranch->id,
            ],
            [
                'email' => 'support@demo.test',
                'name' => 'Liam O\'Connor (Support Agent)',
                'role' => 'support_agent',
                'business_id' => $business->id,
                'branch_id' => $mainBranch->id,
            ],
            [
                'email' => 'moderator@demo.test',
                'name' => 'Aisha Rahman (Moderator)',
                'role' => 'moderator',
                'business_id' => $business->id,
                'branch_id' => $mainBranch->id,
            ],
            [
                'email' => 'finance@demo.test',
                'name' => 'Marcus Sterling (Finance Manager)',
                'role' => 'finance_manager',
                'business_id' => $business->id,
                'branch_id' => $mainBranch->id,
            ],
            [
                'email' => 'content@demo.test',
                'name' => 'Maya Patel (Content Manager)',
                'role' => 'content_manager',
                'business_id' => $business->id,
                'branch_id' => $mainBranch->id,
            ],
            [
                'email' => 'academic@demo.test',
                'name' => 'Prof. Julian Thorne (Academic Coordinator)',
                'role' => 'academic_coordinator',
                'business_id' => $business->id,
                'branch_id' => $londonBranch->id,
            ],
            [
                'email' => 'institution@demo.test',
                'name' => 'St. Jude International Academy (Institution Admin)',
                'role' => 'institution_admin',
                'business_id' => $business->id,
                'branch_id' => $mainBranch->id,
            ],
            [
                'email' => 'affiliate@demo.test',
                'name' => 'EduGrowth Partners (Affiliate)',
                'role' => 'affiliate_partner',
                'business_id' => $business->id,
                'branch_id' => $mainBranch->id,
            ],
        ];

        foreach ($users as $u) {
            $user = User::updateOrCreate(
                ['email' => $u['email']],
                [
                    'name' => $u['name'],
                    'password' => $password,
                    'business_id' => $u['business_id'],
                    'current_branch_id' => $u['branch_id'],
                    'status' => 'active',
                    'timezone' => 'UTC',
                    'locale' => 'en',
                    'email_verified_at' => now(),
                ]
            );

            $user->syncRoles([$u['role']]);

            if ($u['branch_id']) {
                $user->branches()->syncWithoutDetaching([
                    $u['branch_id'] => ['is_primary' => true, 'role' => $u['role']],
                ]);
            }
        }
    }
}
