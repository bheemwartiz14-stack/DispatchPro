@props(['title' => ''])

<x-layouts.base :title="$title">
    <div class="flex min-h-screen items-center justify-center bg-slate-50 px-6 py-12 dark:bg-slate-950">
        <div class="w-full max-w-md">
            {{ $slot }}
        </div>
    </div>
</x-layouts.base>
