
// Handle form submissions with AJAX
document.addEventListener('DOMContentLoaded', function() {
    // Change Name Form
    const nameForm = document.getElementById('changeNameForm');
    if (nameForm) {
        nameForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Updating...';
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update nama di navbar
                    const userNameElements = document.querySelectorAll('.dropdown-header, .nav-link.dropdown-toggle');
                    userNameElements.forEach(el => {
                        if (el.classList.contains('dropdown-header')) {
                            el.textContent = 'Welcome, ' + data.new_name + '!';
                        } else {
                            const icon = el.querySelector('i');
                            el.innerHTML = icon.outerHTML + ' ' + data.new_name;
                        }
                    });
                    
                    // Show success message
                    showToast(data.message, 'success');
                    
                    // Close modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('changeNameModal'));
                    modal.hide();
                    
                    // Reset form
                    nameForm.reset();
                } else {
                    showToast(data.message, 'error');
                }
            })
            .catch(error => {
                showToast('Error: ' + error.message, 'error');
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            });
        });
    }
    
    // Change Password Form
    const passwordForm = document.getElementById('changePasswordForm');
    if (passwordForm) {
        passwordForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (this.new_password.value !== this.new_password_confirmation.value) {
                showToast('New passwords do not match!', 'error');
                return;
            }
            
            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Updating...';
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast(data.message, 'success');
                    
                    // Close modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('changePasswordModal'));
                    modal.hide();
                    
                    // Reset form
                    passwordForm.reset();
                } else {
                    showToast(data.message, 'error');
                }
            })
            .catch(error => {
                showToast('Error: ' + error.message, 'error');
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            });
        });
    }
});

// Toast notification function
function showToast(message, type = 'success') {
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