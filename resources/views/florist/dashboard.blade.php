@extends('layouts.florist')

@section('content')
    {{-- Import Font & Animate --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #fff7fa;
        }

        .dashboard-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2.5rem;
            flex-wrap: wrap;
        }

        .dashboard-header h2 {
            font-weight: 700;
            color: #e64b7d;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.8rem;
        }

        .dashboard-header h2 i {
            font-size: 1.7rem;
        }

        .dashboard-header p {
            color: #6c757d;
            margin: 0;
        }

        /* Stats cards */
        .stat-card {
            background: white;
            border-radius: 1.2rem;
            padding: 1.6rem;
            text-align: center;
            box-shadow: 0 4px 16px rgba(230, 75, 125, 0.1);
            transition: all 0.25s ease;
            border: 1px solid rgba(230, 75, 125, 0.05);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(230, 75, 125, 0.15);
        }

        .stat-icon {
            font-size: 2rem;
            color: #e64b7d;
            background: #ffe4ec;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
        }

        .stat-title {
            font-size: 0.9rem;
            color: #999;
            margin-bottom: 0.3rem;
        }

        .stat-value {
            font-size: 1.6rem;
            font-weight: 700;
            color: #333;
        }

        .stat-value.text-success {
            color: #2ecc71;
        }

        /* Table section */
        .orders-section h4 {
            font-weight: 600;
            color: #333;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 1rem;
        }

        .orders-section h4 i {
            color: #e64b7d;
        }

        table {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            border: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        thead {
            background: #ffe4ec;
            color: #e64b7d;
            font-weight: 600;
        }

        tbody tr:hover {
            background-color: #fff0f6;
        }

        .badge {
            border-radius: 30px;
            padding: 6px 12px;
            font-size: 0.8rem;
        }

        .fade-in {
            animation: fadeIn 0.6s ease-in-out forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <div class="fade-in">
        <div class="dashboard-header">
            <div>
                <h2><i class="bi bi-flower1"></i> Dashboard Florist</h2>
                <p>Selamat datang kembali, <strong>{{ Auth::user()->full_name }}</strong> 🌸</p>
            </div>
            <div class="text-end">
                <small class="text-secondary">Panel Florist | Bloomify</small>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon"><i class="bi bi-basket2-fill"></i></div>
                    <div class="stat-title">Total Produk</div>
                    <div class="stat-value">{{ $stats['products'] }}</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon"><i class="bi bi-cash-stack"></i></div>
                    <div class="stat-title">Pendapatan</div>
                    <div class="stat-value text-success">
                        Rp {{ number_format($stats['revenue'], 0, ',', '.') }}
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon"><i class="bi bi-receipt"></i></div>
                    <div class="stat-title">Pesanan Terbaru</div>
                    <div class="stat-value">{{ count($stats['orders']) }}</div>
                </div>
            </div>
        </div>

        <div class="orders-section fade-in">
            <h4><i class="bi bi-journal-text"></i> Pesanan Terbaru</h4>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>ID Pesanan</th>
                            <th>Akun Pemesan</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stats['orders'] as $order)
                            <tr>
                                <td class="fw-semibold text-secondary">#{{ $order->order_code }}</td>
                                <td>{{ $order->user->full_name ?? '-' }}</td>
                                <td class="fw-semibold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                <td>
                                    @php
                                        $statusColor = match($order->status) {
                                            'Pending' => 'secondary',
                                            'Confirmed' => 'info',
                                            'Processing' => 'primary',
                                            'Being Prepared' => 'warning',
                                            'Ready to Ship' => 'dark',
                                            'Out for Delivery' => 'primary',
                                            'Delivered' => 'success',
                                            default => 'secondary'
                                        };
                                    @endphp

                                    <span class="badge bg-{{ $statusColor }}">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td>{{ $order->created_at->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Belum ada pesanan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
