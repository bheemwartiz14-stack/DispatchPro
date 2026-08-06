<x-layouts.app title="Golf Carts" active="golf-carts.index">
    <x-page-header title="Golf Carts" subtitle="Cart inventory, assignments, and maintenance status.">
        <x-slot:actions>
            <x-button color="primary" icon="plus">Add Cart</x-button>
        </x-slot:actions>
    </x-page-header>

    <div class="flex flex-wrap gap-2">
        <x-button color="secondary" size="sm">All ({{ count($carts) }})</x-button>
        <x-button color="secondary" size="sm">Available ({{ collect($carts)->where('status', 'Available')->count() }})</x-button>
        <x-button color="secondary" size="sm">Assigned ({{ collect($carts)->where('status', 'Assigned')->count() }})</x-button>
        <x-button color="secondary" size="sm">Charging ({{ collect($carts)->where('status', 'Charging')->count() }})</x-button>
        <x-button color="secondary" size="sm">Maintenance ({{ collect($carts)->where('status', 'In Maintenance')->count() }})</x-button>
    </div>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @foreach ($carts as $cart)
            <x-cart-card :cart="$cart" />
        @endforeach
    </div>
</x-layouts.app>