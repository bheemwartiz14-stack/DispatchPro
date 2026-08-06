@props(['icon' => 'clipboard-list', 'title' => 'Nothing here yet', 'message' => ''])

<div {{ $attributes->merge(['class' => 'flex flex-col items-center justify-center rounded-2xl border border-dashed border-slate-300 px-6 py-12 text-center dark:border-slate-700']) }}>
    <span class="flex size-12 items-center justify-center rounded-full bg-slate-100 text-slate-400 dark:bg-slate-800">
        <x-icon :name="$icon" class="size-6" />
    </span>
    <h3 class="mt-4 text-sm font-semibold text-slate-900 dark:text-white">{{ $title }}</h3>
    @if ($message)
        <p class="mt-1 max-w-sm text-sm text-slate-500 dark:text-slate-400">{{ $message }}</p>
    @endif
</div>
