<x-layouts.app title="Route Sheets" active="route-sheets.index">
    <x-page-header title="Route Sheets" subtitle="Printable daily sheets issued to each driver.">
        <x-slot:actions>
            <x-button color="secondary" icon="printer">Print All</x-button>
            <x-button color="primary" icon="document-arrow-down">Export</x-button>
        </x-slot:actions>
    </x-page-header>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($drivers as $driveIndex => $driver)
            @php
                $truck = $trucks[$driveIndex] ?? ['number' => $driver['truck']];
            @endphp
            <div class="card-lift rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="flex size-11 items-center justify-center rounded-full text-sm font-bold text-white {{ $driver['color'] }}">
                            {{ $driver['initials'] }}
                        </span>
                        <div>
                            <h3 class="font-semibold text-slate-900 dark:text-white">{{ $driver['name'] }}</h3>
                            <p class="text-sm text-slate-500 dark:text-slate-400">{{ $driver['truck'] }} · {{ $truck['route'] ?? '' }}</p>
                        </div>
                    </div>
                    <x-badge color="primary">{{ $driver['stops'] }} stops</x-badge>
                </div>

                <div class="mt-4 flex items-center gap-2 border-t border-slate-100 pt-4 dark:border-slate-800">
                    <x-button href="{{ route('route-sheets.show', $driver['id']) }}" color="primary" size="sm" class="flex-1" icon="eye">Open Sheet</x-button>
                    <x-button color="secondary" size="sm" class="flex-1" icon="printer">Print</x-button>
                </div>
            </div>
        @endforeach
    </div>
</x-layouts.app>