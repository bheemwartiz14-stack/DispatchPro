<x-layouts.app title="Import Reservations" active="dispatch.import">
    <x-page-header title="Import Reservations" subtitle="Upload today's reservations from guest services.">
        <x-slot:actions>
            <x-button color="secondary" icon="download">Download template</x-button>
        </x-slot:actions>
    </x-page-header>

    <x-upload-zone />

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        {{-- Preview table --}}
        <x-card class="lg:col-span-2">
            <x-slot:header>
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="font-semibold text-slate-900 dark:text-white">File Preview</h2>
                        <p class="text-sm text-slate-500 dark:text-slate-400">reservations_morning.xlsx · 14 rows</p>
                    </div>
                    <x-badge color="primary">Ready to import</x-badge>
                </div>
            </x-slot:header>
            <div class="-mx-5 -mb-5 overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-slate-100 text-left text-xs uppercase tracking-wider text-slate-400 dark:border-slate-800">
                            <th class="px-5 py-3 font-medium">Row</th>
                            <th class="px-5 py-3 font-medium">Guest</th>
                            <th class="px-5 py-3 font-medium">Type</th>
                            <th class="hidden px-5 py-3 font-medium sm:table-cell">Pickup</th>
                            <th class="hidden px-5 py-3 font-medium md:table-cell">Window</th>
                            <th class="px-5 py-3 font-medium">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        @foreach ([
                            ['row' => 1, 'guest' => 'Avery Thompson', 'type' => 'pickup', 'pickup' => 'North Gate Lobby', 'window' => '08:00 — 09:00', 'status' => 'Valid'],
                            ['row' => 2, 'guest' => 'Liam Nguyen', 'type' => 'delivery', 'pickup' => 'Villa 24 Porch', 'window' => '08:30 — 09:30', 'status' => 'Valid'],
                            ['row' => 3, 'guest' => 'Mia Castillo', 'type' => 'pickup', 'pickup' => 'South Clubhouse', 'window' => '08:15 — 09:15', 'status' => 'Warning'],
                            ['row' => 4, 'guest' => 'Noah Okafor', 'type' => 'delivery', 'pickup' => 'Fairway 3 Cart Path', 'window' => '09:00 — 10:00', 'status' => 'Valid'],
                            ['row' => 5, 'guest' => 'Emma Laurent', 'type' => 'pickup', 'pickup' => 'Main Hotel Lobby', 'window' => '09:30 — 10:30', 'status' => 'Valid'],
                            ['row' => 6, 'guest' => '', 'type' => 'delivery', 'pickup' => 'Unknown Address', 'window' => '10:00 — 11:00', 'status' => 'Error'],
                            ['row' => 7, 'guest' => 'Zoe Al-Sayed', 'type' => 'pickup', 'pickup' => 'Putting Green Circle', 'window' => '10:15 — 11:15', 'status' => 'Valid'],
                        ] as $row)
                            <tr>
                                <td class="px-5 py-3 text-slate-400">#{{ $row['row'] }}</td>
                                <td class="px-5 py-3 font-medium text-slate-900 dark:text-white">{{ $row['guest'] ?: '—' }}</td>
                                <td class="px-5 py-3"><x-status-badge kind="type" :status="$row['type']" /></td>
                                <td class="hidden px-5 py-3 text-slate-500 dark:text-slate-400 sm:table-cell">{{ $row['pickup'] }}</td>
                                <td class="hidden px-5 py-3 text-slate-500 dark:text-slate-400 md:table-cell">{{ $row['window'] }}</td>
                                <td class="px-5 py-3">
                                    @if ($row['status'] === 'Valid')
                                        <x-badge color="success">Valid</x-badge>
                                    @elseif ($row['status'] === 'Warning')
                                        <x-badge color="warning">Warning</x-badge>
                                    @else
                                        <x-badge color="danger">Error</x-badge>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-card>

        <div class="space-y-6">
            {{-- Validation panel --}}
            <x-card>
                <x-slot:header>
                    <h2 class="font-semibold text-slate-900 dark:text-white">Validation</h2>
                </x-slot:header>
                <ul class="space-y-3 text-sm">
                    <li class="flex items-center justify-between">
                        <span class="flex items-center gap-2 text-slate-600 dark:text-slate-300"><x-icon name="check" class="size-4 text-emerald-500" /> Valid rows</span>
                        <span class="font-semibold text-slate-900 dark:text-white">11</span>
                    </li>
                    <li class="flex items-center justify-between">
                        <span class="flex items-center gap-2 text-slate-600 dark:text-slate-300"><x-icon name="clock" class="size-4 text-amber-500" /> Warnings</span>
                        <span class="font-semibold text-slate-900 dark:text-white">2</span>
                    </li>
                    <li class="flex items-center justify-between">
                        <span class="flex items-center gap-2 text-slate-600 dark:text-slate-300"><x-icon name="x-mark" class="size-4 text-red-500" /> Errors</span>
                        <span class="font-semibold text-slate-900 dark:text-white">1</span>
                    </li>
                </ul>
            </x-card>

            {{-- Import summary --}}
            <x-card>
                <x-slot:header>
                    <h2 class="font-semibold text-slate-900 dark:text-white">Import Summary</h2>
                </x-slot:header>
                <ul class="space-y-2 text-sm text-slate-600 dark:text-slate-300">
                    <li class="flex items-center justify-between"><span>File</span><span class="font-medium text-slate-900 dark:text-white">reservations_morning.xlsx</span></li>
                    <li class="flex items-center justify-between"><span>Rows</span><span class="font-medium text-slate-900 dark:text-white">14</span></li>
                    <li class="flex items-center justify-between"><span>Created by</span><span class="font-medium text-slate-900 dark:text-white">Dana Ops</span></li>
                    <li class="flex items-center justify-between"><span>Uploaded</span><span class="font-medium text-slate-900 dark:text-white">Today, 07:42</span></li>
                </ul>
                <x-button color="primary" icon="check-badge" class="mt-4 w-full">Confirm & Import</x-button>
            </x-card>
        </div>
    </div>

    {{-- Recent imports --}}
    <x-card>
        <x-slot:header>
            <h2 class="font-semibold text-slate-900 dark:text-white">Recent Imports</h2>
        </x-slot:header>
        <div class="-mx-5 -mb-5 overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-slate-100 text-left text-xs uppercase tracking-wider text-slate-400 dark:border-slate-800">
                        <th class="px-5 py-3 font-medium">File</th>
                        <th class="hidden px-5 py-3 font-medium sm:table-cell">Uploaded</th>
                        <th class="px-5 py-3 font-medium">Rows</th>
                        <th class="px-5 py-3 font-medium">Status</th>
                        <th class="px-5 py-3 font-medium">Imported by</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @foreach ([
                        ['file' => 'reservations_morning.xlsx', 'time' => 'Today, 07:42', 'rows' => 14, 'status' => 'Imported', 'by' => 'Dana Ops'],
                        ['file' => 'reservations_evening.xlsx', 'time' => 'Yesterday, 18:10', 'rows' => 12, 'status' => 'Imported', 'by' => 'Dana Ops'],
                        ['file' => 'guest_services_export.csv', 'time' => 'Aug 04, 16:25', 'rows' => 9, 'status' => 'Imported', 'by' => 'R. Chen'],
                        ['file' => 'cancellations_aug.csv', 'time' => 'Aug 03, 09:05', 'rows' => 3, 'status' => 'Partial', 'by' => 'Dana Ops'],
                    ] as $import)
                        <tr>
                            <td class="px-5 py-3 font-medium text-slate-900 dark:text-white">{{ $import['file'] }}</td>
                            <td class="hidden px-5 py-3 text-slate-500 dark:text-slate-400 sm:table-cell">{{ $import['time'] }}</td>
                            <td class="px-5 py-3 text-slate-500 dark:text-slate-400">{{ $import['rows'] }}</td>
                            <td class="px-5 py-3"><x-badge :color="$import['status'] === 'Imported' ? 'success' : 'warning'">{{ $import['status'] }}</x-badge></td>
                            <td class="px-5 py-3 text-slate-500 dark:text-slate-400">{{ $import['by'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-card>
</x-layouts.app>
