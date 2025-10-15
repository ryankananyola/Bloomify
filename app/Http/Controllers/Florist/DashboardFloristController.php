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
        $user = Auth::user();

        if (!$user || !$user->florist) {
            return redirect()->route('login')->withErrors('Anda tidak memiliki akses ke dashboard florist.');
        }

        $floristId = $user->florist->id;

        $orders = Order::where('florist_id', $floristId)
            ->latest()
            ->take(5)
            ->get();

        $products = Products::where('florists_id', $floristId)->count();

        $revenue = Order::where('florist_id', $floristId)
            ->where('payment_status', 'Paid')
            ->sum('total_price');

        $stats = [
            'orders' => $orders,
            'products' => $products,
            'revenue' => $revenue,
        ];

        return view('florist.dashboard', compact('stats'));
    }

}
