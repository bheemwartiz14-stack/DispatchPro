<x-layouts.app title="Drivers" active="drivers.index">
    <x-page-header title="Drivers" subtitle="Team members on shift and their current assignment.">
        <x-slot:actions>
            <x-button color="primary" icon="plus">Add Driver</x-button>
        </x-slot:actions>
    </x-page-header>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($drivers as $driver)
            <x-driver-card :driver="$driver" />
        @endforeach
    </div>

    <x-card class="mt-6">
        <x-slot:header>
            <h2 class="font-semibold text-slate-900 dark:text-white">Shift Overview</h2>
        </x-slot:header>
        <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
            <div class="rounded-xl bg-emerald-50 p-4 dark:bg-emerald-950/40">
                <p class="text-xs font-medium text-emerald-700 dark:text-emerald-300">Available</p>
                <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ collect($drivers)->where('status', 'Available')->count() }}</p>
            </div>
            <div class="rounded-xl bg-sky-50 p-4 dark:bg-sky-950/40">
                <p class="text-xs font-medium text-sky-700 dark:text-sky-300">En Route</p>
                <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ collect($drivers)->where('status', 'En Route')->count() }}</p>
            </div>
            <div class="rounded-xl bg-amber-50 p-4 dark:bg-amber-950/40">
                <p class="text-xs font-medium text-amber-700 dark:text-amber-300">On Break</p>
                <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ collect($drivers)->where('status', 'On Break')->count() }}</p>
            </div>
            <div class="rounded-xl bg-slate-100 p-4 dark:bg-slate-800">
                <p class="text-xs font-medium text-slate-600 dark:text-slate-300">Total Stops Today</p>
                <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ collect($drivers)->sum('stops') }}</p>
            </div>
        </div>
    </x-card>
</x-layouts.app>