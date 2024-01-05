<?php

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

Route::namespace('Admin')->prefix('admin')->group(function () {
    Route::get('/dashboard', [VisitorController::class, 'adminDashboard']);
    Route::get('/visitor', [VisitorController::class, 'adminIndex']);
});

Route::get('/', [VisitorController::class, 'HomeIndex']);
