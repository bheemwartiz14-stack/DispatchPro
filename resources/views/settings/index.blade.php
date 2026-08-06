<x-layouts.app title="Settings" active="settings.index" x-data="{ tab: 'general' }">
    <x-page-header title="Settings" subtitle="Configure dispatch preferences and system defaults." />

    @php
        $tabs = [
            'general' => ['icon' => 'cog', 'label' => 'General'],
            'dispatch' => ['icon' => 'map', 'label' => 'Dispatch'],
            'appearance' => ['icon' => 'paint', 'label' => 'Appearance'],
            'notifications' => ['icon' => 'bell', 'label' => 'Notifications'],
            'map' => ['icon' => 'photo', 'label' => 'Map'],
            'import' => ['icon' => 'arrow-down-tray', 'label' => 'Import'],
        ];
    @endphp

    <div class="flex flex-col gap-6 lg:flex-row">
        {{-- Tabs --}}
        <nav class="flex shrink-0 gap-2 overflow-x-auto lg:w-56 lg:flex-col">
            @foreach ($tabs as $key => $tab)
                <button
                    type="button"
                    @click="tab = '{{ $key }}'"
                    class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium transition"
                    :class="tab === '{{ $key }}' ? 'bg-blue-50 text-blue-700 dark:bg-blue-950/50 dark:text-blue-300' : 'text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800'"
                >
                    <x-icon :name="$tab['icon']" class="size-5" />
                    {{ $tab['label'] }}
                </button>
            @endforeach
        </nav>

        <div class="min-w-0 flex-1 space-y-6">
            {{-- General --}}
            <x-card x-show="tab === 'general'" x-transition>
                <x-slot:header><h2 class="font-semibold text-slate-900 dark:text-white">General</h2></x-slot:header>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-slate-700 dark:text-slate-200">Resort name</label>
                        <input value="Palm Valley Resort" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/30 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-slate-700 dark:text-slate-200">Default timezone</label>
                        <select class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/30 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                            <option>Pacific Time (US & Canada)</option>
                            <option>Mountain Time</option>
                            <option>Central Time</option>
                            <option>Eastern Time</option>
                        </select>
                    </div>
                </div>
            </x-card>

            {{-- Dispatch --}}
            <x-card x-show="tab === 'dispatch'" x-transition>
                <x-slot:header><h2 class="font-semibold text-slate-900 dark:text-white">Dispatch defaults</h2></x-slot:header>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-slate-700 dark:text-slate-200">Default cart capacity</label>
                        <input type="number" value="4" class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/30 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-slate-700 dark:text-slate-200">Auto-assign on import</label>
                        <div class="mt-2"><x-badge color="warning">Disabled</x-badge></div>
                    </div>
                </div>
            </x-card>

            {{-- Appearance --}}
            <x-card x-show="tab === 'appearance'" x-transition>
                <x-slot:header><h2 class="font-semibold text-slate-900 dark:text-white">Appearance</h2></x-slot:header>
                <div class="flex gap-3">
                    <button @click="$theme('light')" class="flex-1 rounded-xl border-2 border-blue-500 p-4 text-center">
                        <x-icon name="sun" class="mx-auto size-6 text-amber-500" />
                        <p class="mt-2 text-sm font-medium">Light</p>
                    </button>
                    <button @click="$theme('dark')" class="flex-1 rounded-xl border border-slate-200 p-4 text-center dark:border-slate-700">
                        <x-icon name="moon" class="mx-auto size-6 text-slate-500" />
                        <p class="mt-2 text-sm font-medium">Dark</p>
                    </button>
                </div>
            </x-card>

            {{-- Notifications --}}
            <x-card x-show="tab === 'notifications'" x-transition>
                <x-slot:header><h2 class="font-semibold text-slate-900 dark:text-white">Notifications</h2></x-slot:header>
                <ul class="divide-y divide-slate-100 dark:divide-slate-800">
                    @foreach ([
                        'New reservation imported' => 'on',
                        'Truck reaches capacity' => 'on',
                        'Cart maintenance due' => 'on',
                        'Daily dispatch summary' => 'off',
                        'Route optimization complete' => 'on',
                    ] as $label => $state)
                        <li class="flex items-center justify-between py-3">
                            <span class="text-sm text-slate-700 dark:text-slate-200">{{ $label }}</span>
                            <span class="relative inline-flex">
                                <input type="checkbox" {{ $state === 'on' ? 'checked' : '' }} class="peer sr-only">
                                <span class="block h-6 w-11 rounded-full bg-slate-200 peer-checked:bg-blue-600 dark:bg-slate-700"></span>
                                <span class="absolute left-0.5 top-0.5 size-5 rounded-full bg-white transition peer-checked:translate-x-5"></span>
                            </span>
                        </li>
                    @endforeach
                </ul>
            </x-card>

            {{-- Map --}}
            <x-card x-show="tab === 'map'" x-transition>
                <x-slot:header><h2 class="font-semibold text-slate-900 dark:text-white">Map provider</h2></x-slot:header>
                <div class="flex items-center gap-3 rounded-xl bg-slate-50 p-4 text-sm text-slate-500 dark:bg-slate-800/60 dark:text-slate-400">
                    <x-icon name="map" class="size-5 shrink-0" />
                    Google Maps integration is reserved for Phase 2. A map preview is shown on the dispatch board.
                </div>
                <div class="mt-4">
                    <label class="mb-1.5 block text-sm font-medium text-slate-700 dark:text-slate-200">Google Maps API key</label>
                    <input placeholder="Not configured" class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-sm outline-none dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                </div>
            </x-card>

            {{-- Import --}}
            <x-card x-show="tab === 'import'" x-transition>
                <x-slot:header><h2 class="font-semibold text-slate-900 dark:text-white">Import defaults</h2></x-slot:header>
                <div class="space-y-4">
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-slate-700 dark:text-slate-200">Column mapping template</label>
                        <select class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm outline-none dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                            <option>Guest Services Export (Default)</option>
                            <option>Property Management System</option>
                            <option>Custom Template</option>
                        </select>
                    </div>
                    <x-button color="primary">Save Changes</x-button>
                </div>
            </x-card>
        </div>
    </div>
</x-layouts.app>