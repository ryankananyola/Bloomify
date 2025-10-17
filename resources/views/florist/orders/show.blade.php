@extends('layouts.florist')

@section('content')
<div class="container py-5 animate__animated animate__fadeIn">
    <h2 class="fw-bold text-pink-600 mb-4">
        <i class="bi bi-receipt-cutoff me-2"></i> Detail Pesanan #{{ $order->order_code }}
    </h2>

    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        <div class="card-body p-4">
            <h5 class="fw-semibold mb-3 text-pink-600">Informasi Pelanggan</h5>
            <p><strong>Akun Pemesan:</strong> {{ $order->user->full_name ?? '-' }}</p>
            <p><strong>Nama Pemesan:</strong> {{ $order->customer_name ?? '-' }}</p>
            <p><strong>Alamat:</strong> {{ $order->address ?? '-' }}</p>
            <p><strong>Tanggal Pesan:</strong> {{ $order->created_at->format('d M Y, H:i') }}</p>
            <p><strong>Status Saat Ini:</strong> {{ $order->status }}</p>

            <hr>

            <h5 class="fw-semibold mb-3 text-pink-600">Detail Produk</h5>
            @if($order->product)
                <div class="d-flex align-items-center gap-3 mb-3">
                    <img src="{{ asset('storage/'.$order->product->image) }}" width="80" height="80" class="rounded shadow-sm" style="object-fit:cover;">
                    <div>
                        <p class="fw-semibold mb-1">{{ $order->product->name }}</p>
                        <p class="text-muted small mb-1">Harga: Rp {{ number_format($order->product->price, 0, ',', '.') }}</p>
                        <p class="fw-semibold text-pink-600">Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                    </div>
                </div>
            @endif

            <hr>

            <h5 class="fw-semibold mb-3 text-pink-600">Status Pesanan</h5>
            <form action="{{ route('florist.orders.updateStatus', $order->slug) }}" method="POST" class="d-flex align-items-center gap-2">
                @csrf
                @method('PATCH')
                <select name="status" class="form-select form-select-sm w-auto text-pink-600 rounded-pill" onchange="this.form.submit()">
                    @foreach(['Pending', 'Confirmed', 'Processing', 'Ready to Ship', 'Out for Delivery', 'Delivered'] as $status)
                        <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>
                <span class="text-muted small">(ubah status akan otomatis tersimpan)</span>
            </form>

            <hr>

            <a href="{{ route('florist.orders') }}" class="btn btn-outline-pink rounded-pill px-4 mt-3">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>

<style>
.text-pink-600 { color: #e64b7d !important; }
.btn-outline-pink {
    color: #e64b7d;
    border-color: #e64b7d;
    transition: all 0.3s ease;
}
.btn-outline-pink:hover {
    background-color: #e64b7d;
    color: white;
    box-shadow: 0 4px 10px rgba(230, 75, 125, 0.25);
}
</style>
@endsection
