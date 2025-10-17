<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Florist Panel | Bloomify</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Twinkle+Star&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #fff8fb;
            font-family: 'Inter', sans-serif;
        }

        .sidebar {
            background: linear-gradient(180deg, #ffb6c1 0%, #ff6f91 100%);
            min-height: 100vh;
            color: white;
            padding: 20px 15px;
            position: fixed;
            width: 240px;
            transition: all 0.3s;
            z-index: 10 !important;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
            margin: 5px 0;
            border-radius: 10px;
            transition: background 0.3s;
        }

        .sidebar a.active, .sidebar a:hover {
            background-color: rgba(255,255,255,0.2);
        }

        .content {
            margin-left: 260px;
            padding: 30px;
            /* position: relative; */
            z-index: 20 !important;
        }

        .navbar {
            background: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            border-radius: 10px;
        }

        .navbar-brand {
            color: #e64b7d !important;
            font-weight: 700;
        }

        .modal-backdrop {
            z-index: 1050 !important;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal {
            z-index: 2000 !important;
            position: fixed !important;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
                min-height: auto;
                text-align: center;
            }
            .content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h4 class="fw-bold mb-4 text-center" style="font-family: 'Twinkle Star', cursive; font-size: 2rem;">
            <i class="bi bi-flower3"></i> Bloomify
        </h4>

        <a href="{{ route('florist.dashboard') }}" class="{{ request()->routeIs('florist.dashboard') ? 'active' : '' }}">
            <i class="bi bi-house-door-fill me-2"></i> Dashboard
        </a>

        <a href="{{ route('florist.products.index') }}" class="{{ request()->routeIs('florist.products.*') ? 'active' : '' }}">
            <i class="bi bi-basket2-fill me-2"></i> Produk
        </a>

        <a href="{{ route('florist.orders') }}" class="{{ request()->routeIs('florist.orders') ? 'active' : '' }}">
            <i class="bi bi-bag-check-fill me-2"></i> Pesanan
        </a>

        <a href="{{ route('florist.profile') }}" class="{{ request()->routeIs('florist.profile') ? 'active' : '' }}">
            <i class="bi bi-person-circle me-2"></i> Profil
        </a>

        <hr class="text-white">

        <a href="{{ route('logout.web') }}" 
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-right me-2"></i> Keluar
        </a>

        <form id="logout-form" action="{{ route('logout.web') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>

    <div class="content">
        <nav class="navbar navbar-light mb-4 px-3">
            <span class="navbar-brand">Panel Florist</span>
            <span class="text-muted">Halo, {{ Auth::user()->full_name ?? 'Florist' }}</span>
        </nav>

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
