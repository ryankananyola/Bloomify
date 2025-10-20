@extends('layouts.layout_user')

@section('title', 'Dashboard - Bloomify')

@section('content')
<section class="hero-section fade-up">
    <div class="hero-content" data-aos="fade-up">
        <h1>Welcome to <span>Bloomify!</span> 🌸</h1>
        <p>Start your day with a bloom. Let the good mood begin!</p>
        <div class="hero-search position-relative">
            <i class="bi bi-search search-icon"></i>
            <input type="text" id="searchInput" class="form-control ps-5" placeholder="Search here ya dear...">
        </div>
    </div>
</section>

<div id="searchResults" class="search-results container" style="display:none;">
    <div class="search-card shadow-sm p-4 rounded-4 bg-white">
        <h5 class="fw-bold text-pink mb-3 d-flex align-items-center">
            <i class="bi bi-search-heart me-2"></i> Search Results
        </h5>
        <div id="searchFlorists" class="mb-4"></div>
        <div id="searchProducts"></div>
    </div>
</div>

<div class="location-input py-5 fade-up">
    <div class="container">
        <h5>Hello, <span class="text-pink">Blomy!</span> 🌸</h5>
        <p><strong>Let’s make it easy — add your location to find flower shops near you!</strong></p>
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
            @if ($florist->is_always_closed)
                <div class="florist-card border-0 shadow-sm rounded-4 overflow-hidden position-relative opacity-75">
            @else
                <a href="{{ route('florist.show', $florist->slug) }}" class="text-decoration-none text-dark">
                <div class="florist-card border-0 shadow-sm rounded-4 overflow-hidden position-relative hover-card">
            @endif

                    @php
                        $now = now()->setTimezone('Asia/Jakarta');
                        $open = \Carbon\Carbon::createFromFormat('H:i:s', $florist->open_time, 'Asia/Jakarta');
                        $close = \Carbon\Carbon::createFromFormat('H:i:s', $florist->close_time, 'Asia/Jakarta');
                    @endphp

                    @if ($florist->is_always_closed)
                        <span class="badge bg-danger position-absolute m-3 px-3 py-2 rounded-pill">Close</span>
                    @elseif ($now->lt($open) || $now->gt($close))
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
                            <span class="text-truncate" style="max-width: 240px;">{{ $florist->address }}</span>
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
                            @if ($florist->is_always_closed)
                                Closed permanently
                            @else
                                Open {{ $florist->open_time_formatted }} - Closed {{ $florist->close_time_formatted }}
                            @endif
                        </small>
                    </div>

            @if ($florist->is_always_closed)
                </div>
            @else
                </div></a>
            @endif
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
            @forelse ($topProducts as $product)
                <div class="bouquet-card text-start fade-up">
                    <img src="{{ asset('storage/' . $product->image) }}" 
                        alt="{{ $product->name }}" class="rounded-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-semibold mt-2 bouquet-name">{{ $product->name }}</h5>
                        <p class="text-muted small mb-2 created-by">
                            <i class="bi bi-shop text-pink me-1"></i>
                            <span class="text-dark florist-name">
                                {{ $product->florist->name ?? 'Unknown Florist' }}
                            </span>
                        </p>
                        @if ($product->florist && $product->florist->slug && $product->slug)
                            <a href="{{ route('product.show', [
                                    'florist_slug' => $product->florist->slug,
                                    'product_slug' => $product->slug
                                ]) }}" 
                                class="btn btn-sm btn-pink mt-2 px-3 py-2 rounded-pill shadow-sm">
                                <i class="bi bi-eye me-1"></i> Lihat Detail
                            </a>
                        @else
                            <button class="btn btn-sm btn-pink mt-2 px-3 py-2 rounded-pill shadow-sm" disabled>
                                <i class="bi bi-eye me-1"></i> Lihat Detail
                            </button>
                        @endif

                    </div>
                </div>
            @empty
                <p class="text-muted">No bouquets available yet 🌷</p>
            @endforelse
        </div>
    </div>
</section>

<section class="testimonials py-5 fade-up">
    <div class="container text-center">
        <h3 class="section-title mb-4">
            hear what our lovely customers say about Bloomify 🌷
        </h3>

        <div class="row g-4 mt-4 justify-content-center">
            <div class="col-md-4 fade-up">
                <div class="testimonial-card p-4 shadow-sm rounded-4 position-relative">
                    <div class="d-flex flex-column align-items-center">
                        <img src="https://i.pravatar.cc/100?u=rina" 
                             alt="Rina Sariwati" 
                             class="rounded-circle mb-3 shadow-sm" width="80" height="80">
                        <div class="stars text-warning fs-5 mb-2">★★★★★</div>
                        <p class="text-muted mb-3">"Aku benar-benar terkesan dengan pelayanannya! Bunga-bunganya segar dan dikemas dengan sangat indah."</p>
                        <h6 class="fw-semibold mb-0">Rina Sariwati</h6>
                        <small class="text-muted">Content Creator</small>
                    </div>
                </div>
            </div>

            <div class="col-md-4 fade-up">
                <div class="testimonial-card p-4 shadow-sm rounded-4 position-relative">
                    <div class="d-flex flex-column align-items-center">
                        <img src="https://i.pravatar.cc/100?u=linda" 
                             alt="Linda Kusumawardani" 
                             class="rounded-circle mb-3 shadow-sm" width="80" height="80">
                        <div class="stars text-warning fs-5 mb-2">★★★★★</div>
                        <p class="text-muted mb-3">"Aku suka banget! Bunga-bunganya segar, wangi, dan warnanya menenangkan banget. Pasti order lagi."</p>
                        <h6 class="fw-semibold mb-0">Linda Kusumawardani</h6>
                        <small class="text-muted">Freelance Designer</small>
                    </div>
                </div>
            </div>

            <div class="col-md-4 fade-up">
                <div class="testimonial-card p-4 shadow-sm rounded-4 position-relative">
                    <div class="d-flex flex-column align-items-center">
                        <img src="https://i.pravatar.cc/100?u=cahyady" 
                             alt="Cahyady Anjeli" 
                             class="rounded-circle mb-3 shadow-sm" width="80" height="80">
                        <div class="stars text-warning fs-5 mb-2">★★★★★</div>
                        <p class="text-muted mb-3">"Harga terjangkau, respon cepat, dan pengiriman juga aman. Super recommended!"</p>
                        <h6 class="fw-semibold mb-0">Cahyady Anjeli</h6>
                        <small class="text-muted">Makeup Artist</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="instagram-section py-5 text-center fade-up">
    <div class="container">
        <h3 class="section-title mb-2">which bouquet is your inspiration?</h3>
        <p class="section-subtitle mb-1">Follow us on Instagram</p>
        <h4 class="brand-logo mb-4">Bloomify</h4>

        <div class="instagram-collage">
            <div class="insta-item item-1">
                <img src="{{ asset('storage/uploads/products/instagram/item1.png') }}" alt="Inspiration 1">
            </div>
            <div class="insta-item item-2">
                <img src="{{ asset('storage/uploads/products/instagram/item2.png') }}" alt="Inspiration 2">
            </div>
            <div class="insta-item item-3">
                <img src="{{ asset('storage/uploads/products/instagram/item3.png') }}" alt="Inspiration 3">
            </div>
            <div class="insta-item item-4">
                <img src="{{ asset('storage/uploads/products/instagram/item4.png') }}" alt="Inspiration 4">
            </div>
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

<script>
document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.getElementById("searchInput");
    const searchResults = document.getElementById("searchResults");
    const searchFlorists = document.getElementById("searchFlorists");
    const searchProducts = document.getElementById("searchProducts");

    let timeout = null;

    searchInput.addEventListener("input", () => {
        clearTimeout(timeout);
        const query = searchInput.value.trim();

        if (query.length === 0) {
            searchResults.style.display = "none";
            searchFlorists.innerHTML = "";
            searchProducts.innerHTML = "";
            return;
        }

        timeout = setTimeout(() => {
            fetch(`/user/search?q=${encodeURIComponent(query)}`)
                .then(res => res.json())
                .then(data => {
                    searchFlorists.innerHTML = "";
                    searchProducts.innerHTML = "";

                    if (data.florists.length === 0 && data.products.length === 0) {
                        searchFlorists.innerHTML = `<p class="text-muted text-center p-3">Tidak ada hasil ditemukan 🌸</p>`;
                        searchResults.style.display = "block";
                        return;
                    }

                    if (data.florists.length > 0) {
                        searchFlorists.innerHTML = `<h6 class="fw-bold text-pink mb-3"><i class="bi bi-flower1 me-1"></i> Florists</h6>`;
                        data.florists.forEach(f => {
                            searchFlorists.innerHTML += `
                                <div class="search-item">
                                    <img src="/storage/${f.image}" alt="${f.name}">
                                    <div>
                                        <a href="/florist/${f.slug}">${f.name}</a><br>
                                        <small class="text-muted">⭐ ${f.rating ?? 'Baru'}</small>
                                    </div>
                                </div>
                            `;
                        });
                    }

                    if (data.products.length > 0) {
                        searchProducts.innerHTML = `<h6 class="fw-bold text-pink mb-3"><i class="bi bi-bag-heart me-1"></i> Products</h6>`;
                        data.products.forEach(p => {
                            const floristSlug = p.florist ? p.florist.slug : '#';
                            const floristName = p.florist ? p.florist.name : 'Unknown Florist';
                            searchProducts.innerHTML += `
                                <div class="search-item">
                                    <img src="/storage/${p.image}" alt="${p.name}">
                                    <div>
                                        <a href="/florist/${floristSlug}/product/${p.slug}">${p.name}</a><br>
                                        <small class="text-muted">${floristName} · Rp${parseInt(p.price).toLocaleString('id-ID')}</small>
                                    </div>
                                </div>
                            `;
                        });
                    }

                    searchResults.style.display = "block";
                })
                .catch(err => {
                    console.error(err);
                    searchFlorists.innerHTML = `<p class="text-danger p-3">Terjadi kesalahan saat mencari data.</p>`;
                    searchResults.style.display = "block";
                });
        }, 300); 
    });
});
</script>

@endsection
