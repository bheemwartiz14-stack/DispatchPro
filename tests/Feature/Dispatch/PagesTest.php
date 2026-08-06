<?php

use App\Support\Dispatch\DispatchData;

it('renders the dashboard page', function () {
    $this->get(route('dashboard.index'))
        ->assertOk()
        ->assertSee('Good morning, Dana')
        ->assertSee('Reservation Volume');
});

it('renders the dispatch board page', function () {
    $this->get(route('dispatch.index'))
        ->assertOk()
        ->assertSee('Dispatch Board')
        ->assertSee('Unassigned Reservations')
        ->assertSee('Optimize Route');
});

it('renders the import page', function () {
    $this->get(route('dispatch.import'))
        ->assertOk()
        ->assertSee('Import Reservations')
        ->assertSee('File Preview');
});

it('renders the reservations page', function () {
    $this->get(route('reservations.index'))
        ->assertOk()
        ->assertSee('Reservations')
        ->assertSee('New Reservation');
});

it('renders the drivers page', function () {
    $this->get(route('drivers.index'))
        ->assertOk()
        ->assertSee('Drivers')
        ->assertSee('Shift Overview');
});

it('renders the trucks page', function () {
    $this->get(route('trucks.index'))
        ->assertOk()
        ->assertSee('Trucks')
        ->assertSee('Fleet Summary');
});

it('renders the golf carts page', function () {
    $this->get(route('golf-carts.index'))
        ->assertOk()
        ->assertSee('Golf Carts')
        ->assertSee('Charging');
});

it('renders the dispatch plans page', function () {
    $this->get(route('dispatch-plans.index'))
        ->assertOk()
        ->assertSee('Dispatch Plans')
        ->assertSee('New Plan');
});

it('renders the route sheets index page', function () {
    $this->get(route('route-sheets.index'))
        ->assertOk()
        ->assertSee('Route Sheets')
        ->assertSee('Open Sheet');
});

it('renders a route sheet detail page', function () {
    $this->get(route('route-sheets.show', 1))
        ->assertOk()
        ->assertSee('Route Sheet')
        ->assertSee('Driver')
        ->assertSee('Print Sheet');
});

it('renders the reports page', function () {
    $this->get(route('reports.index'))
        ->assertOk()
        ->assertSee('Reports')
        ->assertSee('Truck Utilization');
});

it('renders the settings page', function () {
    $this->get(route('settings.index'))
        ->assertOk()
        ->assertSee('Settings')
        ->assertSee('Dispatch defaults');
});

it('provides the required volume of dummy data', function () {
    expect(DispatchData::reservations())->toHaveCount(50)
        ->and(DispatchData::drivers())->toHaveCount(6)
        ->and(DispatchData::trucks())->toHaveCount(6)
        ->and(DispatchData::carts())->toHaveCount(50)
        ->and(DispatchData::plans())->toBeGreaterThanOrEqual(5)
        ->and(DispatchData::activities())->toHaveCount(20);
});

it('includes realistic fields on every reservation', function () {
    expect(DispatchData::reservations())
        ->each(fn ($reservation) => $reservation
            ->reference->toStartWith('RSP-')
            ->guest->toBeString()
            ->window->toBeString()
            ->cart->toStartWith('C-'));
});