@props(['label' => 'Loading…'])

<div {{ $attributes->merge(['class' => 'animate-pulse']) }}>
    <div class="flex items-center gap-3">
        <span class="skeleton size-9 rounded-lg"></span>
        <div class="flex-1 space-y-2">
            <div class="skeleton h-3 w-3/4"></div>
            <div class="skeleton h-3 w-1/2"></div>
        </div>
    </div>
    <span class="sr-only">{{ $label }}</span>
</div>
