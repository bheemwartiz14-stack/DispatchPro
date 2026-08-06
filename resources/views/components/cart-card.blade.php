@props(['cart' => []])

@php
    $batteryColor = $cart['battery'] >= 75 ? 'bg-emerald-500' : ($cart['battery'] >= 40 ? 'bg-amber-500' : 'bg-red-500');
@endphp

<div class="card-lift rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
    <div class="flex items-start justify-between gap-3">
        <div class="flex items-center gap-3">
            <span class="flex size-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-950/50 dark:text-blue-300">
                <x-icon name="bolt" class="size-6" />
            </span>
            <div>
                <h3 class="font-semibold text-slate-900 dark:text-white">{{ $cart['number'] }}</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400">{{ $cart['model'] }}</p>
            </div>
        </div>
        <x-status-badge :status="$cart['status']" />
    </div>

    <div class="mt-4 space-y-2 text-sm text-slate-600 dark:text-slate-300">
        <div class="flex items-center justify-between">
            <span class="flex items-center gap-1.5 text-slate-500 dark:text-slate-400">
                <x-icon name="user-group" class="size-4" /> Driver
            </span>
            <span>{{ $cart['driver'] ?? '—' }}</span>
        </div>
        <div class="flex items-center justify-between">
            <span class="flex items-center gap-1.5 text-slate-500 dark:text-slate-400">
                <x-icon name="calendar" class="size-4" /> Reservation
            </span>
            <span>{{ $cart['guest'] ?? 'None' }}</span>
        </div>
    </div>

    <div class="mt-4 border-t border-slate-100 pt-3 dark:border-slate-800">
        <div class="flex items-center justify-between text-xs">
            <span class="font-medium text-slate-500 dark:text-slate-400">Battery</span>
            <span class="font-semibold text-slate-700 dark:text-slate-200">{{ $cart['battery'] }}%</span>
        </div>
        <div class="mt-1.5 h-1.5 w-full overflow-hidden rounded-full bg-slate-200 dark:bg-slate-700">
            <div class="h-full rounded-full transition-all {{ $batteryColor }}" style="width: {{ $cart['battery'] }}%"></div>
        </div>
    </div>
</div>