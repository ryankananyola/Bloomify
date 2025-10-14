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

        $productPrice = $product->price * $request->quantity;

        $paperBagFee = (strtolower($request->paper_bag) === 'yes' || $request->paper_bag === 'Paper Bag')
            ? 10000 * $request->quantity
            : 0;

        $deliveryFee = (strtolower($request->pickup_method) === 'pick up') ? 0 : 26000;

        $adminFee = 9500;

        $total = $productPrice + $paperBagFee + $deliveryFee + $adminFee;

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
        $product = $order->product;

        $floristSlug = $product->florist->slug ?? null;
        $productSlug = $product->slug ?? null;

        $order->delete();

        if ($floristSlug && $productSlug) {
            return redirect()->route('product.show', [
                'florist_slug' => $floristSlug,
                'product_slug' => $productSlug,
            ])->with('success', 'Pesanan telah dibatalkan 💔');
        }

        return redirect()->route('dashboard_user')
                        ->with('success', 'Pesanan telah dibatalkan 💔');
    }

    public function showPayment($slug)
    {
        $order = Order::where('slug', $slug)->firstOrFail();
        return view('user.orders.payment', compact('order'));
    }

    public function submitPayment(Request $request, $slug)
    {
        $order = Order::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'payment_method' => 'required|string|max:100',
            'sender_name' => 'required|string|max:100',
            'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $proofPath = $request->file('payment_proof')->store('order/payment', 'public');

        $order->update([
            'payment_method' => $validated['payment_method'],
            'sender_name' => $validated['sender_name'], 
            'payment_proof' => $proofPath,
            'payment_status' => 'Paid', 
            'status' => 'Confirmed',
        ]);

        return redirect()->route('dashboard_user')
            ->with('success', 'Bukti pembayaran berhasil dikirim 💖');
    }

}
