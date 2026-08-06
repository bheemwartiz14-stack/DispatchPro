<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Support\Dispatch\DispatchData;
use Illuminate\View\View;

final class ReservationController extends Controller
{
    public function index(): View
    {
        return view('reservations.index', [
            'reservations' => DispatchData::reservations(),
            'drivers' => DispatchData::drivers(),
        ]);
    }
}
