<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\OrderController;

// AUTH
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

Route::get('/florist/stats', function () {
    $floristId = 1; // sementara aja buat uji
    return [
        'orders' => \App\Models\Order::where('florist_id', $floristId)->latest()->take(5)->get(),
        'products' => \App\Models\Products::where('florists_id', $floristId)->count(),
        'revenue' => \App\Models\Order::where('florist_id', $floristId)
                        ->where('payment_status', 'Paid')
                        ->sum('total_price'),
    ];
});

