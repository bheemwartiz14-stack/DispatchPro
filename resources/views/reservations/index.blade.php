<x-layouts.app title="Reservations" active="reservations.index">
    <x-page-header title="Reservations" subtitle="All guest transport requests across the resort.">
        <x-slot:actions>
            <x-button href="{{ route('dispatch.import') }}" icon="arrow-down-tray">Import</x-button>
            <x-button color="primary" icon="plus">New Reservation</x-button>
        </x-slot:actions>
    </x-page-header>

    {{-- Filters --}}
    <x-card :padding="'p-4'">
        <div class="flex flex-col gap-3 lg:flex-row lg:items-center">
            <div class="relative flex-1">
                <x-icon name="magnifying-glass" class="pointer-events-none absolute left-3 top-1/2 size-4 -translate-y-1/2 text-slate-400" />
                <input type="search" placeholder="Search by guest, reference, or track…"
                    class="w-full rounded-lg border border-slate-200 bg-slate-50 py-2 pl-9 pr-3 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/30 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
            </div>
            <div class="flex flex-wrap gap-2">
                <select class="rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm text-slate-700 outline-none dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200">
                    <option>All types</option>
                    <option>Delivery</option>
                    <option>Pickup</option>
                    <option>Transfer</option>
                </select>
                <select class="rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm text-slate-700 outline-none dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200">
                    <option>All statuses</option>
                    <option>Unassigned</option>
                    <option>Assigned</option>
                    <option>En Route</option>
                    <option>Completed</option>
                </select>
                <x-button color="secondary" icon="arrow-path">Reset</x-button>
            </div>
        </div>
    </x-card>

    {{-- Table --}}
    <x-card :padding="'p-0'">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-slate-100 text-left text-xs uppercase tracking-wider text-slate-400 dark:border-slate-800">
                        <th class="px-5 py-3 font-medium">Reference</th>
                        <th class="px-5 py-3 font-medium">Guest</th>
                        <th class="hidden px-5 py-3 font-medium md:table-cell">Track</th>
                        <th class="px-5 py-3 font-medium">Type</th>
                        <th class="px-5 py-3 font-medium">Cart</th>
                        <th class="hidden px-5 py-3 font-medium sm:table-cell">Window</th>
                        <th class="hidden px-5 py-3 font-medium lg:table-cell">Driver</th>
                        <th class="px-5 py-3 font-medium">Status</th>
                        <th class="px-5 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @foreach ($reservations as $reservation)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/60">
                            <td class="px-5 py-3 font-medium text-slate-900 dark:text-white">{{ $reservation['reference'] }}</td>
                            <td class="px-5 py-3 text-slate-700 dark:text-slate-200">{{ $reservation['guest'] }}</td>
                            <td class="hidden px-5 py-3 text-slate-500 dark:text-slate-400 md:table-cell">{{ $reservation['track'] }}</td>
                            <td class="px-5 py-3"><x-status-badge kind="type" :status="$reservation['type']" /></td>
                            <td class="px-5 py-3 text-slate-500 dark:text-slate-400">{{ $reservation['cart'] }}</td>
                            <td class="hidden px-5 py-3 text-slate-500 dark:text-slate-400 sm:table-cell">{{ $reservation['window'] }}</td>
                            <td class="hidden px-5 py-3 text-slate-500 dark:text-slate-400 lg:table-cell">{{ $reservation['driver'] ?? '—' }}</td>
                            <td class="px-5 py-3"><x-status-badge :status="$reservation['status']" /></td>
                            <td class="px-5 py-3 text-right">
                                <button class="rounded-lg p-1.5 text-slate-400 hover:bg-slate-100 hover:text-slate-600 dark:hover:bg-slate-700" aria-label="Row actions">
                                    <x-icon name="dots-horizontal" class="size-5" />
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex items-center justify-between border-t border-slate-100 px-5 py-3 text-sm dark:border-slate-800">
            <p class="text-slate-500 dark:text-slate-400">Showing <span class="font-medium text-slate-900 dark:text-white">{{ count($reservations) }}</span> reservations</p>
            <div class="flex items-center gap-1">
                <x-button color="secondary" size="sm">Previous</x-button>
                <x-button color="primary" size="sm">Next</x-button>
            </div>
        </div>
    </x-card>
</x-layouts.app>
