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
            <a href="{{ route('login') }}">
                <i class="bi bi-cart3"></i> Cart
            </a>
            <a href="{{ route('login') }}">
                <i class="bi bi-box-arrow-in-right"></i> Login
            </a>
        </nav>
    </header>

    <section class="hero">
        <div class="hero-content text-center" data-aos="fade-up">   
            <div class="location-select mx-auto">
                <i class="bi bi-geo-alt-fill text-danger"></i>
                <input type="text" id="manualLocation" 
                    class="address-select" 
                    placeholder="Detecting location..." readonly>
                <button id="detectLocation" class="detect-btn">
                    <i class="bi bi-crosshair"></i>
                </button>
            </div>

            <h1 class="mt-4 fw-semibold">
                Select your address and see the nearest florist to creating own bouquet
            </h1>
            <p class="mt-2 text-muted">
                For a wide selection of floral arrangements, pick your favorite bouquets, 
                and customize details as needed.
            </p>

            <div id="nearbyFlorists" class="row mt-4 justify-content-center"></div>
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

        window.addEventListener('load', () => {
            AOS.refresh();
        });
    </script>

    <script>
    document.getElementById('detectLocation').addEventListener('click', () => {
        const locationInput = document.getElementById('manualLocation');
        const container = document.getElementById('nearbyFlorists');

        locationInput.value = "Detecting your location...";
        container.innerHTML = `<p class="text-muted mt-3">⏳ Getting your location...</p>`;

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(async pos => {
                const lat = pos.coords.latitude;
                const lon = pos.coords.longitude;

                try {
                    const geoRes = await fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lon}`);
                    const geoData = await geoRes.json();
                    const address = geoData.display_name || 'Unknown location';
                    locationInput.value = address;

                    const res = await fetch(`/landing/nearby-florists?lat=${lat}&lon=${lon}`);
                    const data = await res.json();

                    container.innerHTML = '';
                    if (!Array.isArray(data) || data.length === 0) {
                        container.innerHTML = `<p class="text-muted">No florists nearby 🌸</p>`;
                        return;
                    }

                    data.forEach((f, index) => {
                        const delay = 100 * index;
                        container.innerHTML += `
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 animate-card" style="animation-delay: ${delay}ms">
                                <div class="card shadow-sm rounded-4 overflow-hidden mt-3 florist-card">
                                    <img src="/storage/${f.image}" class="card-img-top" alt="${f.name}">
                                    <div class="card-body text-center">
                                        <h5 class="fw-semibold mb-1">${f.name}</h5>
                                        <p class="text-muted small mb-1"><i class="bi bi-geo-alt"></i> ${f.address}</p>
                                        <small class="text-success">📍 ${f.distance.toFixed(2)} km dari kamu</small>
                                    </div>
                                </div>
                            </div>`;
                    });
                } catch (error) {
                    container.innerHTML = `<p class="text-danger">Failed to get florist data 😢</p>`;
                    console.error(error);
                }
            }, () => alert('Location permission denied.'));
        } else {
            alert('Your browser does not support geolocation.');
        }
    });
    </script>
</body>
</html>
