<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Facades\Module;
use App\Facades\Setting;
use App\Filament\Admin\Pages\SetupWizard;
use App\Modules\Core\Models\Business;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class SetupWizardTest extends TestCase
{
    use RefreshDatabase;

    public function test_setup_wizard_can_be_completed_and_configures_workspace(): void
    {
        $business = Business::create([
            'name' => 'Initial Academy',
            'slug' => 'initial-academy',
        ]);

        Livewire::test(SetupWizard::class)
            ->set('businessType', 'exam-prep')
            ->set('businessName', 'Oxford Exam Prep')
            ->set('contactEmail', 'oxford@test.com')
            ->set('defaultCurrency', 'GBP')
            ->set('defaultLanguage', 'en')
            ->call('nextStep') // step 2
            ->call('nextStep') // step 3
            ->call('nextStep') // step 4 (completes and saves)
            ->assertSet('currentStep', 4);

        // Verify settings updated
        $this->assertEquals('Oxford Exam Prep', Setting::get('site_name', null, (int) $business->id));
        $this->assertEquals('GBP', Setting::get('default_currency', null, (int) $business->id));

        // Verify exam-prep preset applied
        $this->assertTrue(Module::enabled('quizzes', (int) $business->id));
        $this->assertTrue(Module::enabled('ai-assistant', (int) $business->id));
    }
}
