<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// USER Controllers
use App\Http\Controllers\User\DashboardUserController;
use App\Http\Controllers\User\FloristController;
use App\Http\Controllers\User\TestimonialController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\CartController;

// FLORIST Controllers
use App\Http\Controllers\Florist\DashboardFloristController;
use App\Http\Controllers\Florist\ProductFloristController;
use App\Http\Controllers\Florist\OrderFloristController;

/*
|--------------------------------------------------------------------------
| Landing Page
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('landing');
})->name('landing');

/*
|--------------------------------------------------------------------------
| Authentication (Web)
|--------------------------------------------------------------------------
*/
Route::middleware('web')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
    Route::post('/register', [AuthController::class, 'registerWeb'])->name('register.submit');

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'loginWeb'])->name('login.submit');

    Route::post('/logout', [AuthController::class, 'logoutWeb'])->name('logout.web');
});


/*
|--------------------------------------------------------------------------
| Florist Dashboard
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'florist'])
    ->prefix('florist')
    ->name('florist.')
    ->group(function () {
        Route::get('/dashboard', [DashboardFloristController::class, 'index'])->name('dashboard');
        Route::resource('products', ProductFloristController::class);
        Route::get('/orders', [OrderFloristController::class, 'index'])->name('orders');
        Route::get('/orders/{order}', [OrderFloristController::class, 'show'])->name('orders.show');
        Route::patch('/orders/{order}/status', [OrderFloristController::class, 'updateStatus'])->name('orders.updateStatus');
        Route::get('/profile', fn() => view('florist.profile'))->name('profile');
    });

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/dashboard_user', [DashboardUserController::class, 'index'])->name('dashboard_user');
    Route::get('/orders/history', [OrderController::class, 'history'])->name('order.history');
    Route::get('/orders/history/tracking/{slug}', [OrderController::class, 'tracking'])->name('order.tracking');
    Route::get('/order/{order:slug}', [OrderController::class, 'show'])->name('order.show');
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::delete('/order/{order:slug}/cancel', [OrderController::class, 'cancel'])->name('order.cancel');
});

/*
|--------------------------------------------------------------------------
| Public Florist & Product Routes
|--------------------------------------------------------------------------
*/
Route::get('/user/search', [DashboardUserController::class, 'search'])->name('search');

Route::get('/florists-all', [FloristController::class, 'index'])->name('user.florists_all');
Route::get('/florist/{slug}', [FloristController::class, 'show'])->name('florist.show');
Route::get('/florist/{slug}/search', [FloristController::class, 'search'])->name('florist.search');

Route::get('/florist/{id}/testimonials', [TestimonialController::class, 'showFloristTestimonials'])
    ->name('florist.testimonials.detail');
Route::post('/testimonials/store', [TestimonialController::class, 'store'])
    ->name('testimonials.store');

Route::get('/florist/{florist_slug}/product/{product_slug}', [ProductController::class, 'show'])
    ->name('product.show');

/*
|--------------------------------------------------------------------------
| Payment
|--------------------------------------------------------------------------
*/
Route::get('/payment/{slug}', [OrderController::class, 'showPayment'])->name('payment.show');
Route::post('/payment/{slug}/submit', [OrderController::class, 'submitPayment'])->name('payment.submit');


/*|--------------------------------------------------------------------------
| Testimonial
|--------------------------------------------------------------------------*/
Route::get('/testimonial/create/{florist}/{order}', [TestimonialController::class, 'create'])
    ->name('testimonial.create');

Route::post('/testimonial/store', [TestimonialController::class, 'store'])
    ->name('testimonial.store');
    

/*|--------------------------------------------------------------------------
| Shopping Cart Routes
|--------------------------------------------------------------------------*/
Route::get('/cart', [CartController::class, 'index'])
    ->name('cart.index');
Route::post('/cart/add/{slug}', [CartController::class, 'add'])
    ->name('cart.add');
Route::post('/cart/remove/{slug}', [CartController::class, 'remove'])
    ->name('cart.remove');
Route::get('/checkout/{slug}', [OrderController::class, 'checkout'])
    ->name('checkout');
Route::get('/clear-cart', function() {
    session()->forget('cart');
    return 'Cart cleared!';
});


