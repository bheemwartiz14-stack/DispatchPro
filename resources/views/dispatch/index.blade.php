<x-layouts.app title="Dispatch Dashboard" active="dispatch.index">

    <div class="flex flex-col gap-6 2xl:flex-row">
        {{-- LEFT: MAP PANEL --}}
        <div class="flex w-full flex-col gap-4 2xl:w-1/2" x-data="{ selected: null }">
            <x-page-header title="Dispatch Board" subtitle="Assign reservations and optimize the morning waves.">
                <x-slot:actions>
                    <x-button color="secondary" icon="arrow-path">Optimize Route</x-button>
                    <x-button color="secondary" icon="eye">View Route</x-button>
                    <x-button color="primary" icon="printer">Print Route</x-button>
                </x-slot:actions>
            </x-page-header>

            {{-- Map placeholder --}}
            <x-card :padding="'p-0'" class="overflow-hidden">
                <div class="relative h-[420px] map-grid bg-blue-50/50 dark:bg-blue-950/20">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="flex flex-col items-center gap-2 text-center text-slate-400 dark:text-slate-500">
                            <x-icon name="map" class="size-10" />
                            <span class="text-sm font-medium">Map Preview</span>
                            <span class="max-w-xs text-xs">Google Maps will render here in production. Pins below are placed on a mock grid.</span>
                        </span>
                    </div>

                    @php
                        $pins = [
                            ['type' => 'pickup', 'top' => '18%', 'left' => '22%'],
                            ['type' => 'delivery', 'top' => '28%', 'left' => '55%'],
                            ['type' => 'pickup', 'top' => '45%', 'left' => '38%'],
                            ['type' => 'delivery', 'top' => '55%', 'left' => '70%'],
                            ['type' => 'pickup', 'top' => '70%', 'left' => '30%'],
                            ['type' => 'delivery', 'top' => '76%', 'left' => '60%'],
                        ];
                    @endphp
                    @foreach ($pins as $i => $pin)
                        <button
                            type="button"
                            class="absolute flex size-6 -translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-full text-white shadow-lg ring-4 ring-white/60 transition hover:scale-110 dark:ring-slate-900/60"
                            style="top: {{ $pin['top'] }}; left: {{ $pin['left'] }};"
                            :class="selected === {{ $i }} ? 'ring-blue-500' : '{{ $pin['type'] === 'pickup' ? 'bg-emerald-500' : 'bg-blue-600' }}'"
                            @click="selected = {{ $i }}"
                            :aria-label="'Pin {{ $i + 1 }}'"
                        >
                            <x-icon name="map-pin" class="size-4" />
                        </button>
                    @endforeach

                    <div class="absolute left-3 top-3 flex gap-2">
                        <x-button color="secondary" size="sm" icon="magnifying-glass">Search</x-button>
                        <x-button color="secondary" size="sm" icon="plus">+</x-button>
                        <x-button color="secondary" size="sm" icon="minus">−</x-button>
                    </div>

                    <div class="absolute bottom-3 right-3 rounded-xl border border-slate-200 bg-white/90 p-3 text-xs shadow-sm backdrop-blur dark:border-slate-700 dark:bg-slate-900/90">
                        <p class="mb-2 font-semibold text-slate-900 dark:text-white">Legend</p>
                        <ul class="space-y-1.5 text-slate-600 dark:text-slate-300">
                            <li class="flex items-center gap-2"><span class="size-2.5 rounded-full bg-blue-600"></span>Delivery</li>
                            <li class="flex items-center gap-2"><span class="size-2.5 rounded-full bg-emerald-500"></span>Pickup</li>
                            <li class="flex items-center gap-2"><span class="size-2.5 rounded-full bg-amber-500"></span>On hold</li>
                        </ul>
                    </div>
                </div>
            </x-card>

            {{-- Truck capacity strip --}}
            <x-card>
                <x-slot:header>
                    <h2 class="font-semibold text-slate-900 dark:text-white">Fleet Capacity</h2>
                </x-slot:header>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">
                    @foreach ($trucks as $truck)
                        <x-capacity-widget :load="$truck['load']" :capacity="$truck['capacity']" :label="$truck['number']" />
                    @endforeach
                </div>
            </x-card>
        </div>

        {{-- RIGHT: DISPATCH BOARD --}}
        <div
            class="w-full 2xl:w-1/2"
            x-data="dispatchBoard()"
            x-init="
                window.__board = this;
            "
        >
            <div class="scrollbar-slim space-y-5 2xl:max-h-[calc(100vh-6rem)] 2xl:overflow-y-auto 2xl:pr-1">
                {{-- Unassigned pool --}}
                <div
                    data-sortable="pool"
                    class="rounded-2xl border-2 border-dashed border-slate-300 bg-slate-50/60 p-4 dark:border-slate-700 dark:bg-slate-900/40"
                >
                    <div class="mb-3 flex items-center justify-between">
                        <h3 class="font-semibold text-slate-900 dark:text-white">Unassigned Reservations</h3>
                        <x-badge color="warning">{{ count($unassigned) }}</x-badge>
                    </div>
                    <div class="grid grid-cols-1 gap-3 md:grid-cols-2" data-sortable-container>
                        @foreach ($unassigned as $reservation)
                            <x-reservation-card :reservation="$reservation" />
                        @endforeach
                    </div>
                </div>

                {{-- Driver columns --}}
                @foreach ($board as $index => $driverReservations)
                    @php $driver = $drivers[$index]; @endphp
                    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                        <div class="mb-3 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span class="flex size-9 items-center justify-center rounded-full text-xs font-bold text-white {{ $driver['color'] }}">
                                    {{ $driver['initials'] }}
                                </span>
                                <div>
                                    <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $driver['name'] }}</p>
                                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ $driver['truck'] }} · {{ $driver['status'] }}</p>
                                </div>
                            </div>
                            <x-capacity-widget :load="$driver['load']" :capacity="$driver['capacity']" label="Load" class="!p-2.5 !w-36" />
                        </div>

                        <div class="grid grid-cols-1 gap-3 md:grid-cols-2" data-sortable-container>
                            @foreach ($driverReservations as $reservation)
                                <x-reservation-card :reservation="$reservation" />
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.querySelectorAll('[data-sortable-container]').forEach((container) => {
                new Sortable(container, {
                    group: 'reservations',
                    animation: 200,
                    ghostClass: 'opacity-40',
                    onEnd() {
                        console.info('Dispatch board updated', document.querySelectorAll('[data-sortable-container]').length, 'columns');
                    },
                });
            });
        </script>
    @endpush
</x-layouts.app>
