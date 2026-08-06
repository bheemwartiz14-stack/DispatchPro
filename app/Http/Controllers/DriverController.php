<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Support\Dispatch\DispatchData;
use Illuminate\View\View;

final class DriverController extends Controller
{
    public function index(): View
    {
        return view('drivers.index', [
            'drivers' => DispatchData::drivers(),
            'stats' => DispatchData::stats(),
        ]);
    }
}
