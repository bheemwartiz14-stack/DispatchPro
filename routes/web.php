<?php

declare(strict_types=1);

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DispatchController;
use App\Http\Controllers\DispatchPlanController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\GolfCartController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RouteSheetController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TruckController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/dispatch', [DispatchController::class, 'index'])->name('dispatch.index');
Route::get('/dispatch/import', [DispatchController::class, 'import'])->name('dispatch.import');
Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
Route::get('/drivers', [DriverController::class, 'index'])->name('drivers.index');
Route::get('/trucks', [TruckController::class, 'index'])->name('trucks.index');
Route::get('/golf-carts', [GolfCartController::class, 'index'])->name('golf-carts.index');
Route::get('/dispatch-plans', [DispatchPlanController::class, 'index'])->name('dispatch-plans.index');

Route::get('/route-sheets', [RouteSheetController::class, 'index'])->name('route-sheets.index');
Route::get('/route-sheets/{id}', [RouteSheetController::class, 'show'])->name('route-sheets.show');

Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
require __DIR__.'/settings.php';
