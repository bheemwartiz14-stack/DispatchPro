<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Support\Dispatch\DispatchData;
use Illuminate\View\View;

final class DashboardController extends Controller
{
    public function index(): View
    {
        return view('dashboard.index', [
            'stats' => DispatchData::stats(),
            'reservations' => DispatchData::reservations(),
            'plans' => DispatchData::plans(),
            'activities' => DispatchData::activities(),
            'drivers' => DispatchData::drivers(),
            'reports' => DispatchData::reports(),
        ]);
    }
}
