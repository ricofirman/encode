<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - ENCODE')</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Admin CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    
    @yield('styles')
    
    <!-- Security Headers -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
</head>
<body class="admin-body">
    <!-- Admin Wrapper -->
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <nav class="admin-sidebar" id="sidebar">
            <div class="sidebar-header">
                <h3 class="brand">
                    <i class="bi bi-code-slash"></i> ENCODE<span class="text-warning">Admin</span>
                </h3>
            </div>
            
            {{-- Ganti seluruh sidebar menu dengan ini: --}}
           {{-- GANTI sidebar menu dengan ini: --}}
<ul class="sidebar-menu list-unstyled">
    <li class="sidebar-item {{ Route::is('admin.dashboard') ? 'active' : '' }}">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
            <i class="bi bi-speedometer2"></i>
            <span>Dashboard</span>
        </a>
    </li>
    
    <li class="sidebar-item {{ Route::is('admin.products*') ? 'active' : '' }}">
        <a href="{{ route('admin.products') }}" class="sidebar-link">
            <i class="bi bi-box"></i>
            <span>Products</span>
        </a>
    </li>
    
    <li class="sidebar-divider"></li>
    
    <li class="sidebar-item">
        <a href="{{ url('/') }}" class="sidebar-link">
            <i class="bi bi-shop"></i>
            <span>View Store</span>
        </a>
    </li>
    
    <li class="sidebar-item">
        <a href="{{ url('/logout') }}" class="sidebar-link text-danger">
            <i class="bi bi-box-arrow-right"></i>
            <span>Logout</span>
        </a>
    </li>
</ul>
            
            <div class="sidebar-footer">
                <div class="user-info">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Session::get('user_name', 'Admin')) }}&background=dc3545&color=fff" 
                         class="user-avatar" 
                         alt="Admin">
                    <div class="user-details">
                        <strong>{{ Session::get('user_name') }}</strong>
                        <small class="text-muted"></small>
                    </div>
                </div>
            </div>
        </nav>
        
        <!-- Main Content -->
        <div class="admin-content">
            <!-- Top Navbar -->
            <nav class="admin-topbar">
                <div class="container-fluid">
                    <button class="btn sidebar-toggle" id="sidebarToggle">
                        <i class="bi bi-list"></i>
                    </button>
                    
                    <div class="topbar-right">
                        <div class="topbar-time">
                            <small id="current-time">{{ now()->format('d M Y, H:i:s') }}</small>
                        </div>
                    </div>
                </div>
            </nav>
            
            <!-- Page Content -->
            <main class="admin-main">
                <div class="container-fluid py-4">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Admin JS -->
    <script>
    // Sidebar Toggle
    document.getElementById('sidebarToggle').addEventListener('click', function() {
        document.getElementById('sidebar').classList.toggle('collapsed');
        document.querySelector('.admin-content').classList.toggle('expanded');
    });
    
    // Update Current Time
    function updateTime() {
        const now = new Date();
        const timeString = now.toLocaleDateString('en-US', { 
            weekday: 'long', 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        });
        document.getElementById('current-time').textContent = timeString;
    }
    setInterval(updateTime, 1000);
    
    // Auto-hide alerts
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert:not(.alert-permanent)');
        alerts.forEach(alert => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);
    
    // Prevent back button after logout
    if (performance.navigation.type === 2) {
        window.location.reload();
    }
    
    // Clear form cache
    window.onpageshow = function(event) {
        if (event.persisted) {
            window.location.reload();
        }
    };
    </script>
    
    @yield('scripts')
</body>
</html>