// File: public/js/auth.js

// ====== TOGGLE PASSWORD ======
document.getElementById('togglePassword')?.addEventListener('click', function() {
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

// ====== FUNGSI UTAMA VALIDASI LOGIN ======
document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    
    // Tampilkan error dari session saat page load
    const sessionError = document.getElementById('session-error');
    if (sessionError) {
        const errorText = sessionError.textContent.replace('×', '').trim();
        if (errorText) {
            showToast(errorText, 'error');
        }
    }
    
    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            event.preventDefault();
            
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;
            
            resetValidationErrors();
            
            const isValid = validateLoginInput(email, password);
            
            if (isValid) {
                showLoading(true);
                submitLoginForm(email, password);
            }
        });
    }
});

// ====== FUNGSI VALIDASI INPUT ======
function validateLoginInput(email, password) {
    let isValid = true;
    
    if (!email) {
        showError('email', 'Email harus diisi');
        showToast('Email harus diisi', 'error');
        isValid = false;
    } else if (!isValidEmail(email)) {
        showError('email', 'Format email tidak valid');
        showToast('Format email tidak valid', 'error');
        isValid = false;
    } else {
        showSuccess('email');
    }
    
    if (!password) {
        showError('password', 'Password harus diisi');
        showToast('Password harus diisi', 'error');
        isValid = false;
    } else if (password.length < 6) {
        showError('password', 'Password minimal 6 karakter');
        showToast('Password minimal 6 karakter', 'error');
        isValid = false;
    } else {
        showSuccess('password');
    }
    
    return isValid;
}

// ====== FUNGSI BANTU ======
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function showError(fieldId, message) {
    const field = document.getElementById(fieldId);
    const errorDiv = document.getElementById(fieldId + '-error');
    
    if (field) {
        field.classList.remove('is-valid');
        field.classList.add('is-invalid');
    }
    
    if (errorDiv) {
        errorDiv.textContent = message;
        errorDiv.style.display = 'block';
    }
}

function showSuccess(fieldId) {
    const field = document.getElementById(fieldId);
    const errorDiv = document.getElementById(fieldId + '-error');
    
    if (field) {
        field.classList.remove('is-invalid');
        field.classList.add('is-valid');
    }
    
    if (errorDiv) {
        errorDiv.style.display = 'none';
    }
}

function resetValidationErrors() {
    ['email', 'password'].forEach(fieldId => {
        const field = document.getElementById(fieldId);
        const errorDiv = document.getElementById(fieldId + '-error');
        
        if (field) {
            field.classList.remove('is-invalid', 'is-valid');
        }
        if (errorDiv) {
            errorDiv.style.display = 'none';
            errorDiv.textContent = '';
        }
    });
}

function showLoading(show) {
    const submitBtn = document.getElementById('submitBtn');
    
    if (submitBtn) {
        if (show) {
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Memproses...';
            submitBtn.disabled = true;
        } else {
            submitBtn.innerHTML = '<i class="bi bi-box-arrow-in-right me-1"></i> Masuk';
            submitBtn.disabled = false;
        }
    }
}

// ====== KIRIM DATA KE SERVER ======
function submitLoginForm(email, password) {
    const formData = new FormData();
    formData.append('email', email);
    formData.append('password', password);
    
    fetch('/login', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        // Cek status response
        if (response.status === 500) {
            throw new Error('Server error');
        }
        
        // Cek content type
        const contentType = response.headers.get('content-type');
        
        if (contentType && contentType.includes('application/json')) {
            return response.json();
        } else {
            // Jika response bukan JSON (misal redirect)
            if (response.redirected) {
                window.location.href = response.url;
                return;
            }
            return response.text().then(text => {
                throw new Error('Unexpected response format');
            });
        }
    })
    .then(data => {
        handleServerResponse(data);
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Terjadi kesalahan. Silakan coba lagi.', 'error');
        showLoading(false);
    });
}

// ====== HANDLE RESPONSE DARI SERVER ======

function handleServerResponse(data) {
    showLoading(false);
    
    if (data.success) {
        showToast(data.message || 'Login berhasil!', 'success');
        
        setTimeout(() => {
            if (data.redirect) {
                window.location.href = data.redirect; // Akan ke "/"
            } else {
                window.location.href = '/'; // Redirect ke home
            }
        }, 1000);
    } else {
        if (data.errors) {
            Object.keys(data.errors).forEach(field => {
                showError(field, data.errors[field][0]);
            });
            showToast('Harap perbaiki form Anda', 'error');
        } else {
            showToast(data.message || 'Login gagal', 'error');
        }
    }
}

// ====== TOAST NOTIFICATION ======
function showToast(message, type = 'info') {
    let toastContainer = document.querySelector('.toast-container');
    if (!toastContainer) {
        toastContainer = document.createElement('div');
        toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
        document.body.appendChild(toastContainer);
    }
    
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
    
    toastContainer.insertAdjacentHTML('beforeend', toastHtml);
    
    const toastElement = document.getElementById(toastId);
    const toast = new bootstrap.Toast(toastElement, { delay: 3000 });
    toast.show();
    
    toastElement.addEventListener('hidden.bs.toast', function () {
        this.remove();
    });
}

// ====== VALIDASI REAL-TIME ======
document.addEventListener('DOMContentLoaded', function() {
    const emailInput = document.getElementById('email');
    if (emailInput) {
        emailInput.addEventListener('input', function() {
            const email = this.value.trim();
            if (email && !isValidEmail(email)) {
                showError('email', 'Format email tidak valid');
            } else if (email) {
                showSuccess('email');
            } else {
                // Reset jika kosong
                const errorDiv = document.getElementById('email-error');
                if (errorDiv) {
                    errorDiv.style.display = 'none';
                }
                this.classList.remove('is-invalid', 'is-valid');
            }
        });
    }
    
    const passwordInput = document.getElementById('password');
    if (passwordInput) {
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            if (password && password.length < 6) {
                showError('password', 'Password minimal 6 karakter');
            } else if (password) {
                showSuccess('password');
            } else {
                // Reset jika kosong
                const errorDiv = document.getElementById('password-error');
                if (errorDiv) {
                    errorDiv.style.display = 'none';
                }
                this.classList.remove('is-invalid', 'is-valid');
            }
        });
    }
});