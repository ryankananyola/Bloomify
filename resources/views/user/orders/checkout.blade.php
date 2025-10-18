@extends('layouts.layout_user')

@section('title', 'Checkout - ' . $product->name)

@section('content')
<div class="container py-5 mt-5">
    <h3 class="fw-bold mb-4 text-center" style="color:#e64b7d;">Checkout Produk</h3>

    @include('user.partials.order_form_full', ['product' => $product])
    <div class="card p-4 shadow-sm">
</div>
</div>
@endsection
