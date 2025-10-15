@extends('layouts.florist')

@section('content')
<div class="container py-4 animate__animated animate__fadeIn">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-pink-600">🌸 Produk Saya</h2>
        <a href="{{ route('florist.products.create') }}" class="btn btn-pink shadow-sm px-4 py-2 rounded-pill">
            <i class="bi bi-plus-circle me-1"></i> Tambah Produk
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-sm rounded-3 mb-4 animate__animated animate__fadeInDown">
            {{ session('success') }}
        </div>
    @endif

    <div class="row g-4">
        @forelse($products as $product)
            <div class="col-md-4 animate__animated animate__fadeInUp animate__delay-1s">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden product-card h-100">
                    <div class="position-relative overflow-hidden">
                        <img 
                            src="{{ $product->image ? asset('storage/'.$product->image) : 'https://placehold.co/600x400?text=No+Image' }}" 
                            class="card-img-top" 
                            style="height:220px; object-fit:cover; transition:transform 0.5s ease;"
                        >
                        <div class="card-img-overlay d-flex justify-content-end align-items-start p-3">
                            <span class="badge bg-light text-dark shadow-sm">#{{ $loop->iteration }}</span>
                        </div>
                    </div>

                    <div class="card-body d-flex flex-column">
                        <h5 class="fw-bold text-pink-600">{{ $product->name }}</h5>
                        <p class="text-muted small flex-grow-1">{{ Str::limit($product->description, 80) }}</p>
                        <p class="fw-semibold text-pink-600 fs-5 mb-3">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('florist.products.show', $product->slug) }}" 
                                class="btn btn-outline-pink btn-sm rounded-pill px-3 shadow-sm">
                                <i class="bi bi-eye"></i> Detail
                            </a>

                            <a href="{{ route('florist.products.edit', $product->slug) }}" 
                                class="btn btn-outline-pink btn-sm rounded-pill px-3 shadow-sm">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('florist.products.destroy', $product->slug) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Hapus produk ini?')" 
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm rounded-pill px-3 shadow-sm">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center mt-5 animate__animated animate__fadeIn">
                <img src="https://cdn-icons-png.flaticon.com/512/758/758651.png" width="100" class="mb-3 opacity-75">
                <p class="text-muted">Belum ada produk. Yuk, tambahkan produk pertamamu 🌸</p>
            </div>
        @endforelse
    </div>
</div>

<style>
    .text-pink-600 {
        color: #e64b7d !important;
    }

    .btn-pink {
        background-color: #e64b7d;
        color: white;
        transition: all 0.3s ease;
    }

    .btn-pink:hover {
        background-color: #d83b6e;
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(230, 75, 125, 0.3);
    }

    .btn-outline-pink {
        color: #e64b7d;
        border-color: #e64b7d;
        transition: all 0.3s ease;
    }

    .btn-outline-pink:hover {
        background-color: #e64b7d;
        color: #fff;
        box-shadow: 0 4px 8px rgba(230, 75, 125, 0.25);
    }

    .product-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .product-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 20px rgba(230, 75, 125, 0.25);
    }

    .product-card:hover img {
        transform: scale(1.05);
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@endsection
