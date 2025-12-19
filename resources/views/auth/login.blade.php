<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login — ENCODE</title>
  
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <!-- Bootstrap 5.3.3 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <link rel="stylesheet" href="{{ asset('css/login-register.css') }}">

</head>
<body>

  <!-- Toast Container (Satu saja) -->
  <div class="toast-container position-fixed top-0 end-0 p-3"></div>

  <div class="auth-card">
    <div class="card-header">
      <h2>ENCODE<span class="text-muted">.</span></h2>
      <p>Masuk ke akun Anda</p>
    </div>
    
    <div class="card-body">
      <!-- Tampilkan error dari session -->
      @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-3" id="session-error">
          {{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif
      
      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-3">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif
      
      <form id="loginForm" method="POST" action="/login">
        <?php echo csrf_field(); ?>
        
        <!-- Email -->
        <div class="mb-3">
          <div class="input-group">
            <span class="input-group-text">
              <i class="bi bi-envelope"></i>
            </span>
            <input 
              type="text" 
              class="form-control" 
              id="email"
              name="email"
              placeholder="email"
              autocomplete="email"
              autofocus
            >
          </div>
          <!-- Tempat error email -->
          <div class="text-danger small mt-1" id="email-error" style="display: none;"></div>
        </div>

        <!-- Password -->
        <div class="mb-3">
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
              autocomplete="current-password"
            >
            <button type="button" class="btn btn-outline-secondary" id="togglePassword">
              <i class="bi bi-eye"></i>
            </button>
          </div>
          <!-- Tempat error password -->
          <div class="text-danger small mt-1" id="password-error" style="display: none;"></div>
        </div>

        <!-- Login Button -->
        <button type="submit" class="btn btn-auth w-100 mb-3" id="submitBtn">
          <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
        </button>

        <div class="text-center mt-4 pt-2 border-top border-light">
          <span class="text-muted small">
              Belum punya akun? 
              <a href="{{ url('/register') }}" class="link">Buat akun</a>
          </span>
        </div>
        
        <!-- Sign up link -->
        <div class="text-center mt-4 pt-2 border-top border-light">
          <span class="text-muted small">
            Belum punya akun? 
            <a href="{{ url('/register') }}" class="link">Buat akun</a>
          </span>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Auth JavaScript -->
  <script src="{{ asset('js/auth.js') }}"></script>

</body>
</html>