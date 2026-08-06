@props(['hint' => 'Drag & drop your .xlsx or .csv file here'])

<div
    {{ $attributes->merge(['class' => 'group relative flex flex-col items-center justify-center rounded-2xl border-2 border-dashed border-slate-300 bg-white px-6 py-12 text-center transition hover:border-blue-400 hover:bg-blue-50/40 dark:border-slate-700 dark:bg-slate-900 dark:hover:border-blue-600 dark:hover:bg-blue-950/20']) }}
>
    <span class="flex size-14 items-center justify-center rounded-2xl bg-blue-50 text-blue-600 transition group-hover:scale-105 dark:bg-blue-950/50 dark:text-blue-300">
        <x-icon name="arrow-down-tray" class="size-7" />
    </span>
    <h3 class="mt-4 font-semibold text-slate-900 dark:text-white">Upload reservation spreadsheet</h3>
    <p class="mt-1 max-w-sm text-sm text-slate-500 dark:text-slate-400">{{ $hint }}</p>
    <div class="mt-5 flex items-center gap-2">
        <x-button color="primary" icon="folder">Browse files</x-button>
        <x-button color="secondary" icon="download">Download template</x-button>
    </div>
    <p class="mt-4 text-xs text-slate-400 dark:text-slate-500">.xlsx, .xls, .csv · Max 10 MB</p>
</div>