@props(['title' => ''])

<header
    x-data="{ searchOpen: false, notifOpen: false }"
    class="sticky top-0 z-30 flex h-16 shrink-0 items-center gap-3 border-b border-slate-200 bg-white/80 px-4 backdrop-blur sm:px-6 dark:border-slate-800 dark:bg-slate-900/80"
>
    <button
        type="button"
        class="rounded-lg p-2 text-slate-500 hover:bg-slate-100 hover:text-slate-700 lg:hidden dark:text-slate-400 dark:hover:bg-slate-800"
        @click="$store.app.sidebarOpen = true"
        aria-label="Open menu"
    >
        <x-icon name="bars-3" class="size-6" />
    </button>

    <a href="{{ route('dashboard.index') }}" class="flex items-center gap-2 lg:hidden" aria-label="DispatchPro home">
        <span class="flex size-8 items-center justify-center rounded-lg bg-blue-600 text-white">
            <x-icon name="bolt" class="size-4" />
        </span>
    </a>

    <div class="hidden items-center gap-2 text-sm lg:flex">
        <span class="font-semibold text-slate-900 dark:text-white">{{ $title ?: 'DispatchPro' }}</span>
        <x-icon name="chevron-right" class="size-4 text-slate-400" />
        <span class="text-slate-500 dark:text-slate-400">{{ date('l, F j, Y') }}</span>
    </div>

    <div class="flex-1"></div>

    <form class="relative hidden w-72 md:block" role="search">
        <x-icon name="magnifying-glass" class="pointer-events-none absolute left-3 top-1/2 size-4 -translate-y-1/2 text-slate-400" />
        <input
            type="search"
            placeholder="Search reservations, drivers, carts…"
            class="w-full rounded-lg border border-slate-200 bg-slate-50 py-2 pl-9 pr-3 text-sm text-slate-900 placeholder-slate-400 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/30 dark:border-slate-700 dark:bg-slate-800 dark:text-white"
        />
        <kbd class="absolute right-3 top-1/2 -translate-y-1/2 rounded border border-slate-200 bg-white px-1.5 text-[10px] font-medium text-slate-400 dark:border-slate-700 dark:bg-slate-900">
            ⌘K
        </kbd>
    </form>

    <div class="relative">
        <button
            type="button"
            class="relative rounded-lg p-2 text-slate-500 transition hover:bg-slate-100 hover:text-slate-700 dark:text-slate-400 dark:hover:bg-slate-800"
            @click="notifOpen = !notifOpen; searchOpen = false"
            aria-label="Notifications"
        >
            <x-icon name="bell" class="size-5" />
            <span class="absolute right-1.5 top-1.5 size-2 rounded-full bg-red-500 ring-2 ring-white dark:ring-slate-900"></span>
        </button>

        <div
            x-show="notifOpen"
            x-transition.opacity.scale.origin.top.right
            @click.outside="notifOpen = false"
            class="absolute right-0 mt-2 w-80 overflow-hidden rounded-xl border border-slate-200 bg-white shadow-xl dark:border-slate-700 dark:bg-slate-900"
        >
            <div class="flex items-center justify-between border-b border-slate-200 px-4 py-3 dark:border-slate-700">
                <p class="text-sm font-semibold text-slate-900 dark:text-white">Notifications</p>
                <span class="rounded-full bg-blue-50 px-2 py-0.5 text-xs font-medium text-blue-700 dark:bg-blue-950/50 dark:text-blue-300">3 new</span>
            </div>
            <ul class="divide-y divide-slate-100 dark:divide-slate-800">
                <li class="flex gap-3 px-4 py-3 hover:bg-slate-50 dark:hover:bg-slate-800/60">
                    <span class="mt-0.5 flex size-8 shrink-0 items-center justify-center rounded-lg bg-blue-100 text-blue-600 dark:bg-blue-950/50">
                        <x-icon name="truck" class="size-4" />
                    </span>
                    <div class="min-w-0">
                        <p class="text-sm text-slate-700 dark:text-slate-200"><span class="font-semibold">Truck 02</span> reached full capacity</p>
                        <p class="text-xs text-slate-400">4 minutes ago</p>
                    </div>
                </li>
                <li class="flex gap-3 px-4 py-3 hover:bg-slate-50 dark:hover:bg-slate-800/60">
                    <span class="mt-0.5 flex size-8 shrink-0 items-center justify-center rounded-lg bg-amber-100 text-amber-600 dark:bg-amber-950/50">
                        <x-icon name="wrench" class="size-4" />
                    </span>
                    <div class="min-w-0">
                        <p class="text-sm text-slate-700 dark:text-slate-200"><span class="font-semibold">Cart C-07</span> flagged for maintenance</p>
                        <p class="text-xs text-slate-400">18 minutes ago</p>
                    </div>
                </li>
                <li class="flex gap-3 px-4 py-3 hover:bg-slate-50 dark:hover:bg-slate-800/60">
                    <span class="mt-0.5 flex size-8 shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600 dark:bg-emerald-950/50">
                        <x-icon name="arrow-down-tray" class="size-4" />
                    </span>
                    <div class="min-w-0">
                        <p class="text-sm text-slate-700 dark:text-slate-200"><span class="font-semibold">Import complete</span> — 12 new reservations</p>
                        <p class="text-xs text-slate-400">1 hour ago</p>
                    </div>
                </li>
            </ul>
            <a href="#" class="block border-t border-slate-200 px-4 py-2.5 text-center text-sm font-medium text-blue-600 hover:bg-slate-50 dark:border-slate-700 dark:hover:bg-slate-800/60">
                View all notifications
            </a>
        </div>
    </div>

    <button
        type="button"
        x-data
        @click="$theme(document.documentElement.classList.contains('dark') ? 'light' : 'dark')"
        class="rounded-lg p-2 text-slate-500 transition hover:bg-slate-100 hover:text-slate-700 dark:text-slate-400 dark:hover:bg-slate-800"
        aria-label="Toggle theme"
    >
        <span x-show="document.documentElement.classList.contains('dark')">
            <x-icon name="sun" class="size-5" />
        </span>
        <span x-show="!document.documentElement.classList.contains('dark')" x-cloak>
            <x-icon name="moon" class="size-5" />
        </span>
    </button>

    <div class="hidden h-6 w-px bg-slate-200 sm:block dark:bg-slate-700"></div>

    <button
        type="button"
        class="flex items-center gap-2.5 rounded-lg p-1.5 transition hover:bg-slate-100 dark:hover:bg-slate-800"
        aria-label="Account"
    >
        <span class="flex size-8 items-center justify-center rounded-full bg-gradient-to-br from-blue-500 to-sky-400 text-xs font-semibold text-white">
            DO
        </span>
        <span class="hidden text-left sm:block">
            <span class="block text-sm font-semibold leading-tight text-slate-900 dark:text-white">Dana Ops</span>
            <span class="block text-xs leading-tight text-slate-500 dark:text-slate-400">Lead Dispatcher</span>
        </span>
        <x-icon name="chevron-down" class="hidden size-4 text-slate-400 sm:block" />
    </button>
</header>
