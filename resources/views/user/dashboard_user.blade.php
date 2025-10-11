@extends('layouts.layout_user')

@section('title', 'Dashboard - Bloomify')

@section('content')
<section class="hero-section fade-up">
    <div class="hero-content" data-aos="fade-up">
        <h1>Welcome to <span>Bloomify!</span> 🌸</h1>
        <p>Start your day with a bloom. Let the good mood begin!</p>
        <div class="hero-search position-relative">
            <i class="bi bi-search search-icon"></i>
            <input type="text" class="form-control ps-5" placeholder="Search here ya dear...">
        </div>
    </div>
</section>

<div class="location-input py-5 fade-up">
    <div class="container">
        <h5>Hello, <span class="text-pink">Bloomy!</span> 🌸</h5>
        <p>Let’s make it easy — add your location to find flower shops near you!</p>
        <div class="location-search d-flex align-items-center gap-3">
            <i class="bi bi-geo-alt-fill text-pink fs-4"></i>
            <input type="text" class="form-control rounded-pill" placeholder="📍 Jl. Tirtoboyeh No.1, Babarsari, Yogyakarta">
        </div>
    </div>
</div>

<section class="container py-5 fade-up">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="section-title mb-0">find your favorite flower shop right here!💐</h2>
        <a href="{{ route('user.florists_all') }}" class="see-all-link">See All</a>
    </div>

    <div class="row g-4">
        @foreach ($florists as $florist)
        <div class="col-md-4 florist-item fade-up">
            <div class="florist-card border-0 shadow-sm rounded-4 overflow-hidden position-relative">

                @php
                    $now = now()->setTimezone('Asia/Jakarta');
                    $open = \Carbon\Carbon::createFromFormat('H:i:s', $florist->open_time, 'Asia/Jakarta');
                    $close = \Carbon\Carbon::createFromFormat('H:i:s', $florist->close_time, 'Asia/Jakarta');
                @endphp

                @if ($now->lt($open) || $now->gt($close))
                    <span class="badge bg-danger position-absolute m-3 px-3 py-2 rounded-pill">Close</span>
                @else
                    <span class="badge bg-success position-absolute m-3 px-3 py-2 rounded-pill">Open</span>
                @endif

                <img src="{{ asset('storage/' . $florist->image) }}" 
                     alt="{{ $florist->name }}" 
                     class="florist-img">

                <div class="card-body p-3">
                    <h5 class="fw-semibold florist-name mb-1">{{ $florist->name }}</h5>

                    <p class="text-muted small mb-2 d-flex align-items-center">
                        <i class="bi bi-geo-alt me-1 text-pink"></i>
                        <span class="text-truncate" style="max-width: 240px;">
                            {{ $florist->address }}
                        </span>
                    </p>

                    <div class="d-flex align-items-center justify-content-between mb-1">
                        <small class="text-muted d-flex align-items-center">
                            <i class="bi bi-tag me-1 text-pink"></i>
                            Start From {{ number_format($florist->start_price, 0, ',', '.') }}
                        </small>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-star-fill text-warning me-1"></i>
                            <small class="fw-semibold text-success">{{ number_format($florist->rating, 1) }}</small>
                        </div>
                    </div>

                    <small class="text-muted d-block">
                        <i class="bi bi-clock me-1 text-pink"></i>
                        Open {{ $florist->open_time_formatted }} - Closed {{ $florist->close_time_formatted }}
                    </small>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<section class="bouquets-section py-5 text-center fade-up">
    <div class="container">
        <h3 class="section-title mb-3">the bouquets created by others !</h3>
        <p class="section-subtitle mb-5">
            Experience the stunning bouquets already designed and ordered by others. <br>
            Don’t miss out on the opportunity to enjoy their beauty for yourself.
        </p>

        <div class="bouquet-scroll">
            @foreach ([ 
                ['Velvet Bloom', 'Kaninara Florist', 'https://images.unsplash.com/photo-1588166524941-3bf61a9c41db?auto=format&fit=crop&w=800&q=60'],
                ['Blushing Beauty', 'Melati Florist', 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?auto=format&fit=crop&w=800&q=60'], 
                ['Eternal Elegance', 'Daisy Florist', 'https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=800&q=60'],
                ['Spring Symphony', 'Lily Florist', 'https://images.unsplash.com/photo-1515377905703-c4788e51af15?auto=format&fit=crop&w=800&q=60'],
                ['Morning Bliss', 'Orchid Florist', 'https://images.unsplash.com/photo-1501004318641-b39e6451bec6?auto=format&fit=crop&w=800&q=60'],
                ['Radiant Joy', 'Flower Haven', 'https://images.unsplash.com/photo-1617137968427-85924c800a22?auto=format&fit=crop&w=800&q=60'], 
            ] as $item)
            <div class="bouquet-card text-start fade-up">
                <img src="{{ $item[2] }}" alt="{{ $item[0] }}">
                <div class="card-body">
                    <h5 class="fw-semibold mt-2">{{ $item[0] }}</h5>
                    <p class="text-muted small mb-2">
                        created by: <span class="fw-medium text-dark">{{ $item[1] }}</span>
                    </p>
                    <button class="btn btn-outline-pink">see more details...</button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


<section class="testimonials py-5 fade-up">
    <div class="container text-center">
        <h3 class="section-title">hear what our lovely customers say about Bloomify 🌷</h3>
        <div class="row g-4 mt-4">
            <div class="col-md-4 fade-up">
                <div class="testimonial-card p-4">
                    <div class="stars">★★★★★</div>
                    <p>"Aku benar-benar terkesan dengan pelayanannya! Bunga-bunganya segar dan dikemas dengan sangat indah."</p>
                    <h6 class="mt-3 mb-0">Rina Sariwati</h6>
                    <small class="text-muted">Content Creator</small>
                </div>
            </div>
            <div class="col-md-4 fade-up">
                <div class="testimonial-card p-4">
                    <div class="stars">★★★★★</div>
                    <p>"Aku suka banget! Bunga-bunganya segar, wangi, dan warnanya menenangkan banget. Pasti order lagi."</p>
                    <h6 class="mt-3 mb-0">Linda Kusumawardani</h6>
                    <small class="text-muted">Freelance Designer</small>
                </div>
            </div>
            <div class="col-md-4 fade-up">
                <div class="testimonial-card p-4">
                    <div class="stars">★★★★★</div>
                    <p>"Harga terjangkau, respon cepat, dan pengiriman juga aman. Super recommended!"</p>
                    <h6 class="mt-3 mb-0">Cahyady Anjeli</h6>
                    <small class="text-muted">Makeup Artist</small>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="instagram-section py-5 text-center fade-up">
    <div class="container">
        <h3 class="section-title">which bouquet is your inspiration?</h3>
        <p class="section-subtitle">Follow us on Instagram</p>
        <h4 class="brand-logo">Bloomify</h4>
        <div class="row g-4 mt-4">
            @for ($i = 0; $i < 4; $i++)
            <div class="col-md-3 fade-up">
                <img src="https://images.unsplash.com/photo-1509042239860-f550ce710b93?auto=format&fit=crop&w=800&q=60"
                    alt="Instagram Post" class="img-fluid rounded-4 shadow-sm">
            </div>
            @endfor
        </div>
    </div>
</section>

<script>
document.querySelectorAll('.bouquet-scroll').forEach(scrollContainer => {
    scrollContainer.addEventListener('wheel', (evt) => {
        evt.preventDefault();
        scrollContainer.scrollLeft += evt.deltaY;
    });
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const elements = document.querySelectorAll('.fade-up');
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) entry.target.classList.add('show');
        });
    }, { threshold: 0.15 });
    elements.forEach(el => observer.observe(el));
});
</script>

@endsection
