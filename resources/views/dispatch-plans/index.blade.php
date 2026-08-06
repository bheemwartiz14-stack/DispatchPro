<x-layouts.app title="Dispatch Plans" active="dispatch-plans.index">
    <x-page-header title="Dispatch Plans" subtitle="Create and manage the dispatch waves for each day.">
        <x-slot:actions>
            <x-button color="primary" icon="plus">New Plan</x-button>
        </x-slot:actions>
    </x-page-header>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($plans as $plan)
            <div class="card-lift rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <div class="flex items-start justify-between">
                    <span class="flex size-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-950/50 dark:text-blue-300">
                        <x-icon name="clipboard-list" class="size-6" />
                    </span>
                    <x-status-badge :status="$plan['status']" />
                </div>

                <h3 class="mt-4 font-semibold text-slate-900 dark:text-white">{{ $plan['name'] }}</h3>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ $plan['date'] }}</p>

                <div class="mt-4 grid grid-cols-3 gap-2 border-t border-slate-100 pt-4 text-center dark:border-slate-800">
                    <div>
                        <p class="text-lg font-bold text-slate-900 dark:text-white">{{ $plan['reservations'] }}</p>
                        <p class="text-xs text-slate-400">Reservations</p>
                    </div>
                    <div>
                        <p class="text-lg font-bold text-slate-900 dark:text-white">{{ $plan['drivers'] }}</p>
                        <p class="text-xs text-slate-400">Drivers</p>
                    </div>
                    <div>
                        <p class="text-lg font-bold text-slate-900 dark:text-white">{{ $plan['start'] }}</p>
                        <p class="text-xs text-slate-400">Start</p>
                    </div>
                </div>

                <div class="mt-4 flex items-center gap-2">
                    <x-button href="{{ route('dispatch.index') }}" color="secondary" size="sm" class="flex-1" icon="eye">Open</x-button>
                    <x-button color="secondary" size="sm" class="flex-1" icon="printer">Route Sheets</x-button>
                </div>
            </div>
        @endforeach
    </div>
</x-layouts.app>