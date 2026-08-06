@props(['status' => '', 'kind' => 'status'])

@php
    $statuses = [
        'available' => ['success', 'Available'],
        'en route' => ['info', 'En Route'],
        'en-route' => ['info', 'En Route'],
        'on route' => ['info', 'On Route'],
        'on break' => ['warning', 'On Break'],
        'assigned' => ['primary', 'Assigned'],
        'unassigned' => ['warning', 'Unassigned'],
        'en route' => ['info', 'En Route'],
        'in progress' => ['info', 'In Progress'],
        'full' => ['danger', 'Full'],
        'active' => ['success', 'Active'],
        'draft' => ['neutral', 'Draft'],
        'completed' => ['success', 'Completed'],
        'cancelled' => ['danger', 'Cancelled'],
        'on hold' => ['warning', 'On Hold'],
        'in maintenance' => ['danger', 'In Maintenance'],
        'charging' => ['warning', 'Charging'],
    ];

    $types = [
        'delivery' => ['primary', 'Delivery'],
        'pickup' => ['success', 'Pickup'],
        'transfer' => ['violet', 'Transfer'],
    ];

    $key = strtolower(trim($status));
    $map = $kind === 'type' ? $types : $statuses;
    [$color, $label] = $map[$key] ?? ['neutral', $status ?: '—'];
@endphp

<x-badge :color="$color">{{ $label }}</x-badge>
