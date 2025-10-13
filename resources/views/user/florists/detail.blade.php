@extends('layouts.layout_user')

@section('title', $florist->name . ' - Bloomify')

@section('content')

<section class="text-center py-5 mt-5 fade-in-section">
    <div class="container">
        <h2 class="fw-bold mb-3" style="font-family: 'Playfair Display', serif; font-size: 1.8rem;">
            🌸 hi, <span style="color:#e64b7d;">{{ $florist->name }}</span> in here !
        </h2>
        <p class="text-bold mb-2" style="font-family: 'Playfair Display', serif; font-size: 1.7rem;">
            how can we help you today?
        </p>

        <p class="small text-muted mb-2" style="max-width: 600px; margin: 0 auto;">
            Choose the topic that fits your concern below.<br>
            No email? No worries — just give us a quick call, and our lovely team will help you right away!
        </p>

        <p class="small text-muted mb-4">
            📍 {{ $florist->address }}
        </p>

        <div class="mb-5 position-relative" style="max-width: 500px; margin: 0 auto;">
            <i class="bi bi-search position-absolute" style="left: 18px; top: 50%; transform: translateY(-50%); color: #e64b7d; font-size: 1.2rem;"></i>
            <input type="text"
                   class="form-control rounded-pill ps-5 shadow-sm"
                   placeholder="Search here ya dear!"
                   style="border: 1.5px solid #e64b7d;">
        </div>
    </div>
</section>

<section class="position-relative text-center py-5"
         style="
             background: url('{{ asset('assets/images/landing.jpg') }}') no-repeat center center/cover;
             min-height: 380px;
             color: #333;
         ">
    <div class="position-absolute top-0 start-0 w-100 h-100"
         style="background: rgba(255, 240, 245, 0.45); backdrop-filter: blur(2px);"></div>

    <div class="position-relative container" style="z-index: 2;">
        <h5 class="fw-semibold mb-3">
            🌸 Custom Bouquet - {{ $florist->name }}
        </h5>
        <p class="text-dark mb-4" style="max-width: 650px; margin: 0 auto;">
            Punya ide bouquet sendiri?<br>
            Di {{ $florist->name }}, kamu bisa custom rangkaian bunga sesuai warna, bentuk, dan makna yang kamu mau.<br>
            Setiap bunga punya cerita — biar kamu yang menentukannya. 🌷
        </p>
        <a href="#" class="btn rounded-pill px-4 py-2 fw-semibold shadow-sm"
           style="border: 1.5px solid #000000b3; color:#000000b3; backdrop-filter: blur(4px);">
            Custom Bouquet Pesan Disini Ya Dear!
        </a>
    </div>
</section>

<section class="py-5 fade-in-section">
    <div class="container text-center">
        <h3 class="fw-bold mb-4" style="color:#e64b7d; font-family: 'Playfair Display', serif;">
            Catalogue
        </h3>

        <div class="row g-4 justify-content-center">
            @forelse($florist->products as $product)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <img src="{{ asset('storage/'.$product->image) }}" 
                             class="card-img-top rounded-top-4" 
                             style="height:220px; object-fit:cover;">
                        <div class="card-body">
                            <h6 class="fw-semibold mb-1">{{ $product->name }}</h6>
                            <p class="text-muted small mb-2">Harga: Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <a href="{{ route('product.show', [
                                'florist_slug' => $product->florist->slug,
                                'product_slug' => $product->slug
                            ]) }}" 
                            class="btn btn-sm btn-pink mt-2 px-3 py-2 rounded-pill shadow-sm">
                                <i class="bi bi-eye me-1"></i> Lihat Detail
                            </a>

                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted mt-4">Belum ada produk di florist ini 🌸</p>
            @endforelse
        </div>
    </div>
</section>

<section class="py-5 text-start">
    <div class="container">
        <h4 class="fw-bold mb-4 text-center" style="color:#e64b7d; font-family: 'Playfair Display', serif;">
            Customer Review and Rating
        </h4>

        @php
            $jobs = ['Student', 'Content Creator', 'Florist Enthusiast', 'Designer', 'Teacher', 'Photographer', 'Entrepreneur', 'Blogger', 'Artist', 'Musician'];
        @endphp

        @forelse($florist->testimonials->take(2) as $testimonial)
            @php
                $userId = $testimonial->user_id ?? 0;
                $randomIndex = crc32($userId) % count($jobs);
                $randomJob = $jobs[$randomIndex];
            @endphp

            <div class="card border-1 rounded-4 mb-4 px-4 py-3" style="border-color:#f2a2c2;">
                <div class="mb-2">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="bi bi-star{{ $i <= $testimonial->rating ? '-fill text-warning' : '' }}"></i>
                    @endfor
                </div>

                <p class="text-muted small mb-3" style="line-height: 1.6;">
                    {{ $testimonial->comment }}
                </p>

                <div class="d-flex align-items-center mt-3">
                    <img src="https://i.pravatar.cc/50?u={{ $testimonial->user_id }}" alt="User Avatar" class="rounded-circle me-3" width="45" height="45">

                    <div>
                        <div class="fw-semibold" style="color:#333;">
                            {{ $testimonial->user->full_name ?? 'Anonymous' }}
                        </div>
                        <div class="text-muted small">{{ $randomJob }}</div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted text-center">Belum ada testimoni untuk florist ini 🌸</p>
        @endforelse

        @if($florist->testimonials->count() > 2)
            <div class="text-center mt-4">
                <a href="{{ route('florist.testimonials.detail', $florist->id) }}" class="btn rounded-pill px-4 py-2 text-white fw-semibold" style="background-color: #e64b7d;">
                    See More Testimonials
                </a>
            </div>
        @endif
    </div>
</section>


<style>
    .fade-in-section {
        opacity: 0;
        transform: translateY(25px);
        animation: fadeUp 0.8s ease-out forwards;
    }

    @keyframes fadeUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endsection
