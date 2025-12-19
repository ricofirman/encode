@extends('layouts.app')

@section('title', 'Shopping Cart - ENCODE')

@section('styles')
    
    <link rel="stylesheet" href="{{ asset('css/help.css') }}">
    <!-- Main Content -->
    <div class="container">
        <!-- Search Box -->
        <div class="search-box">
            <h3>Search for Answers</h3>
            <input type="text" placeholder="What can we help you with?">
            <button>SEARCH</button>
        </div>
        
        <!-- Help Categories -->
        <div class="row">
            <div class="col-lg-6">
                <div class="help-category">
                    <h3>Order & Shipping</h3>
                    <div class="help-item">
                        <i class="fas fa-shopping-cart"></i>
                        <div class="help-content">
                            <h5>How do I track my order?</h5>
                            <p>Find out how to track your order status and estimated delivery date</p>
                        </div>
                        <i class="fas fa-chevron-right help-arrow"></i>
                    </div>
                    <div class="help-item">
                        <i class="fas fa-truck"></i>
                        <div class="help-content">
                            <h5>What are your shipping options?</h5>
                            <p>Learn about our shipping methods, costs, and delivery times</p>
                        </div>
                        <i class="fas fa-chevron-right help-arrow"></i>
                    </div>
                    <div class="help-item">
                        <i class="fas fa-undo"></i>
                        <div class="help-content">
                            <h5>How do I return an item?</h5>
                            <p>Step-by-step guide for returning items for a refund or exchange</p>
                        </div>
                        <i class="fas fa-chevron-right help-arrow"></i>
                    </div>
                    <div class="help-item">
                        <i class="fas fa-question-circle"></i>
                        <div class="help-content">
                            <h5>My order hasn't arrived yet</h5>
                            <p>What to do if your order is delayed or missing</p>
                        </div>
                        <i class="fas fa-chevron-right help-arrow"></i>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="help-category">
                    <h3>Account & Payments</h3>
                    <div class="help-item">
                        <i class="fas fa-user"></i>
                        <div class="help-content">
                            <h5>How do I create an account?</h5>
                            <p>Simple steps to create your Encode account</p>
                        </div>
                        <i class="fas fa-chevron-right help-arrow"></i>
                    </div>
                    <div class="help-item">
                        <i class="fas fa-lock"></i>
                        <div class="help-content">
                            <h5>I forgot my password</h5>
                            <p>Reset your password and regain access to your account</p>
                        </div>
                        <i class="fas fa-chevron-right help-arrow"></i>
                    </div>
                    <div class="help-item">
                        <i class="fas fa-credit-card"></i>
                        <div class="help-content">
                            <h5>Payment issues</h5>
                            <p>Common payment problems and solutions</p>
                        </div>
                        <i class="fas fa-chevron-right help-arrow"></i>
                    </div>
                    <div class="help-item">
                        <i class="fas fa-wallet"></i>
                        <div class="help-content">
                            <h5>Gift cards & promotions</h5>
                            <p>How to use gift cards and apply promotional codes</p>
                        </div>
                        <i class="fas fa-chevron-right help-arrow"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-6">
                <div class="help-category">
                    <h3>Products & Sizes</h3>
                    <div class="help-item">
                        <i class="fas fa-tshirt"></i>
                        <div class="help-content">
                            <h5>How do I find my size?</h5>
                            <p>Use our size guide to find the perfect fit</p>
                        </div>
                        <i class="fas fa-chevron-right help-arrow"></i>
                    </div>
                    <div class="help-item">
                        <i class="fas fa-info-circle"></i>
                        <div class="help-content">
                            <h5>Product information</h5>
                            <p>Details about materials, care instructions, and features</p>
                        </div>
                        <i class="fas fa-chevron-right help-arrow"></i>
                    </div>
                    <div class="help-item">
                        <i class="fas fa-exchange-alt"></i>
                        <div class="help-content">
                            <h5>Can I exchange an item?</h5>
                            <p>Information about exchanges and how to request one</p>
                        </div>
                        <i class="fas fa-chevron-right help-arrow"></i>
                    </div>
                    <div class="help-item">
                        <i class="fas fa-shoe-prints"></i>
                        <div class="help-content">
                            <h5>Shoe sizing guide</h5>
                            <p>How to measure your feet and find the right shoe size</p>
                        </div>
                        <i class="fas fa-chevron-right help-arrow"></i>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="help-category">
                    <h3>Technical Support</h3>
                    <div class="help-item">
                        <i class="fas fa-laptop"></i>
                        <div class="help-content">
                            <h5>Website issues</h5>
                            <p>Troubleshooting tips for common website problems</p>
                        </div>
                        <i class="fas fa-chevron-right help-arrow"></i>
                    </div>
                    <div class="help-item">
                        <i class="fas fa-mobile-alt"></i>
                        <div class="help-content">
                            <h5>Mobile app help</h5>
                            <p>Guidance for using the ENCODE mobile application</p>
                        </div>
                        <i class="fas fa-chevron-right help-arrow"></i>
                    </div>
                    <div class="help-item">
                        <i class="fas fa-headset"></i>
                        <div class="help-content">
                            <h5>Contact customer service</h5>
                            <p>Various ways to reach our customer support team</p>
                        </div>
                        <i class="fas fa-chevron-right help-arrow"></i>
                    </div>
                    <div class="help-item">
                        <i class="fas fa-comments"></i>
                        <div class="help-content">
                            <h5>Live chat support</h5>
                            <p>Connect with a representative in real-time for immediate assistance</p>
                        </div>
                        <i class="fas fa-chevron-right help-arrow"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Contact Support -->
        <div class="row mt-4">
            <div class="col">
                <div class="help-category">
                    <h3>Still Need Help?</h3>
                    <p>If you can't find what you're looking for in our help center, our customer service team is ready to assist you.</p>
                    <div class="d-flex gap-3">
                        <a href="{{ route('contact') }}" class="btn btn-adidas">CONTACT US</a>
                        <a href="#" class="btn btn-outline-dark">LIVE CHAT</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection