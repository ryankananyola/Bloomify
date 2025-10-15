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

Route::middleware(['auth:sanctum', 'florist'])->get('/florist/stats', function () {
    $florist = Auth::user()->florist;
    $floristId = $florist->id ?? null;

    return [
        'orders' => \App\Models\Order::where('florist_id', $floristId)->latest()->take(5)->get(),
        'products' => \App\Models\Products::where('florists_id', $floristId)->count(),
        'revenue' => \App\Models\Order::where('florist_id', $floristId)
                        ->where('payment_status', 'Paid')
                        ->sum('total_price'),
    ];
});
