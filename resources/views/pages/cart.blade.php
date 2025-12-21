@extends('layouts.app')

@section('title', 'Shopping Cart - ENCODE')

@section('content')
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">

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
        
        @if($cartItems->count() > 0)
        <div class="row">
            <!-- Cart Items -->
            <div class="col-lg-8">
                @foreach($cartItems as $item)
                <div class="cart-item" id="cart-item-{{ $item->id }}">
                    <img src="{{ asset('img/' . $item->product->image) }}" 
                         alt="{{ $item->product->name }}" 
                         class="cart-item-image">
                    
                    <div class="cart-item-details">
                        <h5 class="cart-item-title">{{ $item->product->name }}</h5>
                        <p class="cart-item-price">{{ $item->product->formatted_price }}</p>
                        <p>Category: {{ $item->product->category_label }}</p>
                    </div>
                    
                    <div class="quantity-control">
                        <button class="quantity-btn" 
                                onclick="updateQuantity({{ $item->id }}, -1)">-</button>
                        <input type="text" class="quantity-input" 
                               id="qty-{{ $item->id }}" 
                               value="{{ $item->quantity }}" readonly>
                        <button class="quantity-btn" 
                                onclick="updateQuantity({{ $item->id }}, 1)">+</button>
                    </div>
                    
                    <div class="item-subtotal">
                        {{ $item->formatted_subtotal }}
                    </div>
                    
                    <button class="remove-btn" onclick="removeItem({{ $item->id }})">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
                @endforeach
                
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
                        <span>Subtotal ({{ $totalItems }} items)</span>
                        <span id="subtotal">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    
                    <div class="summary-row">
                        <span>Shipping</span>
                        <span>FREE</span>
                    </div>
                    
                    <div class="summary-row">
                        <span>Tax (10%)</span>
                        <span id="tax">Rp {{ number_format($total * 0.1, 0, ',', '.') }}</span>
                    </div>
                    
                    <div class="summary-row summary-total">
                        <span>Total</span>
                        <span id="total">Rp {{ number_format($total * 1.1, 0, ',', '.') }}</span>
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
        @else
        <div class="empty-cart text-center py-5">
            <i class="bi bi-cart-x display-1 text-muted"></i>
            <h4 class="mt-3">Your cart is empty</h4>
            <p class="text-muted">Add some products to your cart</p>
            <a href="{{ url('/products') }}" class="btn btn-dark mt-3">
                <i class="bi bi-bag me-2"></i>Start Shopping
            </a>
        </div>
        @endif
    </div>
</section>
@endsection

@section('scripts')
<script>
// Update quantity via AJAX
function updateQuantity(itemId, change) {
    const input = document.getElementById('qty-' + itemId);
    let newQty = parseInt(input.value) + change;
    
    if (newQty < 1) newQty = 1;
    
    fetch(`/cart/update/${itemId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ quantity: newQty })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            input.value = newQty;
            location.reload(); // Simple reload untuk update total
        }
    });
}

// Remove item via AJAX
function removeItem(itemId) {
    if (confirm('Remove this item from cart?')) {
        fetch(`/cart/remove/${itemId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('cart-item-' + itemId).remove();
                location.reload(); // Reload untuk update total
            }
        });
    }
}

function checkout() {
    alert('Checkout feature coming soon!');
    // window.location.href = "/checkout";
}

// Pastikan ada toast function
function showToast(message, type = 'success') {
    // Sama seperti di auth.js
}
</script>
@endsection