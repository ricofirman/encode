<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login — a Studio</title>
  
  <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- pelindung  -->
  
  <!-- Bootstrap 5.3.3 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <link rel="stylesheet" href="{{ asset('css/login-register.css') }}">  <!-- rico- tambah style -->


</head>
<body>

  <!-- Toast Notification -->
  <div class="toast-container position-fixed top-0 end-0 p-3">
    <div id="liveToast" class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body me-2" id="toast-body">
          Pesan akan muncul di sini.
        </div>
        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  </div>

  <div class="auth-card">
    <div class="card-header">
      <h2>ENCODE<span class="text-muted">.</span></h2>
      <p>Masuk ke akun Anda</p>
    </div>
    <div class="card-body">
      <form id="loginForm" method="POST" action="/login">
        <?php echo csrf_field(); ?>
        
        <!-- Email -->
        <div class="input-group">
          <span class="input-group-text">
            <i class="bi bi-envelope"></i>
          </span>
          <input 
            type="email" 
            class="form-control" 
            id="email"
            name="email"
            placeholder="email" 
            required
            autocomplete="email"
            autofocus
          >

        </div>

        <!-- Password -->
        <div class="input-group">
          <span class="input-group-text">
            <i class="bi bi-lock"></i>
          </span>
          <input 
            type="password" 
            class="form-control" 
            id="password"
            name="password"
            placeholder="password" 
            required
            autocomplete="current-password"
          >
          <button type="button" class="toggle-password" id="togglePassword">
            <i class="bi bi-eye"></i>
          </button>
        </div>

        <!-- Remember me + Forgot password -->
        <div class="d-flex justify-content-between align-items-center mb-4">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="remember">
            <label class="form-check-label small" for="remember">
              Ingat sesi
            </label>
          </div>
          <a href="#" class="link">Lupa sandi?</a>
        </div>

        <!-- Login Button -->
        <button type="submit" class="btn btn-auth">
          <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
        </button>

        <!-- Divider -->
        <div class="divider">atau</div>

        <!-- Hanya Google -->
        <div class="d-grid">
          <button type="button" class="btn btn-outline-dark">
            <i class="bi bi-google me-2"></i> Lanjutkan dengan Google
          </button>
        </div>

        <!-- Sign up link -->
        <div class="text-center mt-4 pt-2 border-top border-light">
          <span class="text-muted small">
            Belum punya akun? 
            <a href="register" class="link">Buat akun</a>
          </span>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script src="{{ asset('js/auth.js') }}"></script>

</body>
</html>