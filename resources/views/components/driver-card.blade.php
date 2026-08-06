@props(['driver' => []])

<div class="card-lift rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
    <div class="flex items-start gap-4">
        <span class="flex size-12 shrink-0 items-center justify-center rounded-full text-sm font-bold text-white {{ $driver['color'] }}">
            {{ $driver['initials'] }}
        </span>

        <div class="min-w-0 flex-1">
            <div class="flex items-start justify-between gap-2">
                <div>
                    <h3 class="font-semibold text-slate-900 dark:text-white">{{ $driver['name'] }}</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400">{{ $driver['truck'] }} · {{ $driver['license'] }}</p>
                </div>
                <x-status-badge :status="$driver['status']" />
            </div>

            <p class="mt-2 flex items-center gap-1.5 text-sm text-slate-500 dark:text-slate-400">
                <x-icon name="phone" class="size-4" />
                {{ $driver['phone'] }}
            </p>
        </div>
    </div>

    <div class="mt-4 grid grid-cols-2 gap-2 border-t border-slate-100 pt-4 dark:border-slate-800">
        <div>
            <p class="text-xs text-slate-400 dark:text-slate-500">Today's Stops</p>
            <p class="text-lg font-semibold text-slate-900 dark:text-white">{{ $driver['stops'] }}</p>
        </div>
        <x-capacity-widget :load="$driver['load']" :capacity="$driver['capacity']" label="Cart Capacity" />
    </div>
</div>