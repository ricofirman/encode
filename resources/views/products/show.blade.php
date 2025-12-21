@extends('layouts.app')

@section('title', $product->name . ' - ENCODE')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
    
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products') }}">Products</a></li>
            <li class="breadcrumb-item active">{{ $product->name }}</li>
        </ol>
    </nav>

    <!-- Product Detail -->
    <section class="container py-4">
        <div class="row">
            <!-- Product Image -->
            <div class="col-md-6">
                <img src="{{ asset('img/' . $product->image) }}" 
                     alt="{{ $product->name }}" 
                     class="img-fluid rounded">
            </div>
            
            <!-- Product Info -->
            <div class="col-md-6">
                <h1>{{ $product->name }}</h1>
                <p class="text-muted">{{ $product->category_label }}</p>
                
                <h3 class="text-primary">{{ $product->formatted_price }}</h3>
                
                <p class="mt-4">{{ $product->description }}</p>
                
                <!-- Stock Info -->
                @if($product->stock > 0)
                    <p class="text-success">✅ In Stock ({{ $product->stock }} available)</p>
                @else
                    <p class="text-danger">❌ Out of Stock</p>
                @endif
                
                <!-- Add to Cart -->
                <div class="mt-4">
                    <button class="btn btn-dark btn-lg add-to-cart" 
                            data-product-id="{{ $product->id }}"
                            {{ $product->stock == 0 ? 'disabled' : '' }}>
                        <i class="bi bi-cart-plus"></i> ADD TO CART
                    </button>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle add to cart button di detail page
        const addToCartBtn = document.querySelector('.add-to-cart');
        if (addToCartBtn) {
            addToCartBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const productId = this.getAttribute('data-product-id');
                addToCart(productId);
            });
        }
    });
    
    // Function untuk show toast (sama dengan di index)
    function showToast(message, type = 'success') {
        let toastContainer = document.querySelector('.toast-container');
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
            document.body.appendChild(toastContainer);
        }
        
        const toastId = 'toast-' + Date.now();
        const toastHtml = `
            <div id="${toastId}" class="toast align-items-center ${type === 'success' ? 'bg-success text-white' : 'bg-danger text-white'}" role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        ${type === 'success' ? '✅' : '⚠️'} ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
        `;
        
        toastContainer.insertAdjacentHTML('beforeend', toastHtml);
        
        const toastElement = document.getElementById(toastId);
        const toast = new bootstrap.Toast(toastElement, { delay: 3000 });
        toast.show();
        
        toastElement.addEventListener('hidden.bs.toast', function () {
            this.remove();
        });
    }
    
    // Function addToCart dengan toast notification
    function addToCart(productId) {
        fetch('/cart/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ product_id: productId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.redirect) {
                // Belum login, redirect ke login dengan toast
                showToast('Please login to add to cart', 'error');
                setTimeout(() => {
                    window.location.href = data.redirect;
                }, 1500);
            } else if (data.success) {
                // Show success toast
                showToast(data.message, 'success');
                
                // Update cart badge di navbar
                updateCartBadge(data.count);
                
                // Disable button atau ganti text jika mau
                const btn = document.querySelector('.add-to-cart');
                if (btn) {
                    btn.innerHTML = '<i class="bi bi-check-circle"></i> ADDED TO CART';
                    btn.classList.remove('btn-dark');
                    btn.classList.add('btn-success');
                    btn.disabled = true;
                    
                    // Reset setelah 3 detik
                    setTimeout(() => {
                        btn.innerHTML = '<i class="bi bi-cart-plus"></i> ADD TO CART';
                        btn.classList.remove('btn-success');
                        btn.classList.add('btn-dark');
                        btn.disabled = false;
                    }, 3000);
                }
            } else {
                showToast(data.message || 'Failed to add to cart', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Error adding to cart', 'error');
        });
    }
    
    // Update cart badge di navbar
    function updateCartBadge(count) {
        let badge = document.querySelector('.cart-badge, .nav-link[href*="cart"] .badge');
        const cartLink = document.querySelector('.nav-link[href*="cart"]');
        
        if (count > 0) {
            if (badge) {
                badge.textContent = count;
            } else if (cartLink) {
                // Create badge jika belum ada
                badge = document.createElement('span');
                badge.className = 'badge bg-danger cart-badge';
                badge.textContent = count;
                cartLink.appendChild(badge);
            }
        } else if (badge) {
            badge.remove();
        }
    }
</script>
@endsection