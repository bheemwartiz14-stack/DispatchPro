<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Support\Dispatch\DispatchData;
use Illuminate\View\View;

final class ReportController extends Controller
{
    public function index(): View
    {
        return view('reports.index', [
            'reports' => DispatchData::reports(),
            'stats' => DispatchData::stats(),
        ]);
    }
}
