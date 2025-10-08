<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloomify</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Twinkle+Star&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">

</head>
<body>

    <header class="navbar">
        <div class="logo">Bloomify</div>
        <nav>
            <a href="#">
                <i class="bi bi-cart3"></i> Cart
            </a>
            <a href="{{ route('login.form') }}">
                <i class="bi bi-box-arrow-in-right"></i> Login
            </a>
        </nav>
    </header>

    <section class="hero">
        <div class="hero-content" data-aos="fade-up">
            <div class="location-select">
                <i class="bi bi-geo-alt-fill"></i>
                <select class="address-select">
                    <option>Jalan Tambakbayan No.1, Babarsari Yogyakarta</option>
                    <option>Jalan Malioboro, Yogyakarta</option>
                    <option>Jalan Kaliurang, Sleman</option>
                </select>
            </div>
            <h1>Select your address and see the nearest florist to creating own bouquet</h1>
            <p>For a wide selection of floral arrangements, pick your favorite bouquets, and customize details as needed.</p>
        </div>
    </section>

    <section class="how-it-works" data-aos="fade-up">
        <div class="how-container">
            <div class="how-text">
                <h2>How can I make a bouquet using <span>Bloomify?</span></h2>
                <p>
                    At Bloomify, the first step is to choose your address so the system can show you the nearest flower shops.
                    Next, select your preferred florist — or explore florists in other cities if you want to send flowers somewhere else.
                    Then, you can start creating your own bouquet or choose from our beautiful ready-made collections.
                    With Bloomify, you can easily order and send stunning bouquets to someone you love, wherever they are.
                </p>
                <button class="learn-btn">Learn More...</button>
            </div>

            <div class="how-image">
                <img src="{{ asset('assets/images/florist.png') }}" alt="Florist Illustration" data-aos="zoom-in">
            </div>
        </div>
    </section>

    @include('partials.footer')

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });
    </script>
</body>
</html>
