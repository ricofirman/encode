<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status - ENCODE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        
        .breadcrumb {
            background-color: transparent;
            padding: 1rem 0;
        }
        
        .order-search {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-bottom: 2rem;
        }
        
        .order-search h3 {
            margin-bottom: 1.5rem;
            border-bottom: 2px solid var(--adidas-red);
            padding-bottom: 0.5rem;
        }
        
        .order-search input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 1rem;
        }
        
        .order-search button {
            width: 100%;
            background-color: var(--adidas-black);
            color: var(--adidas-white);
            border: none;
            padding: 0.75rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
        .order-search button:hover {
            background-color: var(--adidas-red);
        }
        
        .order-details {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-bottom: 2rem;
        }
        
        .order-details h3 {
            margin-bottom: 1.5rem;
            border-bottom: 2px solid var(--adidas-red);
            padding-bottom: 0.5rem;
        }
        
        .order-info {
            display: flex;
            justify-content: space-between;
            padding: 1rem;
            background-color: #f8f9fa;
            border-radius: 5px;
            margin-bottom: 1rem;
        }
        
        .order-status {
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
        }
        
        .status-pending {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
        }
        
        .status-processing {
            background-color: #cce5ff;
            border-left: 4px solid #007bff;
        }
        
        .status-shipped {
            background-color: #d4edda;
            border-left: 4px solid #28a745;
        }
        
        .status-delivered {
            background-color: #d1ecf1;
            border-left: 4px solid #17a2b8;
        }
        
        .order-items {
            margin-top: 1.5rem;
        }
        
        .order-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid #eee;
        }
        
        .order-item img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            margin-right: 1rem;
        }
        
        .order-item .item-details {
            flex: 1;
        }
        
        .order-item .item-price {
            font-weight: bold;
            color: var(--adidas-red);
        }
        
        .tracking-progress {
            margin-top: 2rem;
            padding: 1.5rem;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .tracking-progress h4 {
            margin-bottom: 1rem;
            border-bottom: 2px solid var(--adidas-red);
            padding-bottom: 0.5rem;
        }
        
        .progress-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
        }
        
        .progress-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
        }
        
        .progress-circle {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        
        .progress-line {
            flex: 1;
            height: 3px;
            background-color: #ddd;
            margin: 0 1rem;
        }
        
        .progress-step.active .progress-circle {
            background-color: var(--adidas-red);
        }
        
        .progress-step.completed .progress-circle {
            background-color: var(--adidas-green);
        }
        
        .progress-step.active .progress-line {
            background-color: var(--adidas-red);
        }
        
        .progress-step.completed .progress-line {
            background-color: var(--adidas-green);
        }
        
        @media (max-width: 768px) {
            .order-status-header h1 {
                font-size: 2rem;
            }
            
            .navbar {
                padding: 0.5rem 1rem;
            }
        }
    </style>
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
                        <a class="nav-link" href="t-shirt.html">T-shirt</a>
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
                        <a class="nav-link" href="#">Order status</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Cart</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Order Status</li>
        </ol>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <!-- Order Search -->
        <div class="order-search">
            <h3>Find Your Order</h3>
            <p>Enter your order number or email address to check the status of your order.</p>
            <input type="text" placeholder="Order Number or Email Address">
            <button>TRACK ORDER</button>
        </div>
        
        <!-- Order Details -->
        <div class="order-details">
            <h3>Order #IJAZAHASLI</h3>
            
            <div class="order-info">
                <div>
                    <strong>Order Date:</strong> November 27, 2025
                </div>
                <div>
                    <strong>Order Total:</strong> Rp 50
                </div>
                <div>
                    <strong>Status:</strong> <span class="badge bg-success">Shipped</span>
                </div>
            </div>
            
            <div class="order-status status-shipped">
                <strong>Current Status:</strong> Your order has been shipped and is on its way to you.
            </div>
            
            <div class="order-items">
                <h4>Items in this Order</h4>
                <div class="order-item">
                    <img src="" alt="WAHABI">
                    <div class="item-details">
                        <h5>...</h5>
                        <p>Size: XXL | Color: Black</p>
                    </div>
                    <div class="item-price">Rp 50</div>
                </div>
                <div class="order-item">
                    <img src="" alt="POHON SAWIT">
                    <div class="item-details">
                        <h5>...</h5>
                        <p>Size: P | Color: MERAH</p>
                    </div>
                    <div class="item-price">Rp 50</div>
                </div>
            </div>
            
            <div class="mt-3">
                <strong>Shipping Address:</strong><br>
                Anton Lari Maraton<br>
                Jl. Menuju Surga No. 1<br>
                Surabaya bagian panas, Indonesia 10220
            </div>
            
            <div class="mt-3">
                <strong>Estimated Delivery:</strong> October, 11 2005
            </div>
        </div>
        
        <!-- Tracking Progress -->
        <div class="tracking-progress">
            <h4>Order Progress</h4>
            <div class="progress-container">
                <div class="progress-step completed">
                    <div class="progress-circle">1</div>
                    <div>Order Confirmed</div>
                </div>
                <div class="progress-line"></div>
                <div class="progress-step completed">
                    <div class="progress-circle">2</div>
                    <div>Processing</div>
                </div>
                <div class="progress-line"></div>
                <div class="progress-step active">
                    <div class="progress-circle">3</div>
                    <div>Shipped</div>
                </div>
                <div class="progress-line"></div>
                <div class="progress-step">
                    <div class="progress-circle">4</div>
                    <div>Delivered</div>
                </div>
            </div>
        </div>
        
        <!-- Additional Options -->
        <div class="row mt-4">
            <div class="col-lg-6">
                <div class="order-details">
                    <h3>Need Help?</h3>
                    <p>If you have questions about your order, our customer service team is here to help.</p>
                    <a href="contact.html" class="btn btn-adidas">CONTACT US</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="order-details">
                    <h3>Return Policy</h3>
                    <p>You can return items within 30 days of delivery for a full refund. Items must be unworn, unwashed, and in original packaging.</p>
                    <a href="#" class="btn btn-outline-dark">START RETURN</a>
                </div>
            </div>
        </div>
    </div>

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