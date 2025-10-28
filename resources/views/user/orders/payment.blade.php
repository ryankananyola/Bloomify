@extends('layouts.layout_user')

@section('title', 'Checkout - ' . $order->product->name)

@section('content')
<div class="container checkout-page">
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
                <label class="form-label fw-semibold">Metode Pembayaran</label>
                <input type="text"
                       class="form-control border-pink rounded-3 bg-light"
                       value="{{ $order->payment_method }}"
                       readonly>
                <input type="hidden" name="payment_method" value="{{ $order->payment_method }}">
            </div>

            @if($order->payment_method == 'Transfer Bank')
                @php
                    $banks = [
                        ['name' => 'Bank BCA', 'logo' => 'assets/images/banks/bca.png', 'account' => '8467006678'],
                        ['name' => 'Bank Mandiri', 'logo' => 'assets/images/banks/mandiri.png', 'account' => '1370022084095'],
                        ['name' => 'Bank BRI', 'logo' => 'assets/images/banks/bri.png', 'account' => '307701036580537'],
                        ['name' => 'Bank BNI', 'logo' => 'assets/images/banks/bni.png', 'account' => '1234567890'],
                    ];
                    $owner = 'Yohanes Febryan Kana Nyola';
                    function formatAcct($acct) {
                        return preg_replace('/(\d)(?=(\d{3})+$)/', '$1', $acct);
                    }
                @endphp

                <div id="bank-info" class="payment-info">
                    <p class="fw-semibold text-secondary mb-2">Pilih salah satu rekening di bawah ini dear 💕</p>

                    <div class="row g-3">
                        @foreach($banks as $bank)
                            @php
                                $rawAcct = $bank['account'];
                                $displayAcct = formatAcct($rawAcct);
                            @endphp

                            <div class="col-12">
                                <div class="d-flex align-items-center p-3 border rounded-3 bank-card">
                                    <div class="me-3 bank-logo-wrap">
                                        <img src="{{ asset($bank['logo']) }}"
                                             alt="{{ $bank['name'] }} logo"
                                             class="bank-logo">
                                    </div>

                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="mb-1 fw-bold bank-name">{{ $bank['name'] }}</h6>
                                                <p class="mb-0 small text-muted">a.n {{ $owner }}</p>
                                            </div>

                                            <div class="text-end">
                                                <p class="mb-0 fw-semibold bank-number" data-raw="{{ $rawAcct }}">
                                                    {{ $displayAcct }}
                                                </p>
                                                <small class="text-muted">Klik salin</small>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="button"
                                            class="btn btn-sm btn-outline-pink ms-3 copy-btn"
                                            data-target="{{ $rawAcct }}">
                                        Salin
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if($order->payment_method == 'QRIS')
                <div id="qris-info" class="payment-info text-center">
                    <p class="fw-semibold text-secondary mb-2">Scan QRIS di bawah ini ya dear 💖</p>
                    <img src="{{ asset('assets/images/qris.png') }}"
                         alt="QRIS"
                         class="rounded-3"
                         width="220">
                    <p class="mt-2 small text-muted">
                        Total: 
                        <span class="fw-semibold text-danger">
                            Rp{{ number_format($order->total_price, 0, ',', '.') }}
                        </span>
                    </p>
                </div>
            @endif

            <div class="mb-3 mt-3">
                <label class="form-label fw-semibold">Nama Pengirim</label>
                <input type="text"
                       name="sender_name"
                       class="form-control border-pink rounded-3"
                       placeholder="Nama sesuai rekening / e-wallet"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Upload Bukti Pembayaran</label>
                <input type="file"
                       name="payment_proof"
                       accept="image/*"
                       class="form-control border-pink rounded-3"
                       required>
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
.checkout-page {
    max-width: 850px;
    margin: 0 auto;
    padding-top: 120px;
    padding-bottom: 80px; 
}
.border-pink {
    border: 1.5px solid #e64b7d;
}
.border-pink:focus {
    border-color: #e64b7d;
    box-shadow: 0 0 0 0.15rem rgba(230,75,125,0.2);
}
.bank-card {
    border-color: rgba(230,75,125,0.12);
    background: #fff;
}
.bank-logo-wrap {
    width: 56px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fff0f4;
    border-radius: 8px;
    padding: 6px;
}
.bank-logo {
    max-width: 100%;
    max-height: 28px;
    object-fit: contain;
}
.bank-number {
    font-size: 1rem;
    color: #c2185b;
    letter-spacing: 0.5px;
}
.btn-outline-pink {
    color: #e64b7d;
    border-color: #e64b7d;
    background: transparent;
    border-radius: 8px;
}
.btn-outline-pink:hover {
    background: rgba(230,75,125,0.06);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const copyBtns = document.querySelectorAll('.copy-btn');
    copyBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const raw = btn.getAttribute('data-target');
            if (!raw) return;
            navigator.clipboard?.writeText(raw).then(() => {
                const old = btn.innerText;
                btn.innerText = 'Tersalin';
                setTimeout(() => btn.innerText = old, 1500);
            }).catch(() => {
                const temp = document.createElement('input');
                temp.value = raw;
                document.body.appendChild(temp);
                temp.select();
                document.execCommand('copy');
                document.body.removeChild(temp);
                const old = btn.innerText;
                btn.innerText = 'Tersalin';
                setTimeout(() => btn.innerText = old, 1500);
            });
        });
    });
});
</script>
@endsection
