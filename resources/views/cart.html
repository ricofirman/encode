<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Shop - Keranjang Belanja</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="style.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #858796;
            --success-color: #1cc88a;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
            --light-color: #f8f9fc;
            --dark-color: #5a5c69;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fb;
            color: #333;
            padding-bottom: 50px;
        }
        
        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color);
        }
        
        .cart-icon {
            position: relative;
            font-size: 1.5rem;
        }
        
        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: var(--danger-color);
            color: white;
            border-radius: 50%;
            width: 22px;
            height: 22px;
            font-size: 0.8rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .product-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
        }
        
        .quantity-control {
            display: flex;
            align-items: center;
        }
        
        .quantity-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: #f0f0f0;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        
        .quantity-input {
            width: 50px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin: 0 8px;
            padding: 5px;
        }
        
        .cart-item {
            transition: all 0.3s ease;
        }
        
        .cart-item:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }
        
        .remove-item {
            color: var(--danger-color);
            background: none;
            border: none;
            font-size: 1.2rem;
            transition: transform 0.2s;
        }
        
        .remove-item:hover {
            transform: scale(1.2);
        }
        
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        }
        
        .card-header {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            border-radius: 10px 10px 0 0 !important;
        }
        
        .summary-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px dashed #eee;
        }
        
        .summary-total {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary-color);
        }
        
        .btn-checkout {
            background-color: var(--success-color);
            color: white;
            font-weight: 600;
            padding: 12px;
            border-radius: 8px;
            transition: all 0.3s;
        }
        
        .btn-checkout:hover {
            background-color: #17a673;
            transform: translateY(-2px);
        }
        
        .btn-continue {
            background-color: var(--light-color);
            color: var(--dark-color);
            font-weight: 600;
            padding: 12px;
            border-radius: 8px;
            transition: all 0.3s;
        }
        
        .btn-continue:hover {
            background-color: #e8eaef;
        }
        
        .empty-cart {
            text-align: center;
            padding: 40px 20px;
        }
        
        .empty-cart i {
            font-size: 5rem;
            color: #ddd;
            margin-bottom: 20px;
        }
        
        .discount-badge {
            background-color: var(--warning-color);
            color: #856404;
            font-size: 0.8rem;
            padding: 3px 8px;
            border-radius: 4px;
            margin-left: 8px;
        }
        
        .coupon-input {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }
        
        .coupon-btn {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }
        
        .save-cart-btn {
            background-color: #e9ecef;
            color: var(--dark-color);
            border: 1px solid #ddd;
        }
        
        .save-cart-btn:hover {
            background-color: #dee2e6;
        }
        
        .product-title {
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
        }
        
        .product-title:hover {
            text-decoration: underline;
        }
        
        .stock-info {
            font-size: 0.85rem;
            color: var(--success-color);
        }
        
        .stock-warning {
            color: var(--warning-color);
        }
        
        .stock-danger {
            color: var(--danger-color);
        }
        
        .shipping-option {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .shipping-option:hover {
            border-color: var(--primary-color);
            background-color: rgba(78, 115, 223, 0.05);
        }
        
        .shipping-option.selected {
            border-color: var(--primary-color);
            background-color: rgba(78, 115, 223, 0.1);
        }
        
        .shipping-radio {
            margin-right: 10px;
        }
        
        @media (max-width: 768px) {
            .product-img {
                width: 80px;
                height: 80px;
            }
            
            .quantity-control {
                justify-content: center;
                margin-top: 10px;
            }
            
            .mobile-spacing {
                margin-top: 15px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-shopping-bag me-2"></i>ShopCart
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-home me-1"></i> Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-store me-1"></i> Toko</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-tag me-1"></i> Promo</a>
                    </li>
                </ul>
                
                <div class="d-flex align-items-center">
                    <div class="cart-icon me-4 position-relative">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="cart-count">3</span>
                    </div>
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="https://ui-avatars.com/api/?name=User+Demo&background=4e73df&color=fff&size=32" class="rounded-circle me-2" alt="User">
                            <span>User Demo</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profil</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-history me-2"></i> Riwayat</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2"></i> Keluar</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        <div class="row">
            <!-- Cart Items -->
            <div class="col-lg-8 mb-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-shopping-cart me-2"></i>Keranjang Belanja</span>
                        <span class="badge bg-light text-dark">3 item</span>
                    </div>
                    
                    <div class="card-body p-0">
                        <!-- Cart Items List -->
                        <div class="p-3 border-bottom cart-item">
                            <div class="row align-items-center">
                                <div class="col-md-2 col-4">
                                    <img src="https://images.unsplash.com/photo-1546868871-7041f2a55e12?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&q=80" alt="Smart Watch" class="product-img">
                                </div>
                                <div class="col-md-5 col-8">
                                    <a href="#" class="product-title">Smart Watch Series 5</a>
                                    <p class="text-muted mb-1">Warna: Hitam | Ukuran: 42mm</p>
                                    <p class="mb-0 stock-info"><i class="fas fa-check-circle me-1"></i> Tersedia: 12</p>
                                </div>
                                <div class="col-md-2 col-6 mt-md-0 mt-3">
                                    <div class="quantity-control">
                                        <button class="quantity-btn decrease" data-id="1"><i class="fas fa-minus"></i></button>
                                        <input type="number" class="quantity-input" value="1" min="1" max="10" data-id="1">
                                        <button class="quantity-btn increase" data-id="1"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="col-md-2 col-6 text-md-center mt-md-0 mt-3">
                                    <div class="h5 mb-0">Rp 1.250.000</div>
                                    <small class="text-muted text-decoration-line-through">Rp 1.500.000</small>
                                    <span class="discount-badge">-17%</span>
                                </div>
                                <div class="col-md-1 col-12 text-end mt-md-0 mobile-spacing">
                                    <button class="remove-item" data-id="1">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-3 border-bottom cart-item">
                            <div class="row align-items-center">
                                <div class="col-md-2 col-4">
                                    <img src="https://images.unsplash.com/photo-1581094794329-c8112a89af12?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&q=80" alt="Headphones" class="product-img">
                                </div>
                                <div class="col-md-5 col-8">
                                    <a href="#" class="product-title">Wireless Headphones Premium</a>
                                    <p class="text-muted mb-1">Warna: Putih | Tipe: Noise Cancelling</p>
                                    <p class="mb-0 stock-info stock-warning"><i class="fas fa-exclamation-circle me-1"></i> Tersedia: 3</p>
                                </div>
                                <div class="col-md-2 col-6 mt-md-0 mt-3">
                                    <div class="quantity-control">
                                        <button class="quantity-btn decrease" data-id="2"><i class="fas fa-minus"></i></button>
                                        <input type="number" class="quantity-input" value="2" min="1" max="5" data-id="2">
                                        <button class="quantity-btn increase" data-id="2"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="col-md-2 col-6 text-md-center mt-md-0 mt-3">
                                    <div class="h5 mb-0">Rp 850.000</div>
                                </div>
                                <div class="col-md-1 col-12 text-end mt-md-0 mobile-spacing">
                                    <button class="remove-item" data-id="2">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-3 cart-item">
                            <div class="row align-items-center">
                                <div class="col-md-2 col-4">
                                    <img src="https://images.unsplash.com/photo-1517336714731-489689fd1ca8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&q=80" alt="Laptop" class="product-img">
                                </div>
                                <div class="col-md-5 col-8">
                                    <a href="#" class="product-title">Laptop Ultrabook Pro 14"</a>
                                    <p class="text-muted mb-1">Warna: Silver | RAM: 16GB | SSD: 512GB</p>
                                    <p class="mb-0 stock-info stock-danger"><i class="fas fa-times-circle me-1"></i> Tersisa: 1</p>
                                </div>
                                <div class="col-md-2 col-6 mt-md-0 mt-3">
                                    <div class="quantity-control">
                                        <button class="quantity-btn decrease" data-id="3"><i class="fas fa-minus"></i></button>
                                        <input type="number" class="quantity-input" value="1" min="1" max="1" data-id="3">
                                        <button class="quantity-btn increase" data-id="3"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="col-md-2 col-6 text-md-center mt-md-0 mt-3">
                                    <div class="h5 mb-0">Rp 12.500.000</div>
                                    <small class="text-muted text-decoration-line-through">Rp 14.000.000</small>
                                    <span class="discount-badge">-11%</span>
                                </div>
                                <div class="col-md-1 col-12 text-end mt-md-0 mobile-spacing">
                                    <button class="remove-item" data-id="3">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Empty Cart State (Hidden by default) -->
                        <div class="empty-cart d-none">
                            <i class="fas fa-shopping-cart"></i>
                            <h4 class="mt-3">Keranjang Belanja Kosong</h4>
                            <p class="text-muted">Belum ada barang di keranjang belanja Anda</p>
                            <a href="#" class="btn btn-primary mt-3"><i class="fas fa-store me-2"></i> Mulai Belanja</a>
                        </div>
                    </div>
                    
                    <!-- Coupon & Actions -->
                    <div class="card-footer bg-light">
                        <div class="row">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <div class="input-group">
                                    <input type="text" class="form-control coupon-input" placeholder="Masukkan kode kupon">
                                    <button class="btn btn-primary coupon-btn" type="button">Terapkan</button>
                                </div>
                                <small class="text-muted mt-2 d-block">Contoh kupon: DISKON10, FREESHIP</small>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <button class="btn save-cart-btn me-2"><i class="far fa-bookmark me-1"></i> Simpan Keranjang</button>
                                <button class="btn btn-outline-danger" id="clear-cart"><i class="fas fa-trash-alt me-1"></i> Kosongkan Keranjang</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Shipping Options -->
                <div class="card mt-4">
                    <div class="card-header">
                        <i class="fas fa-shipping-fast me-2"></i>Opsi Pengiriman
                    </div>
                    <div class="card-body">
                        <div class="shipping-option selected" data-shipping="regular">
                            <div class="form-check">
                                <input class="form-check-input shipping-radio" type="radio" name="shipping" id="regular" checked>
                                <label class="form-check-label w-100" for="regular">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <strong>Reguler</strong>
                                            <p class="mb-0 text-muted">Estimasi 3-5 hari kerja</p>
                                        </div>
                                        <div class="h6 mb-0">Rp 15.000</div>
                                    </div>
                                </label>
                            </div>
                        </div>
                        
                        <div class="shipping-option" data-shipping="express">
                            <div class="form-check">
                                <input class="form-check-input shipping-radio" type="radio" name="shipping" id="express">
                                <label class="form-check-label w-100" for="express">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <strong>Express</strong>
                                            <p class="mb-0 text-muted">Estimasi 1-2 hari kerja</p>
                                        </div>
                                        <div class="h6 mb-0">Rp 30.000</div>
                                    </div>
                                </label>
                            </div>
                        </div>
                        
                        <div class="shipping-option" data-shipping="same-day">
                            <div class="form-check">
                                <input class="form-check-input shipping-radio" type="radio" name="shipping" id="same-day">
                                <label class="form-check-label w-100" for="same-day">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <strong>Same Day</strong>
                                            <p class="mb-0 text-muted">Dikirim hari ini</p>
                                        </div>
                                        <div class="h6 mb-0">Rp 50.000</div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="card sticky-top" style="top: 20px;">
                    <div class="card-header">
                        <i class="fas fa-receipt me-2"></i>Ringkasan Belanja
                    </div>
                    <div class="card-body">
                        <div class="summary-item">
                            <span>Subtotal (3 barang)</span>
                            <span id="subtotal">Rp 14.600.000</span>
                        </div>
                        <div class="summary-item">
                            <span>Diskon</span>
                            <span class="text-success" id="discount">- Rp 900.000</span>
                        </div>
                        <div class="summary-item">
                            <span>Biaya Pengiriman</span>
                            <span id="shipping-cost">Rp 15.000</span>
                        </div>
                        <div class="summary-item">
                            <span>Biaya Layanan</span>
                            <span>Rp 2.000</span>
                        </div>
                        <div class="summary-item summary-total mt-3 pt-3">
                            <span>Total</span>
                            <span id="total">Rp 13.717.000</span>
                        </div>
                        
                        <div class="mt-4">
                            <button class="btn btn-checkout w-100 mb-3">
                                <i class="fas fa-credit-card me-2"></i> Lanjut ke Pembayaran
                            </button>
                            <button class="btn btn-continue w-100">
                                <i class="fas fa-arrow-left me-2"></i> Lanjutkan Belanja
                            </button>
                        </div>
                        
                        <div class="mt-4 pt-3 border-top">
                            <h6 class="mb-3"><i class="fas fa-shield-alt me-2 text-primary"></i>Keamanan & Garansi</h6>
                            <div class="d-flex">
                                <div class="me-3 text-center">
                                    <i class="fas fa-lock fa-2x text-success mb-2"></i>
                                    <p class="small mb-0">Pembayaran Aman</p>
                                </div>
                                <div class="me-3 text-center">
                                    <i class="fas fa-undo fa-2x text-primary mb-2"></i>
                                    <p class="small mb-0">Garansi 30 Hari</p>
                                </div>
                                <div class="text-center">
                                    <i class="fas fa-headset fa-2x text-warning mb-2"></i>
                                    <p class="small mb-0">Dukungan 24/7</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Recommended Products -->
                <div class="card mt-4">
                    <div class="card-header">
                        <i class="fas fa-fire me-2"></i>Rekomendasi untuk Anda
                    </div>
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            <img src="https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=100&q=80" alt="Kamera" class="product-img me-3" style="width: 70px; height: 70px;">
                            <div>
                                <h6 class="mb-1">Kamera Mirrorless</h6>
                                <p class="text-muted small mb-1">Rp 8.500.000</p>
                                <button class="btn btn-sm btn-outline-primary">+ Tambah</button>
                            </div>
                        </div>
                        
                        <div class="d-flex">
                            <img src="https://images.unsplash.com/photo-1543512214-318c7553f230?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=100&q=80" alt="Speaker" class="product-img me-3" style="width: 70px; height: 70px;">
                            <div>
                                <h6 class="mb-1">Bluetooth Speaker</h6>
                                <p class="text-muted small mb-1">Rp 650.000</p>
                                <button class="btn btn-sm btn-outline-primary">+ Tambah</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Update cart count
            function updateCartCount() {
                const cartItems = document.querySelectorAll('.cart-item:not(.d-none)');
                const cartCount = document.querySelector('.cart-count');
                const itemCountBadge = document.querySelector('.badge.bg-light');
                
                let totalItems = 0;
                cartItems.forEach(item => {
                    if (!item.classList.contains('d-none')) {
                        const quantityInput = item.querySelector('.quantity-input');
                        totalItems += parseInt(quantityInput.value);
                    }
                });
                
                cartCount.textContent = totalItems;
                itemCountBadge.textContent = cartItems.length + ' item';
                
                // Show/hide empty cart message
                const emptyCart = document.querySelector('.empty-cart');
                const cartItemsContainer = document.querySelector('.card-body');
                if (cartItems.length === 0) {
                    emptyCart.classList.remove('d-none');
                    cartItemsContainer.style.display = 'none';
                } else {
                    emptyCart.classList.add('d-none');
                    cartItemsContainer.style.display = 'block';
                }
                
                updateSummary();
            }
            
            // Update order summary
            function updateSummary() {
                let subtotal = 0;
                let discount = 0;
                
                document.querySelectorAll('.cart-item:not(.d-none)').forEach(item => {
                    const quantity = parseInt(item.querySelector('.quantity-input').value);
                    const priceElement = item.querySelector('.h5.mb-0');
                    const originalPriceElement = item.querySelector('.text-decoration-line-through');
                    
                    let price = 0;
                    if (priceElement) {
                        price = parseFloat(priceElement.textContent.replace('Rp ', '').replace('.', '').replace(',', '.'));
                    }
                    
                    let originalPrice = price;
                    if (originalPriceElement) {
                        originalPrice = parseFloat(originalPriceElement.textContent.replace('Rp ', '').replace('.', '').replace(',', '.'));
                        discount += (originalPrice - price) * quantity;
                    }
                    
                    subtotal += price * quantity;
                });
                
                const shippingCost = parseInt(document.querySelector('.shipping-option.selected .h6.mb-0').textContent.replace('Rp ', '').replace('.', '').replace(',', '.'));
                const serviceFee = 2000;
                
                const total = subtotal + shippingCost + serviceFee;
                
                // Format numbers with thousand separators
                function formatRupiah(number) {
                    return 'Rp ' + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                }
                
                document.getElementById('subtotal').textContent = formatRupiah(subtotal);
                document.getElementById('discount').textContent = '- ' + formatRupiah(discount);
                document.getElementById('shipping-cost').textContent = formatRupiah(shippingCost);
                document.getElementById('total').textContent = formatRupiah(total);
            }
            
            // Quantity controls
            document.querySelectorAll('.quantity-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const input = document.querySelector(`.quantity-input[data-id="${id}"]`);
                    let value = parseInt(input.value);
                    
                    if (this.classList.contains('increase')) {
                        const max = parseInt(input.getAttribute('max'));
                        if (value < max) {
                            input.value = value + 1;
                        }
                    } else if (this.classList.contains('decrease')) {
                        const min = parseInt(input.getAttribute('min'));
                        if (value > min) {
                            input.value = value - 1;
                        }
                    }
                    
                    updateCartCount();
                });
            });
            
            // Quantity input change
            document.querySelectorAll('.quantity-input').forEach(input => {
                input.addEventListener('change', function() {
                    const min = parseInt(this.getAttribute('min'));
                    const max = parseInt(this.getAttribute('max'));
                    let value = parseInt(this.value);
                    
                    if (value < min) this.value = min;
                    if (value > max) this.value = max;
                    
                    updateCartCount();
                });
            });
            
            // Remove item from cart
            document.querySelectorAll('.remove-item').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const item = document.querySelector(`.cart-item .remove-item[data-id="${id}"]`).closest('.cart-item');
                    item.classList.add('d-none');
                    
                    // Animation effect
                    item.style.opacity = '0';
                    setTimeout(() => {
                        item.remove();
                        updateCartCount();
                    }, 300);
                });
            });
            
            // Clear cart button
            document.getElementById('clear-cart').addEventListener('click', function() {
                document.querySelectorAll('.cart-item').forEach(item => {
                    item.classList.add('d-none');
                    item.style.opacity = '0';
                    setTimeout(() => {
                        item.remove();
                        updateCartCount();
                    }, 300);
                });
            });
            
            // Shipping option selection
            document.querySelectorAll('.shipping-option').forEach(option => {
                option.addEventListener('click', function() {
                    // Remove selected class from all options
                    document.querySelectorAll('.shipping-option').forEach(opt => {
                        opt.classList.remove('selected');
                        opt.querySelector('.shipping-radio').checked = false;
                    });
                    
                    // Add selected class to clicked option
                    this.classList.add('selected');
                    this.querySelector('.shipping-radio').checked = true;
                    
                    updateSummary();
                });
            });
            
            // Apply coupon button
            document.querySelector('.coupon-btn').addEventListener('click', function() {
                const couponInput = document.querySelector('.coupon-input');
                const couponCode = couponInput.value.trim().toUpperCase();
                
                if (couponCode === 'DISKON10') {
                    alert('Kupon DISKON10 berhasil diterapkan! Anda mendapatkan diskon tambahan 10%.');
                    couponInput.value = '';
                } else if (couponCode === 'FREESHIP') {
                    alert('Kupon FREESHIP berhasil diterapkan! Gratis ongkir untuk pesanan Anda.');
                    couponInput.value = '';
                } else if (couponCode) {
                    alert('Kupon tidak valid. Silakan coba kupon lain.');
                } else {
                    alert('Silakan masukkan kode kupon.');
                }
                
                updateSummary();
            });
            
            // Continue shopping button
            document.querySelector('.btn-continue').addEventListener('click', function() {
                alert('Mengarahkan ke halaman produk...');
            });
            
            // Checkout button
            document.querySelector('.btn-checkout').addEventListener('click', function() {
                alert('Mengarahkan ke halaman pembayaran...');
            });
            
            // Add recommended product to cart
            document.querySelectorAll('.btn-sm.btn-outline-primary').forEach(button => {
                button.addEventListener('click', function() {
                    alert('Produk telah ditambahkan ke keranjang!');
                    // In a real app, you would update the cart with the new item
                });
            });
            
            // Initialize cart count
            updateCartCount();
        });
    </script>
</body>
</html>