<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Products;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'customer_name' => 'required|string|max:100',
            'customer_phone' => 'required|string|max:20',
            'quantity' => 'required|integer|min:1',
            'pickup_method' => 'required|string',
            'pickup_date' => 'nullable|date',
            'pickup_time' => 'nullable',
            'paper_bag' => 'required|string',
            'greeting_card' => 'required|string',
            'greeting_message' => 'nullable|string',
            'additional_request' => 'nullable|string',
            'address' => 'nullable|string',
            'payment_method' => 'required|string',
        ]);

        $product = Products::findOrFail($request->product_id);

        $total = $product->price * $request->quantity;
        if ($request->paper_bag == 'Paper Bag') {
            $total += 10000;
        }

        $slug = Str::slug($product->name . '-' . Str::random(5));

        $order = Order::create([
            'product_id' => $product->id,
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'quantity' => $request->quantity,
            'pickup_method' => $request->pickup_method,
            'pickup_date' => $request->pickup_date,
            'pickup_time' => $request->pickup_time,
            'paper_bag' => $request->paper_bag,
            'greeting_card' => $request->greeting_card == 'Ya',
            'greeting_message' => $request->greeting_message,
            'additional_request' => $request->additional_request,
            'address' => $request->address,
            'payment_method' => $request->payment_method,
            'total_price' => $total,
            'status' => 'Pending',
            'slug' => $slug, 
        ]);

        return redirect()->route('order.show', $order->slug);
    }

    public function show(Order $order)
    {
        return view('user.orders.detail', compact('order'));
    }

    public function cancel(Order $order)
    {
        $productSlug = $order->product->slug ?? null;

        $order->delete();

        if ($productSlug) {
            return redirect()->route('product.show', $productSlug)
                            ->with('success', 'Pesanan telah dibatalkan 💔');
        }

        // Kalau produk tidak ditemukan, balik ke dashboard
        return redirect()->route('dashboard_user')
                        ->with('success', 'Pesanan telah dibatalkan 💔');
    }

}
