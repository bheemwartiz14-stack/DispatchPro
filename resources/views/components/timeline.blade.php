@props(['items' => []])

<ol {{ $attributes->merge(['class' => 'relative ml-3 space-y-5 border-l-2 border-slate-200 dark:border-slate-700']) }}>
    @foreach ($items as $item)
        <li class="relative pl-6">
            <span class="absolute -left-[9px] top-1 flex size-4 items-center justify-center rounded-full border-2 border-white bg-blue-600 ring-0 dark:border-slate-900"></span>
            <p class="text-sm font-medium text-slate-900 dark:text-white">{{ $item['title'] }}</p>
            <p class="text-xs text-slate-500 dark:text-slate-400">{{ $item['meta'] }}</p>
        </li>
    @endforeach
</ol>