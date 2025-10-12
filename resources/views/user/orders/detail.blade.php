@extends('layouts.layout_user')

@section('content')
<div class="container" style="max-width:1000px; padding-top:120px; padding-bottom:80px;">
    <h4 class="fw-bold" style="color:#e64b7d;">Hi, {{ $order->customer_name }}!</h4>
    <p class="text-muted">
        Terima kasih telah memesan bunga di Bloomify! 💐<br>
        Silakan periksa kembali pesananmu di bawah ini, dear 💖<br>
        Setelah pesanan sesuai, lanjutkan ke pembayaran agar pesanan segera kami proses 🌸
    </p>

    <hr style="border:1px solid #f5c6d6; margin: 20px 0;">

    <h5 class="fw-semibold mb-3" style="color:#e64b7d;">Detail Pesanan</h5>
    <div class="row align-items-center">
        <div class="col-md-4 d-flex justify-content-center">
            <div class="p-3 rounded-4 shadow-sm" 
                style="background-color:#fff0f5; border:2px solid #f8c8dc; width:100%; max-width:280px;">
                <img src="{{ asset('storage/' . $order->product->image) }}" 
                    alt="{{ $order->product->name }}" 
                    class="rounded-4 w-100" 
                    style="object-fit:cover;">
            </div>
        </div>

        <div class="col-md-8 mt-3 mt-md-0">
            <table class="table table-borderless" style="font-size: 0.95rem;">
                <tbody>
                    <tr><td style="width:160px;">Flower Name</td><td>: {{ $order->product->name }}</td></tr>
                    <tr><td>Name</td><td>: {{ $order->customer_name }}</td></tr>
                    <tr><td>Phone Number</td><td>: {{ $order->customer_phone }}</td></tr>
                    <tr><td>Order Qty</td><td>: {{ $order->quantity }}</td></tr>
                    <tr><td>Pick Up</td><td>: {{ $order->pickup_method }}</td></tr>
                    <tr><td>Pick Up Date</td><td>: {{ \Carbon\Carbon::parse($order->pickup_date)->translatedFormat('l, d F Y') }}</td></tr>
                    <tr><td>Time</td><td>: {{ $order->pickup_time }}</td></tr>
                    <tr><td>Address</td><td>: {{ $order->address ?? '-' }}</td></tr>
                    <tr><td>Paper Bag</td><td>: {{ $order->paper_bag }}</td></tr>
                    <tr><td>Greeting Card</td><td>: {{ $order->greeting_card ? 'Yes' : 'No' }}</td></tr>
                    <tr><td>Greeting Message</td><td>: {{ $order->greeting_message ?? '-' }}</td></tr>
                    <tr><td>Additional Request</td><td>: {{ $order->additional_request ?? '-' }}</td></tr>
                    <tr><td>Payment Method</td><td>: {{ $order->payment_method }}</td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <h5 class="fw-semibold mb-3 mt-4" style="color:#e64b7d;">Payment</h6>
    <div class="payment-section mt-3 p-4 rounded-4 shadow-sm">
        <div class="voucher-box mb-4">
            <label class="fw-semibold mb-2 d-block" style="color:#e64b7d;">Got a voucher code, Blomy? 💖</label>
            <div class="input-group">
                <input type="text" class="form-control rounded-start-4 border-pink" placeholder="Enter it here dear!">
                <button class="btn text-white rounded-end-4 fw-semibold" style="background-color:#e64b7d;">Apply</button>
            </div>
        </div>

        <div class="payment-summary bg-white rounded-4 p-3">
            <table class="table table-borderless mb-0" style="font-size:0.95rem;">
                <tbody>
                    <tr>
                        <td class="text-secondary">Sub Total</td>
                        <td class="text-end">Rp{{ number_format($order->product->price, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="text-secondary">Quantity</td>
                        <td class="text-end">{{ $order->quantity }}</td>
                    </tr>
                    <tr>
                        <td class="text-secondary">Delivery Fee</td>
                        <td class="text-end">Rp26.000</td>
                    </tr>
                    <tr>
                        <td class="text-secondary">Admin Fee</td>
                        <td class="text-end">Rp9.500</td>
                    </tr>
                    <tr>
                        <td class="text-secondary">Voucher</td>
                        <td class="text-end">-</td>
                    </tr>
                    <tr class="border-top">
                        <td class="fw-bold pt-3" style="color:#e64b7d;">Total</td>
                        <td class="fw-bold text-danger text-end pt-3">Rp{{ number_format($order->total_price + 26000 + 9500, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="text-end mt-4">
        <form action="{{ route('order.cancel', $order->slug) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-light border rounded-pill px-4 me-2"
                    onclick="return confirm('Yakin ingin membatalkan pesanan ini, dear? 💔')">
                Cancel
            </button>
        </form>

        <a href="#" class="btn text-white rounded-pill px-5" style="background-color:#e64b7d;">
            <i class="bi bi-bag-heart"></i> Checkout and Payment
        </a>
    </div>
</div>

<style>
.border-pink {
    border: 1.5px solid #e64b7d;
}
.border-pink:focus {
    border-color: #e64b7d;
    box-shadow: 0 0 0 0.2rem rgba(230,75,125,0.15);
}
.payment-section {
    border: 2px solid #f8c8d9;
    background-color: #fff9fb;
    transition: all 0.3s ease;
}
.payment-section:hover {
    box-shadow: 0 4px 15px rgba(230, 75, 125, 0.15);
    transform: translateY(-2px);
}

.voucher-box .form-control {
    border: 1.5px solid #f5b5c6;
    font-size: 0.9rem;
}
.voucher-box .form-control:focus {
    border-color: #e64b7d;
    box-shadow: 0 0 0 0.2rem rgba(230,75,125,0.1);
}
.table td {
    padding: 0.45rem 0.5rem;
}

</style>
@endsection
