@props(['label', 'value', 'icon', 'delta' => '', 'trend' => 'flat', 'iconClass' => 'bg-blue-600 text-white'])

<div class="card-lift rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
    <div class="flex items-start justify-between">
        <div>
            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">{{ $label }}</p>
            <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900 dark:text-white">{{ $value }}</p>
        </div>
        <span class="flex size-11 shrink-0 items-center justify-center rounded-xl {{ $iconClass }}">
            <x-icon :name="$icon" class="size-6" />
        </span>
    </div>

    <div class="mt-4 flex items-center gap-1.5 text-xs">
        @if ($trend === 'up')
            <x-icon name="arrow-up-right" class="size-3.5 text-emerald-500" />
            <span class="font-semibold text-emerald-600 dark:text-emerald-400">{{ $delta }}</span>
        @elseif ($trend === 'down')
            <x-icon name="arrow-up-right" class="size-3.5 rotate-90 text-red-500" />
            <span class="font-semibold text-red-600 dark:text-red-400">{{ $delta }}</span>
        @else
            <span class="font-medium text-slate-500 dark:text-slate-400">{{ $delta }}</span>
        @endif
        <span class="text-slate-400 dark:text-slate-500">vs yesterday</span>
    </div>
</div>
