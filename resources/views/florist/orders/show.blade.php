@extends('layouts.florist')

@section('content')
<div class="container py-5 animate__animated animate__fadeIn">
    <h2 class="fw-bold text-pink-600 mb-4">
        <i class="bi bi-receipt-cutoff me-2"></i> Detail Pesanan #{{ $order->order_code }}
    </h2>

    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        <div class="card-body p-4">
            <h5 class="fw-semibold mb-3 text-pink-600">Informasi Pelanggan</h5>
            <p><strong>Akun Pemesan:</strong> {{ $order->user->full_name ?? '-' }}</p>
            <p><strong>Nama Pemesan:</strong> {{ $order->customer_name ?? '-' }}</p>
            <p><strong>Alamat:</strong> {{ $order->address ?? '-' }}</p>
            <p><strong>Tanggal Pesan:</strong> {{ $order->created_at->format('d M Y, H:i') }}</p>
            <p><strong>Status Saat Ini:</strong> {{ $order->status }}</p>

            <hr>

            <h5 class="fw-semibold mb-3 text-pink-600">Detail Produk</h5>
            @if($order->product)
                <div class="d-flex align-items-center gap-3 mb-3">
                    <img src="{{ asset('storage/'.$order->product->image) }}" width="80" height="80" class="rounded shadow-sm" style="object-fit:cover;">
                    <div>
                        <p class="fw-semibold mb-1">{{ $order->product->name }}</p>
                        <p class="text-muted small mb-1">Harga: Rp {{ number_format($order->product->price, 0, ',', '.') }}</p>
                        <p class="fw-semibold text-pink-600">Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                    </div>
                </div>
            @endif

            <hr>

            <h5 class="fw-semibold mb-3 text-pink-600">Status Pesanan</h5>
            @php
                $statuses = ['Pending', 'Confirmed', 'Processing', 'Ready to Ship', 'Out for Delivery', 'Delivered'];
                $currentIndex = array_search($order->status, $statuses);
            @endphp

            <form id="statusForm" action="{{ route('florist.orders.updateStatus', $order->slug) }}" method="POST" class="d-flex align-items-center gap-2">
                @csrf
                @method('PATCH')
                <select name="status" id="statusSelect" class="form-select form-select-sm w-auto text-pink-600 rounded-pill">
                    @foreach($statuses as $index => $status)
                        <option 
                            value="{{ $status }}" 
                            {{ $order->status == $status ? 'selected' : '' }}
                            {{ $index < $currentIndex ? 'disabled' : '' }}>
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
                <span class="text-muted small">(status sebelumnya dikunci)</span>
            </form>

            <hr>

            <h5 class="fw-semibold mb-3 text-pink-600">Riwayat Pembayaran</h5>
            @if($order->payment_time || $order->payment_proof)
                <div class="border rounded-3 p-3 bg-light mb-3">
                    <p class="mb-1"><strong>Metode Pembayaran:</strong> {{ $order->payment_method ?? '-' }}</p>
                    <p class="mb-1"><strong>Waktu Pembayaran:</strong> 
                        {{ $order->payment_time ? \Carbon\Carbon::parse($order->payment_time)->format('d M Y, H:i') : '-' }}
                    </p>

                    @if($order->payment_proof)
                        <div class="mt-2">
                            <p class="mb-2"><strong>Bukti Transfer:</strong></p>
                            <a href="{{ asset('storage/'.$order->payment_proof) }}" target="_blank">
                                <img src="{{ asset('storage/'.$order->payment_proof) }}" 
                                     alt="Bukti Pembayaran" 
                                     class="rounded shadow-sm border" 
                                     width="220" 
                                     style="object-fit:cover;">
                            </a>
                        </div>
                    @endif
                </div>
            @else
                <p class="text-muted fst-italic">Belum ada data pembayaran dari pelanggan.</p>
            @endif

            <hr>

            <a href="{{ route('florist.orders') }}" class="btn btn-outline-pink rounded-pill px-4 mt-3">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">
      <div class="modal-header border-0">
        <h5 class="modal-title fw-semibold text-pink-600"><i class="bi bi-exclamation-triangle me-2"></i>Konfirmasi Perubahan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <p class="mb-3">Apakah kamu yakin ingin mengubah status pesanan ini menjadi:</p>
        <h5 id="statusToChange" class="fw-bold text-pink-600"></h5>
      </div>
      <div class="modal-footer border-0 d-flex justify-content-center">
        <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
        <button type="button" id="confirmChange" class="btn btn-pink rounded-pill px-4">Ya, Ubah</button>
      </div>
    </div>
  </div>
</div>

<style>
.text-pink-600 { color: #e64b7d !important; }
.btn-outline-pink {
    color: #e64b7d;
    border-color: #e64b7d;
    transition: all 0.3s ease;
}
.btn-outline-pink:hover {
    background-color: #e64b7d;
    color: white;
    box-shadow: 0 4px 10px rgba(230, 75, 125, 0.25);
}
.btn-pink {
    background-color: #e64b7d;
    color: white;
    border: none;
}
.btn-pink:hover {
    background-color: #d84372;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusSelect = document.getElementById('statusSelect');
    const statusForm = document.getElementById('statusForm');
    const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
    const statusToChange = document.getElementById('statusToChange');
    const confirmBtn = document.getElementById('confirmChange');
    const currentStatus = "{{ $order->status }}";

    let selectedStatus = null;

    statusSelect.addEventListener('change', function() {
        selectedStatus = this.value;

        const orderStatuses = @json($statuses);
        const currentIndex = orderStatuses.indexOf(currentStatus);
        const newIndex = orderStatuses.indexOf(selectedStatus);

        if (newIndex < currentIndex) {
            alert('❌ Kamu tidak bisa mengubah status ke tahap sebelumnya!');
            this.value = currentStatus;
            return;
        }

        statusToChange.textContent = selectedStatus;
        modal.show();
    });

    confirmBtn.addEventListener('click', function() {
        modal.hide();
        statusForm.submit();
    });
});
</script>
@endsection
