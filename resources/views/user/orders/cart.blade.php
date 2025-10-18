@extends('layouts.layout_user')

@section('title', 'Keranjang - Bloomify')

@section('content')
<div class="container" style="margin-top: 150px; max-width: 1000px;">
    <div class="text-center mb-5">
        <h3 class="fw-bold" style="color:#e64b7d;">🛒 Keranjang Belanja Anda</h3>
        <p class="text-muted">Cek kembali pesananmu sebelum melanjutkan ke pembayaran</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success text-center shadow-sm rounded-pill">
            {{ session('success') }}
        </div>
    @endif

    @if(empty($cart))
        <div class="text-center my-5">
            {{-- <img src="{{ asset('images/empty_cart.png') }}" alt="Empty Cart" width="160" class="mb-4 opacity-75"> --}}
            <h5 class="text-muted mb-3">Keranjang Anda kosong 💐</h5>
            <a href="{{ route('dashboard_user') }}" class="btn text-white rounded-pill px-4 py-2 shadow-sm" style="background-color:#e64b7d;">
                Kembali Belanja
            </a>
        </div>
    @else
        <div class="card shadow-lg border-0 rounded-4 overflow-hidden mb-5">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table align-middle text-center mb-0">
                        <thead class="table-light" style="color:#e64b7d;">
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $grandTotal = 0; @endphp
                            @foreach($cart as $slug => $item)
                                @php 
                                    $total = $item['price'] * $item['quantity']; 
                                    $grandTotal += $total; 
                                @endphp
                                <tr class="align-middle">
                                    <td class="text-start">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('storage/' . $item['image']) }}" width="65" height="65" class="me-3 rounded-3 shadow-sm" style="object-fit:cover;">
                                            <div>
                                                <strong>{{ $item['name'] }}</strong><br>
                                                <small class="text-muted">Florist: {{ $item['florist_name'] }}</small><br>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-secondary">Rp{{ number_format($item['price'], 0, ',', '.') }}</td>
                                    <td>{{ $item['quantity'] }}</td>
                                    <td class="fw-semibold">Rp{{ number_format($total, 0, ',', '.') }}</td>
                                    <td>
                                        <div class="d-flex flex-column align-items-center gap-2">
                                            <a href="{{ route('checkout', ['slug' => $item['slug']]) }}"
                                                class="btn btn-sm text-white rounded-pill px-3 py-1 shadow-sm"
                                                style="background-color:#e64b7d;">
                                                Checkout
                                            </a>
                                            <form action="{{ route('cart.remove', $slug) }}" method="POST" onsubmit="return confirm('Hapus produk ini dari keranjang?')">
                                                @csrf
                                                <button type="submit" class="btn btn-sm text-danger border-0 p-0">
                                                    <i class="bi bi-trash fs-5"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4 border-top pt-3">
                    <h5 class="fw-bold text-dark mb-0">Total Semua:</h5>
                    <h4 class="fw-bold mb-0" style="color:#e64b7d;">Rp{{ number_format($grandTotal, 0, ',', '.') }}</h4>
                </div>

                <div class="text-end mt-4">
                    <a href="{{ route('dashboard_user') }}" class="btn btn-outline-secondary rounded-pill px-4 me-2">← Lanjut Belanja</a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
