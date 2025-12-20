@extends('layouts.app')

@section('title', 'ENCODE Dashboard')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="brand-background">
            <img src="{{ asset('img/BDB.png') }}" alt="">
        </div>
    </section>
    
    <!-- Categories Section -->
    <section class="category-section">
        <div class="container">
            <h2 class="section-title">WHAT'S HOT</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="category-card">
                        <img src="{{ asset('img/display/e1.jpg') }}" alt="T-shirt Encode">
                        <div class="card-body">
                            <h5>Streetwear E</h5>
                            <p>Struktur yang berbicara. Kodekan karakter yang sangat tajam.</p>
                            <a href="{{ url('/products') }}" class="btn btn-encode">SHOP NOW</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="category-card">
                        <img src="{{ asset('img/display/e2.jpg') }}" alt="T-shirt Encode">
                        <div class="card-body">
                            <h5>Black Shirt ENCODE</h5>
                            <p>Encode gaya adaptif untuk eksplorasi kota tanpa batas.</p>
                            <a href="{{ url('/products') }}" class="btn btn-encode">SHOP NOW</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="category-card">
                        <img src="{{ asset('img/display/e3.jpg') }}" alt="T-shirt Encode">
                        <div class="card-body">
                            <h5>Casual-Shirt</h5>
                            <p>Struktur yang mendefinisikan kekuatan feminin yang elegan</p>
                            <a href="{{ url('/products') }}" class="btn btn-encode">SHOP NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gender Categories -->
    <section class="category-section" style="background-color: white;">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="category-card">
                        <img src="{{ asset('img/display/TS1.jpg') }}" alt="Shirt Collection">
                        <div class="card-body text-center">
                            <h5>Shirt</h5>
                            <a href="{{ url('/products') }}" class="btn btn-encode">SHOP NOW</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="category-card">
                        <img src="{{ asset('img/display/S1.jpg') }}" alt="T-Shirt Collection">
                        <div class="card-body text-center">
                            <h5>T-Shirt</h5>
                            <a href="{{ url('/products') }}" class="btn btn-encode">SHOP NOW</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="category-card">
                        <img src="{{ asset('img/display/J1.jpg') }}" alt="Jacket Collection">
                        <div class="card-body text-center">
                            <h5>Jacket</h5>
                            <a href="{{ url('/products') }}" class="btn btn-encode">SHOP NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Grid -->
    <section class="category-section">
        <div class="container">
            <h2 class="section-title">FEATURED PRODUCTS</h2>
            <div class="product-grid">
                <div class="product-card">
                    <a id="link" href="{{ url('/products') }}">
                        <img src="{{ asset('img/j13.png') }}" alt="">
                        <div class="card-body">
                            <h5 class="product-title">Tunder black jacket</h5>
                            <p class="product-price">Rp 699.000</p>
                        </div>
                    </a>
                </div>
                <div class="product-card">
                    <a id="link" href="{{ url('/products') }}">
                        <img src="{{ asset('img/j2.png') }}" alt="">
                        <div class="card-body">
                            <h5 class="product-title">Black light jacket</h5>
                            <p class="product-price">Rp 399.000</p>
                        </div>
                    </a>
                </div>
                <div class="product-card">
                    <a id="link" href="{{ url('/products') }}">
                        <img src="{{ asset('img/s12.png') }}" alt="">
                        <div class="card-body">
                            <h5 class="product-title">Casual vibe shirt</h5>
                            <p class="product-price">Rp 179.000</p>
                        </div>
                    </a>
                </div>
                <div class="product-card">
                    <a id="link" href="{{ url('/products') }}">
                        <img src="{{ asset('img/j4.png') }}" alt="">
                        <div class="card-body">
                            <h5  class="product-title">Colorful sweater</h5>
                            <p style="link" class="product-price">Rp 799.000</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="category-section" style="background-color: white;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3>WEAR YOUR CODE</h3>
                    <p>Welcome to the official online destination of ENCODE Surabaya...</p>
                </div>
                <div class="col-md-6">
                    <h3>ENCODE: THE FOUNDATION OF YOUR STYLE LANGUAGE</h3>
                    <p>Searching for clothing that resonates with your core identity...</p>
                </div>
            </div>
        </div>
    </section>
@endsection