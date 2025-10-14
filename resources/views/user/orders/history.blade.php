@extends('layouts.layout_user')

@section('title', 'Pesanan - Bloomify')

@section('content')
<div class="container py-5" style="max-width: 900px; margin-top: 90px;">
    <h4 class="fw-bold mb-4 text-center" style="color:#e64b7d;">Riwayat Pesanan Anda</h4>

    @if($orders->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-bag-heart text-muted" style="font-size: 2.5rem;"></i>
            <p class="mt-3 text-muted">Belum ada pesanan yang dibuat 💐</p>
            <a href="{{ route('user.florists_all') }}" class="btn text-white rounded-pill px-4" style="background-color:#e64b7d;">Mulai Belanja</a>
        </div>
    @else
        @foreach($orders as $order)
        <div class="card shadow-sm border-0 rounded-4 mb-4 p-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('storage/' . $order->product->image) }}" 
                        alt="{{ $order->product->name }}" 
                        class="rounded-3 me-3" 
                        style="width:90px; height:90px; object-fit:cover;">
                    <div>
                        <h6 class="fw-bold mb-1">{{ $order->product->name }}</h6>
                        <p class="text-muted mb-1 small">{{ $order->product->florist->name ?? 'Florist' }}</p>
                        <p class="mb-0 small text-dark">
                            <strong>Total:</strong> Rp{{ number_format($order->total_price, 0, ',', '.') }}
                        </p>
                    </div>
                </div>

                <div class="text-end mt-3 mt-sm-0">
                    <span class="badge 
                        @if($order->payment_status == 'Paid') bg-success 
                        @elseif($order->payment_status == 'Pending') bg-warning text-dark 
                        @else bg-secondary 
                        @endif">
                        {{ ucfirst($order->payment_status ?? 'Pending') }}
                    </span>

                    <p class="small text-muted mt-2 mb-1">{{ $order->created_at->timezone('Asia/Jakarta')->format('d M Y | H:i') }}</p>

                    <a href="{{ route('order.tracking', $order->slug) }}" class="btn btn-sm rounded-pill text-white" style="background-color:#e64b7d;">
                        <i class="bi bi-truck"></i> Lihat Tracking
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    @endif
</div>
@endsection
