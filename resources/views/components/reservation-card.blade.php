@props(['reservation' => []])

<article
    class="group cursor-grab rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:border-blue-300 hover:shadow-lg dark:border-slate-800 dark:bg-slate-900 dark:hover:border-blue-800"
    :class="dragging ? 'opacity-40' : ''"
>
    <div class="flex items-center justify-between gap-2">
        <div class="flex items-center gap-2">
            <x-icon name="grip-vertical" class="size-4 shrink-0 text-slate-300 group-hover:text-slate-400 dark:text-slate-600" />
            <span class="text-xs font-semibold text-slate-400">{{ $reservation['reference'] }}</span>
        </div>
        <x-status-badge :status="$reservation['status']" />
    </div>

    <h3 class="mt-3 truncate font-semibold text-slate-900 dark:text-white">{{ $reservation['guest'] }}</h3>
    <p class="text-xs text-slate-400">Party of {{ $reservation['party_size'] }} · {{ $reservation['phone'] }}</p>

    <div class="mt-3 flex flex-wrap items-center gap-1.5">
        <x-status-badge kind="type" :status="$reservation['type']" />
        <x-badge color="violet">
            <x-icon name="bolt" class="size-3" />
            {{ $reservation['cart'] }}
        </x-badge>
    </div>

    <div class="mt-3 space-y-2 border-t border-slate-100 pt-3 text-sm dark:border-slate-800">
        <p class="flex items-center gap-2 text-slate-600 dark:text-slate-300">
            <x-icon name="map-pin" class="size-4 shrink-0 {{ $reservation['type'] === 'pickup' ? 'text-emerald-500' : 'text-blue-500' }}" />
            <span class="truncate">{{ $reservation['pickup'] }}</span>
        </p>
        <p class="flex items-center gap-2 text-slate-600 dark:text-slate-300">
            <x-icon name="flag" class="size-4 shrink-0 text-red-500" />
            <span class="truncate">{{ $reservation['dropoff'] }}</span>
        </p>
        <p class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400">
            <x-icon name="clock" class="size-4 shrink-0" />
            {{ $reservation['window'] }}
        </p>
    </div>
</article>