<?php

use App\Http\Controllers\CourseController;
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
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    Route::get('/dashboard', [VisitorController::class, 'adminDashboard'])->name('admin.dashboard');

    Route::get('/visitor', [VisitorController::class, 'adminIndex'])->name('dashboard.visitor');


    
// Services Route
    Route::get('/services', [ServicesController::class, 'services'])->name('dashboard.services');

    Route::get('/get-services-data', [ServicesController::class, 'servicesData'])->name('dashboard.servicesData');

    Route::post('/services-details', [ServicesController::class, 'servicesDetails'])->name('dashboard.servicesDetails');

    Route::post('/services-delete', [ServicesController::class, 'servicesDelete'])->name('dashboard.servicesDelete');

    Route::post('/services-update', [ServicesController::class, 'servicesUpdate'])->name('dashboard.servicesDelete');

    Route::post('/services-add-new', [ServicesController::class, 'servicesAddNew'])->name('dashboard.servicesDelete');
    

// Course Route
    Route::get('/course', [CourseController::class,'index'])->name('dashboard.course');
    
    Route::get('/get-course-data', [CourseController::class,'getCourseData'])->name('dashboard.get-course-data');
    
    Route::post('/course-details', [CourseController::class,'courseDetails'])->name('dashboard.course-details');

    Route::post('/course-delete', [CourseController::class, 'courseDelete'])->name('dashboard.course-delete');

    Route::post('/course-update', [CourseController::class, 'courseUpdate'])->name('dashboard.course-update');

    Route::post('/course-add-new', [CourseController::class, 'courseAddNew'])->name('dashboard.course-add-new');

});

Route::get('/', [VisitorController::class, 'HomeIndex']);
