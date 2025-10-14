@extends('layouts.layout_user')

@section('title', 'Keranjang - Bloomify')

@section('content')
<div class="container py-5 text-center" style="padding-top: 120px;">
    <h4 class="fw-bold mb-4" style="color:#e64b7d;">Keranjang Belanja Anda</h4>
    <p class="text-muted">Fitur keranjang masih dalam pengembangan 💐</p>
    <a href="{{ route('dashboard_user') }}" class="btn text-white rounded-pill px-4" style="background-color:#e64b7d;">
        Kembali Belanja
    </a>
</div>
@endsection
