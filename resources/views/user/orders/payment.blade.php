@extends('layouts.layout_user')

@section('content')
<div class="container py-5" style="max-width: 850px; padding-top: 120px;">
    <div class="text-center mb-4">
        <h4 class="fw-bold" style="color:#e64b7d;">Checkout & Payment</h4>
        <p class="text-muted">Yuk selesaikan pembayaranmu agar pesanan segera kami proses 💖</p>
    </div>

    <div class="card shadow-sm border-0 rounded-4 p-4">
        <h6 class="fw-semibold mb-3" style="color:#e64b7d;">Order Summary</h6>
        <div class="d-flex align-items-center mb-3">
            <img src="{{ asset('storage/' . $order->product->image) }}" 
                 alt="{{ $order->product->name }}" 
                 class="rounded-3 me-3" 
                 style="width:90px; height:90px; object-fit:cover;">
            <div>
                <h6 class="fw-bold mb-1">{{ $order->product->name }}</h6>
                <p class="text-muted small mb-0">Qty: {{ $order->quantity }}</p>
                <p class="text-muted small mb-0">
                    Total: 
                    <span class="fw-semibold text-danger">
                        Rp{{ number_format($order->total_price, 0, ',', '.') }}
                    </span>
                </p>
            </div>
        </div>

        <hr>

        <form action="{{ route('payment.submit', $order->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="payment_method" class="form-label fw-semibold">Metode Pembayaran</label>
                <select name="payment_method" id="payment_method" class="form-select border-pink rounded-3" required>
                    <option value="" selected disabled>Pilih metode pembayaran</option>
                    <option value="Transfer Bank">Transfer Bank</option>
                    <option value="QRIS">QRIS</option>
                </select>
            </div>

            <div id="bank-info" class="payment-info" style="display:none;">
                <div class="p-3 border rounded-3 mb-3" style="border-color:#f8c8dc;">
                    <p class="mb-1 fw-semibold text-secondary">Transfer ke rekening berikut:</p>
                    <p class="mb-0 small">
                        <span class="fw-bold text-dark">BCA - 1234567890</span><br>
                        a.n <span class="fw-semibold">Bloomify Florist</span>
                    </p>
                </div>
            </div>

            <div id="qris-info" class="payment-info" style="display:none;">
                <div class="text-center mb-3">
                    <p class="fw-semibold text-secondary mb-2">Scan QR berikut untuk pembayaran:</p>
                    <img src="{{ asset('assets/images/qris.png') }}" alt="QRIS" class="rounded-3" width="220">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Pengirim</label>
                <input type="text" name="sender_name" class="form-control border-pink rounded-3" placeholder="Nama sesuai rekening / e-wallet" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Upload Bukti Transfer</label>
                <input type="file" name="payment_proof" accept="image/*" class="form-control border-pink rounded-3" required>
                <small class="text-muted">Format: JPG, JPEG, PNG (max 2MB)</small>
            </div>

            <div class="text-end mt-4">
                <button type="submit" class="btn text-white rounded-pill px-4" style="background-color:#e64b7d;">
                    <i class="bi bi-send"></i> Kirim Pembayaran
                </button>
            </div>
        </form>
    </div>
</div>

<style>
.border-pink {
    border: 1.5px solid #e64b7d;
}
.border-pink:focus {
    border-color: #e64b7d;
    box-shadow: 0 0 0 0.15rem rgba(230,75,125,0.2);
}
.card {
    background-color: #fffdfd !important;
}
</style>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const methodSelect = document.getElementById('payment_method');
    const bankInfo = document.getElementById('bank-info');
    const qrisInfo = document.getElementById('qris-info');

    methodSelect.addEventListener('change', function() {
        bankInfo.style.display = this.value === 'Transfer Bank' ? 'block' : 'none';
        qrisInfo.style.display = this.value === 'QRIS' ? 'block' : 'none';
    });
});
</script>
@endsection
