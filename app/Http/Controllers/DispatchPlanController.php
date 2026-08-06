<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Support\Dispatch\DispatchData;
use Illuminate\View\View;

final class DispatchPlanController extends Controller
{
    public function index(): View
    {
        return view('dispatch-plans.index', [
            'plans' => DispatchData::plans(),
            'drivers' => DispatchData::drivers(),
        ]);
    }
}
