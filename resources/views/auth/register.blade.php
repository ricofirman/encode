<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Daftar — ENCODE</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="{{asset('css/login-register.css')}}">
</head>
<body>

<div class="toast-container position-fixed top-0 end-0 p-3">
  <div id="liveToast" class="toast align-items-center" role="alert">
    <div class="d-flex">
      <div class="toast-body me-2" id="toast-body">Pesan di sini.</div>
      <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>
  </div>
</div>

<div class="auth-card">
  <div class="card-header">
    <h2>ENCODE<span class="text-muted">.</span></h2>
    <p>Buat akun baru</p>
  </div>
  <div class="card-body">
    <form id="registerForm" method="POST" action="/register">
      
      <?php echo csrf_field(); ?>

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
        <button type="button" class="toggle-password" id="togglePassword"><i class="bi bi-eye"></i></button>
      </div>
      <div class="input-group">
        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
        <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" placeholder="konfirmasi password" required>
        <button type="button" class="toggle-password" id="toggleConfirmPassword"><i class="bi bi-eye"></i></button>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- <script src="{{ asset('js/auth.js') }}"></script> -->

</body>
</html>