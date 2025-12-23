@extends('layouts.app')

@section('title', 'Shopping Cart - ENCODE')

@section('content')
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">

<nav aria-label="breadcrumb" class="container">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item active">Shopping Cart</li>
    </ol>
</nav>

<section class="container py-4">
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
            <div class="card mb-3" id="cart-item-{{ $item->id }}">
                <div class="row g-0">
                    <div class="col-md-3">
                        <img src="{{ asset('img/' . $item->product->image) }}" 
                             class="img-fluid rounded-start" 
                             alt="{{ $item->product->name }}">
                    </div>
                    <div class="col-md-5">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->product->name }}</h5>
                            <p class="card-text text-success">{{ $item->product->formatted_price }}</p>
                            <p class="card-text">
                                <small class="text-muted">{{ $item->product->category_label }}</small>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-body">
                            <!-- Quantity Control -->
                            <div class="d-flex align-items-center mb-3">
                                <button class="btn btn-outline-secondary btn-sm" 
                                        onclick="updateQuantity({{ $item->id }}, -1)">-</button>
                                <input type="text" class="form-control form-control-sm text-center mx-2 quantity-input" 
                                       id="qty-{{ $item->id }}" 
                                       value="{{ $item->quantity }}" 
                                       style="width: 60px;" readonly>
                                <button class="btn btn-outline-secondary btn-sm" 
                                        onclick="updateQuantity({{ $item->id }}, 1)">+</button>
                            </div>
                            
                            <!-- Subtotal -->
                            <p class="fw-bold mb-2">
                                Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                            </p>
                            
                            <!-- Remove Button -->
                            <button class="btn btn-outline-danger btn-sm w-100" 
                                    onclick="removeItem({{ $item->id }})">
                                <i class="bi bi-trash"></i> Remove
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            
            <!-- Continue Shopping -->
            <div class="mt-4">
                <a href="{{ url('/products') }}" class="btn btn-outline-dark">
                    <i class="bi bi-arrow-left me-2"></i>Continue Shopping
                </a>
            </div>
        </div>
        
        <!-- Order Summary -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Order Summary</h5>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal ({{ $totalItems }} items)</span>
                        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span>Shipping</span>
                        <span class="text-success">FREE</span>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tax (10%)</span>
                        <span>Rp {{ number_format($total * 0.1, 0, ',', '.') }}</span>
                    </div>
                    
                    <hr>
                    
                    <div class="d-flex justify-content-between mb-3">
                        <strong>Total</strong>
                        <strong class="text-primary h5">
                            Rp {{ number_format($total * 1.1, 0, ',', '.') }}
                        </strong>
                    </div>
                    
                    <!-- Checkout Button -->
                    <button class="btn btn-dark w-100 mb-3" onclick="checkout()">
                        PROCEED TO CHECKOUT
                    </button>
                    
                    <!-- Payment Methods -->
                    <div class="text-center">
                        <small class="text-muted">We accept:</small>
                        <div class="mt-2">
                            <i class="bi bi-credit-card me-2 fs-5"></i>
                            <i class="bi bi-paypal me-2 fs-5"></i>
                            <i class="bi bi-bank me-2 fs-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <!-- Empty Cart -->
    <div class="text-center py-5">
        <i class="bi bi-cart-x display-1 text-muted"></i>
        <h4 class="mt-3">Your cart is empty</h4>
        <p class="text-muted">Add some products to your cart</p>
        <a href="{{ url('/products') }}" class="btn btn-dark mt-3">
            <i class="bi bi-bag me-2"></i>Start Shopping
        </a>
    </div>
    @endif
</section>
@endsection

@section('scripts')
<script>
// Update quantity via AJAX (DARI KODE LAMAMU)
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
        } else {
            alert('Failed to update quantity');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error updating quantity');
    });
}

// Remove item via AJAX (DARI KODE LAMAMU)
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
            } else {
                alert('Failed to remove item');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error removing item');
        });
    }
}

function checkout() {
  window.location.href = "/checkout";
}


</script>
@endsection