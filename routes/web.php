<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\DashboardUserController;
use App\Http\Controllers\User\FloristController;
use App\Http\Controllers\User\TestimonialController;

// Landing Page
Route::get('/', function () {
    return view('landing');
})->name('landing');

// AUTHENTICATION
Route::get('/register', [AuthController::class, 'showRegisterForm'])
    ->name('register.form');
Route::post('/register', [AuthController::class, 'registerWeb'])
    ->name('register.submit');
Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->name('login.form');
Route::post('/login', [AuthController::class, 'loginWeb'])
    ->name('login.submit');
Route::post('/logout', [AuthController::class, 'logoutWeb'])
    ->name('logout.web');

// USER
Route::get('/dashboard_user', [DashboardUserController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard_user');
Route::get('/florists-all', [FloristController::class, 'index'])
    ->name('user.florists_all');
Route::get('/florist/{slug}', [FloristController::class, 'show'])
    ->name('florist.show');
Route::post('/testimonials/store', [TestimonialController::class, 'store'])
    ->name('testimonials.store');
Route::get('/florist/{id}/testimonials', [TestimonialController::class, 'showFloristTestimonials'])
    ->name('florist.testimonials.detail');



