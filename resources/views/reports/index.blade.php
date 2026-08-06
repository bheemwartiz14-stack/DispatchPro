<x-layouts.app title="Reports" active="reports.index">
    <x-page-header title="Reports" subtitle="Weekly and monthly operational analytics.">
        <x-slot:actions>
            <x-button color="secondary" icon="arrow-path">Refresh</x-button>
            <x-button color="primary" icon="document-arrow-down">Export Report</x-button>
        </x-slot:actions>
    </x-page-header>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <x-card :padding="'p-4'">
            <x-slot:header><h2 class="font-semibold text-slate-900 dark:text-white">Deliveries & Pickups</h2></x-slot:header>
            <div class="h-72"><canvas id="report-volume" data-labels='@json($reports['labels'])' data-deliveries='@json($reports['deliveries'])' data-pickups='@json($reports['pickups'])'></canvas></div>
        </x-card>

        <x-card :padding="'p-4'">
            <x-slot:header><h2 class="font-semibold text-slate-900 dark:text-white">Driver Performance</h2></x-slot:header>
            <div class="h-72"><canvas id="report-drivers" data-labels='@json($reports['labels'])' data-values='@json($reports['driver_performance'])'></canvas></div>
        </x-card>

        <x-card :padding="'p-4'">
            <x-slot:header><h2 class="font-semibold text-slate-900 dark:text-white">Truck Utilization</h2></x-slot:header>
            <div class="h-72"><canvas id="report-trucks" data-labels='@json($reports['labels'])' data-values='@json($reports['truck_utilization'])'></canvas></div>
        </x-card>

        <x-card :padding="'p-4'">
            <x-slot:header><h2 class="font-semibold text-slate-900 dark:text-white">Golf Cart Utilization</h2></x-slot:header>
            <div class="h-72"><canvas id="report-carts" data-labels='@json($reports['labels'])' data-values='@json($reports['cart_utilization'])'></canvas></div>
        </x-card>
    </div>

    @push('scripts')
        <script>
            window.addEventListener('DOMContentLoaded', () => {
                const line = (id) => {
                    const el = document.querySelector(id);
                    return { labels: JSON.parse(el.dataset.labels), values: JSON.parse(el.dataset.values) };
                };

                const volume = line('#report-volume');
                new Chart(document.querySelector('#report-volume'), {
                    type: 'bar',
                    data: {
                        labels: volume.labels,
                        datasets: [
                            { label: 'Deliveries', data: JSON.parse(document.querySelector('#report-volume').dataset.deliveries), backgroundColor: 'rgba(37, 99, 235, 0.85)', borderRadius: 6 },
                            { label: 'Pickups', data: JSON.parse(document.querySelector('#report-volume').dataset.pickups), backgroundColor: 'rgba(16, 185, 129, 0.85)', borderRadius: 6 },
                        ],
                    },
                    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } } },
                });

                [['#report-drivers', 'rgba(16, 185, 129, 1)', 'Stops per driver'],
                 ['#report-trucks', 'rgba(37, 99, 235, 1)', 'Truck utilization %'],
                 ['#report-carts', 'rgba(14, 165, 233, 1)', 'Cart utilization %']].forEach(([id, color, label]) => {
                    const d = line(id);
                    new Chart(document.querySelector(id), {
                        type: 'line',
                        data: {
                            labels: d.labels,
                            datasets: [{ label, data: d.values, borderColor: color, backgroundColor: color.replace('1)', '0.1)'), fill: true, tension: 0.4 }],
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: { legend: { display: false } },
                            scales: { y: { suggestedMax: 100 } },
                        },
                    });
                });
            });
        </script>
    @endpush
</x-layouts.app>