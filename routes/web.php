<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'registerWeb'])->name('register.submit');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'loginWeb'])->name('login.submit');

Route::get('/dashboard_user', function () {
    return view('dashboard_user');
})->middleware('auth')->name('dashboard_user');

Route::get('/florists-all', function () {
    return view('users.florists_all');
})->name('users.florists.all');


Route::post('/logout', [AuthController::class, 'logoutWeb'])->name('logout.web');

