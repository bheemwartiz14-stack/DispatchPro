<header class="border-b border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-900">
    <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
        <a href="{{ route('dashboard.index') }}" class="flex items-center gap-2" aria-label="DispatchPro home">
            <span class="flex size-8 items-center justify-center rounded-lg bg-blue-600 text-white">
                <x-icon name="bolt" class="size-4" />
            </span>
            <span class="text-lg font-bold tracking-tight text-slate-900 dark:text-white">
                Dispatch<span class="text-blue-600">Pro</span>
            </span>
        </a>
        <nav class="flex items-center gap-4 text-sm font-medium text-slate-600 dark:text-slate-300">
            <a href="{{ route('dashboard.index') }}" class="hover:text-slate-900 dark:hover:text-white">Dashboard</a>
            <a href="{{ route('dispatch.index') }}" class="hover:text-slate-900 dark:hover:text-white">Dispatch</a>
            <a href="{{ route('reports.index') }}" class="hover:text-slate-900 dark:hover:text-white">Reports</a>
        </nav>
    </div>
</header>
