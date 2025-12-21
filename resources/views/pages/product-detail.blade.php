@extends('layouts.app')

@section('title', 'Product Detail - ENCODE')

@section('styles')
<style>
    .product-detail-section {
        padding: 3rem 0;
    }
    
    .product-image {
        width: 100%;
        border-radius: 10px;
        margin-bottom: 1rem;
    }
    
    .product-title {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 1rem;
    }
    
    .product-price {
        color: #d5001c;
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 1.5rem;
    }
    
    .product-description {
        margin-bottom: 2rem;
        line-height: 1.6;
    }
    
    .size-options {
        margin-bottom: 1.5rem;
    }
    
    .size-btn {
        width: 40px;
        height: 40px;
        margin-right: 10px;
        border: 1px solid #ddd;
        background: white;
        border-radius: 5px;
    }
    
    .size-btn.active {
        background-color: #000;
        color: white;
        border-color: #000;
    }
    
    .quantity-selector {
        display: flex;
        align-items: center;
        margin-bottom: 2rem;
    }
    
    .quantity-btn {
        width: 40px;
        height: 40px;
        border: 1px solid #ddd;
        background: white;
        font-size: 1.2rem;
    }
    
    .quantity-input {
        width: 60px;
        height: 40px;
        text-align: center;
        border: 1px solid #ddd;
        margin: 0 10px;
    }
    
    .btn-add-to-cart {
        padding: 12px 30px;
        font-size: 1.1rem;
        font-weight: bold;
    }
</style>
@endsection

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/products') }}">Products</a></li>
            <li class="breadcrumb-item active">Product Detail</li>
        </ol>
    </nav>

    <!-- Product Detail -->
    <section class="product-detail-section">
        <div class="container">
            <div class="row">
                <!-- Product Image -->
                <div class="col-md-6">
                    <img src="{{ asset('img/J3.jpg') }}" alt="The Ciper Blazer" class="product-image">
                </div>
                
                <!-- Product Info -->
                <div class="col-md-6">
                    <h1 class="product-title">The Ciper Blazer</h1>
                    <p class="product-price">Rp 1,200</p>
                    
                    <div class="product-description">
                        <p>Struktur yang berbicara. Kodekan profesionalisme dan karakter tajam Anda.</p>
                        <p>Bahan premium dengan jahitan rapi yang memberikan kesan elegan dan profesional. Cocok untuk berbagai acara formal dan semi-formal.</p>
                    </div>
                    
                    <!-- Size Options -->
                    <div class="size-options">
                        <h5>Size:</h5>
                        <button class="size-btn active">S</button>
                        <button class="size-btn">M</button>
                        <button class="size-btn">L</button>
                        <button class="size-btn">XL</button>
                    </div>
                    
                    <!-- Quantity Selector -->
                    <div class="quantity-selector">
                        <h5 class="me-3">Quantity:</h5>
                        <button class="quantity-btn" id="decrease-qty">-</button>
                        <input type="text" class="quantity-input" value="1" id="quantity">
                        <button class="quantity-btn" id="increase-qty">+</button>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="d-flex gap-3">
                        <button class="btn btn-dark btn-add-to-cart">
                            <i class="bi bi-cart-plus me-2"></i>ADD TO CART
                        </button>
                        <button class="btn btn-outline-dark btn-add-to-cart">
                            <i class="bi bi-heart me-2"></i>WISHLIST
                        </button>
                    </div>
                    
                    <!-- Product Details -->
                    <div class="mt-4">
                        <h5>Product Details:</h5>
                        <ul>
                            <li>Material: Premium Cotton</li>
                            <li>Color: Black</li>
                            <li>Fit: Regular Fit</li>
                            <li>Care: Machine Wash Cold</li>
                            <li>Made in Indonesia</li>
                        </ul>
                    </div>
                </div>

                
            </div>


        </div>
    </section>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Size selection
        const sizeButtons = document.querySelectorAll('.size-btn');
        sizeButtons.forEach(button => {
            button.addEventListener('click', function() {
                sizeButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
            });
        });
        
        // Quantity selector
        const quantityInput = document.getElementById('quantity');
        const decreaseBtn = document.getElementById('decrease-qty');
        const increaseBtn = document.getElementById('increase-qty');
        
        decreaseBtn.addEventListener('click', function() {
            let value = parseInt(quantityInput.value);
            if (value > 1) {
                quantityInput.value = value - 1;
            }
        });
        
        increaseBtn.addEventListener('click', function() {
            let value = parseInt(quantityInput.value);
            quantityInput.value = value + 1;
        });
        
        // Add to cart
        const addToCartBtn = document.querySelector('.btn-add-to-cart');
        addToCartBtn.addEventListener('click', function() {
            const size = document.querySelector('.size-btn.active').textContent;
            const quantity = quantityInput.value;
            
            alert(`Added to cart: The Ciper Blazer\nSize: ${size}\nQuantity: ${quantity}`);
            
            // Redirect to cart page
            // window.location.href = "{{ url('/cart') }}";
        });
    });
</script>
@endsection