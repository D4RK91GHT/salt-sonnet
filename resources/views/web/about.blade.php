@extends('web.web-layout')

@section('header')
    <link href="{{ asset('assets/web/css/about.css') }}" rel="stylesheet">
@endsection

@section('main')
    <!-- Hero Section -->
    <div class="hero-about">
        <div class="container">
            <div class="hero-content">
                <h1 class="text-light">About Us</h1>
                <div class="breadcrumbs">
                    <a href="{{ route('home') }}">Home</a> / <span>About Us</span>
                </div>
            </div>
        </div>
    </div>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-img">
                        <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Restaurant Interior">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-content">
                        <h2>Welcome to Our Restaurant</h2>
                        <p>Since our humble beginnings in 2010, we have been dedicated to serving the most delicious and authentic dishes made from the finest ingredients. Our passion for food and commitment to quality has made us a beloved dining destination for food lovers.</p>
                        
                        <h3>Our Mission</h3>
                        <p>To provide an exceptional dining experience by serving high-quality, delicious food in a warm and welcoming atmosphere. We strive to create memorable moments for our guests through our culinary expertise and outstanding service.</p>
                        
                        <h3>Our Vision</h3>
                        <p>To be the most loved and trusted restaurant brand, known for our innovative menu, exceptional service, and commitment to sustainability and community.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section bg-light py-5">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2>Why Choose Us</h2>
                <p class="lead">Discover what makes us different</p>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-box">
                        <i class="icon_clock_alt"></i>
                        <h4>Fast Delivery</h4>
                        <p>We deliver your favorite meals right to your doorstep in under 30 minutes or it's free.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <i class="icon_ribbon_alt"></i>
                        <h4>Fresh Ingredients</h4>
                        <p>We use only the freshest, locally-sourced ingredients in all our dishes.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <i class="icon_heart_alt"></i>
                        <h4>Made with Love</h4>
                        <p>Every dish is prepared with care and passion by our expert chefs.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team-section py-5">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2>Meet Our Chefs</h2>
                <p class="lead">The talented people behind our delicious food</p>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="team-member">
                        <div class="team-img">
                            <img src="https://images.unsplash.com/photo-1577219491135-ce391730fb2c?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&h=500&fit=crop&crop=faces" alt="Chef John" class="img-fluid">
                        </div>
                        <div class="team-content">
                            <h4>John Smith</h4>
                            <span>Head Chef</span>
                            <div class="social-links">
                                <a href="#"><i class="social_facebook"></i></a>
                                <a href="#"><i class="social_twitter"></i></a>
                                <a href="#"><i class="social_instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="team-member">
                        <div class="team-img">
                            <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&h=500&fit=crop&crop=faces" alt="Chef Sarah" class="img-fluid">
                        </div>
                        <div class="team-content">
                            <h4>Sarah Johnson</h4>
                            <span>Sous Chef</span>
                            <div class="social-links">
                                <a href="#"><i class="social_facebook"></i></a>
                                <a href="#"><i class="social_twitter"></i></a>
                                <a href="#"><i class="social_instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="team-member">
                        <div class="team-img">
                            <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&h=500&fit=crop&crop=faces" alt="Chef Mike" class="img-fluid">
                        </div>
                        <div class="team-content">
                            <h4>Mike Chen</h4>
                            <span>Pastry Chef</span>
                            <div class="social-links">
                                <a href="#"><i class="social_facebook"></i></a>
                                <a href="#"><i class="social_twitter"></i></a>
                                <a href="#"><i class="social_instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section py-5 text-white text-center">
        <div class="container">
            <h2 class="mb-4">Ready to try our delicious food?</h2>
            <p class="lead mb-4">Order now and get 10% off your first order!</p>
            <a href="{{ route('home') }}" class="btn btn-light btn-lg">View Our Menu</a>
        </div>
    </section>
@endsection

@section('elements')
@endsection

@section('custom-js')
@endsection
