<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ENCODE')</title>

    <!-- Prevent Caching for Logged In Users -->
    @if(Session::has('is_logged_in'))
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    @endif

    <!-- CSRF TOKEN -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    
    <!-- Additional Styles per page -->
    @yield('styles')
</head>
<body>
    <!-- ====== NAVBAR ====== -->
    @include('partials.navbar')
    
    <!-- ====== MAIN CONTENT ====== -->
    <main>
        @yield('content')
    </main>
    
    <!-- ====== FOOTER ====== -->
    @include('partials.footer')
    
    <!-- ====== SCRIPTS ====== -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Additional Scripts per page -->
    @yield('scripts')
</body>
</html>