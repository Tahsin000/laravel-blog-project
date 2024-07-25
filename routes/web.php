<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Frontend\BlogController as FrontendBlogController;
use App\Http\Controllers\Frontend\CourseController as FrontendCourseController;
use App\Http\Controllers\Frontend\PolicyController;
use App\Http\Controllers\Frontend\ProjectController as FrontendProjectController;
use App\Http\Controllers\Frontend\TermsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReviewController;
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

Route::middleware(['loginCheck'])->namespace('admin')->prefix('admin')->group(function () {
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


    //---------- Course Route
    Route::get('/course', [CourseController::class, 'index'])->name('dashboard.course');

    Route::get('/get-course-data', [CourseController::class, 'getCourseData'])->name('dashboard.get-course-data');

    Route::post('/course-details', [CourseController::class, 'courseDetails'])->name('dashboard.course-details');

    Route::post('/course-delete', [CourseController::class, 'courseDelete'])->name('dashboard.course-delete');

    Route::post('/course-update', [CourseController::class, 'courseUpdate'])->name('dashboard.course-update');

    Route::post('/course-add-new', [CourseController::class, 'courseAddNew'])->name('dashboard.course-add-new');

    //---------- Project
    Route::get('/project', [ProjectController::class, 'index'])->name('dashboard.project');
    Route::get('/get-project-data', [ProjectController::class, 'projectsData'])->name('dashboard.projectData');
    Route::post('/project-add-new', [ProjectController::class, 'projectAddNew'])->name('dashboard.project-add-new');
    Route::post('/project-details', [ProjectController::class, 'projectDetails'])->name('dashboard.project-details');
    Route::post('/project-delete', [ProjectController::class, 'projectDelete'])->name('dashboard.project-delete');
    Route::post('/project-update', [ProjectController::class, 'projectUpdate'])->name('dashboard.project-update');

    //---------- Contact
    Route::get('/contact', [ContactController::class, 'index'])->name('dashboard.contact');
    Route::get('/get-contact-data', [ContactController::class, 'contactsData'])->name('dashboard.contactData');
    Route::post('/contact-delete', [ContactController::class, 'contactDelete'])->name('dashboard.contact-delete');

    //---------- Review
    Route::get('/review', [ReviewController::class, 'index'])->name('dashboard.review');
    Route::get('/get-review-data', [ReviewController::class, 'reviewsData'])->name('dashboard.reviewData');
    Route::post('/review-add-new', [ReviewController::class, 'reviewAddNew'])->name('dashboard.review-add-new');
    Route::post('/review-details', [ReviewController::class, 'reviewDetails'])->name('dashboard.review-details');
    Route::post('/review-delete', [ReviewController::class, 'reviewDelete'])->name('dashboard.review-delete');
    Route::post('/review-update', [ReviewController::class, 'reviewUpdate'])->name('dashboard.review-update');

    //---------- Blog
    Route::get('/blog', [BlogController::class, 'index'])->name('dashboard.blog');
    Route::get('/get-blog-data', [BlogController::class, 'blogsData'])->name('dashboard.blogData');
    Route::post('/blog-add-new', [BlogController::class, 'blogAddNew'])->name('dashboard.blog-add-new');
    Route::post('/blog-details', [BlogController::class, 'blogDetails'])->name('dashboard.blog-details');
    Route::post('/blog-delete', [BlogController::class, 'blogDelete'])->name('dashboard.blog-delete');
    Route::post('/blog-update', [BlogController::class, 'blogUpdate'])->name('dashboard.blog-update');

    //---------- Gallery
    Route::get('/gallery', [PhotoController::class, 'index'])->name('dashboard.gallery');
    Route::post('/photo-upload', [PhotoController::class, 'upload'])->name('dashboard.gallery.upload');
    Route::get('/photo-json', [PhotoController::class, 'PhotoJSON'])->name('dashboard.gallery.PhotoJSON');
    Route::get('/photo-json/{id}', [PhotoController::class, 'PhotoJSONByID'])->name('dashboard.gallery.PhotoJSONId');
    Route::post('/photo-delete', [PhotoController::class, 'photoDelete'])->name('dashboard.gallery.photoDelete');
});

Route::get('/', [VisitorController::class, 'HomeIndex']);
Route::post('/contactSend', [VisitorController::class, 'contactSend']);

Route::get('/projects', [FrontendProjectController::class, 'index'])->name('frontend.projects');
Route::get('/course', [FrontendCourseController::class, 'index'])->name('frontend.course');
Route::get('/policy', [PolicyController::class, 'index'])->name('frontend.policy');
Route::get('/terms', [TermsController::class, 'index'])->name('frontend.terms');
Route::get('/blog', [FrontendBlogController::class, 'index'])->name('frontend.blog');
Route::get('/contact', function(){
    return view('Frontend.contact'); 
})->name('frontend.contact');

Route::get('/login',[LoginController::class, 'index'])->name('adminLogin');
Route::post('/on-login',[LoginController::class, 'onLogin'])->name('adminLogin.verify');
Route::get('/on-logout',[LoginController::class, 'onLogout'])->name('adminLogout');