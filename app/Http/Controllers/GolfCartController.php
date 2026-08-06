<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Support\Dispatch\DispatchData;
use Illuminate\View\View;

final class GolfCartController extends Controller
{
    public function index(): View
    {
        return view('golf-carts.index', [
            'carts' => DispatchData::carts(),
        ]);
    }
}
