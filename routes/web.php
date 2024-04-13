<?php

use App\Http\Controllers\ServicesController;
use App\Http\Controllers\VisitorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// this is my admin route

Route::namespace('admin')->prefix('admin')->group(function () {
    Route::get('/dashboard', [VisitorController::class, 'adminDashboard']);

    Route::get('/visitor', [VisitorController::class, 'adminIndex'])->name('dashboard.visitor');

    Route::get('/services', [ServicesController::class, 'services'])->name('dashboard.services');

    Route::get('/get-services-data', [ServicesController::class, 'servicesData'])->name('dashboard.servicesData');

    Route::post('/services-delete', [ServicesController::class, 'servicesDelete'])->name('dashboard.servicesDelete');

});

Route::get('/', [VisitorController::class, 'HomeIndex']);
