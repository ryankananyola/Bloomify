@extends('layouts.florist')

@section('content')
<div class="container py-4 animate__animated animate__fadeIn">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-pink-600">
            🌸 Detail Produk
        </h2>
        <a href="{{ route('florist.products.index') }}" class="btn btn-outline-pink rounded-pill shadow-sm">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
        <div class="row g-0">
            <div class="col-md-5">
                <img 
                    src="{{ $product->image ? asset('storage/'.$product->image) : 'https://placehold.co/600x600?text=No+Image' }}" 
                    class="img-fluid w-100 h-100 object-fit-cover"
                    style="object-fit: cover; height: 100%;"
                    alt="{{ $product->name }}">
            </div>

            <div class="col-md-7 p-4">
                <h3 class="fw-bold text-pink-600 mb-3">{{ $product->name }}</h3>
                <p class="text-muted mb-4">{{ $product->description ?: 'Tidak ada deskripsi.' }}</p>

                <div class="mb-4">
                    <span class="fw-semibold text-muted">Harga:</span>
                    <h4 class="fw-bold text-pink-600 mt-1">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </h4>
                </div>

                @if(!empty($product->flowers))
                    <div class="mb-4">
                        <h6 class="fw-bold text-pink-600 mb-2">
                            🌼 Daftar Bunga yang Digunakan
                        </h6>
                        <ul class="list-group list-group-flush rounded-3 shadow-sm">
                            @foreach($product->flowers as $flower)
                                <li class="list-group-item">
                                    <i class="bi bi-flower1 text-pink-600 me-2"></i> {{ $flower }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="d-flex gap-2 mt-4">
                    <a href="{{ route('florist.products.edit', $product->slug) }}" 
                       class="btn btn-pink rounded-pill px-4 shadow-sm">
                        <i class="bi bi-pencil-square me-1"></i> Edit Produk
                    </a>

                    <form action="{{ route('florist.products.destroy', $product->slug) }}" 
                          method="POST" 
                          onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger rounded-pill px-4 shadow-sm">
                            <i class="bi bi-trash3"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Style --}}
<style>
    .text-pink-600 { color: #e64b7d !important; }
    .btn-pink { background-color: #e64b7d; color: #fff; transition: all 0.3s ease; }
    .btn-pink:hover { background-color: #d83b6e; transform: translateY(-2px); box-shadow: 0 6px 12px rgba(230,75,125,0.3); }
    .btn-outline-pink { color: #e64b7d; border-color: #e64b7d; transition: all 0.3s ease; }
    .btn-outline-pink:hover { background-color: #e64b7d; color: white; }
    .list-group-item { border: none; border-bottom: 1px solid #f3c6d4; }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@endsection
