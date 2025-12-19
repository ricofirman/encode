@extends('layouts.app')

@section('title', 'Contact - ENCODE')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
        </ol>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <!-- Contact Information -->
            <div class="col-lg-6">
                <div class="contact-info">
                    <h3>Get In Touch</h3>
                    <div class="contact-method">
                        <i class="fas fa-phone"></i>
                        <div>
                            <strong>Customer Service</strong><br>
                            +62 821 3954 4310<br>
                            Monday-Friday: 9AM-6PM WIB
                        </div>
                    </div>
                    <div class="contact-method">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <strong>Email Support</strong><br>
                            24051204204@MHS.UNESA.AC.ID<br>
                            We respond within 25 hours
                        </div>
                    </div>
                    <div class="contact-method">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <strong>Our Office</strong><br>
                            Jl. Ketintang No. A10<br>
                            Surabaya Barat, Indonesia
                        </div>
                    </div>
                    <div class="contact-method">
                        <i class="fas fa-clock"></i>
                        <div>
                            <strong>Store Hours</strong><br>
                            Monday-Saturday: 10AM-9PM<br>
                            Sunday: 10AM-8PM
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Contact Form -->
            <div class="col-lg-6">
                <div class="contact-form">
                    <h3>Send Us a Message</h3>
                    <form>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Your Name" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Your Email" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Subject">
                        </div>
                        <div class="mb-3">
                            <select class="form-select" required>
                                <option selected disabled>Select Topic</option>
                                <option>Product Inquiry</option>
                                <option>Order Status</option>
                                <option>Return/Exchange</option>
                                <option>Website Issue</option>
                                <option>Other</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" rows="5" placeholder="Your Message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-adidas">SEND MESSAGE</button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- FAQ Section -->
        <div class="row mt-4">
            <div class="col">
                <div class="contact-info">
                    <h3>Frequently Asked Questions</h3>
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                    How long does shipping take?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Standard shipping takes 3-5 business days within Indonesia. Express shipping is available for 1-2 business days.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                    What is your return policy?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    You can return items within 30 days of purchase for a full refund. Items must be unworn, unwashed, and in original packaging.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                    How can I track my order?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    You can track your order using the tracking number sent to your email after your order has shipped. Visit our Order Tracking page for more information.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
                                    Do you offer international shipping?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Currently, we only ship within Indonesia. For international customers, please visit our global website at encode.com.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection