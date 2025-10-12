@extends('layouts.layout_user')

@section('title', $product->name . ' - Bloomify')

@section('content')
<div class="container py-5 mt-5">

    <div class="row justify-content-center gy-5">

        <div class="col-lg-5 text-center">
            <div class="d-flex flex-column align-items-center">
                <img src="{{ asset('storage/' . $product->image) }}" 
                    alt="{{ $product->name }}"
                    class="img-fluid rounded-4 shadow-sm mb-4"
                    style="max-height:470px; object-fit:cover; border-radius: 20px;">
                
                <a href="#" 
                    class="btn text-white fw-semibold rounded-pill shadow-sm mt-2" 
                    style="background-color:#e64b7d; font-size:1rem; padding: 0.4rem 8rem; letter-spacing:0.5px;"
                    onclick="toggleOrderForm(event)">
                    Order Now !
                </a>

            </div>
        </div>

        <div class="col-lg-6">
            <h2 class="fw-bold mb-3" 
                style="color:#e64b7d; font-family:'Playfair Display', serif; font-size:2.2rem;">
                {{ $product->name }}
            </h2>

            <p class="text-muted mb-4" style="line-height:1.8; font-size:0.95rem;">
                {{ $product->description ?? 'This bouquet brings warmth and beauty to any moment. Crafted with love and the finest blossoms.' }}
            </p>

            <h5 class="fw-semibold mb-4" style="color:#555;">
                Harga: <span style="color:#000;">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
            </h5>

            @if(!empty($product->flowers) && is_array($product->flowers))
                <div class="mb-4">
                    <h6 class="fw-semibold mb-2" style="color:#e64b7d;">Description Bouquet ♡</h6>
                    <ul class="text-muted small" style="padding-left:1.2rem; columns: 2;">
                        @foreach($product->flowers as $flower)
                            <li>{{ $flower }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <a href="#" 
            class="btn fw-semibold px-4 py-2 rounded-pill shadow-sm mt-3" 
            style="border: 1.5px solid #e64b7d; color:#e64b7d;">
                <i class="bi bi-bag-heart me-1"></i> Keranjang
            </a>
        </div>
    </div>

    <div class="text-center mt-5">
        <a href="{{ url()->previous() }}" 
        class="text-decoration-none fw-semibold" 
        style="color:#e64b7d;">
            ← Back to Catalogue
        </a>
    </div>
</div>

<style>
    body {
        background-color: #fff8fa;
    }

    html, body {
        overflow-x: hidden;
    }

    .btn:hover {
        transform: translateY(-2px);
        transition: all 0.2s ease;
    }

    #orderFormSection {
        display: none;
        position: fixed;       
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;          
        background-color: #fff7fa;
        border-top: 3px solid #e64b7d;
        z-index: 9999;         
        overflow-y: auto;       
        padding-top: 80px;     
    }

    .order-form-section.show {
        display: block !important;
        animation: fadeSlideIn 0.6s ease;
    }

    @keyframes fadeSlideIn {
        0% { opacity: 0; transform: translateY(30px); }
        100% { opacity: 1; transform: translateY(0); }
    }
</style>

@include('user.partials.order_form_full', ['product' => $product])

<script>
function toggleOrderForm(e) {
    e.preventDefault();
    const section = document.getElementById('orderFormSection');
    section.classList.toggle('show');
    section.scrollIntoView({ behavior: "smooth" });
}
</script>


@endsection
