<x-layouts.app title="Dashboard" active="dashboard.index">
    <x-page-header title="Good morning, Dana" subtitle="Here's what's happening across the resort this morning.">
        <x-slot:actions>
            <x-button href="{{ route('dispatch.import') }}" icon="arrow-down-tray">Import Reservations</x-button>
            <x-button href="{{ route('dispatch.index') }}" color="primary" icon="map">Open Dispatch Board</x-button>
        </x-slot:actions>
    </x-page-header>

    {{-- Statistic cards --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">
        @foreach ($stats as $stat)
            <x-stat-card
                :label="$stat['label']"
                :value="$stat['value']"
                :delta="$stat['delta']"
                :trend="$stat['trend']"
                :icon="$stat['icon']"
            />
        @endforeach
    </div>

    {{-- Charts row --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <x-card class="lg:col-span-2">
            <x-slot:header>
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="font-semibold text-slate-900 dark:text-white">Reservation Volume</h2>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Deliveries vs pickups this week</p>
                    </div>
                    <x-badge color="primary">Live</x-badge>
                </div>
            </x-slot:header>
            <div class="h-72">
                <canvas id="volume-chart" data-labels='@json($reports['labels'] ?? [])' data-deliveries='@json($reports['deliveries'] ?? [])' data-pickups='@json($reports['pickups'] ?? [])'></canvas>
            </div>
        </x-card>

        <x-card>
            <x-slot:header>
                <div>
                    <h2 class="font-semibold text-slate-900 dark:text-white">Fleet Health</h2>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Cart utilization over time</p>
                </div>
            </x-slot:header>
            <div class="h-72">
                <canvas id="fleet-chart" data-labels='@json($reports['labels'] ?? [])' data-values='@json($reports['cart_utilization'] ?? [])'></canvas>
            </div>
        </x-card>
    </div>

    {{-- Lower row: reservations + activities --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2">
            <x-card>
                <x-slot:header>
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="font-semibold text-slate-900 dark:text-white">Recent Reservations</h2>
                            <p class="text-sm text-slate-500 dark:text-slate-400">Latest incoming requests</p>
                        </div>
                        <a href="{{ route('reservations.index') }}" class="text-sm font-medium text-blue-600 hover:underline">View all</a>
                    </div>
                </x-slot:header>
                <div class="-mx-5 -mb-5 overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-slate-100 text-left text-xs uppercase tracking-wider text-slate-400 dark:border-slate-800">
                                <th class="px-5 py-3 font-medium">Reservation</th>
                                <th class="px-5 py-3 font-medium">Guest</th>
                                <th class="hidden px-5 py-3 font-medium md:table-cell">Track</th>
                                <th class="px-5 py-3 font-medium">Type</th>
                                <th class="hidden px-5 py-3 font-medium sm:table-cell">Window</th>
                                <th class="px-5 py-3 font-medium">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                            @foreach (array_slice($reservations, 0, 8) as $reservation)
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/60">
                                    <td class="px-5 py-3 font-medium text-slate-900 dark:text-white">{{ $reservation['reference'] }}</td>
                                    <td class="px-5 py-3 text-slate-600 dark:text-slate-300">{{ $reservation['guest'] }}</td>
                                    <td class="hidden px-5 py-3 text-slate-500 dark:text-slate-400 md:table-cell">{{ $reservation['track'] }}</td>
                                    <td class="px-5 py-3"><x-status-badge kind="type" :status="$reservation['type']" /></td>
                                    <td class="hidden px-5 py-3 text-slate-500 dark:text-slate-400 sm:table-cell">{{ $reservation['window'] }}</td>
                                    <td class="px-5 py-3"><x-status-badge :status="$reservation['status']" /></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-card>
        </div>

        <div class="space-y-6">
            <x-card>
                <x-slot:header>
                    <h2 class="font-semibold text-slate-900 dark:text-white">Recent Activity</h2>
                </x-slot:header>
                <div class="-m-5">
                    <ul class="divide-y divide-slate-100 dark:divide-slate-800">
                        @foreach (array_slice($activities, 0, 6) as $activity)
                            <li class="flex gap-3 px-5 py-3">
                                <span class="mt-0.5 size-2 shrink-0 rounded-full bg-blue-500"></span>
                                <div class="min-w-0">
                                    <p class="text-sm text-slate-700 dark:text-slate-200">{{ $activity['message'] }}</p>
                                    <p class="text-xs text-slate-400">{{ $activity['time'] }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </x-card>
        </div>
    </div>

    {{-- Quick actions --}}
    <x-card>
        <x-slot:header>
            <h2 class="font-semibold text-slate-900 dark:text-white">Quick Actions</h2>
        </x-slot:header>
        <div class="grid grid-cols-2 gap-3 md:grid-cols-4">
            <a href="{{ route('dispatch.index') }}" class="card-lift flex items-center gap-3 rounded-xl border border-slate-200 p-4 dark:border-slate-800">
                <span class="flex size-10 items-center justify-center rounded-lg bg-blue-50 text-blue-600 dark:bg-blue-950/50"><x-icon name="map" class="size-5" /></span>
                <span class="text-sm font-medium text-slate-700 dark:text-slate-200">Dispatch Board</span>
            </a>
            <a href="{{ route('dispatch.import') }}" class="card-lift flex items-center gap-3 rounded-xl border border-slate-200 p-4 dark:border-slate-800">
                <span class="flex size-10 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600 dark:bg-emerald-950/50"><x-icon name="arrow-down-tray" class="size-5" /></span>
                <span class="text-sm font-medium text-slate-700 dark:text-slate-200">Import</span>
            </a>
            <a href="{{ route('dispatch-plans.index') }}" class="card-lift flex items-center gap-3 rounded-xl border border-slate-200 p-4 dark:border-slate-800">
                <span class="flex size-10 items-center justify-center rounded-lg bg-amber-50 text-amber-600 dark:bg-amber-950/50"><x-icon name="clipboard-list" class="size-5" /></span>
                <span class="text-sm font-medium text-slate-700 dark:text-slate-200">New Plan</span>
            </a>
            <a href="{{ route('reports.index') }}" class="card-lift flex items-center gap-3 rounded-xl border border-slate-200 p-4 dark:border-slate-800">
                <span class="flex size-10 items-center justify-center rounded-lg bg-sky-50 text-sky-600 dark:bg-sky-950/50"><x-icon name="chart-bar" class="size-5" /></span>
                <span class="text-sm font-medium text-slate-700 dark:text-slate-200">Reports</span>
            </a>
        </div>
    </x-card>
</x-layouts.app>

@push('scripts')
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const labels = JSON.parse(document.querySelector('#volume-chart').dataset.labels || '[]');
            new Chart(document.querySelector('#volume-chart'), {
                type: 'bar',
                data: {
                    labels,
                    datasets: [
                        { label: 'Deliveries', data: JSON.parse(document.querySelector('#volume-chart').dataset.deliveries), backgroundColor: 'rgba(37, 99, 235, 0.85)', borderRadius: 6 },
                        { label: 'Pickups', data: JSON.parse(document.querySelector('#volume-chart').dataset.pickups), backgroundColor: 'rgba(16, 185, 129, 0.85)', borderRadius: 6 },
                    ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { position: 'bottom' } },
                },
            });

            new Chart(document.querySelector('#fleet-chart'), {
                type: 'line',
                data: {
                    labels,
                    datasets: [{
                        label: 'Cart Utilization %',
                        data: JSON.parse(document.querySelector('#fleet-chart').dataset.values),
                        borderColor: '#0ea5e9',
                        backgroundColor: 'rgba(14, 165, 233, 0.1)',
                        fill: true,
                        tension: 0.4,
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: { y: { max: 100 } },
                },
            });
        });
    </script>
@endpush
