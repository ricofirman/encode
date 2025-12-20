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