@extends('layouts.layout_user')

@section('title', 'Pesanan - Bloomify')

@section('content')
<div class="container py-5" style="max-width: 900px; margin-top: 90px;">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-4" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
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
                <div class="d-flex align-items-center mb-3 mb-sm-0">
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

                <div class="text-end">
                    <span class="badge 
                        @switch($order->status)
                            @case('Pending') bg-secondary @break
                            @case('Confirmed') bg-info @break
                            @case('Processing') bg-warning text-dark @break
                            @case('Being Prepared') bg-primary @break
                            @case('Ready to Ship') bg-success @break
                            @case('Out for Delivery') bg-pink text-white @break
                            @case('Delivered') bg-success @break
                            @default bg-light text-dark
                        @endswitch
                    ">
                        {{ ucfirst($order->status ?? 'Pending') }}
                    </span>

                    <p class="small text-muted mt-2 mb-2">{{ $order->created_at->timezone('Asia/Jakarta')->format('d M Y | H:i') }}</p>

                    <div class="d-flex align-items-center justify-content-end gap-2 flex-wrap">
                        <a href="{{ route('order.tracking', $order->slug) }}" 
                            class="btn btn-sm rounded-pill text-white" 
                            style="background-color:#e64b7d;">
                            <i class="bi bi-truck"></i> Lihat Tracking
                        </a>

                        @if($order->status === 'Delivered')
                            <a href="{{ route('testimonial.create', ['florist' => $order->product->florist->id, 'order' => $order->id]) }}" 
                                class="btn btn-sm rounded-pill text-white" 
                                style="background-color:#ff69b4;">
                                <i class="bi bi-chat-heart"></i> Kirim Testimoni
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @endif
</div>
@endsection
