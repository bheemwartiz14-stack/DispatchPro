@props(['padding' => 'p-5'])

<div {{ $attributes->merge(['class' => 'rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900']) }}>
    @isset($header)
        <div class="border-b border-slate-100 px-5 py-4 dark:border-slate-800">
            {{ $header }}
        </div>
    @endisset

    <div class="{{ $padding }}">
        {{ $slot }}
    </div>
</div>
