@extends('layouts.layout_user')

@section('title', 'All Florists - Bloomify')

@section('content')
<section class="py-5 florist-page fade-in-section">
    <div class="container">

        <h2 class="text-center fw-semibold mb-4 fade-up" style="color: #e64b7d; font-family: 'Playfair Display', serif;">
            find your favorite flower shop right here! 🌷
        </h2>

        <div class="d-flex justify-content-center mb-5 fade-up" style="animation-delay: 0.3s;">
            <div class="position-relative w-75">
                <i class="bi bi-search position-absolute top-50 translate-middle-y ms-3 text-muted"></i>
                <input type="text" class="form-control rounded-pill ps-5 py-2 shadow-sm"
                    placeholder="Search Here Ya Dear !">
            </div>
        </div>

        <div class="row g-4 fade-up" style="animation-delay: 0.5s;">
            @for ($i = 0; $i < 12; $i++)
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 florist-card position-relative rounded-4 overflow-hidden">

                    @if(in_array($i, [4, 5, 10]))
                        <span class="badge bg-danger position-absolute top-0 start-0 m-3 px-3 py-2 rounded-pill">Close</span>
                    @endif

                    <img src="https://images.unsplash.com/photo-1509042239860-f550ce710b93?auto=format&fit=crop&w=800&q=60"
                        class="card-img-top" alt="Florist Image" style="height: 220px; object-fit: cover;">

                    <div class="card-body">
                        <h5 class="fw-semibold">Kanihera Florist</h5>
                        <p class="text-muted small mb-2">
                            <i class="bi bi-geo-alt"></i>
                            Jl. Kaliurang Km. 13, Sleman, Yogyakarta
                        </p>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="text-muted small">
                                Opening 09:00 - Closing 21:00
                            </div>
                            <div class="d-flex align-items-center small">
                                <i class="bi bi-star-fill text-warning me-1"></i>
                                <span>4.8</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mt-2">
                            <i class="bi bi-tag text-pink me-1"></i>
                            <small class="text-muted">Start From 10.000</small>
                        </div>
                    </div>
                </div>
            </div>
            @endfor
        </div>

    </div>
</section>

<style>
    .florist-page {
        padding-top: 8rem !important;
    }

    .text-pink {
        color: #e64b7d !important;
    }

    .florist-card:hover {
        transform: translateY(-5px);
        transition: all 0.3s ease;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
    }

    .fade-in-section {
        animation: fadeIn 0.8s ease-in-out forwards;
        opacity: 0;
    }

    .fade-up {
        opacity: 0;
        transform: translateY(25px);
        animation: fadeUp 0.9s ease-out forwards;
    }

    .fade-up[style*="animation-delay"] {
        animation-delay: inherit;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endsection
