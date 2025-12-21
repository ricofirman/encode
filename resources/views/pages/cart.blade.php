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
                        <button class="btn btn-dark w-100 mt-3" onclick="showPayment()">
                        PROCEED TO CHECKOUT
                        </button>

                        <!-- Payment Section -->
                        <div id="paymentSection" class="mt-4" style="display:none;">
                        <h4 class="mb-3">Payment Method</h4>

                        <div class="payment-option">
                            <input type="radio" name="payment_method" id="bank" value="bank">
                            <label for="bank">Transfer Bank</label>
                        </div>

                        <div class="payment-option">
                            <input type="radio" name="payment_method" id="ewallet" value="ewallet">
                            <label for="ewallet">E-Wallet (OVO, DANA, GoPay)</label>
                        </div>

                        <div class="payment-option">
                            <input type="radio" name="payment_method" id="cod" value="cod">
                            <label for="cod">Cash on Delivery (COD)</label>
                        </div>


                        <button class="btn btn-success w-100 mt-3" onclick="placeOrder()">
                            PLACE ORDER
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
    
    function calculateTotal() {
        // Manual calculation
        const subtotal = 1898; // Base price
        const tax = 190;
        const total = subtotal + tax;
        
        document.getElementById('subtotal').textContent = 'Rp ' + subtotal.toLocaleString();
        document.getElementById('total').textContent = 'Rp ' + total.toLocaleString();
    }
    


    function showPayment() 
    {
        document.getElementById('paymentSection').style.display = 'block';
        document.getElementById('paymentSection').scrollIntoView({ behavior: 'smooth' });
        }


        // Midtrans need JANGAN DIPINDAH
        function placeOrder() {
        const method = document.querySelector('input[name="payment_method"]:checked');

        if (!method) {
            alert('Please select a payment method');
            return;
        }

        alert('Order placed with payment method: ' + method.value);

        function getCartItems() {
            // sesuaikan key localStorage kamu (paling sering: cartItems / cart)
            const raw = localStorage.getItem('cartItems') || localStorage.getItem('cart');
            if (!raw) return [];
            try { return JSON.parse(raw); } catch(e) { return []; }
        }

        function normalizeItems(rawItems) {
            return rawItems.map((it, idx) => ({
            id: it.id ?? idx + 1,
            name: it.name ?? it.title ?? 'Item',
            price: Math.round(Number(it.price ?? 0)),
            quantity: Math.round(Number(it.qty ?? it.quantity ?? 1)),
            })).filter(it => it.price > 0 && it.quantity > 0);
        }

        async function placeOrder() {
            const methodEl = document.querySelector('input[name="payment_method"]:checked');
            if (!methodEl) return alert('Pilih metode pembayaran dulu ya');

            const payment_method = methodEl.value;

            const items = normalizeItems(getCartItems());
            if (!items.length) return alert('Cart kosong / key localStorage cart belum sesuai');

            const gross_amount = items.reduce((sum, it) => sum + (it.price * it.quantity), 0);

            const res = await fetch("{{ route('checkout.token') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
            },
            body: JSON.stringify({ payment_method, gross_amount, items }),
            });

            if (!res.ok) {
            console.log(await res.text());
            return alert('Gagal bikin order/token');
            }

            const data = await res.json();

            // COD selesai
            if (payment_method === 'cod') {
            alert('Order COD dibuat: ' + data.order_number);
            return;
            }

            // Midtrans popup
            window.snap.pay(data.snap_token, {
            onSuccess: () => alert('Sukses bayar (sandbox) - ' + data.order_number),
            onPending: () => alert('Pending - ' + data.order_number),
            onError: () => alert('Gagal - ' + data.order_number),
            onClose: () => console.log('popup ditutup')
            });
        }
        

        
    }


    
    // Initial calculation
    calculateTotal();
</script>


<!-- // Dependednsi midtrasn sandbok -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}">
</script>

@endsection