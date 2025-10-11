<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\DashboardUserController;
use App\Http\Controllers\User\FloristController;

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'registerWeb'])->name('register.submit');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'loginWeb'])->name('login.submit');

Route::get('/dashboard_user', [DashboardUserController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard_user');

Route::get('/florists-all', [FloristController::class, 'index'])
    ->name('user.florists_all');

Route::get('/florist/{slug}', [FloristController::class, 'show'])->name('florist.show');

Route::post('/logout', [AuthController::class, 'logoutWeb'])->name('logout.web');

