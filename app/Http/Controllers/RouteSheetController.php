<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Support\Dispatch\DispatchData;
use Illuminate\View\View;

final class RouteSheetController extends Controller
{
    public function index(): View
    {
        return view('route-sheets.index', [
            'drivers' => DispatchData::drivers(),
            'trucks' => DispatchData::trucks(),
        ]);
    }

    public function show(int $id): View
    {
        $truck = collect(DispatchData::trucks())->firstWhere('id', $id) ?? DispatchData::trucks()[0];

        return view('route-sheets.show', [
            'driver' => collect(DispatchData::drivers())->firstWhere('id', $id) ?? DispatchData::drivers()[0],
            'truck' => $truck,
            'stops' => array_slice(DispatchData::reservations(), 0, 12),
        ]);
    }
}
