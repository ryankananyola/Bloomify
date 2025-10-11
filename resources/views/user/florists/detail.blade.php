@extends('layouts.layout_user')

@section('title', $florist->name . ' - Bloomify')

@section('content')
<section class="py-5 text-center fade-in-section">
    <div class="container">
        <h2 class="fw-bold mb-3" style="color:#e64b7d;">{{ $florist->name }}</h2>
        <p class="text-muted mb-4">{{ $florist->address }}</p>

        <div class="row g-4 justify-content-center">
            @forelse($florist->products as $product)
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm rounded-4">
                        <img src="{{ asset('storage/'.$product->image) }}" class="card-img-top" style="height:200px; object-fit:cover;">
                        <div class="card-body">
                            <h6 class="fw-semibold">{{ $product->name }}</h6>
                            <p class="text-muted small mb-1">{{ $product->price }}</p>
                            <a href="#" class="btn btn-sm rounded-pill text-white" style="background-color:#e64b7d;">Order Now</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">Belum ada produk di florist ini 🌸</p>
            @endforelse
        </div>
    </div>
</section>
@endsection
