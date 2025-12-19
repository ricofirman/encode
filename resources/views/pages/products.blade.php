@extends('layouts.app')

@section('title', 'Products - ENCODE')

@section('styles')
<style>
    .category-filter {
        margin-bottom: 2rem;
        text-align: center;
    }
    
    .category-btn {
        margin: 0 5px;
        padding: 8px 20px;
        border-radius: 20px;
        transition: all 0.3s;
        border: 1px solid #ddd;
        background: white;
    }
    
    .category-btn:hover,
    .category-btn.active {
        background-color: #000;
        color: white;
        border-color: #000;
    }
    
    .product-card {
        border: 1px solid #eee;
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s;
        margin-bottom: 1.5rem;
        background: white;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    .product-card img {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }
    
    .card-body {
        padding: 1rem;
    }
    
    .product-title {
        font-weight: bold;
        margin-bottom: 0.5rem;
        font-size: 1rem;
    }
    
    .product-price {
        color: #d5001c;
        font-weight: bold;
        font-size: 1.1rem;
        margin-bottom: 1rem;
    }
    
    .breadcrumb {
        background: transparent;
        padding: 1rem 0;
    }
</style>
@endsection

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active">Products</li>
        </ol>
    </nav>

    <!-- Product Categories Filter -->
    <section class="container py-4">
        <div class="category-filter">
            <button class="category-btn active" data-category="all">All Products</button>
            <button class="category-btn" data-category="t-shirt">T-Shirt</button>
            <button class="category-btn" data-category="shirt">Shirt</button>
            <button class="category-btn" data-category="jacket">Jacket/Sweater</button>
        </div>
        
        <div class="row" id="products-container">
            <!-- ====== T-SHIRT PRODUCTS ====== -->
            <div class="col-md-4 col-lg-3 product-item" data-category="t-shirt">
                <div class="product-card">
                    <a href="{{ url('/product/1') }}">
                        <img src="{{ asset('img/S1.jpg') }}" alt="Binary T-Shirt">
                        <div class="card-body">
                            <h5 class="product-title">Binary T-Shirt</h5>
                            <p class="product-price">Rp 99</p>
                            <button class="btn btn-dark w-100">ADD TO CART</button>
                        </div>
                    </a>
                </div>
            </div>
            
            <div class="col-md-4 col-lg-3 product-item" data-category="t-shirt">
                <div class="product-card">
                    <a href="{{ url('/product/2') }}">
                        <img src="{{ asset('img/e1.jpg') }}" alt="Streetwear T-Shirt">
                        <div class="card-body">
                            <h5 class="product-title">Streetwear T-Shirt</h5>
                            <p class="product-price">Rp 129</p>
                            <button class="btn btn-dark w-100">ADD TO CART</button>
                        </div>
                    </a>
                </div>
            </div>
            
            <!-- ====== SHIRT PRODUCTS ====== -->
            <div class="col-md-4 col-lg-3 product-item" data-category="shirt">
                <div class="product-card">
                    <a href="{{ url('/product/3') }}">
                        <img src="{{ asset('img/TS1.jpg') }}" alt="Formal Shirt">
                        <div class="card-body">
                            <h5 class="product-title">Formal Shirt</h5>
                            <p class="product-price">Rp 299</p>
                            <button class="btn btn-dark w-100">ADD TO CART</button>
                        </div>
                    </a>
                </div>
            </div>
            
            <div class="col-md-4 col-lg-3 product-item" data-category="shirt">
                <div class="product-card">
                    <a href="{{ url('/product/4') }}">
                        <img src="{{ asset('img/TS2.jpg') }}" alt="Casual Shirt">
                        <div class="card-body">
                            <h5 class="product-title">Casual Shirt</h5>
                            <p class="product-price">Rp 249</p>
                            <button class="btn btn-dark w-100">ADD TO CART</button>
                        </div>
                    </a>
                </div>
            </div>
            
            <!-- ====== JACKET PRODUCTS ====== -->
            <div class="col-md-4 col-lg-3 product-item" data-category="jacket">
                <div class="product-card">
                    <a href="{{ url('/product/5') }}">
                        <img src="{{ asset('img/J1.jpg') }}" alt="Winter Jacket">
                        <div class="card-body">
                            <h5 class="product-title">Winter Jacket</h5>
                            <p class="product-price">Rp 499</p>
                            <button class="btn btn-dark w-100">ADD TO CART</button>
                        </div>
                    </a>
                </div>
            </div>
            
            <div class="col-md-4 col-lg-3 product-item" data-category="jacket">
                <div class="product-card">
                    <a href="{{ url('/product/6') }}">
                        <img src="{{ asset('img/J2.jpg') }}" alt="Light Jacket">
                        <div class="card-body">
                            <h5 class="product-title">Light Jacket</h5>
                            <p class="product-price">Rp 399</p>
                            <button class="btn btn-dark w-100">ADD TO CART</button>
                        </div>
                    </a>
                </div>
            </div>
            
            <div class="col-md-4 col-lg-3 product-item" data-category="jacket">
                <div class="product-card">
                    <a href="{{ url('/product/7') }}">
                        <img src="{{ asset('img/J3.jpg') }}" alt="Blazer">
                        <div class="card-body">
                            <h5 class="product-title">The Ciper Blazer</h5>
                            <p class="product-price">Rp 1,200</p>
                            <button class="btn btn-dark w-100">ADD TO CART</button>
                        </div>
                    </a>
                </div>
            </div>
            
            <!-- Tambah lebih banyak produk sesuai kebutuhan -->
            <div class="col-md-4 col-lg-3 product-item" data-category="t-shirt">
                <div class="product-card">
                    <a href="{{ url('/product/8') }}">
                        <img src="{{ asset('img/e2.jpg') }}" alt="Black T-Shirt">
                        <div class="card-body">
                            <h5 class="product-title">Black T-Shirt</h5>
                            <p class="product-price">Rp 89</p>
                            <button class="btn btn-dark w-100">ADD TO CART</button>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Filter products by category
        const categoryButtons = document.querySelectorAll('.category-btn');
        const productItems = document.querySelectorAll('.product-item');
        
        categoryButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                categoryButtons.forEach(btn => {
                    btn.classList.remove('active');
                });
                
                // Add active class to clicked button
                this.classList.add('active');
                
                const category = this.getAttribute('data-category');
                
                // Show/hide products based on category
                productItems.forEach(item => {
                    if (category === 'all' || item.getAttribute('data-category') === category) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    });
</script>
@endsection