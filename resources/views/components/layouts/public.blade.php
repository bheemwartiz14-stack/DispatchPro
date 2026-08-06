@props(['title' => ''])

<x-layouts.base :title="$title">
    <x-partials.public.header />

    <main>
        <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:px-8">
            {{ $slot }}
        </div>
    </main>

    <x-partials.public.footer />
</x-layouts.base>
