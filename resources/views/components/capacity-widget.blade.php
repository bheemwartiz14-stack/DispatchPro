@props(['load' => 0, 'capacity' => 1, 'label' => 'Capacity'])

@php
    $pct = $capacity > 0 ? (int) round(($load / $capacity) * 100) : 0;
    $bar = $pct >= 100 ? 'bg-red-500' : ($pct >= 75 ? 'bg-amber-500' : 'bg-emerald-500');
    $text = $pct >= 100 ? 'text-red-600 dark:text-red-400' : ($pct >= 75 ? 'text-amber-600 dark:text-amber-400' : 'text-emerald-600 dark:text-emerald-400');
    $badge = $pct >= 100 ? 'danger' : ($pct >= 75 ? 'warning' : 'success');
@endphp

<div {{ $attributes->merge(['class' => 'rounded-xl border border-slate-200 bg-slate-50 p-3 dark:border-slate-700 dark:bg-slate-800/60']) }}>
    <div class="flex items-center justify-between gap-2">
        <span class="text-xs font-medium text-slate-500 dark:text-slate-400">{{ $label }}</span>
        <x-badge :color="$badge">{{ $load }}/{{ $capacity }}</x-badge>
    </div>
    <div class="mt-2.5 h-2 w-full overflow-hidden rounded-full bg-slate-200 dark:bg-slate-700">
        <div class="h-full rounded-full transition-all duration-500 {{ $bar }}" style="width: {{ $pct }}%"></div>
    </div>
    <p class="mt-1.5 text-right text-xs font-semibold {{ $text }}">{{ $pct }}% full</p>
</div>
