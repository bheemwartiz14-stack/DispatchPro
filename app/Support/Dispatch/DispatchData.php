<?php

declare(strict_types=1);

namespace App\Support\Dispatch;

/**
 * Single source of truth for Phase 1 dummy data.
 *
 * Every value is deliberately hard-coded so controllers can later swap these
 * array-backed fetchers for real repository/database queries without touching
 * the Blade templates.
 */
final class DispatchData
{
    /**
     * Statistic cards rendered on the dashboard.
     *
     * @return list<array{label: string, value: string, delta: string, trend: string, icon: string}>
     */
    public static function stats(): array
    {
        return [
            ['label' => 'Today\'s Deliveries', 'value' => '32', 'delta' => '+8', 'trend' => 'up', 'icon' => 'truck'],
            ['label' => 'Today\'s Pickups', 'value' => '48', 'delta' => '+12', 'trend' => 'up', 'icon' => 'arrow-down-tray'],
            ['label' => 'Drivers Working', 'value' => '6', 'delta' => '2 idle', 'trend' => 'flat', 'icon' => 'user-group'],
            ['label' => 'Golf Carts', 'value' => '50', 'delta' => '44 deployed', 'trend' => 'flat', 'icon' => 'scooter'],
            ['label' => 'Completed Stops', 'value' => '61', 'delta' => '24%', 'trend' => 'up', 'icon' => 'check-badge'],
            ['label' => 'Pending Stops', 'value' => '193', 'delta' => '12 on hold', 'trend' => 'down', 'icon' => 'clock'],
        ];
    }

    /**
     * Drivers assigned to trucks today.
     *
     * @return list<array{id: int, name: string, initials: string, color: string, truck: string,
     *                     license: string, phone: string, capacity: int, load: int,
     *                     status: string, stops: int}>
     */
    public static function drivers(): array
    {
        return [
            ['id' => 1, 'name' => 'Marcus Reed', 'initials' => 'MR', 'color' => 'bg-blue-600', 'truck' => 'Truck 01', 'license' => 'Golf Cart License', 'phone' => '(971) 555-0131', 'capacity' => 4, 'load' => 3, 'status' => 'Available', 'stops' => 18],
            ['id' => 2, 'name' => 'Priya Nair', 'initials' => 'PN', 'color' => 'bg-emerald-600', 'truck' => 'Truck 02', 'license' => 'Golf Cart License', 'phone' => '(971) 555-0117', 'capacity' => 4, 'load' => 4, 'status' => 'En Route', 'stops' => 14],
            ['id' => 3, 'name' => 'Omar Delgado', 'initials' => 'OD', 'color' => 'bg-amber-600', 'truck' => 'Truck 03', 'license' => 'Golf Cart License', 'phone' => '(971) 555-0194', 'capacity' => 4, 'load' => 2, 'status' => 'Available', 'stops' => 11],
            ['id' => 4, 'name' => 'Sofia Petrova', 'initials' => 'SP', 'color' => 'bg-sky-600', 'truck' => 'Truck 04', 'license' => 'Golf Cart License', 'phone' => '(971) 555-0166', 'capacity' => 4, 'load' => 4, 'status' => 'En Route', 'stops' => 16],
            ['id' => 5, 'name' => 'James Whitely', 'initials' => 'JW', 'color' => 'bg-violet-600', 'truck' => 'Truck 05', 'license' => 'Golf Cart License', 'phone' => '(971) 555-0129', 'capacity' => 4, 'load' => 1, 'status' => 'On Break', 'stops' => 9],
            ['id' => 6, 'name' => 'Hana Kim', 'initials' => 'HK', 'color' => 'bg-rose-600', 'truck' => 'Truck 06', 'license' => 'Golf Cart License', 'phone' => '(971) 555-0155', 'capacity' => 4, 'load' => 3, 'status' => 'Available', 'stops' => 12],
        ];
    }

    /**
     * @return list<array{id: int, number: string, driver: string, capacity: int, load: int,
     *                     status: string, route: string}>
     */
    public static function trucks(): array
    {
        return [
            ['id' => 1, 'number' => 'Truck 01', 'driver' => 'Marcus Reed', 'capacity' => 4, 'load' => 3, 'status' => 'On Route', 'route' => 'North Course'],
            ['id' => 2, 'number' => 'Truck 02', 'driver' => 'Priya Nair', 'capacity' => 4, 'load' => 4, 'status' => 'Full', 'route' => 'Lakeside'],
            ['id' => 3, 'number' => 'Truck 03', 'driver' => 'Omar Delgado', 'capacity' => 4, 'load' => 2, 'status' => 'On Route', 'route' => 'Fairways'],
            ['id' => 4, 'number' => 'Truck 04', 'driver' => 'Sofia Petrova', 'capacity' => 4, 'load' => 4, 'status' => 'Full', 'route' => 'Links'],
            ['id' => 5, 'number' => 'Truck 05', 'driver' => 'James Whitely', 'capacity' => 4, 'load' => 1, 'status' => 'On Route', 'route' => 'West Loop'],
            ['id' => 6, 'number' => 'Truck 06', 'driver' => 'Hana Kim', 'capacity' => 4, 'load' => 3, 'status' => 'On Route', 'route' => 'Meadows'],
        ];
    }

    /**
     * Golf cart inventory across the resort.
     *
     * @return list<array{id: int, number: string, model: string, driver: string|null,
     *                     guest: string|null, battery: int, status: string}>
     */
    public static function carts(): array
    {
        $registry = [
            'E-Z-GO RXV', 'Club Car Onward', 'Yamaha Drive2', 'E-Z-GO Freedom',
            'Club Car Tempo', 'Yamaha Quiet Tech',
        ];

        $drivers = self::drivers();
        $inUse = 0;

        foreach (range(1, 6) as $truck) {
            $inUse += self::trucks()[$truck - 1]['load'];
        }

        $inventory = [];
        foreach (range(1, 50) as $id) {
            $model = $registry[$id % count($registry)];

            if ($id <= $inUse) {
                $driver = $drivers[($id - 1) % count($drivers)]['name'];
                $status = 'Assigned';
                $battery = random_int(70, 100);
            } elseif ($id % 6 === 0) {
                $status = 'In Maintenance';
                $battery = 0;
                $driver = null;
            } elseif ($id % 5 === 0) {
                $status = 'Charging';
                $battery = random_int(15, 55);
                $driver = null;
            } else {
                $status = 'Available';
                $battery = random_int(60, 100);
                $driver = null;
            }

            $inventory[] = [
                'id' => $id,
                'number' => 'C-'.str_pad((string) $id, 2, '0', STR_PAD_LEFT),
                'model' => $model,
                'driver' => $driver,
                'guest' => null,
                'battery' => $battery,
                'status' => $status,
            ];
        }

        return $inventory;
    }

    /**
     * Reservations waiting to be dispatched or already on the board.
     *
     * @return list<array{id: int, reference: string, guest: string, phone: string, party_size: int,
     *                     track: string, type: string, status: string,
     *                     window: string, pickup: string, dropoff: string,
     *                     cart: string, driver: string|null}>
     */
    public static function reservations(): array
    {
        $guests = [
            'Avery Thompson' => 'North Gate Lobby',
            'Liam Nguyen' => 'Villa 24 Porch',
            'Mia Castillo' => 'South Clubhouse',
            'Noah Okafor' => 'Fairway 3 Cart Path',
            'Emma Laurent' => 'Main Hotel Lobby',
            'Lucas Meyer' => 'Lakeside Pavilion',
            'Zoe Al-Sayed' => 'Putting Green Circle',
            'Ethan Brooks' => 'East Parking Lot',
            'Isla Rosario' => 'Pro Shop Entrance',
            'Oliver Trent' => 'North Gate B',
            'Ava Petrov' => 'Meadows Trailhead',
            'Leo Mendoza' => 'West Pool Gate',
            'Grace Halloway' => 'Club Terrace',
            'Jack Dubois' => 'Cart Barn 2',
            'Nora Almeida' => 'Lakeview Villa 12',
        ];

        $statuses = ['assigned', 'assigned', 'en-route', 'completed', 'completed', 'unassigned', 'on-hold'];
        $types = ['delivery', 'pickup', 'delivery', 'pickup', 'transfer'];

        $rows = [];

        foreach (range(1, 50) as $index) {
            $guest = array_keys($guests)[$index % count($guests)];
            $type = $types[$index % count($types)];
            $status = $statuses[$index % count($statuses)];
            $driver = $status === 'unassigned' ? null : self::drivers()[$index % count(self::drivers())]['name'];

            $rows[] = [
                'id' => $index,
                'reference' => 'RSP-'.str_pad((string) (1000 + $index), 5, '0', STR_PAD_LEFT),
                'guest' => $guest,
                'phone' => '(971) 55'.substr((string) (1000 + $index), 0, 2).'-'.str_pad((string) $index, 4, '0', STR_PAD_LEFT),
                'party_size' => random_int(1, 4),
                'track' => $guests[$guest],
                'type' => $type,
                'status' => $status,
                'window' => self::windowFor($index),
                'pickup' => $guests[$guest],
                'dropoff' => array_values($guests)[($index + 3) % count($guests)],
                'cart' => 'C-'.str_pad((string) (($index % 50) + 1), 2, '0', STR_PAD_LEFT),
                'driver' => $driver,
            ];
        }

        return $rows;
    }

    /**
     * Reservations not yet assigned to a driver.
     *
     * @return list<array{id: int, reference: string, guest: string, phone: string, party_size: int,
     *                     track: string, type: string, status: string,
     *                     window: string, pickup: string, dropoff: string,
     *                     cart: string, driver: string|null}>
     */
    public static function unassigned(): array
    {
        return array_values(array_filter(
            self::reservations(),
            static fn (array $r): bool => $r['status'] === 'unassigned',
        ));
    }

    /**
     * Reservations grouped under a driver for the dispatch board.
     *
     * @return array<int, list<array{id: int, reference: string, guest: string, phone: string,
     *                              party_size: int, track: string, type: string, status: string,
     *                              window: string, pickup: string, dropoff: string,
     *                              cart: string, driver: string|null}>>
     */
    public static function board(): array
    {
        $board = [];

        foreach (self::drivers() as $index => $driver) {
            $board[$index] = array_values(array_filter(
                self::reservations(),
                static fn (array $r): bool => $r['driver'] === $driver['name'],
            ));
        }

        return $board;
    }

    /**
     * Dispatch plans with their manifest summaries.
     *
     * @return list<array{id: int, name: string, date: string, status: string,
     *                     reservations: int, drivers: int, start: string, end: string}>
     */
    public static function plans(): array
    {
        return [
            ['id' => 1, 'name' => 'Morning Wave — North Course', 'date' => 'Aug 06, 2026', 'status' => 'Active', 'reservations' => 24, 'drivers' => 6, 'start' => '08:00', 'end' => '11:30'],
            ['id' => 2, 'name' => 'Mid-Day — Lakeside & Fairways', 'date' => 'Aug 06, 2026', 'status' => 'Active', 'reservations' => 18, 'drivers' => 4, 'start' => '11:15', 'end' => '14:45'],
            ['id' => 3, 'name' => 'Afternoon — South + Meadows', 'date' => 'Aug 06, 2026', 'status' => 'Draft', 'reservations' => 21, 'drivers' => 5, 'start' => '14:30', 'end' => '18:00'],
            ['id' => 4, 'name' => 'Evening Transport Wave', 'date' => 'Aug 06, 2026', 'status' => 'Draft', 'reservations' => 12, 'drivers' => 3, 'start' => '18:00', 'end' => '21:30'],
            ['id' => 5, 'name' => 'Yesterday — Full Campus', 'date' => 'Aug 05, 2026', 'status' => 'Completed', 'reservations' => 46, 'drivers' => 6, 'start' => '08:00', 'end' => '21:00'],
        ];
    }

    /**
     * Recent activity feed.
     *
     * @return list<array{id: int, type: string, message: string, time: string}>
     */
    public static function activities(): array
    {
        return [
            ['id' => 1, 'type' => 'assignment', 'message' => 'Priya Nair assigned RSP-01002 to Truck 02', 'time' => '2m ago'],
            ['id' => 2, 'type' => 'import', 'message' => 'Reservations imported — 12 new entries', 'time' => '9m ago'],
            ['id' => 3, 'type' => 'status', 'message' => 'Cart C-07 marked as In Maintenance', 'time' => '14m ago'],
            ['id' => 4, 'type' => 'assignment', 'message' => 'Marcus Reed completed 5 stops on North Course', 'time' => '22m ago'],
            ['id' => 5, 'type' => 'plan', 'message' => 'Dispatch plan "Morning Wave" activated', 'time' => '34m ago'],
            ['id' => 6, 'type' => 'assignment', 'message' => 'Sofia Petrova assigned RSP-01011 to Truck 04', 'time' => '41m ago'],
            ['id' => 7, 'type' => 'import', 'message' => 'Validation complete — 22 rows passed, 2 warnings', 'time' => '48m ago'],
            ['id' => 8, 'type' => 'plan', 'message' => 'Route sheet printed for Truck 05 (West Loop)', 'time' => '1h ago'],
            ['id' => 9, 'type' => 'status', 'message' => 'Cart C-21 returned to the charging bay', 'time' => '1h ago'],
            ['id' => 10, 'type' => 'assignment', 'message' => 'Omar Delgado signed on for the morning shift', 'time' => '2h ago'],
            ['id' => 11, 'type' => 'plan', 'message' => 'Dispatch: “Evening Transport” moved to draft', 'time' => '2h ago'],
            ['id' => 12, 'type' => 'import', 'message' => '3 reservations cancelled by guest services', 'time' => '3h ago'],
            ['id' => 13, 'type' => 'assignment', 'message' => 'Hana Kim returned Truck 06 to the barn', 'time' => '3h ago'],
            ['id' => 14, 'type' => 'status', 'message' => 'Truck 04 reached full capacity (4/4 cart)', 'time' => '4h ago'],
            ['id' => 15, 'type' => 'plan', 'message' => 'Route optimization completed for Fairways zone', 'time' => '5h ago'],
            ['id' => 16, 'type' => 'status', 'message' => 'Cart C-21 flagged for battery swap', 'time' => '5h ago'],
            ['id' => 17, 'type' => 'assignment', 'message' => 'Marcus Reed finished morning route cleanup', 'time' => '6h ago'],
            ['id' => 18, 'type' => 'import', 'message' => 'Morning import batch archived (12 rows)', 'time' => '7h ago'],
            ['id' => 19, 'type' => 'plan', 'message' => 'Weekly report generated and shared', 'time' => '8h ago'],
            ['id' => 20, 'type' => 'status', 'message' => 'Campus wide cart health check complete', 'time' => '9h ago'],
        ];
    }

    /**
     * Chart series consumed by Chart.js on the reports page.
     *
     * @return array{deliveries: list<int>, pickups: list<int>, driver_performance: list<int>,
     *               truck_utilization: list<int>, cart_utilization: list<int>, labels: list<string>}
     */
    public static function reports(): array
    {
        return [
            'labels' => ['May', 'Jun', 'Jul', 'Aug 1', 'Aug 2', 'Aug 3', 'Aug 4', 'Aug 5', 'Aug 6'],
            'deliveries' => [120, 148, 162, 24, 31, 28, 35, 29, 32],
            'pickups' => [96, 124, 140, 22, 29, 25, 33, 27, 30],
            'driver_performance' => [12, 18, 16, 20, 14, 11, 15, 13, 17],
            'truck_utilization' => [62, 70, 74, 68, 82, 75, 86, 79, 83],
            'cart_utilization' => [58, 64, 71, 69, 77, 73, 84, 78, 81],
        ];
    }

    /**
     * Build a display delivery window for a reservation row.
     */
    private static function windowFor(int $index): string
    {
        $startHour = 8 + ($index % 12);
        $startMinute = ($index % 2) * 30;

        return \sprintf('%02d:%02d', $startHour, $startMinute).' — '.\sprintf('%02d:%02d', $startHour + 1, $startMinute);
    }
}
