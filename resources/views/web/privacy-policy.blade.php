@extends('web.web-layout')

@section('header')
    <link href="{{ asset('assets/web/css/about.css') }}" rel="stylesheet">
    <style>
        .privacy-hero {
            width: 100%;
            height: 300px;
            background: url('https://images.unsplash.com/photo-1586282391129-76a6dfe126b9?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80') center center no-repeat;
            background-size: cover;
            position: relative;
            margin-bottom: 60px;
        }
        .privacy-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.7);
        }
        .privacy-content {
            padding: 60px 0;
        }
        .privacy-section {
            margin-bottom: 40px;
        }
        .privacy-section h2 {
            color: #222;
            font-size: 28px;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #ffb536;
            display: inline-block;
        }
        .privacy-section h3 {
            color: #444;
            font-size: 22px;
            margin: 30px 0 15px;
        }
        .privacy-section p, 
        .privacy-section ul {
            color: #666;
            line-height: 1.8;
            margin-bottom: 15px;
        }
        .privacy-section ul {
            padding-left: 20px;
        }
        .privacy-section li {
            margin-bottom: 10px;
        }
        .last-updated {
            font-style: italic;
            color: #888;
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }
    </style>
@endsection

@section('main')
    <!-- Hero Section -->
    <div class="privacy-hero">
        <div class="container">
            <div class="hero-content">
                <h1 class="text-light">Privacy Policy</h1>
                <div class="breadcrumbs">
                    <a href="{{ route('home') }}">Home</a> / <span>Privacy Policy</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Privacy Content -->
    <section class="privacy-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="privacy-section">
                        <p>At <a href="{{ route('home') }}" title="Bistro">Bistro</a>, we are committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website or use our services.</p>
                    </div>

                    <div class="privacy-section">
                        <h2>1. Information We Collect</h2>
                        <p>We may collect personal information that you provide directly to us, including but not limited to:</p>
                        <ul>
                            <li>Your name, email address, phone number, and delivery address</li>
                            <li>Payment information (processed securely through our payment processor)</li>
                            <li>Order history and preferences</li>
                            <li>Customer service inquiries and feedback</li>
                            <li>Device and usage information collected automatically through cookies and similar technologies</li>
                        </ul>
                    </div>

                    <div class="privacy-section">
                        <h2>2. How We Use Your Information</h2>
                        <p>We may use the information we collect for various purposes, including to:</p>
                        <ul>
                            <li>Process and fulfill your food orders</li>
                            <li>Communicate with you about your orders and account</li>
                            <li>Provide customer support</li>
                            <li>Improve our website, products, and services</li>
                            <li>Send promotional offers and updates (you can opt-out at any time)</li>
                            <li>Comply with legal obligations</li>
                        </ul>
                    </div>

                    <div class="privacy-section">
                        <h2>3. Information Sharing</h2>
                        <p>We do not sell or rent your personal information to third parties. We may share your information with:</p>
                        <ul>
                            <li>Restaurants and delivery personnel to fulfill your orders</li>
                            <li>Service providers who assist with our business operations</li>
                            <li>Legal authorities when required by law</li>
                            <li>Business transfers (in case of merger, acquisition, or sale of assets)</li>
                        </ul>
                    </div>

                    <div class="privacy-section">
                        <h2>4. Data Security</h2>
                        <p>We implement appropriate security measures to protect your personal information from unauthorized access, alteration, disclosure, or destruction. However, no internet transmission is completely secure, and we cannot guarantee absolute security.</p>
                    </div>

                    <div class="privacy-section">
                        <h2>5. Your Rights</h2>
                        <p>You have the right to:</p>
                        <ul>
                            <li>Access, update, or delete your account information</li>
                            <li>Opt-out of marketing communications</li>
                            <li>Request a copy of your personal data</li>
                            <li>Withdraw consent for data processing</li>
                        </ul>
                    </div>

                    <div class="privacy-section">
                        <h2>6. Cookies and Tracking Technologies</h2>
                        <p>We use cookies and similar technologies to enhance your experience on our website. You can set your browser to refuse all or some browser cookies, but this may affect certain features of our website.</p>
                    </div>

                    <div class="privacy-section">
                        <h2>7. Changes to This Policy</h2>
                        <p>We may update this Privacy Policy from time to time. We will notify you of any changes by posting the new policy on this page and updating the "Last Updated" date.</p>
                    </div>

                    <div class="privacy-section">
                        <h2>8. Contact Us</h2>
                        <p>If you have any questions about this Privacy Policy, please contact us at:</p>
                        <p>
                            Email: privacy@foodexpress.com<br>
                            Phone: (123) 456-7890<br>
                            Address: 123 Food Street, Cuisine City, 10001
                        </p>
                    </div>

                    <p class="last-updated">Last Updated: October 20, 2025</p>
                </div>
            </div>
        </div>
    </section>
@endsection
