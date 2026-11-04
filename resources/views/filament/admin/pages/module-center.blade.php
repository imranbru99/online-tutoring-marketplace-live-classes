<x-filament-panels::page>
    <div class="space-y-6">
        <!-- Preset Selector Card -->
        <div class="p-6 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Business Architecture Presets</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Quickly configure your entire platform for specific operational models. Everything remains fully customizable afterwards.
                    </p>
                </div>
                <div class="flex items-center gap-3">
                    <select wire:model.live="selectedPreset" class="text-sm rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-primary-500">
                        @foreach($this->presets as $pKey => $pInfo)
                            <option value="{{ $pKey }}">{{ $pInfo['name'] }}</option>
                        @endforeach
                    </select>
                    <x-filament::button wire:click="applySelectedPreset" color="primary">
                        Apply Preset
                    </x-filament::button>
                </div>
            </div>
            @if(isset($this->presets[$selectedPreset]))
                <div class="mt-3 text-xs text-primary-600 dark:text-primary-400 bg-primary-50 dark:bg-primary-950/40 p-2.5 rounded-lg border border-primary-200 dark:border-primary-800">
                    <strong>Preset Focus:</strong> {{ $this->presets[$selectedPreset]['description'] }}
                </div>
            @endif
        </div>

        <!-- Filter bar -->
        <div class="flex items-center justify-between gap-4">
            <div class="relative w-full max-w-sm">
                <input type="text" wire:model.live.debounce.250ms="searchQuery" placeholder="Search modules, tags, keys..." class="w-full text-sm pl-9 pr-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white focus:ring-primary-500">
                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <div class="text-sm text-gray-500 dark:text-gray-400">
                Found {{ count($this->modules) }} modules
            </div>
        </div>

        <!-- Module Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($this->modules as $mod)
                <div class="flex flex-col justify-between p-5 bg-white dark:bg-gray-800 rounded-xl border {{ $mod['is_enabled'] ? 'border-primary-500/40 shadow-sm' : 'border-gray-200 dark:border-gray-700 opacity-75' }}">
                    <div>
                        <div class="flex items-start justify-between gap-2 mb-2">
                            <div>
                                <h4 class="font-bold text-base text-gray-900 dark:text-white flex items-center gap-2">
                                    {{ $mod['name'] }}
                                    @if(!empty($mod['always_enabled']))
                                        <span class="text-[10px] uppercase font-bold tracking-wider px-1.5 py-0.5 rounded bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300">Core</span>
                                    @endif
                                </h4>
                                <span class="text-xs font-mono text-gray-400 dark:text-gray-500">[{{ $mod['key'] }}]</span>
                            </div>
                            <div>
                                @if(!empty($mod['always_enabled']))
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-300">
                                        Always Active
                                    </span>
                                @else
                                    <button 
                                        type="button" 
                                        wire:click="toggleModule('{{ $mod['key'] }}')"
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium transition {{ $mod['is_enabled'] ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 hover:bg-green-200' : 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400 hover:bg-gray-200' }}">
                                        {{ $mod['is_enabled'] ? 'Enabled' : 'Disabled' }}
                                    </button>
                                @endif
                            </div>
                        </div>
                        <p class="text-xs text-gray-600 dark:text-gray-300 mb-3 leading-relaxed">
                            {{ $mod['description'] }}
                        </p>
                    </div>

                    <div class="pt-3 border-t border-gray-100 dark:border-gray-700/60 flex items-center justify-between text-[11px] text-gray-400">
                        <div>
                            @if(!empty($mod['dependencies']))
                                <span class="font-medium text-gray-500">Requires:</span>
                                @foreach($mod['dependencies'] as $dep)
                                    <span class="inline-block px-1.5 py-0.5 bg-gray-100 dark:bg-gray-700 rounded text-gray-600 dark:text-gray-300">{{ $dep }}</span>
                                @endforeach
                            @else
                                <span class="text-gray-400">No dependencies</span>
                            @endif
                        </div>
                        <span class="font-mono">v{{ $mod['version'] ?? '1.0.0' }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-filament-panels::page>
