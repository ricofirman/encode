<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENCODE Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">ENCODE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="t-shirt.html">T-Shirt</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="shirt.html">Shirt</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="jacket-sweater.html">Jacket/Sweater</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact-us.html">Contact me</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="help.html">Help</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="order-status.html">Order status</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Cart</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="brand-background">
            <img src="{{ asset('img/BDB.jpg') }}" alt="">
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
                            <a href="#" class="btn btn-encode">SHOP NOW</a>
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
            <div class="row">
                <div class="col-md-4">
                    <h5>LOG IN</h5>
                    <p>Sign in to your account to access exclusive benefits.</p>
                </div>
                <div class="col-md-4">
                    <h5>YOUR BAG (0)</h5>
                    <p>Your shopping bag is currently empty.</p>
                </div>
                <div class="col-md-4">
                    <h5>REGISTER YOUR EMAIL FOR NEWS AND SPECIAL OFFERS</h5>
                    <form class="newsletter-form">
                        <input type="email" placeholder="Enter your email">
                        <button type="submit">SIGN UP FOR FREE <i class="fas fa-arrow-right ms-2"></i></button>
                    </form>
                </div>
            </div>
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