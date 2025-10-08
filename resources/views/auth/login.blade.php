<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bloomify</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&family=Twinkle+Star&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

    <div class="logo">Bloomify</div>

    <main class="login-wrapper">
        <h1 class="login-title">Log In</h1>

        <div class="login-content">
            <p class="welcome">🌸 Welcome Back, <span>Blomy!</span></p>
            <p class="subtitle">Ready to make someone smile with flowers today?</p>

            @if (session('success'))
                <div class="success-message">
                    🌸 {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.submit') }}">
                @csrf

                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="phone" placeholder="012345678910" value="{{ old('phone') }}">
                    @error('phone') <div class="error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group password-field">
                    <label>Password</label>
                    <div class="password-wrapper">
                        <input type="password" name="password" id="password" placeholder="************">
                        <i class="bi bi-eye-slash toggle-password" id="togglePassword"></i>
                    </div>
                    @error('password') <div class="error">{{ $message }}</div> @enderror
                </div>

                <div class="options">
                    <label><input type="checkbox" name="remember"> Remember Me</label>
                    <a href="#">Forgot Password?</a>
                </div>

                <button type="submit" class="btn-login">Login</button>

                <p class="signup">Don’t have an account? <a href="{{ route('register.form') }}">Sign Up</a></p>
            </form>
        </div>
    </main>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const passwordInput = document.querySelector('#password');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });
    </script>

</body>
</html>
