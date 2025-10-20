@extends('web.web-layout')

@section('header')
    <link href="{{ asset('assets/web/css/about.css') }}" rel="stylesheet">
    <style>
        .terms-hero {
            width: 100%;
            height: 300px;
            background: url('https://images.unsplash.com/photo-1504674900247-0877039348bf?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80') center center no-repeat;
            background-size: cover;
            position: relative;
            margin-bottom: 60px;
        }
        .terms-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.7);
        }
        .terms-content {
            padding: 60px 0;
        }
        .terms-section {
            margin-bottom: 40px;
        }
        .terms-section h2 {
            color: #222;
            font-size: 28px;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #ffb536;
            display: inline-block;
        }
        .terms-section h3 {
            color: #444;
            font-size: 22px;
            margin: 30px 0 15px;
        }
        .terms-section p, 
        .terms-section ul, 
        .terms-section ol {
            color: #666;
            line-height: 1.8;
            margin-bottom: 15px;
        }
        .terms-section ul, 
        .terms-section ol {
            padding-left: 25px;
            margin: 15px 0;
        }
        .terms-section li {
            margin-bottom: 10px;
            position: relative;
        }
        .terms-section ol {
            list-style-type: decimal;
        }
        .terms-section ul {
            list-style-type: disc;
        }
        .highlight {
            background-color: #fff9e6;
            padding: 15px;
            border-left: 4px solid #ffb536;
            margin: 20px 0;
            border-radius: 0 4px 4px 0;
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
    <div class="terms-hero">
        <div class="container">
            <div class="hero-content">
                <h1 class="text-light">Terms & Conditions</h1>
                <div class="breadcrumbs">
                    <a href="{{ route('home') }}">Home</a> / <span>Terms & Conditions</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Terms Content -->
    <section class="terms-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="terms-section">
                        <p>Welcome to <a href="{{ route('home') }}" title="Bistro">Bistro</a>. These Terms and Conditions outline the rules and regulations for the use of our website and services. By accessing this website, we assume you accept these terms and conditions in full. Do not continue to use Bistro's website if you do not accept all of the terms and conditions stated on this page.</p>
                    </div>

                    <div class="terms-section">
                        <h2>1. Definitions</h2>
                        <p>The following terminology applies to these Terms and Conditions:</p>
                        <ul>
                            <li><strong>"Bistro", "We", "Us", or "Our"</strong> refers to our company.</li>
                            <li><strong>"You"</strong> and <strong>"Your"</strong> refers to you, the person accessing this website and accepting the Company's terms and conditions.</li>
                            <li><strong>"Service"</strong> refers to the food ordering and delivery services provided by Bistro.</li>
                            <li><strong>"Order"</strong> means a request by you to purchase food items from our platform.</li>
                        </ul>
                    </div>

                    <div class="terms-section">
                        <h2>2. Account Registration</h2>
                        <p>To place an order, you may need to create an account. You agree to:</p>
                        <ol>
                            <li>Provide accurate, current, and complete information during registration</li>
                            <li>Maintain and promptly update your account information</li>
                            <li>Maintain the security of your account credentials</li>
                            <li>Accept responsibility for all activities that occur under your account</li>
                            <li>Be at least 18 years of age to use our services</li>
                        </ol>
                    </div>

                    <div class="terms-section">
                        <h2>3. Ordering and Payment</h2>
                        <h3>3.1 Placing Orders</h3>
                        <p>When you place an order through our platform, you agree to provide accurate and complete information, including delivery address and payment details.</p>
                        
                        <h3>3.2 Pricing and Payment</h3>
                        <p>All prices are listed in your local currency and are subject to change without notice. You agree to pay all charges including applicable taxes and delivery fees.</p>
                        
                        <div class="highlight">
                            <h4>Important:</h4>
                            <p>We reserve the right to refuse or cancel any order for any reason, including but not limited to product availability, errors in the description or price of the product, or error in your order.</p>
                        </div>
                    </div>

                    <div class="terms-section">
                        <h2>4. Delivery</h2>
                        <p>We aim to deliver your order within the estimated time, but delivery times are not guaranteed. Factors such as traffic, weather conditions, and order volume may affect delivery times.</p>
                        <p>You are responsible for ensuring someone is available at the delivery address to receive the order. If no one is available, our delivery partner may leave the order in a safe place at their discretion.</p>
                    </div>

                    <div class="terms-section">
                        <h2>5. Cancellation and Refund Policy</h2>
                        <h3>5.1 Order Cancellation</h3>
                        <p>You may cancel your order within 5 minutes of placing it, provided the restaurant has not started preparing your food. To cancel, please contact our customer support immediately.</p>
                        
                        <h3>5.2 Refunds</h3>
                        <p>Refunds, when applicable, will be processed to the original payment method within 5-7 business days. The following conditions apply:</p>
                        <ul>
                            <li>Incorrect or missing items</li>
                            <li>Late delivery beyond the estimated time (subject to terms)</li>
                            <li>Poor food quality or incorrect order</li>
                        </ul>
                    </div>

                    <div class="terms-section">
                        <h2>6. Intellectual Property</h2>
                        <p>All content included on this website, such as text, graphics, logos, button icons, images, audio clips, digital downloads, and software, is the property of Bistro or its content suppliers and protected by international copyright laws.</p>
                    </div>

                    <div class="terms-section">
                        <h2>7. Limitation of Liability</h2>
                        <p>To the maximum extent permitted by law, Bistro shall not be liable for any indirect, incidental, special, consequential, or punitive damages, or any loss of profits or revenues, whether incurred directly or indirectly, or any loss of data, use, goodwill, or other intangible losses resulting from:</p>
                        <ul>
                            <li>Your use or inability to use the service</li>
                            <li>Any unauthorized access to or use of our servers and/or any personal information stored therein</li>
                            <li>Any interruption or cessation of transmission to or from our service</li>
                            <li>Any bugs, viruses, or the like that may be transmitted to or through our service</li>
                        </ul>
                    </div>

                    <div class="terms-section">
                        <h2>8. Changes to Terms</h2>
                        <p>We reserve the right to modify these terms at any time. We will notify users of any changes by posting the new terms on this page. Your continued use of the service after such modifications constitutes your acknowledgment and acceptance of the modified terms.</p>
                    </div>

                    <div class="terms-section">
                        <h2>9. Governing Law</h2>
                        <p>These terms shall be governed by and construed in accordance with the laws of [Your Country/State], without regard to its conflict of law provisions.</p>
                    </div>

                    <div class="terms-section">
                        <h2>10. Contact Us</h2>
                        <p>If you have any questions about these Terms and Conditions, please contact us at:</p>
                        <p>
                            Email: legal@bistro.com<br>
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
