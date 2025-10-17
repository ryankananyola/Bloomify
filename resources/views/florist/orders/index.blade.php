@extends('layouts.florist')

@section('content')
<div class="container py-5 animate__animated animate__fadeIn">

    <div class="d-flex justify-content-between align-items-center mb-5">
        <h2 class="fw-bold text-pink-600 mb-0">
            <i class="bi bi-bag-check-fill me-2"></i> Pesanan Masuk
        </h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-sm rounded-3 mb-4 animate__animated animate__fadeInDown">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        </div>
    @endif

    @if($orders->count())
    <div class="table-responsive shadow-sm rounded-4 overflow-hidden bg-white animate__animated animate__fadeInUp">
        <table class="table align-middle mb-0 table-hover">
            <thead class="table-light text-center align-middle">
                <tr>
                    <th>ID Pesanan</th>
                    <th>Akun Pemesan</th>
                    <th>Nama Pemesan</th>
                    <th>Produk</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach($orders as $order)
                <tr class="align-middle table-row">
                    <td class="fw-semibold">#{{ $order->order_code }}</td>
                    <td class="fw-semibold">{{ $order->user->full_name ?? '-' }}</td>
                    <td class="fw-semibold">{{ $order->customer_name ?? '-' }}</td>

                    <td>
                        @if($order->product)
                            <div class="d-flex align-items-center justify-content-center gap-2">
                                <div class="product-img-wrapper">
                                    <img src="{{ $order->product->image ? asset('storage/'.$order->product->image) : 'https://placehold.co/60x60' }}" 
                                        class="rounded product-img shadow-sm" alt="produk">
                                </div>
                                <span>{{ $order->product->name }}</span>
                            </div>
                        @else
                            <span class="text-muted">Produk dihapus</span>
                        @endif
                    </td>

                    <td>{{ $order->created_at->translatedFormat('d F Y, H:i') }}</td>
                    <td class="fw-semibold text-pink-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>

                    <td>
                        <span class="badge status-badge 
                            @switch($order->status)
                                @case('Pending') bg-secondary @break
                                @case('Confirmed') bg-info text-dark @break
                                @case('Processing') bg-warning text-dark @break
                                @case('Ready to Ship') bg-success @break
                                @case('Out for Delivery') bg-pink text-white @break
                                @case('Delivered') bg-success @break
                                @default bg-light text-dark
                            @endswitch
                        ">
                            {{ $order->status }}
                        </span>
                    </td>

                    <td>
                        <a href="{{ route('florist.orders.show', $order->slug) }}" 
                            class="btn btn-outline-pink btn-sm rounded-pill px-3 shadow-sm btn-detail">
                            <i class="bi bi-eye"></i> Detail
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $orders->links() }}
    </div>

    @else
    <div class="text-center mt-5 animate__animated animate__fadeIn">
        <img src="https://cdn-icons-png.flaticon.com/512/4076/4076509.png" width="120" class="mb-3 opacity-75">
        <h5 class="fw-semibold text-muted">Belum ada pesanan saat ini 🧺</h5>
        <p class="text-secondary small">Pesanan pelanggan akan muncul di sini setelah mereka checkout produkmu.</p>
    </div>
    @endif
</div>

<style>
    /* 🌸 Warna tema utama */
    .text-pink-600 { color: #e64b7d !important; }

    /* 🌸 Tombol */
    .btn-outline-pink {
        color: #e64b7d;
        border-color: #e64b7d;
        transition: all 0.3s ease;
    }
    .btn-outline-pink:hover {
        background-color: #e64b7d;
        color: #fff;
        box-shadow: 0 4px 12px rgba(230, 75, 125, 0.3);
        transform: translateY(-1px);
    }

    /* 🩷 Badge Status */
    .status-badge {
        border-radius: 30px;
        font-size: 0.8rem;
        padding: 6px 14px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .status-badge:hover {
        transform: scale(1.05);
        box-shadow: 0 2px 6px rgba(230, 75, 125, 0.25);
    }

    .bg-pink {
        background-color: #e64b7d !important;
    }

    /* 🌸 Gambar Produk */
    .product-img-wrapper {
        position: relative;
        width: 50px;
        height: 50px;
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .product-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.4s ease;
    }

    .product-img-wrapper:hover .product-img {
        transform: scale(1.1);
        filter: brightness(1.1);
    }

    /* ✨ Table Styling */
    table {
        font-size: 0.95rem;
        border-collapse: separate;
        border-spacing: 0 8px;
    }

    tbody tr {
        transition: all 0.25s ease;
    }

    tbody tr:hover {
        background-color: #fff5f8;
        transform: scale(1.005);
        box-shadow: 0 4px 10px rgba(230, 75, 125, 0.05);
    }

    thead tr th {
        background-color: #ffe4ec !important;
        color: #e64b7d;
        border-bottom: 2px solid #f8c9d9;
    }

    .btn-detail {
        transition: all 0.3s ease;
    }

    .btn-detail:hover {
        transform: translateY(-1px);
    }

    .pagination {
        --bs-pagination-active-bg: #e64b7d;
        --bs-pagination-active-border-color: #e64b7d;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@endsection
