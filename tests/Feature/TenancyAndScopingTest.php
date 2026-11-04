<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Modules\Core\Models\Branch;
use App\Modules\Core\Models\Business;
use App\Services\Tenancy\TenantContext;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TenancyAndScopingTest extends TestCase
{
    use RefreshDatabase;

    public function test_business_and_branches_auto_generate_universal_slugs(): void
    {
        $business = Business::create([
            'name' => 'বিশ্বমানের অনলাইন একাডেমি', // Bengali Unicode Title
            'email' => 'academy@test.com',
        ]);

        $this->assertNotEmpty($business->slug);

        $branch = Branch::create([
            'business_id' => $business->id,
            'name' => 'মেইন শাখা',
            'city' => 'ঢাকা',
            'is_main' => true,
        ]);

        $this->assertNotEmpty($branch->slug);
        $this->assertEquals($business->id, $branch->business_id);
    }

    public function test_tenant_context_switches_and_isolates_branch_queries(): void
    {
        $biz1 = Business::create(['name' => 'Business One', 'slug' => 'biz-one']);
        $biz2 = Business::create(['name' => 'Business Two', 'slug' => 'biz-two']);

        $branch1 = Branch::create(['business_id' => $biz1->id, 'name' => 'Campus 1', 'slug' => 'c1']);
        $branch2 = Branch::create(['business_id' => $biz2->id, 'name' => 'Campus 2', 'slug' => 'c2']);

        /** @var TenantContext $context */
        $context = app(TenantContext::class);

        // Under Biz1, Branch::all() should only return branch1
        $context->setBusiness($biz1);
        $branchesForBiz1 = Branch::all();
        $this->assertCount(1, $branchesForBiz1);
        $this->assertEquals($branch1->id, $branchesForBiz1->first()->id);

        // Under Biz2, Branch::all() should only return branch2
        $context->setBusiness($biz2);
        $branchesForBiz2 = Branch::all();
        $this->assertCount(1, $branchesForBiz2);
        $this->assertEquals($branch2->id, $branchesForBiz2->first()->id);

        // Without scoping, all branches returned
        $context->disableScoping();
        $this->assertCount(2, Branch::all());
    }
}
