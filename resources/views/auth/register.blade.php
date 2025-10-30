<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Sign Up - Bloomify</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/signup.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <div class="signup-container">
    <div class="signup-form">
      <h1 class="title">Sign Up</h1>
      <p class="welcome">🌸 <strong>Welcome, <span>Blomy!</span></strong></p>
      <p class="subtitle">Ready to make someone smile with flowers today?</p>

      <form action="{{ route('register.submit') }}" method="POST">
        @csrf
        <div class="form-group">
          <input type="text" name="phone_number" placeholder="Phone Number" value="{{ old('phone_number') }}">
          @error('phone_number') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
          <input type="text" name="full_name" placeholder="Full Name" value="{{ old('full_name') }}">
          @error('full_name') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
          <input type="email" name="email" placeholder="E-Mail" value="{{ old('email') }}">
          @error('email') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group password-field">
          <div class="password-wrapper">
            <input type="password" id="password" name="password" placeholder="Password">
            <i class="bi bi-eye-slash toggle-password" id="togglePassword"></i>
          </div>
          @error('password') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group password-field">
          <div class="password-wrapper">
            <input type="password" id="confirm_password" name="password_confirmation" placeholder="Confirm Password">
            <i class="bi bi-eye-slash toggle-password" id="toggleConfirm"></i>
          </div>
        </div>

        <div class="terms">
          <input type="checkbox" id="agree" required>
          <label for="agree">You will have accepted <a href="#">Terms & Conditions</a> by signing up.</label>
        </div>

        <button class="btn-signup" type="submit">Sign Up</button>

        <p class="login-text">Already have an account? <a href="{{ route('login') }}">Login</a></p>
      </form>
    </div>

    <div class="signup-testimonial">
      <div class="testimonial">
        <h3>Nadin Amizah</h3>
        <p class="stars">⭐️⭐️⭐️⭐️⭐️</p>
        <p>Bloomify made my first flower order such a lovely experience. The website was simple to use, and the bouquet arrived exactly as shown — maybe even better! The flowers were fresh, perfectly arranged, and smelled amazing.</p>
        <div class="quote">
          <p>“Every flower is a whisper of love — let Bloomify help you say it beautifully.”</p>
          <img src="{{ asset('assets/images/signup.png') }}" alt="Flower illustration" class="illustration">
        </div>
      </div>
    </div>
  </div>

  <script>
    document.querySelectorAll('.toggle-password').forEach(icon => {
      icon.addEventListener('click', () => {
        const input = icon.previousElementSibling;
        const isPassword = input.type === "password";
        input.type = isPassword ? "text" : "password";
        icon.classList.toggle("bi-eye");
        icon.classList.toggle("bi-eye-slash");
      });
    });
  </script>
</body>
</html>
