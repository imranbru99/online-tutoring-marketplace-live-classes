<x-filament-panels::page>
    <div class="space-y-6">
        <!-- Header status banner -->
        <div class="p-6 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center {{ ($healthData['overall_status'] ?? 'healthy') === 'healthy' ? 'bg-green-100 text-green-600 dark:bg-green-900/40 dark:text-green-400' : 'bg-red-100 text-red-600 dark:bg-red-900/40 dark:text-red-400' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                        System Status: 
                        <span class="capitalize {{ ($healthData['overall_status'] ?? 'healthy') === 'healthy' ? 'text-green-600' : 'text-red-600' }}">
                            {{ $healthData['overall_status'] ?? 'Operational' }}
                        </span>
                    </h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        Last audited: {{ isset($healthData['checked_at']) ? \Carbon\Carbon::parse($healthData['checked_at'])->diffForHumans() : 'Just now' }}
                    </p>
                </div>
            </div>
            <div>
                <x-filament::button wire:click="refreshStatus(app(\App\Services\Health\SystemHealthService::class))" color="gray" icon="heroicon-o-arrow-path">
                    Run Fresh Diagnostics
                </x-filament::button>
            </div>
        </div>

        <!-- Mandatory Packages Section -->
        <div>
            <h3 class="text-base font-bold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                <span>Core Ecosystem Packages</span>
                <span class="text-xs font-normal text-gray-400">(7 Mandatory Packages)</span>
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach(($healthData['mandatory_packages'] ?? []) as $key => $pkg)
                    <div class="p-5 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm flex flex-col justify-between">
                        <div>
                            <div class="flex items-start justify-between gap-2 mb-2">
                                <div>
                                    <h4 class="font-bold text-sm text-gray-900 dark:text-white">{{ $pkg['name'] }}</h4>
                                    <span class="text-xs font-mono text-gray-400">{{ $pkg['package'] }}</span>
                                </div>
                                <div>
                                    @if(($pkg['status'] ?? '') === 'healthy')
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-300">
                                            Online
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-300">
                                            {{ $pkg['status'] ?? 'Issue' }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <p class="text-xs text-gray-600 dark:text-gray-300 mb-3">
                                {{ $pkg['message'] }}
                            </p>
                        </div>
                        <div class="pt-3 border-t border-gray-100 dark:border-gray-700/60 flex items-center justify-between text-[11px] text-gray-400">
                            <span>Version: {{ $pkg['version'] }}</span>
                            <span class="text-green-600 dark:text-green-400">Configured</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Infrastructure Section -->
        <div>
            <h3 class="text-base font-bold text-gray-900 dark:text-white mb-3">
                Infrastructure & Connectivity
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach(($healthData['infrastructure'] ?? []) as $key => $infra)
                    <div class="p-4 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">{{ $infra['name'] }}</span>
                            <span class="w-2 h-2 rounded-full {{ ($infra['status'] ?? '') === 'healthy' ? 'bg-green-500' : 'bg-yellow-500' }}"></span>
                        </div>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white mb-1">
                            {{ $infra['message'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-filament-panels::page>
