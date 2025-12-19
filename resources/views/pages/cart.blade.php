@extends('layouts.app')

@section('title', 'Shopping Cart - ENCODE')


@section('content')

    href="{{ asset('css/cart.css') }}">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active">Shopping Cart</li>
        </ol>
    </nav>

    <!-- Cart Section -->
    <section class="cart-section">
        <div class="container">
            <h2 class="mb-4">Your Shopping Cart</h2>
            
            @if(!Session::has('is_logged_in'))
                <div class="alert alert-info">
                    Please <a href="{{ url('/login') }}">login</a> to save your cart items.
                </div>
            @endif
            
            <div class="row">
                <!-- Cart Items -->
                <div class="col-lg-8">
                    <!-- Cart Item 1 -->
                    <div class="cart-item">
                        <img src="{{ asset('img/J3.jpg') }}" alt="The Ciper Blazer" class="cart-item-image">
                        
                        <div class="cart-item-details">
                            <h5 class="cart-item-title">The Ciper Blazer</h5>
                            <p class="cart-item-price">Rp 1,200</p>
                            <p>Size: M | Color: Black</p>
                        </div>
                        
                        <div class="quantity-control">
                            <button class="quantity-btn" onclick="updateQuantity('item1', -1)">-</button>
                            <input type="text" class="quantity-input" id="qty-item1" value="1" readonly>
                            <button class="quantity-btn" onclick="updateQuantity('item1', 1)">+</button>
                        </div>
                        
                        <button class="remove-btn" onclick="removeItem('item1')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                    
                    <!-- Cart Item 2 -->
                    <div class="cart-item">
                        <img src="{{ asset('img/S2.jpg') }}" alt="Binary T-Shirt" class="cart-item-image">
                        
                        <div class="cart-item-details">
                            <h5 class="cart-item-title">Binary T-Shirt</h5>
                            <p class="cart-item-price">Rp 99</p>
                            <p>Size: L | Color: White</p>
                        </div>
                        
                        <div class="quantity-control">
                            <button class="quantity-btn" onclick="updateQuantity('item2', -1)">-</button>
                            <input type="text" class="quantity-input" id="qty-item2" value="2" readonly>
                            <button class="quantity-btn" onclick="updateQuantity('item2', 1)">+</button>
                        </div>
                        
                        <button class="remove-btn" onclick="removeItem('item2')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                    
                    <!-- Cart Item 3 -->
                    <div class="cart-item">
                        <img src="{{ asset('img/TS2.jpg') }}" alt="Blueprint Shirt" class="cart-item-image">
                        
                        <div class="cart-item-details">
                            <h5 class="cart-item-title">Blueprint Shirt</h5>
                            <p class="cart-item-price">Rp 599</p>
                            <p>Size: S | Color: Blue</p>
                        </div>
                        
                        <div class="quantity-control">
                            <button class="quantity-btn" onclick="updateQuantity('item3', -1)">-</button>
                            <input type="text" class="quantity-input" id="qty-item3" value="1" readonly>
                            <button class="quantity-btn" onclick="updateQuantity('item3', 1)">+</button>
                        </div>
                        
                        <button class="remove-btn" onclick="removeItem('item3')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                    
                    <!-- Continue Shopping Button -->
                    <div class="mt-4">
                        <a href="{{ url('/products') }}" class="btn btn-outline-dark">
                            <i class="bi bi-arrow-left me-2"></i>Continue Shopping
                        </a>
                    </div>
                </div>
                
                <!-- Order Summary -->
                <div class="col-lg-4">
                    <div class="cart-summary">
                        <h5 class="mb-3">Order Summary</h5>
                        
                        <div class="summary-row">
                            <span>Subtotal (3 items)</span>
                            <span id="subtotal">Rp 1,898</span>
                        </div>
                        
                        <div class="summary-row">
                            <span>Shipping</span>
                            <span>FREE</span>
                        </div>
                        
                        <div class="summary-row">
                            <span>Tax</span>
                            <span>Rp 190</span>
                        </div>
                        
                        <div class="summary-row summary-total">
                            <span>Total</span>
                            <span id="total">Rp 2,088</span>
                        </div>
                        
                        <!-- Checkout Button -->
                        <button class="btn btn-dark w-100 mt-3" onclick="checkout()">
                            PROCEED TO CHECKOUT
                        </button>
                        
                        <!-- Payment Methods -->
                        <div class="mt-3 text-center">
                            <small class="text-muted">We accept:</small>
                            <div class="mt-2">
                                <i class="bi bi-credit-card me-2"></i>
                                <i class="bi bi-paypal me-2"></i>
                                <i class="bi bi-bank me-2"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    // Cart functions (manual, no database yet)
    function updateQuantity(itemId, change) {
        const input = document.getElementById('qty-' + itemId);
        let value = parseInt(input.value) + change;
        
        if (value < 1) value = 1;
        if (value > 10) value = 10;
        
        input.value = value;
        calculateTotal();
    }
    
    function removeItem(itemId) {
        if (confirm('Remove this item from cart?')) {
            const item = document.querySelector(`[onclick*="${itemId}"]`).closest('.cart-item');
            item.remove();
            calculateTotal();
        }
    }
    
    function calculateTotal() {
        // Manual calculation
        const subtotal = 1898; // Base price
        const tax = 190;
        const total = subtotal + tax;
        
        document.getElementById('subtotal').textContent = 'Rp ' + subtotal.toLocaleString();
        document.getElementById('total').textContent = 'Rp ' + total.toLocaleString();
    }
    
    function checkout() {
        if (!{{ Session::has('is_logged_in') ? 'true' : 'false' }}) {
            alert('Please login to proceed to checkout');
            window.location.href = "{{ url('/login') }}";
            return;
        }
        
        alert('Proceeding to checkout...');
        // window.location.href = "{{ url('/checkout') }}";
    }
    
    // Initial calculation
    calculateTotal();
</script>
@endsection