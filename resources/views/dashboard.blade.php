<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENCODE Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    <!-- Navigation -->
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
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/t-shirt') }}">T-Shirt</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/shirt') }}">Shirt</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/jacket-sweater') }}">Jacket/Sweater</a>
                    </li>
                    
                    <!-- Menu khusus untuk USER YANG LOGIN -->
                    @if(Session::has('is_logged_in'))
                        <!-- Dropdown untuk user yang sudah login -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
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
                                @endif
                                
                                <li><a class="dropdown-item" href="#">
                                    <i class="bi bi-person me-2"></i>My Profile
                                </a></li>
                                <li><a class="dropdown-item" href="#">
                                    <i class="bi bi-bag me-2"></i>My Orders
                                </a></li>
                                <li><a class="dropdown-item" href="{{ url('/cart') }}">
                                    <i class="bi bi-cart me-2"></i>Cart
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-danger" href="{{ url('/logout') }}">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <!-- Tombol Cart kecil di samping dropdown -->
                        <li class="nav-item">
                            <a class="nav-link position-relative" href="{{ url('/cart') }}">
                                <i class="bi bi-cart3"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    3
                                </span>
                            </a>
                        </li>
                        
                    @else
                        <!-- Menu untuk GUEST (belum login) -->
                        <li class="nav-item">
                            <a class="nav-link " href="{{ url('/contact-us') }}">Contact me</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/help') }}">Help</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/order-status') }}">Order status</a>
                        </li>
                        
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

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="brand-background">
            <img src="{{ asset('img/BDB.png') }}" alt="">
        </div>
    </section>
    
    <!-- Categories Section -->
    <section class="category-section">
        <div class="container">
            <h2 class="section-title">WHAT'S HOT</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="category-card">
                        <img src="{{ asset('img/e1.jpg') }}" alt="T-shirt Encode">
                        <div class="card-body">
                            <h5>Streetwear E</h5>
                            <p>Struktur yang berbicara. Kodekan profesionalisme dan karakter tajam Anda.</p>
                            <a href="{{ url('/shop/streetwear-e') }}" class="btn btn-encode">SHOP NOW</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="category-card">
                        <img src="{{ asset('img/e2.jpg') }}" alt="T-shirt Encode">
                        <div class="card-body">
                            <h5>Black Shirt ENCODE</h5>
                            <p>Encode gaya adaptif untuk eksplorasi kota tanpa batas.</p>
                            <a href="#" class="btn btn-encode">SHOP NOW</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="category-card">
                        <img src="{{ asset('img/e3.jpg') }}" alt="T-shirt Encode">
                        <div class="card-body">
                            <h5>Casual-Shirt</h5>
                            <p>Struktur yang mendefinisikan kekuatan feminin yang elegan</p>
                            <a href="#" class="btn btn-encode">SHOP NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gender Categories -->
    <section class="category-section" style="background-color: white;">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="category-card">
                        <img src="{{ asset('img/TS1.jpg') }}" alt="Men Collection">
                        <div class="card-body text-center">
                            <h5>Shirt</h5>
                            <a href="shirt.html" class="btn btn-encode">SHOP NOW <i class="fas fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="category-card">
                        <img src="{{ asset('img/S1.jpg') }}" alt="Kids Collection">
                        <div class="card-body text-center">
                            <h5>T-Shirt</h5>
                            <a href="t-shirt.html" class="btn btn-encode">SHOP NOW <i class="fas fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="category-card">
                        <img src="{{ asset('img/J1.jpg') }}" alt="Women Collection">
                        <div class="card-body text-center">
                            <h5>Jacket</h5>
                            <a href="jacket-sweater.html" class="btn btn-encode">SHOP NOW <i class="fas fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Grid -->
    <section class="category-section">
        <div class="container">
            <h2 class="section-title">FEATURED PRODUCTS</h2>
            <div class="product-grid">
                <div class="product-card">
                    <img src="{{ asset('img/J3.jpg') }}" alt="">
                    <div class="card-body">
                        <h5 class="product-title">The Ciper Blazer</h5>
                        <p class="product-price">Rp 1,200</p>
                    </div>
                </div>
                <div class="product-card">
                    <img src="{{ asset('img/J2.jpg') }}" alt="">
                    <div class="card-body">
                        <h5 class="product-title">E-Jacket</h5>
                        <p class="product-price">Rp 499</p>
                    </div>
                </div>
                <div class="product-card">
                    <img src="{{ asset('img/S2.jpg') }}" alt="">
                    <div class="card-body">
                        <h5 class="product-title">Binary T-Shirt</h5>
                        <p class="product-price">Rp 99</p>
                    </div>
                </div>
                <div class="product-card">
                    <img src="{{ asset('img/TS2.jpg') }}" alt="">
                    <div class="card-body">
                        <h5 class="product-title">Blueprint Shirt</h5>
                        <p class="product-price">Rp 599</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="category-section" style="background-color: white;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3>WEAR YOUR CODE</h3>
                    <p>Welcome to the official online destination of ENCODE Surabaya, where we believe clothing is the ultimate medium for self-expression. Just as data is encoded into a complex digital language, ENCODE empowers you to translate your unique personality, values, and story into a sophisticated style statement. At the ENCODE Surabaya Official Online Store, you will discover a meticulously curated collection of apparel that emphasizes clean lines, structured silhouettes, and meaningful design. Our pieces are more than just clothing; they are the building blocks of your personal aesthetic. Explore our range of essential wear, from sharp tailoring and minimalist tops to architecturally-inspired bottoms, all designed to help you construct a wardrobe that is authentically you. The ENCODE collection is constantly evolving, offering new interpretations of modern dressing for men and women. Find your signature style and the perfect pieces to define your identity only at our official store.</p>
                </div>
                <div class="col-md-6">
                    <h3>ENCODE: THE FOUNDATION OF YOUR STYLE LANGUAGE</h3>
                    <p>Searching for clothing that resonates with your core identity and offers unparalleled sophistication? Look no further than ENCODE Surabaya Official Online Store. We provide the essential elements for your style lexicon, from statement outerwear and elegant knits to versatile basics for every occasion. ENCODE Indonesia is committed to a seamless and refined shopping experience. We offer exclusive online benefits, including complimentary delivery for orders above IDR 1,200, hassle-free returns, and personalized styling consultations. Build your perfect wardrobe and start encoding your identity with ENCODE.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
         
            <hr class="my-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="d-flex gap-4">
                        <a href="#">Contact Online Shop</a>
                        <a href="#">FAQ</a>
                    </div>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="d-flex gap-4 justify-content-md-end">
                        <a href="#">Delivery</a>
                        <a href="#">Order Status</a>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col text-center">
                    <p>© 2025 ENCODE Surabaya</p>
                    <div class="social-icons">
                        <i class="fab fa-facebook-f"></i>
                        <i class="fab fa-twitter"></i>
                        <i class="fab fa-instagram"></i>
                        <i class="fab fa-youtube"></i>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>