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
                <input 
                    type="text" 
                    id="searchFlorist" 
                    class="form-control rounded-pill ps-5 py-2 shadow-sm"
                    placeholder="Search Here Ya Dear !">
            </div>
        </div>

        <div id="noResultsMessage" class="text-center text-muted mt-4" style="display: none;">
            <p class="fw-semibold">Tidak ada florist yang sesuai 🌸</p>
        </div>

        <div class="row g-4 fade-up" style="animation-delay: 0.5s;">
            @foreach ($florists as $florist)
                <div class="col-md-4 florist-item">
                    <div class="card border-0 shadow-sm h-100 florist-card position-relative rounded-4 overflow-hidden">
                        @php
                            $currentTime = now()->setTimezone('Asia/Jakarta');
                            $open = \Carbon\Carbon::createFromFormat('H:i:s', $florist->open_time, 'Asia/Jakarta');
                            $close = \Carbon\Carbon::createFromFormat('H:i:s', $florist->close_time, 'Asia/Jakarta');
                        @endphp

                        @if ($currentTime->lt($open) || $currentTime->gt($close))
                            <span class="badge bg-danger position-absolute top-0 start-0 m-3 px-3 py-2 rounded-pill">Close</span>
                        @else
                            <span class="badge bg-success position-absolute top-0 start-0 m-3 px-3 py-2 rounded-pill">Open</span>
                        @endif

                        <img src="{{ asset('storage/' . $florist->image) }}" 
                            class="card-img-top" alt="Florist Image" 
                            style="height: 220px; object-fit: cover;">

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

    </div>
</section>

<style>
    .florist-item {
        transition: all 0.4s ease;
        opacity: 1;
        transform: scale(1);
    }

    .florist-item.hidden {
        opacity: 0;
        transform: scale(0.9);
        pointer-events: none;
        position: absolute;
    }

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

    #noResultsMessage {
        animation: fadeIn 0.4s ease;
        color: #e64b7d;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
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

<script>
document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById("searchFlorist");
    const floristItems = document.querySelectorAll(".florist-item");
    const noResultsMessage = document.getElementById("noResultsMessage");

    searchInput.addEventListener("input", function() {
        const query = this.value.toLowerCase().trim();
        let hasVisible = false;

        floristItems.forEach(item => {
            const name = item.querySelector("h5").textContent.toLowerCase();
            if (name.includes(query)) {
                item.style.display = "block";
                hasVisible = true;
            } else {
                item.style.display = "none";
            }
        });

        noResultsMessage.style.display = hasVisible ? "none" : "block";
    });
});
</script>


@endsection
