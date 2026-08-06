<x-layouts.app title="Route Sheet" active="route-sheets.index" maxWidth="max-w-4xl">
    <div class="no-print flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <a href="{{ route('route-sheets.index') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-blue-600 hover:underline">
                <x-icon name="chevron-right" class="size-4 rotate-180" /> Back to route sheets
            </a>
            <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-900 dark:text-white">Route Sheet</h1>
        </div>
        <x-button color="primary" icon="printer" onclick="window.print()">Print Sheet</x-button>
    </div>

    {{-- Printable document --}}
    <div class="print-area overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
        {{-- Header --}}
        <div class="border-b border-slate-200 bg-slate-50 p-6 dark:border-slate-800 dark:bg-slate-900">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                <div class="flex items-center gap-3">
                    <span class="flex size-10 items-center justify-center rounded-xl bg-blue-600 text-white">
                        <x-icon name="bolt" class="size-6" />
                    </span>
                    <div>
                        <p class="text-lg font-bold tracking-tight text-slate-900 dark:text-white">Dispatch<span class="text-blue-600">Pro</span></p>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Palm Valley Resort · Guest Transport</p>
                    </div>
                </div>
                <div class="text-sm">
                    <p class="font-semibold text-slate-900 dark:text-white">{{ $truck['route'] }} Route</p>
                    <p class="text-slate-500 dark:text-slate-400">{{ date('l, F j, Y') }}</p>
                    <p class="text-slate-500 dark:text-slate-400">Wave: Morning · {{ $truck['number'] }}</p>
                </div>
            </div>

            <div class="mt-6 grid grid-cols-2 gap-4 sm:grid-cols-4">
                <div>
                    <p class="text-xs text-slate-400">Driver</p>
                    <p class="font-semibold text-slate-900 dark:text-white">{{ $driver['name'] }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-400">Phone</p>
                    <p class="font-semibold text-slate-900 dark:text-white">{{ $driver['phone'] }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-400">Truck</p>
                    <p class="font-semibold text-slate-900 dark:text-white">{{ $truck['number'] }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-400">Stops</p>
                    <p class="font-semibold text-slate-900 dark:text-white">{{ count($stops) }}</p>
                </div>
            </div>
        </div>

        {{-- Stops --}}
        <div class="p-6">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-slate-200 text-left text-xs uppercase tracking-wider text-slate-400 dark:border-slate-700">
                        <th class="py-3 pr-4 font-medium">#</th>
                        <th class="py-3 pr-4 font-medium">Guest</th>
                        <th class="hidden py-3 pr-4 font-medium sm:table-cell">Type</th>
                        <th class="hidden py-3 pr-4 font-medium md:table-cell">Address</th>
                        <th class="py-3 pr-4 font-medium">Cart</th>
                        <th class="hidden py-3 pr-4 font-medium sm:table-cell">Window</th>
                        <th class="py-3 font-medium">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @foreach ($stops as $index => $stop)
                        <tr>
                            <td class="py-3 pr-4 font-semibold text-slate-400">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</td>
                            <td class="py-3 pr-4 font-medium text-slate-900 dark:text-white">{{ $stop['guest'] }}</td>
                            <td class="hidden py-3 pr-4 sm:table-cell"><x-status-badge kind="type" :status="$stop['type']" /></td>
                            <td class="hidden py-3 pr-4 text-slate-500 dark:text-slate-400 md:table-cell">{{ $stop['pickup'] }}</td>
                            <td class="py-3 pr-4 text-slate-500 dark:text-slate-400">{{ $stop['cart'] }}</td>
                            <td class="hidden py-3 pr-4 text-slate-500 dark:text-slate-400 sm:table-cell">{{ $stop['window'] }}</td>
                            <td class="py-3"><x-status-badge :status="$stop['status']" /></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-6 border-t border-slate-200 pt-4 text-xs text-slate-400 dark:border-slate-700">
                <p>Issued by DispatchPro · Driver must confirm every stop in the mobile app.</p>
                <p class="mt-1">Generated {{ date('g:i A') }} · Plan "Morning Wave — North Course"</p>
            </div>
        </div>
    </div>
</x-layouts.app>