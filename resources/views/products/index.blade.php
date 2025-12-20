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
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // Jika AJAX gagal, reload page
                        window.location.href = `/products?category=${category}`;
                    });
            });
        });
        
        // Handle add to cart button (akan kita buat nanti)
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('add-to-cart')) {
                e.preventDefault();
                const productId = e.target.getAttribute('data-product-id');
                addToCart(productId);
            }
        });
        
        function addToCart(productId) {
            // Kirim AJAX request untuk add to cart
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
                if (data.success) {
                    alert('Product added to cart!');
                } else {
                    alert('Failed to add product to cart');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error adding to cart');
            });
        }
    });
</script>
@endsection