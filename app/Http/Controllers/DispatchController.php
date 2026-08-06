<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Support\Dispatch\DispatchData;
use Illuminate\View\View;

final class DispatchController extends Controller
{
    public function index(): View
    {
        return view('dispatch.index', [
            'drivers' => DispatchData::drivers(),
            'trucks' => DispatchData::trucks(),
            'unassigned' => DispatchData::unassigned(),
            'board' => DispatchData::board(),
        ]);
    }

    public function import(): View
    {
        return view('dispatch.import', [
            'activities' => DispatchData::activities(),
        ]);
    }
}
