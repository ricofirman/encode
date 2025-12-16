// ====== HANYA TOGGLE PASSWORD SAJA ======
function setupPasswordToggle() {
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.previousElementSibling;
            if (input && input.type === 'password') {
                input.type = 'text';
                this.innerHTML = '<i class="bi bi-eye-slash"></i>';
            } else if (input) {
                input.type = 'password';
                this.innerHTML = '<i class="bi bi-eye"></i>';
            }
        });
    });
}

// ====== INISIALISASI ======
document.addEventListener('DOMContentLoaded', function() {
    console.log('✅ Simple auth script loaded');
    setupPasswordToggle();
});