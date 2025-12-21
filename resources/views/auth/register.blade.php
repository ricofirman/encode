<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Daftar — ENCODE</title>
  
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <!-- Bootstrap 5.3.3 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  
  <link rel="stylesheet" href="{{ asset('css/login-register.css') }}">
</head>
<body>

  <!-- Toast Container (sama dengan login) -->
  <div class="toast-container position-fixed top-0 end-0 p-3"></div>

  <div class="auth-card">
    <div class="card-header">
      <h2>ENCODE<span class="text-muted">.</span></h2>
      <p>Buat akun baru</p>
    </div>
    
    <div class="card-body">
      <!-- Tampilkan pesan dari session -->
      @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-3">
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
      
      <form id="registerForm" method="POST" action="/register">
        <?php echo csrf_field(); ?>
        
        <!-- Nama -->
        <div class="mb-3">
          <div class="input-group">
            <span class="input-group-text">
              <i class="bi bi-person"></i>
            </span>
            <input 
              type="text" 
              class="form-control" 
              id="name"
              name="name"
              placeholder="Nama lengkap"
              autocomplete="name"
              autofocus
            >
          </div>
          <!-- Tempat error nama -->
          <div class="text-danger small mt-1" id="name-error" style="display: none;"></div>
        </div>

        <!-- Email -->
        <div class="mb-3">
          <div class="input-group">
            <span class="input-group-text">
              <i class="bi bi-envelope"></i>
            </span>
            <input 
              type="email" 
              class="form-control" 
              id="email"
              name="email"
              placeholder="Email"
              autocomplete="email"
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
              placeholder="Password"
              autocomplete="new-password"
            >
            <button type="button" class="btn btn-outline-secondary" id="togglePassword">
              <i class="bi bi-eye"></i>
            </button>
          </div>
          <!-- Tempat error password -->
          <div class="text-danger small mt-1" id="password-error" style="display: none;"></div>
        </div>

        <!-- Konfirmasi Password -->
        <div class="mb-3">
          <div class="input-group">
            <span class="input-group-text">
              <i class="bi bi-lock-fill"></i>
            </span>
            <input 
              type="password" 
              class="form-control" 
              id="confirmPassword"
              name="password_confirmation"
              placeholder="Konfirmasi password"
              autocomplete="new-password"
            >
            <button type="button" class="btn btn-outline-secondary" id="toggleConfirmPassword">
              <i class="bi bi-eye"></i>
            </button>
          </div>
          <!-- Tempat error konfirmasi password -->
          <div class="text-danger small mt-1" id="confirmPassword-error" style="display: none;"></div>
        </div>

        <!-- Register Button -->
        <button type="submit" class="btn btn-auth w-100 mb-3" id="submitBtn">
          <i class="bi bi-person-plus me-1"></i> Daftar
        </button>

        <!-- Link ke login -->
        <div class="text-center mt-4 pt-2 border-top border-light">
          <span class="text-muted small">
            Sudah punya akun? 
            <a href="{{ url('/login') }}" class="link">Masuk</a>
          </span>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Auth JavaScript -->
  <script src="{{ asset('js/auth.js') }}"></script>
      <div class="input-group">
        <span class="input-group-text"><i class="bi bi-person"></i></span>
        <input type="text" class="form-control" id="name" name="name" placeholder="Nama lengkap" required>
      </div>
      <div class="input-group">
        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
        <input type="email" class="form-control" id="email" name="email" placeholder="email" required>
      </div>
      
      <div class="input-group">
        <span class="input-group-text"><i class="bi bi-lock"></i></span>
        <input type="password" class="form-control" id="password" name="password" placeholder="password" required>

        <button class="btn btn-outline-secondary" type="button" id="togglePassword" aria-label="Toggle password">
          <i class="bi bi-eye" id="iconPassword"></i>
        </button>
      </div>

      <div class="input-group mt-3">
        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
        <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" placeholder="konfirmasi password" required>

        <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword" aria-label="Toggle confirm password">
          <i class="bi bi-eye" id="iconConfirmPassword"></i>
        </button>
      </div>

      <button type="submit" class="btn btn-auth">
        <i class="bi bi-person-plus me-1 "></i> Daftar
      </button>
      <div class="text-center mt-4 pt-2 border-top border-light">
        <span class="text-muted small">Sudah punya akun? <a href="login" class="link">Masuk</a></span>
      </div>
    </form>
  </div>
</div>



<script>
  function setupToggle(inputId, buttonId, iconId) {
    const input = document.getElementById(inputId);
    const button = document.getElementById(buttonId);
    const icon = document.getElementById(iconId);

    if (!input || !button || !icon) return;

    button.addEventListener('click', () => {
      const isPassword = input.type === 'password';
      input.type = isPassword ? 'text' : 'password';

      // ganti icon
      icon.classList.toggle('bi-eye', !isPassword);
      icon.classList.toggle('bi-eye-slash', isPassword);
    });
  }

  document.addEventListener('DOMContentLoaded', () => {
    setupToggle('password', 'togglePassword', 'iconPassword');
    setupToggle('confirmPassword', 'toggleConfirmPassword', 'iconConfirmPassword');
  });
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- <script src="{{ asset('js/auth.js') }}"></script> -->

</body>
</html>