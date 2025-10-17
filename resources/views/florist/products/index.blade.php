@extends('layouts.florist')

@section('content')
<div class="container py-5 animate__animated animate__fadeIn">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h2 class="fw-bold text-pink-600 mb-0">🌸 Katalog Saya</h2>
        <a href="{{ route('florist.products.create') }}" class="btn btn-gradient shadow-sm px-4 py-2 rounded-pill fw-semibold">
            <i class="bi bi-plus-circle me-2"></i>Tambah Produk
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-sm rounded-3 mb-4 animate__animated animate__fadeInDown">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        </div>
    @endif

    @if($products->count())
        <div class="row g-4">
            @foreach($products as $product)
            <div class="col-md-4">
                <a href="{{ route('florist.products.show', $product->slug) }}" 
                   class="text-decoration-none text-dark">
                    <div class="card product-card border-0 shadow-lg rounded-4 overflow-hidden position-relative">
                        <div class="image-wrapper position-relative">
                            <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://placehold.co/600x400?text=No+Image' }}"
                                 alt="{{ $product->name }}"
                                 class="card-img-top img-fluid">
                        </div>

                        <div class="card-body text-center p-4">
                            <h5 class="fw-bold text-pink-600 mb-2">{{ $product->name }}</h5>
                            <p class="text-muted small mb-3">{{ Str::limit($product->description, 70) }}</p>
                            <div class="fw-semibold text-pink-600 fs-5 mb-0">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    @else
        <div class="text-center mt-5 animate__animated animate__fadeIn">
            <img src="https://cdn-icons-png.flaticon.com/512/758/758651.png" width="110" class="mb-4 opacity-75">
            <h5 class="fw-semibold text-muted">Belum ada produk 🌷</h5>
            <p class="text-secondary small">Yuk, tambahkan produk pertamamu agar toko kamu makin cantik!</p>
        </div>
    @endif
</div>

<style>
    /* Warna tema utama */
    .text-pink-600 {
        color: #e64b7d !important;
    }

    /* Tombol gradien lembut */
    .btn-gradient {
        background: linear-gradient(135deg, #ff85b3, #e64b7d);
        color: white;
        transition: all 0.3s ease;
    }

    .btn-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(230, 75, 125, 0.3);
    }

    /* Kartu produk */
    .product-card {
        transition: transform 0.4s ease, box-shadow 0.4s ease;
        background-color: #fffafc;
        cursor: pointer;
    }

    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(230, 75, 125, 0.25);
    }

    /* Gambar produk */
    .image-wrapper {
        position: relative;
        overflow: hidden;
    }

    .image-wrapper img {
        height: 220px;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .product-card:hover img {
        transform: scale(1.08);
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@endsection
