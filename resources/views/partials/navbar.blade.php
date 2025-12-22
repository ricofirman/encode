<nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm" style="z-index: 1030;">
    <div class="container-fluid">
        <a class="brand" href="{{ url('/') }}">ENCODE</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Menu untuk SEMUA pengunjung -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('products') ? 'active' : '' }}" href="{{ url('/products') }}">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="{{ url('/contact') }}">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('help') ? 'active' : '' }}" href="{{ url('/help') }}">Help</a>
                </li>
                
                <!-- Menu khusus untuk USER YANG LOGIN -->
                @if(Session::has('is_logged_in'))
                   
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('cart') ? 'active' : '' }}" href="{{ url('/cart') }}">
                            <i class="bi bi-cart3"></i> Cart
                            @if(Session::has('cart_count') && Session::get('cart_count') > 0)
                                <span class="badge bg-danger cart-badge">{{ Session::get('cart_count') }}</span>
                            @endif
                        </a>
                    </li>
                    
                    <!-- Dropdown User -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i>
                            {{ Session::get('user_name') }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><h6 class="dropdown-header">Welcome, {{ Session::get('user_name') }}!</h6></li>
                            <li><hr class="dropdown-divider"></li>
                            
                            @if(Session::get('user_role') == 'admin')
                                <li><a class="dropdown-item" href="{{ url('/admin/dashboard') }}">
                                    <i class="bi bi-speedometer2 me-2"></i>Admin Dashboard
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                            @endif
                            
                            <!-- Profile Settings -->
                            <li><a class="dropdown-item" href="{{ url('/profile') }}">
                                <i class="bi bi-person me-2"></i>My Profile
                            </a></li>
                            
                            <!-- Change Name -->
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#changeNameModal">
                                <i class="bi bi-pencil-square me-2"></i>Change Name
                            </a></li>
                            
                            <!-- Change Password -->
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                <i class="bi bi-key me-2"></i>Change Password
                            </a></li>
                            
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="{{ url('/logout') }}">
                                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                @else
                    <!-- Tombol Login/Register untuk guest -->
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-primary btn-sm mx-2" href="{{ url('/login') }}">
                            <i class="bi bi-box-arrow-in-right me-1"></i>Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary btn-sm" href="{{ url('/register') }}">
                            <i class="bi bi-person-plus me-1"></i>Register
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<!-- Modal Change Name -->
<div class="modal fade" id="changeNameModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Your Name</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="changeNameForm" action="{{ url('/profile/change-name') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Current Name</label>
                        <input type="text" class="form-control" value="{{ Session::get('user_name') }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">New Name *</label>
                        <input type="text" name="name" class="form-control" required 
                               placeholder="Enter your new name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Name</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Change Password -->
<div class="modal fade" id="changePasswordModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="changePasswordForm" action="{{ url('/profile/change-password') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Current Password *</label>
                        <input type="password" name="current_password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">New Password *</label>
                        <input type="password" name="new_password" class="form-control" required minlength="6">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm New Password *</label>
                        <input type="password" name="new_password_confirmation" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    body {
        padding-top: 76px !important;
    }
    
    .nav-link.active {
        color: #d5001c !important;
        font-weight: 600;
    }
    
    .navbar .badge {
        font-size: 0.6rem;
        margin-left: 3px;
    }
    
    .dropdown-header {
        font-size: 0.85rem;
        color: #6c757d;
    }
</style>

<script src="{{ asset('js/auth-nav.js') }}"></script>