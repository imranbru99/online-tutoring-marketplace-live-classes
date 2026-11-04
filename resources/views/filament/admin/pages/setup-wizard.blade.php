<x-filament-panels::page>
    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Step progress indicator -->
        <div class="flex items-center justify-between border-b border-gray-200 dark:border-gray-700 pb-4">
            <div class="flex items-center gap-3">
                <span class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold {{ $currentStep >= 1 ? 'bg-primary-600 text-white' : 'bg-gray-200 text-gray-600' }}">1</span>
                <span class="text-sm font-medium {{ $currentStep === 1 ? 'text-primary-600 font-bold' : 'text-gray-500' }}">Architecture Preset</span>
            </div>
            <div class="flex-1 h-0.5 mx-4 {{ $currentStep >= 2 ? 'bg-primary-600' : 'bg-gray-200 dark:bg-gray-700' }}"></div>
            <div class="flex items-center gap-3">
                <span class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold {{ $currentStep >= 2 ? 'bg-primary-600 text-white' : 'bg-gray-200 text-gray-600' }}">2</span>
                <span class="text-sm font-medium {{ $currentStep === 2 ? 'text-primary-600 font-bold' : 'text-gray-500' }}">Branding & Locale</span>
            </div>
            <div class="flex-1 h-0.5 mx-4 {{ $currentStep >= 3 ? 'bg-primary-600' : 'bg-gray-200 dark:bg-gray-700' }}"></div>
            <div class="flex items-center gap-3">
                <span class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold {{ $currentStep >= 3 ? 'bg-primary-600 text-white' : 'bg-gray-200 text-gray-600' }}">3</span>
                <span class="text-sm font-medium {{ $currentStep === 3 ? 'text-primary-600 font-bold' : 'text-gray-500' }}">Campus & Launch</span>
            </div>
        </div>

        @if($currentStep === 1)
            <!-- Step 1: Preset -->
            <div class="p-6 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm space-y-4">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Choose Your Business Model</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Select how your tutoring organization will operate. This automatically enables the ideal set of modules.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2">
                    @foreach($this->presets as $pKey => $preset)
                        <label class="relative flex flex-col p-4 border rounded-xl cursor-pointer transition {{ $businessType === $pKey ? 'border-primary-600 bg-primary-50/40 dark:bg-primary-950/30' : 'border-gray-200 dark:border-gray-700 hover:border-gray-300' }}">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-bold text-sm text-gray-900 dark:text-white">{{ $preset['name'] }}</span>
                                <input type="radio" wire:model.live="businessType" value="{{ $pKey }}" class="text-primary-600 focus:ring-primary-500">
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $preset['description'] }}
                            </p>
                        </label>
                    @endforeach
                </div>

                <div class="pt-4 flex justify-end">
                    <x-filament::button wire:click="nextStep">
                        Continue to Branding &rarr;
                    </x-filament::button>
                </div>
            </div>
        @elseif($currentStep === 2)
            <!-- Step 2: Branding -->
            <div class="p-6 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm space-y-4">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Branding & Regional Settings</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Personalize your brand identity, primary currency, and base timezone.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 mb-1">Organization Name</label>
                        <input type="text" wire:model="businessName" class="w-full text-sm rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 mb-1">Contact Email</label>
                        <input type="email" wire:model="contactEmail" class="w-full text-sm rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 mb-1">Primary Color (Hex)</label>
                        <input type="text" wire:model="primaryColor" class="w-full text-sm rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 mb-1">Default Currency</label>
                        <select wire:model="defaultCurrency" class="w-full text-sm rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            <option value="USD">USD ($) - US Dollar</option>
                            <option value="BDT">BDT (৳) - Bangladeshi Taka</option>
                            <option value="EUR">EUR (€) - Euro</option>
                            <option value="GBP">GBP (£) - British Pound</option>
                            <option value="SAR">SAR (﷼) - Saudi Riyal</option>
                            <option value="AED">AED (د.إ) - UAE Dirham</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 mb-1">Default Timezone</label>
                        <input type="text" wire:model="defaultTimezone" class="w-full text-sm rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 mb-1">Default Language</label>
                        <select wire:model="defaultLanguage" class="w-full text-sm rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            <option value="en">English (US/UK)</option>
                            <option value="bn">Bangla (বাংলা)</option>
                            <option value="ar">Arabic (العربية - RTL)</option>
                            <option value="es">Spanish (Español)</option>
                            <option value="fr">French (Français)</option>
                        </select>
                    </div>
                </div>

                <div class="pt-4 flex justify-between">
                    <x-filament::button wire:click="previousStep" color="gray">
                        &larr; Back
                    </x-filament::button>
                    <x-filament::button wire:click="nextStep">
                        Continue to Branch Setup &rarr;
                    </x-filament::button>
                </div>
            </div>
        @elseif($currentStep === 3)
            <!-- Step 3: Branch & Go Live -->
            <div class="p-6 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm space-y-4">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Main Branch / Campus Setup</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Configure your primary branch (virtual or physical) to activate scheduling and bookings.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 mb-1">Main Branch Name</label>
                        <input type="text" wire:model="mainBranchName" class="w-full text-sm rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 mb-1">City / Region</label>
                        <input type="text" wire:model="mainBranchCity" class="w-full text-sm rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    </div>
                </div>

                <div class="p-4 rounded-lg bg-green-50 dark:bg-green-950/40 border border-green-200 dark:border-green-800 text-xs text-green-800 dark:text-green-300 space-y-1">
                    <p class="font-bold">Ready to Launch:</p>
                    <ul class="list-disc list-inside space-y-0.5">
                        <li>All selected modules will be initialized with strict dependency enforcement.</li>
                        <li>Branding, timezone, and multi-lingual presets will be persisted.</li>
                        <li>Role-based panels will become immediately operational.</li>
                    </ul>
                </div>

                <div class="pt-4 flex justify-between">
                    <x-filament::button wire:click="previousStep" color="gray">
                        &larr; Back
                    </x-filament::button>
                    <x-filament::button wire:click="nextStep" color="success">
                        Complete Setup & Launch &rarr;
                    </x-filament::button>
                </div>
            </div>
        @else
            <!-- Step 4: Finished -->
            <div class="p-8 bg-white dark:bg-gray-800 rounded-xl border border-green-300 dark:border-green-700 shadow-sm text-center space-y-4">
                <div class="w-16 h-16 bg-green-100 text-green-600 dark:bg-green-900/50 dark:text-green-300 rounded-full flex items-center justify-center mx-auto">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Workspace Successfully Initialized!</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 max-w-md mx-auto">
                    Your platform has been configured with the <strong class="text-gray-900 dark:text-white">{{ $businessName }}</strong> profile and is ready for tutors, students, and live classes.
                </p>
                <div class="pt-4 flex justify-center gap-3">
                    <a href="{{ url('/admin/module-center') }}" class="inline-flex items-center px-4 py-2 rounded-lg bg-primary-600 text-white font-medium text-sm hover:bg-primary-700">
                        Open Module Center
                    </a>
                    <a href="{{ url('/admin') }}" class="inline-flex items-center px-4 py-2 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-medium text-sm hover:bg-gray-200">
                        Admin Dashboard
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-filament-panels::page>
