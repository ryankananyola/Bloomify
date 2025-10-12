@extends('layouts.layout_user')

@section('title', 'Testimonials - ' . $florist->name)

@section('content')
<div class="container py-5 mt-4">

    <div class="text-center mb-5">
        <h3 class="fw-bold mb-2" style="font-family:'Playfair Display', serif; color:#000;">
            💬 Testimonials for <span style="color:#e64b7d;">{{ $florist->name }}</span>
        </h3>
        <p class="text-muted small">
            Lihat apa kata pelanggan tentang pengalaman mereka dengan {{ $florist->name }} 🌸
        </p>
        <div class="mt-3" style="height: 3px; width: 80px; background-color:#e64b7d; margin: 0 auto; border-radius: 2px;"></div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">

            @php
                $jobs = ['Student', 'Content Creator', 'Florist Enthusiast', 'Designer', 'Teacher', 'Photographer', 'Entrepreneur', 'Blogger', 'Artist', 'Musician'];
            @endphp

            @forelse($testimonials as $testimonial)
                @php
                    $userId = $testimonial->user_id ?? 0;
                    $randomIndex = crc32($userId) % count($jobs);
                    $randomJob = $jobs[$randomIndex];
                @endphp

                <div class="card border-1 rounded-4 p-4 mb-4" style="border-color:#f3b5c8; background-color:#fff8fb;">
                    <div class="mb-2">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="bi bi-star{{ $i <= $testimonial->rating ? '-fill text-warning' : '' }}"></i>
                        @endfor
                    </div>

                    <p class="text-muted mb-3" style="line-height: 1.6; font-size: 0.95rem;">
                        "{{ $testimonial->comment }}"
                    </p>

                    <div class="d-flex align-items-center">
                        <img src="https://i.pravatar.cc/60?u={{ $testimonial->user_id }}" 
                             alt="User Avatar" 
                             class="rounded-circle me-3 shadow-sm"
                             width="55" height="55">
                        <div>
                            <div class="fw-semibold" style="color:#333;">
                                {{ $testimonial->user->full_name ?? 'Anonymous' }}
                            </div>
                            <div class="text-muted small">{{ $randomJob }}</div>
                            <div class="text-muted small fst-italic">{{ $testimonial->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-muted mt-4">Belum ada testimoni untuk florist ini 🌷</p>
            @endforelse

            <div class="d-flex justify-content-center mt-4">
                {{ $testimonials->links('pagination::bootstrap-5') }}
            </div>

            <div class="text-center mt-5">
                <a href="{{ url()->previous() }}" 
                   class="btn rounded-pill px-4 py-2 fw-semibold text-white shadow-sm"
                   style="background-color:#e64b7d;">
                    ← Back to Florist
                </a>
            </div>

        </div>
    </div>
</div>

<style>
    .card {
        transition: all 0.3s ease;
    }
    .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(230, 75, 125, 0.1);
    }
</style>
@endsection
