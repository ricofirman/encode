// ====== HANYA TOGGLE PASSWORD SAJA ======
    const togglePassword = document.querySelector('#togglePassword');
    const passwordInput = document.querySelector('#password');

    togglePassword.addEventListener('click', function () {
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
      this.innerHTML = type === 'password' 
        ? '<i class="bi bi-eye"></i>' 
        : '<i class="bi bi-eye-slash"></i>';
    });

     const toastEl = document.getElementById('liveToast');
        const toastBody = document.getElementById('toast-body');
        const toast = new bootstrap.Toast(toastEl, { delay: 3000 });

        function showToast(message, type = 'info') {
            let icon = 'ℹ️';
            toastEl.className = 'toast align-items-center';
            
            if (type === 'success') {
                icon = '✅';
                toastEl.classList.add('text-bg-success');
            } else if (type === 'error') {
                icon = '⚠️';
                toastEl.classList.add('text-bg-danger');
            } else if (type === 'warning') {
                icon = '⚠️';
                toastEl.classList.add('text-bg-warning');
            } else {
                toastEl.classList.add('text-bg-light');
            }

            toastBody.innerHTML = `${icon} ${message}`;
            toast.show();
        }

        // Validasi client-side
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = this.email.value.trim();
            const password = this.password.value;

            // Reset validasi
            this.email.classList.remove('is-valid', 'is-invalid');
            this.password.classList.remove('is-valid', 'is-invalid');
            
            let valid = true;

            // Validasi email
            if (!email) {
                this.email.classList.add('is-invalid');
                showToast('Email wajib diisi.', 'error');
                valid = false;
            } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                this.email.classList.add('is-invalid');
                showToast('Format email tidak valid.', 'error');
                valid = false;
            } else {
                this.email.classList.add('is-valid');
            }

            // Validasi password
            if (!password) {
                this.password.classList.add('is-invalid');
                showToast('Kata sandi wajib diisi.', 'error');
                valid = false;
            } else if (password.length < 6) {
                this.password.classList.add('is-invalid');
                showToast('Kata sandi minimal 6 karakter.', 'error');
                valid = false;
            } else {
                this.password.classList.add('is-valid');
            }

            if (valid) {
                showToast('Sedang memproses login...', 'info');
                
                // Submit form setelah validasi berhasil
                setTimeout(() => {
                    this.submit();
                }, 1000);
            }
        });