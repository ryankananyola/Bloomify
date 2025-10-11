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
            <i class="bi bi-search position-absolute" 
            style="left: 18px; top: 50%; transform: translateY(-50%); color: #e64b7d; font-size: 1.2rem;"></i>

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

<section class="text-center mt-5 pb-5">
    <div class="p-5 rounded-4 shadow-sm"
         style="max-width: 600px; margin: 0 auto; background-color: #fff7fa;">
        <img src="{{ asset('storage/uploads/florists/closed.png') }}" 
             alt="Closed Image" 
             class="img-fluid mb-3"
             style="max-width: 320px;">
        <h4 class="fw-bold mb-2" style="color:#e64b7d; font-family: 'Playfair Display', serif;">
            Sorry, We’re Closed
        </h4>
        <p class="text-muted mb-0">
            <strong>{{ $florist->name }}</strong> sedang tutup sementara ya dear,<br>
            tapi jangan sedih, kamu bisa cek kembali nanti 💕
        </p>
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
