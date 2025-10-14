@extends('layouts.layout_user')

@section('title', 'Tracking Pesanan - Bloomify')

@section('content')
@php
    use Carbon\Carbon;
    Carbon::setLocale('id'); 

    $paidAt = $order->paid_at ? Carbon::parse($order->paid_at)->timezone('Asia/Jakarta') : null;
    $preparedAt = $order->prepared_at ? Carbon::parse($order->prepared_at)->timezone('Asia/Jakarta') : null;
    $readyAt = $order->ready_at ? Carbon::parse($order->ready_at)->timezone('Asia/Jakarta') : null;
    $shippedAt = $order->shipped_at ? Carbon::parse($order->shipped_at)->timezone('Asia/Jakarta') : null;
    $deliveredAt = $order->delivered_at ? Carbon::parse($order->delivered_at)->timezone('Asia/Jakarta') : null;

    $steps = [
        ['label'=>'Verifikasi Pesanan', 'time'=>$paidAt],
        ['label'=>'Bunga Dibuat', 'time'=>$preparedAt],
        ['label'=>'Bunga Siap Dikirim', 'time'=>$readyAt],
        ['label'=>'Bunga Dalam Pengiriman', 'time'=>$shippedAt],
        ['label'=>'Pesanan Selesai', 'time'=>$deliveredAt],
    ];

    $statusMap = [
        'Pending' => 1,
        'Confirmed' => 2,
        'Processing' => 3,
        'Ready to Ship' => 4,
        'Out for Delivery' => 5,
        'Delivered' => 6,
        'Cancelled' => 7,
    ];

    $currentStep = $statusMap[$order->status] ?? 1;
@endphp

<div class="container" 
     style="max-width: 1000px; padding-top: 130px; font-family: 'Poppins', sans-serif; color:#333;">

    <h4 class="fw-semibold mb-1" style="color:#e64b7d;">Status Pesanan Anda</h4>
    <p class="fw-medium" style="color:#c74a7d;">#{{ strtoupper($order->order_code) }}</p>

    <div class="position-relative mt-4 mb-5">
        <div class="position-absolute top-50 start-0 w-100 translate-middle-y" 
            style="height:4px; background-color:#f3c4d7; z-index:1;"></div>

        <div class="d-flex justify-content-between position-relative" style="z-index:2;">
            @foreach ($steps as $i => $step)
                <div class="text-center flex-fill">
                    <div class="rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center
                        @if(($i + 1) <= $currentStep && $step['time']) bg-success text-white @else bg-white border border-2 border-secondary @endif"
                        style="width:28px; height:28px;">
                    </div>
                    <small class="fw-medium d-block">{{ $step['label'] }}</small>

                    @if($step['time'])
                        <small class="text-muted d-block">
                            {{ $step['time']->translatedFormat('d F Y') }} | {{ $step['time']->format('H:i') }} WIB
                        </small>
                    @else
                        <small class="text-muted d-block">-</small>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <h5 class="fw-semibold mb-3" style="color:#e64b7d;">Detail Pesanan</h5>
    <div class="card border-0 rounded-4 shadow-sm p-4 mb-4">
        <div class="row align-items-start">
            <div class="col-md-7">
                <table class="table table-borderless small mb-0">
                    <tr>
                        <td class="fw-semibold">ID Pesanan</td>
                        <td>: {{ strtoupper($order->order_code) }}</td>
                    </tr>
                    <tr>
                        <td class="fw-semibold">Tanggal Pesanan</td>
                        <td>: {{ $order->created_at->timezone('Asia/Jakarta')->translatedFormat('l, d F Y') }}</td>
                    </tr>
                    <tr>
                        <td class="fw-semibold">Nama Bunga</td>
                        <td>: {{ $order->product->name }}</td>
                    </tr>
                    <tr>
                        <td class="fw-semibold">Nama Penerima</td>
                        <td>: {{ $order->customer_name }}</td>
                    </tr>
                    <tr>
                        <td class="fw-semibold">Nomor Telepon</td>
                        <td>: {{ $order->customer_phone }}</td>
                    </tr>
                    <tr>
                        <td class="fw-semibold">Alamat Tujuan</td>
                        <td>: {{ $order->address ?? '-' }}</td>
                    </tr>
                </table>
            </div>

            <div class="col-md-5 text-center">
                <div class="border rounded-4 p-3" style="border-color:#f1b8ca;">
                    <img src="{{ asset('storage/' . $order->product->image) }}" 
                         alt="{{ $order->product->name }}" 
                         class="img-fluid rounded-3 mb-2" 
                         style="max-height:150px; object-fit:cover;">
                    <p class="fw-semibold mb-0" style="color:#e64b7d;">{{ $order->product->name }}</p>
                    <p class="small mb-0 text-muted">Dari: {{ $order->product->florist->name ?? 'Florist' }}</p>
                    <p class="small mb-0">Jumlah: {{ $order->quantity }}</p>
                    <p class="small mb-0 fw-semibold">Total: Rp{{ number_format($order->total_price, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 rounded-4 shadow-sm p-4" style="background-color:#fff8fa;">
        <h6 class="fw-semibold mb-4" style="color:#e64b7d;">Log Aktivitas dan Update Terkini</h6>

        <div class="timeline">
            @php
                $logs = [
                    ['time' => $order->created_at, 'text' => 'Pesanan dibuat oleh pengguna'],
                    ['time' => $order->paid_at, 'text' => 'Pembayaran diterima', 'show' => $order->payment_status === 'Paid'],
                    ['time' => $order->prepared_at, 'text' => 'Bunga sedang dibuat', 'show' => in_array($order->status, ['Processing','Ready to Ship','Out for Delivery','Delivered','Completed'])],
                    ['time' => $order->ready_at, 'text' => 'Bunga siap dikirim', 'show' => in_array($order->status, ['Ready to Ship','Out for Delivery','Delivered','Completed'])],
                    ['time' => $order->shipped_at, 'text' => 'Pesanan dikirim ke alamat tujuan', 'show' => in_array($order->status, ['Out for Delivery','Delivered','Completed'])],
                    ['time' => $order->delivered_at, 'text' => 'Pesanan selesai diterima pelanggan', 'show' => $order->status === 'Completed'],
                ];
            @endphp

            @foreach ($logs as $log)
                @if(!isset($log['show']) || $log['show'])
                    @php
                        $time = $log['time'] ? Carbon::parse($log['time'])->timezone('Asia/Jakarta') : null;
                    @endphp
                    <div class="timeline-item d-flex mb-3">
                        <div class="flex-shrink-0">
                            <div class="rounded-circle" 
                                style="width:12px; height:12px; background-color:#e64b7d; margin-top:6px;"></div>
                        </div>
                        <div class="ms-3">
                            <p class="mb-0 fw-semibold" style="color:#e64b7d;">{{ $log['text'] }}</p>
                            <small class="text-muted">
                                {{ $time ? $time->translatedFormat('d F Y, H:i') . ' WIB' : '-' }}
                            </small>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <p class="fw-semibold mt-4 mb-2">
            Perkiraan Tiba:
            <span style="color:#e64b7d;">
                Hari Ini, {{ now()->timezone('Asia/Jakarta')->translatedFormat('d F Y') }}
                Pukul {{ now()->addMinutes(30)->timezone('Asia/Jakarta')->format('H.i') }} – {{ now()->addMinutes(40)->timezone('Asia/Jakarta')->format('H.i') }} WIB
            </span>
        </p>

        <div class="d-flex justify-content-center gap-3 mt-3">
            <a href="#" class="btn btn-sm text-white px-4 rounded-pill" style="background-color:#e64b7d;">Lihat Kurir di Peta</a>
            <a href="#" class="btn btn-sm btn-outline-danger px-4 rounded-pill">Hubungi Kurir</a>
        </div>
    </div>

    <div class="text-center mt-5 mb-4">
        <p class="text-muted small mb-1">
            Terima kasih telah memesan bunga di <strong>{{ $order->product->florist->name ?? 'Bloomify Florist' }}</strong>! 🌸
        </p>
        <p class="text-muted small">Semoga suka dengan hasil tangan kami ya, dear 💖</p>
    </div>
</div>

<style>
.timeline {
    border-left: 2px solid #f3c4d7;
    padding-left: 15px;
}
.timeline-item:last-child {
    margin-bottom: 0;
}
</style>
@endsection
