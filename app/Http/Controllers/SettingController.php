<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\View\View;

final class SettingController extends Controller
{
    public function index(): View
    {
        return view('settings.index');
    }
}
