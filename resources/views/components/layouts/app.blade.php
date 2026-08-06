@props(['title' => '', 'active' => '', 'maxWidth' => 'max-w-7xl'])

<x-layouts.base :title="$title">
    <div class="flex h-screen overflow-hidden bg-slate-50 dark:bg-slate-950">
        <x-partials.app.sidebar :active="$active" />

        <div class="flex min-w-0 flex-1 flex-col">
            <x-partials.app.header :title="$title" />

            <main class="scrollbar-slim flex-1 overflow-y-auto">
                <div class="{{ $maxWidth }} mx-auto space-y-6 px-4 py-6 sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
                <x-partials.app.footer />
            </main>
        </div>
    </div>
</x-layouts.base>
