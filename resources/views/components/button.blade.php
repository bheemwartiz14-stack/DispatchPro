@props([
    'href' => null,
    'color' => 'primary',
    'size' => 'md',
    'icon' => null,
])

@php
    $colors = [
        'primary' => 'bg-blue-600 text-white hover:bg-blue-700 focus-visible:ring-blue-500',
        'secondary' => 'bg-white text-slate-700 ring-1 ring-inset ring-slate-200 hover:bg-slate-50 dark:bg-slate-800 dark:text-slate-200 dark:ring-slate-700 dark:hover:bg-slate-700',
        'danger' => 'bg-red-600 text-white hover:bg-red-700 focus-visible:ring-red-500',
        'ghost' => 'text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800',
    ];
    $sizes = [
        'sm' => 'px-2.5 py-1.5 text-xs',
        'md' => 'px-3.5 py-2 text-sm',
        'lg' => 'px-4 py-2.5 text-sm',
    ];
    $classes = 'inline-flex items-center justify-center gap-2 rounded-lg font-medium transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 dark:focus-visible:ring-offset-slate-950 '.($colors[$color] ?? $colors['primary']).' '.($sizes[$size] ?? $sizes['md']);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if ($icon)
            <x-icon :name="$icon" class="size-4" />
        @endif
        {{ $slot }}
    </a>
@else
    <button type="button" {{ $attributes->merge(['class' => $classes]) }}>
        @if ($icon)
            <x-icon :name="$icon" class="size-4" />
        @endif
        {{ $slot }}
    </button>
@endif
