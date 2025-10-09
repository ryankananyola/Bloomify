@extends('layouts.layout_user')

@section('title', 'Dashboard - Bloomify')

@section('content')
<section class="hero-section">
    <div class="hero-content" data-aos="fade-up">
        <h1>Welcome to <span>Bloomify!</span> 🌸</h1>
        <p>Start your day with a bloom. Let the good mood begin!</p>
        <div class="hero-search position-relative">
            <i class="bi bi-search search-icon"></i>
            <input type="text" class="form-control ps-5" placeholder="Search here ya dear...">
        </div>
    </div>
</section>

<div class="location-input py-5">
    <div class="container">
        <h5>Hello, <span class="text-pink">Bloomy!</span> 🌸</h5>
        <p>Let’s make it easy — add your location to find flower shops near you!</p>
        <div class="location-search d-flex align-items-center gap-3">
            <i class="bi bi-geo-alt-fill text-pink fs-4"></i>
            <input type="text" class="form-control rounded-pill" placeholder="📍 Jl. Tirtoboyeh No.1, Babarsari, Yogyakarta">
        </div>
    </div>
</div>

<section class="container py-5">
    <h2 class="section-title text-center mb-4">Find Your Favorite Flower Shop 💐</h2>
    <div class="row g-4">
        @for ($i = 0; $i < 6; $i++)
        <div class="col-md-4">
            <div class="card florist-card">
                <img src="https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?auto=format&fit=crop&w=800&q=60" alt="Florist">
                <div class="card-body">
                    <h5>Kanihera Florist</h5>
                    <p class="text-muted"><i class="bi bi-geo-alt"></i> Jl. Mawar No. 15, Bali</p>
                    <div class="d-flex align-items-center">
                        <i class="bi bi-star-fill text-warning me-1"></i> 4.8 (250 reviews)
                    </div>
                </div>
            </div>
        </div>
        @endfor
    </div>
</section>
@endsection
