<x-layouts.app title="Trucks" active="trucks.index">
    <x-page-header title="Trucks" subtitle="Track fleet trucks, drivers, and current cart load.">
        <x-slot:actions>
            <x-button color="primary" icon="plus">Register Truck</x-button>
        </x-slot:actions>
    </x-page-header>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($trucks as $truck)
            <x-truck-card :truck="$truck" />
        @endforeach
    </div>

    <x-card class="mt-6">
        <x-slot:header>
            <h2 class="font-semibold text-slate-900 dark:text-white">Fleet Summary</h2>
        </x-slot:header>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
            <div>
                <p class="mb-2 text-xs font-medium text-slate-400">Total capacity used</p>
                <x-capacity-widget
                    :load="collect($trucks)->sum('load')"
                    :capacity="collect($trucks)->sum('capacity')"
                    label="Fleet wide"
                />
            </div>
            <div>
                <p class="mb-2 text-xs font-medium text-slate-400">Trucks on route</p>
                <p class="text-3xl font-bold text-slate-900 dark:text-white">{{ collect($trucks)->where('status', 'On Route')->count() }}</p>
            </div>
            <div>
                <p class="mb-2 text-xs font-medium text-slate-400">Trucks at capacity</p>
                <p class="text-3xl font-bold text-amber-600 dark:text-amber-400">{{ collect($trucks)->where('status', 'Full')->count() }}</p>
            </div>
        </div>
    </x-card>
</x-layouts.app>