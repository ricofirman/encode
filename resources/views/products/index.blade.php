@extends('layouts.app')

@section('title', 'Products - ENCODE')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
    
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
            <button class="category-btn {{ $activeCategory == 'all' ? 'active' : '' }}" 
                    data-category="all">All Products</button>
            <button class="category-btn {{ $activeCategory == 't-shirt' ? 'active' : '' }}" 
                    data-category="t-shirt">T-Shirt</button>
            <button class="category-btn {{ $activeCategory == 'shirt' ? 'active' : '' }}" 
                    data-category="shirt">Shirt</button>
            <button class="category-btn {{ $activeCategory == 'jacket' ? 'active' : '' }}" 
                    data-category="jacket">Jacket/Sweater</button>
        </div>
        
        <div class="row" id="products-container">
            @forelse($products as $product)
                <div class=" col-md-4 col-lg-3 product-item" data-category="{{ $product->category }}">
                    <div class="product-card">
                        <a id="link" href="/product/{{ $product->slug }}">
                            <!-- Gunakan image_url dari Model -->
                            <img src="{{ asset('img/' . $product->image) }}" alt="{{ $product->name }}">
                            <div class="card-body">
                                <h5 class="product-title">{{ $product->name }}</h5>
                                <p class="product-price">{{ $product->formatted_price }}</p>
                                <button class="btn btn-dark w-100 add-to-cart" 
                                        data-product-id="{{ $product->id }}">
                                    ADD TO CART
                                </button>
                            </div>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        No products found.
                    </div>
                </div>
            @endforelse
        </div>
    </section>
@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Filter products by category dengan AJAX
        const categoryButtons = document.querySelectorAll('.category-btn');
        
        categoryButtons.forEach(button => {
            button.addEventListener('click', function() {
                const category = this.getAttribute('data-category');
                
                // Update URL tanpa reload page
                const url = new URL(window.location.href);
                url.searchParams.set('category', category);
                window.history.pushState({}, '', url);
                
                // Remove active class from all buttons
                categoryButtons.forEach(btn => {
                    btn.classList.remove('active');
                });
                
                // Add active class to clicked button
                this.classList.add('active');
                
                // Kirim request AJAX untuk filter
                fetch(`/products?category=${category}`)
                    .then(response => response.text())
                    .then(html => {
                        // Parse HTML response
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const newProducts = doc.querySelector('#products-container').innerHTML;
                        
                        // Update products container
                        document.querySelector('#products-container').innerHTML = newProducts;
                        
                        // Re-attach event listeners untuk tombol add to cart yang baru
                        attachCartListeners();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // Jika AJAX gagal, reload page
                        window.location.href = `/products?category=${category}`;
                    });
            });
        });
        
        // Attach event listeners untuk tombol add to cart
        function attachCartListeners() {
            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const productId = this.getAttribute('data-product-id');
                    addToCart(productId);
                });
            });
        }
        
        // Initial attachment
        attachCartListeners();
    });
    
    // Function untuk show toast (sama dengan di auth.js)
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
    // Simple version - langsung update badge yang ada
    function updateCartBadge(count) {
        // Cari semua badge di cart link
        const cartLinks = document.querySelectorAll('a[href*="cart"]');
        
        cartLinks.forEach(cartLink => {
            let badge = cartLink.querySelector('.badge');
            
            if (count > 0) {
                if (badge) {
                    badge.textContent = count;
                } else {
                    // Create badge
                    const newBadge = document.createElement('span');
                    newBadge.className = 'badge bg-danger';
                    newBadge.textContent = count;
                    cartLink.appendChild(newBadge);
                }
            } else if (badge) {
                badge.remove();
            }
        });
    }
</script>
@endsection