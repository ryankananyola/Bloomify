<?php

namespace App\Http\Controllers\Florist;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;

class DashboardFloristController extends Controller
{
    public function index()
    {
        $florist = Auth::user()->florist;
        $floristId = $florist->id ?? null;

        $orders = Order::where('florist_id', $floristId)->latest()->take(5)->get();
        $products = Products::where('florists_id', $floristId)->count();
        $revenue = Order::where('florist_id', $floristId)
                        ->where('payment_status', 'Paid')
                        ->sum('total_price');

        return view('florist.dashboard', compact('orders', 'products', 'revenue'));
    }
}
