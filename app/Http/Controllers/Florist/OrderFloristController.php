<?php

namespace App\Http\Controllers\Florist;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OrderFloristController extends Controller
{
    public function index()
    {
        $floristId = Auth::user()->florist->id;
        $orders = Order::where('florist_id', $floristId)->latest()->paginate(10);
        return view('florist.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->florist_id !== Auth::user()->florist->id) {
            abort(403);
        }
        return view('florist.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        if ($order->florist_id !== Auth::user()->florist->id) {
            abort(403);
        }

        $request->validate(['status' => 'required']);

        $order->status = $request->status;

        switch ($request->status) {
            case 'Ready to Ship':
                $order->ready_at = $order->ready_at ?? Carbon::now('Asia/Jakarta');
                break;
            case 'Out for Delivery':
                $order->shipped_at = $order->shipped_at ?? Carbon::now('Asia/Jakarta');
                break;
            case 'Delivered':
                $order->delivered_at = $order->delivered_at ?? Carbon::now('Asia/Jakarta');
                break;
        }

        $order->save();

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
