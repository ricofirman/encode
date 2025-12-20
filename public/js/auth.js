// File: public/js/auth.js
// File ini untuk handle login dan register

// ==================== 1. FUNGSI TOGGLE PASSWORD ====================
// Fungsi untuk show/hide password
function setupPasswordToggle() {
    // Toggle untuk password utama (login dan register)
    const togglePassword = document.getElementById('togglePassword');
    if (togglePassword) {
        togglePassword.addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        });
    }
    
    // Toggle untuk confirm password (hanya di register)
    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
    if (toggleConfirmPassword) {
        toggleConfirmPassword.addEventListener('click', function() {
            const confirmPasswordInput = document.getElementById('confirmPassword');
            const icon = this.querySelector('i');
            
            if (confirmPasswordInput.type === 'password') {
                confirmPasswordInput.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                confirmPasswordInput.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        });
    }
}

// ==================== 2. FUNGSI TOAST (SAMA UNTUK LOGIN & REGISTER) ====================
// Fungsi untuk menampilkan pesan toast
function showToast(message, type = 'error') {
    // Buat container toast jika belum ada
    let toastContainer = document.querySelector('.toast-container');
    if (!toastContainer) {
        toastContainer = document.createElement('div');
        toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
        document.body.appendChild(toastContainer);
    }
    
    // Buat toast element dengan style yang sama
    const toastId = 'toast-' + Date.now();
    const toastHtml = `
        <div id="${toastId}" class="toast align-items-center ${type === 'success' ? 'bg-success text-white' : 'bg-danger text-white'}" role="alert">
            <div class="d-flex">
                <div class="toast-body">
                    ${type === 'success' ? '✅' : '⚠️'} ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    `;
    
    // Tambahkan toast ke container
    toastContainer.insertAdjacentHTML('beforeend', toastHtml);
    
    // Tampilkan toast
    const toastElement = document.getElementById(toastId);
    const toast = new bootstrap.Toast(toastElement, { delay: 3000 });
    toast.show();
    
    // Hapus toast setelah selesai
    toastElement.addEventListener('hidden.bs.toast', function () {
        this.remove();
    });
}

// ==================== 3. FUNGSI VALIDASI EMAIL ====================
// Cek apakah email valid
function isValidEmail(email) {
    return email.includes('@') && email.includes('.');
}

// ==================== 4. VALIDASI FORM REGISTER ====================
function validateRegisterForm() {
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    
    let isValid = true;
    
    // Validasi nama
    if (!name) {
        document.getElementById('name-error').textContent = 'Nama harus diisi';
        document.getElementById('name-error').style.display = 'block';
        showToast('Nama harus diisi', 'error');
        isValid = false;
    } else {
        document.getElementById('name-error').style.display = 'none';
    }
    
    // Validasi email
    if (!email) {
        document.getElementById('email-error').textContent = 'Email harus diisi';
        document.getElementById('email-error').style.display = 'block';
        showToast('Email harus diisi', 'error');
        isValid = false;
    } else if (!isValidEmail(email)) {
        document.getElementById('email-error').textContent = 'Email tidak valid';
        document.getElementById('email-error').style.display = 'block';
        showToast('Email tidak valid', 'error');
        isValid = false;
    } else {
        document.getElementById('email-error').style.display = 'none';
    }
    
    // Validasi password
    if (!password) {
        document.getElementById('password-error').textContent = 'Password harus diisi';
        document.getElementById('password-error').style.display = 'block';
        showToast('Password harus diisi', 'error');
        isValid = false;
    } else if (password.length < 6) {
        document.getElementById('password-error').textContent = 'Password minimal 6 karakter';
        document.getElementById('password-error').style.display = 'block';
        showToast('Password minimal 6 karakter', 'error');
        isValid = false;
    } else {
        document.getElementById('password-error').style.display = 'none';
    }
    
    // Validasi konfirmasi password
    if (!confirmPassword) {
        document.getElementById('confirmPassword-error').textContent = 'Konfirmasi password harus diisi';
        document.getElementById('confirmPassword-error').style.display = 'block';
        showToast('Konfirmasi password harus diisi', 'error');
        isValid = false;
    } else if (password !== confirmPassword) {
        document.getElementById('confirmPassword-error').textContent = 'Password tidak sama';
        document.getElementById('confirmPassword-error').style.display = 'block';
        showToast('Password tidak sama', 'error');
        isValid = false;
    } else {
        document.getElementById('confirmPassword-error').style.display = 'none';
    }
    
    return isValid;
}

// ==================== 5. VALIDASI FORM LOGIN ====================
function validateLoginForm() {
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;
    
    let isValid = true;
    
    // Validasi email
    if (!email) {
        document.getElementById('email-error').textContent = 'Email harus diisi';
        document.getElementById('email-error').style.display = 'block';
        showToast('Email harus diisi', 'error');
        isValid = false;
    } else if (!isValidEmail(email)) {
        document.getElementById('email-error').textContent = 'Email tidak valid';
        document.getElementById('email-error').style.display = 'block';
        showToast('Email tidak valid', 'error');
        isValid = false;
    } else {
        if (document.getElementById('email-error')) {
            document.getElementById('email-error').style.display = 'none';
        }
    }
    
    // Validasi password
    if (!password) {
        document.getElementById('password-error').textContent = 'Password harus diisi';
        document.getElementById('password-error').style.display = 'block';
        showToast('Password harus diisi', 'error');
        isValid = false;
    } else if (password.length < 6) {
        document.getElementById('password-error').textContent = 'Password minimal 6 karakter';
        document.getElementById('password-error').style.display = 'block';
        showToast('Password minimal 6 karakter', 'error');
        isValid = false;
    } else {
        if (document.getElementById('password-error')) {
            document.getElementById('password-error').style.display = 'none';
        }
    }
    
    return isValid;
}

// ==================== 6. KIRIM FORM REGISTER DENGAN AJAX ====================
function submitRegisterForm() {
    // Ambil data dari form
    const formData = new FormData(document.getElementById('registerForm'));
    
    // Tampilkan loading
    const submitBtn = document.getElementById('submitBtn');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Memproses...';
    submitBtn.disabled = true;
    
    // Kirim dengan AJAX ke server
    fetch('/register', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        // Kembalikan button ke normal
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
        
        if (data.success) {
            // Jika sukses, tampilkan toast sukses
            showToast(data.message, 'success');
            // Redirect ke login setelah 1.5 detik
            setTimeout(() => {
                window.location.href = '/login';
            }, 1500);
        } else {
            // Jika error, tampilkan pesan error dari server
            showToast(data.message, 'error');
        }
    })
    .catch(error => {
        // Jika ada error jaringan
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
        showToast('Terjadi kesalahan, coba lagi', 'error');
    });
}

// ==================== 7. KIRIM FORM LOGIN DENGAN AJAX ====================
function submitLoginForm() {
    // Ambil data dari form
    const formData = new FormData(document.getElementById('loginForm'));
    
    // Tampilkan loading
    const submitBtn = document.getElementById('submitBtn');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Memproses...';
    submitBtn.disabled = true;
    
    // Kirim dengan AJAX ke server
    fetch('/login', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        // Kembalikan button ke normal
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
        
        if (data.success) {
            // Jika sukses, tampilkan toast sukses
            showToast(data.message, 'success');
            // Redirect ke home setelah 1 detik
            setTimeout(() => {
                window.location.href = data.redirect || '/';
            }, 1000);
        } else {
            // Jika error, tampilkan pesan error dari server
            showToast(data.message, 'error');
        }
    })
    .catch(error => {
        // Jika ada error jaringan
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
        showToast('Terjadi kesalahan, coba lagi', 'error');
    });
}

// ==================== 8. INISIALISASI SAAT PAGE LOAD ====================
document.addEventListener('DOMContentLoaded', function() {
    // Setup toggle password
    setupPasswordToggle();
    
    // Tampilkan toast dari session jika ada (untuk login)
    const sessionError = document.getElementById('session-error');
    if (sessionError) {
        const errorText = sessionError.textContent.replace('×', '').trim();
        if (errorText) {
            showToast(errorText, 'error');
        }
    }
    
    // Handle form register
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Cegah reload page
            
            // Validasi di frontend
            if (validateRegisterForm()) {
                // Jika valid, kirim ke server dengan AJAX
                submitRegisterForm();
            }
        });
    }
    
    // Handle form login
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Cegah reload page
            
            // Validasi di frontend
            if (validateLoginForm()) {
                // Jika valid, kirim ke server dengan AJAX
                submitLoginForm();
            }
        });
    }
});