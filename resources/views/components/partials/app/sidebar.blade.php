@props(['active' => ''])

@php
    $groups = [
        'Overview' => [
            ['name' => 'dashboard.index', 'label' => 'Dashboard', 'icon' => 'home'],
        ],
        'Dispatch' => [
            ['name' => 'dispatch.index', 'label' => 'Dispatch Dashboard', 'icon' => 'map'],
            ['name' => 'dispatch.import', 'label' => 'Import Reservations', 'icon' => 'arrow-down-tray'],
        ],
        'Operations' => [
            ['name' => 'dispatch-plans.index', 'label' => 'Dispatch Plans', 'icon' => 'clipboard-list'],
            ['name' => 'reservations.index', 'label' => 'Reservations', 'icon' => 'calendar'],
            ['name' => 'drivers.index', 'label' => 'Drivers', 'icon' => 'user-group'],
            ['name' => 'trucks.index', 'label' => 'Trucks', 'icon' => 'truck'],
            ['name' => 'golf-carts.index', 'label' => 'Golf Carts', 'icon' => 'bolt'],
        ],
        'Reporting' => [
            ['name' => 'route-sheets.index', 'label' => 'Route Sheets', 'icon' => 'document'],
            ['name' => 'reports.index', 'label' => 'Reports', 'icon' => 'chart-bar'],
        ],
        'System' => [
            ['name' => 'settings.index', 'label' => 'Settings', 'icon' => 'cog'],
        ],
    ];

    $current = $active !== '' ? $active : request()->route()?->getName();
@endphp

<aside
    class="fixed inset-y-0 left-0 z-40 w-72 shrink-0 transform border-r border-slate-200 bg-white transition-transform duration-300 lg:static lg:translate-x-0 dark:border-slate-800 dark:bg-slate-900"
    :class="$store.app.sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
>
    <div class="flex h-full flex-col">
        <div class="flex h-16 items-center justify-between gap-3 border-b border-slate-200 px-5 dark:border-slate-800">
            <a href="{{ route('dashboard.index') }}" class="flex items-center gap-3" aria-label="DispatchPro home">
                <span class="flex size-9 items-center justify-center rounded-xl bg-blue-600 text-white shadow-sm">
                    <x-icon name="bolt" class="size-5" />
                </span>
                <span class="text-lg font-bold tracking-tight text-slate-900 dark:text-white">
                    Dispatch<span class="text-blue-600">Pro</span>
                </span>
            </a>
            <button
                type="button"
                class="rounded-lg p-1.5 text-slate-500 hover:bg-slate-100 hover:text-slate-700 lg:hidden dark:hover:bg-slate-800 dark:hover:text-slate-200"
                @click="$store.app.sidebarOpen = false"
                aria-label="Close sidebar"
            >
                <x-icon name="x-mark" class="size-5" />
            </button>
        </div>

        <nav class="scrollbar-slim flex-1 space-y-6 overflow-y-auto px-3 py-5">
            @foreach ($groups as $heading => $items)
                <div>
                    <p class="px-3 text-xs font-semibold uppercase tracking-wider text-slate-400 dark:text-slate-500">
                        {{ $heading }}
                    </p>
                    <div class="mt-2 space-y-1">
                        @foreach ($items as $item)
                            <a
                                href="{{ route($item['name']) }}"
                                class="group flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium transition
                                    {{ request()->routeIs($item['name']) ? 'bg-blue-50 text-blue-700 dark:bg-blue-950/50 dark:text-blue-300' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white' }}"
                            >
                                <x-icon :name="$item['icon']" class="size-5 shrink-0" />
                                {{ $item['label'] }}
                                @if ($item['name'] === 'dispatch.index' && request()->routeIs('dispatch.index'))
                                    <span class="ml-auto size-1.5 rounded-full bg-blue-600"></span>
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </nav>

        <div class="border-t border-slate-200 p-4 dark:border-slate-800">
            <div class="flex items-center gap-3 rounded-xl bg-slate-50 p-3 dark:bg-slate-800/60">
                <span class="flex size-9 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-blue-500 to-sky-400 text-sm font-semibold text-white">
                    DJ
                </span>
                <div class="min-w-0 flex-1">
                    <p class="truncate text-sm font-semibold text-slate-900 dark:text-white">Dana Ops</p>
                    <p class="truncate text-xs text-slate-500 dark:text-slate-400">Lead Dispatcher</p>
                </div>
                <x-icon name="dots-horizontal" class="size-5 shrink-0 text-slate-400" />
            </div>
        </div>
    </div>
</aside>

<button
    type="button"
    class="fixed inset-0 z-30 hidden bg-slate-900/50 backdrop-blur-sm lg:hidden"
    :class="$store.app.sidebarOpen ? 'block' : 'hidden'"
    @click="$store.app.sidebarOpen = false"
    aria-label="Close sidebar overlay"
></button>
