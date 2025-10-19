@extends('layouts.web.user-portal.main-layout')

@push('styles')
    <style>
        .hover-shadow {
            transition: all 0.3s ease;
        }

        .hover-shadow:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1) !important;
        }

        .icon-box {
            transition: all 0.3s ease;
        }

        .card:hover .icon-box {
            transform: scale(1.05);
        }

        .nav-tabs .nav-link {
            color: #6c757d;
            font-weight: 500;
            border: none;
            padding: 0.75rem 1.25rem;
            position: relative;
        }

        .nav-tabs .nav-link.active {
            color: #0d6efd;
            background-color: transparent;
            border: none;
        }

        .nav-tabs .nav-link.active:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2px;
            background-color: #0d6efd;
        }

        .nav-tabs .nav-link:hover:not(.active) {
            border: none;
            color: #0d6efd;
        }

        .badge {
            font-weight: 500;
            letter-spacing: 0.3px;
        }

        .order-item {
            transition: all 0.3s ease;
        }

        .order-item:hover {
            transform: translateY(-2px);
        }
    </style>
@endpush

@section('main')
    <style>
        .order-card {
            transition: all 0.3s ease-in-out;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid transparent;
            position: relative;
        }

        .order-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 10px;
            padding: 1px;
            background: linear-gradient(135deg, #0d6efd, transparent);
            -webkit-mask:
                linear-gradient(#fff 0 0) content-box,
                linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
            pointer-events: none;
            /* This ensures clicks pass through to elements below */
            z-index: 0;
            /* Lower z-index than card content */
        }

        /* Ensure card content is above the pseudo-element */
        .order-card>* {
            position: relative;
            z-index: 1;
        }

        .order-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1.5rem rgba(13, 110, 253, 0.1) !important;
        }

        .order-card:hover::before {
            opacity: 1;
        }

        .status-badge {
            font-size: 0.75rem;
            font-weight: 500;
            letter-spacing: 0.5px;
            padding: 0.35rem 0.75rem;
        }

        .hover-shadow {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .hover-shadow:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1) !important;
        }

        .icon-box {
            transition: all 0.3s ease;
        }

        .card:hover .icon-box {
            transform: scale(1.1);
        }

        .accordion-button:not(.collapsed) {
            background-color: #f8f9fa;
            color: #0d6efd;
        }
    </style>

    <section class="container mt-5 p-3 p-md-4">

        <div class="mt-4">
            <!-- Header Section -->
            <div class="text-center mb-5">
                <h2 class="h3 mb-3">How Can We Help You?</h2>
                <p class="text-muted">We're here to assist you with any questions or concerns</p>
            </div>

            <!-- Support Cards -->
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                        <div class="card-body text-center p-4">
                            <div class="icon-box bg-light-primary text-primary rounded-circle mx-auto mb-3"
                                style="width: 60px; height: 60px; line-height: 60px;">
                                <i class="bi bi-telephone fs-4"></i>
                            </div>
                            <h5 class="h6 mb-2">Call Us</h5>
                            <p class="text-muted small mb-0">Available 24/7 for urgent matters</p>
                            <a href="tel:+1234567890" class="btn btn-link text-decoration-none p-0 mt-2">+1 (234)
                                567-890</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                        <div class="card-body text-center p-4">
                            <div class="icon-box bg-light-success text-success rounded-circle mx-auto mb-3"
                                style="width: 60px; height: 60px; line-height: 60px;">
                                <i class="bi bi-envelope fs-4"></i>
                            </div>
                            <h5 class="h6 mb-2">Email Us</h5>
                            <p class="text-muted small mb-0">We'll respond within 24 hours</p>
                            <a href="mailto:support@bistro.com"
                                class="btn btn-link text-decoration-none p-0 mt-2">support@bistro.com</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                        <div class="card-body text-center p-4">
                            <div class="icon-box bg-light-warning text-warning rounded-circle mx-auto mb-3"
                                style="width: 60px; height: 60px; line-height: 60px;">
                                <i class="bi bi-chat-dots fs-4"></i>
                            </div>
                            <h5 class="h6 mb-2">Live Chat</h5>
                            <p class="text-muted small mb-0">Chat with our support team</p>
                            <button class="btn btn-link text-decoration-none p-0 mt-2" data-bs-toggle="modal"
                                data-bs-target="#chatModal">
                                Start Chat
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ Section -->
            <div class="mb-5">
                <h4 class="h5 mb-4">Frequently Asked Questions</h4>
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item border-0 mb-2 rounded-3 overflow-hidden shadow-sm">
                        <h5 class="accordion-header" id="faq1">
                            <button class="accordion-button collapsed bg-light" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFaq1">
                                What are your opening hours?
                            </button>
                        </h5>
                        <div id="collapseFaq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                We're open Monday to Friday from 11:00 AM to 10:00 PM, and on weekends from 12:00 PM
                                to 11:00 PM.
                            </div>
                        </div>
                    </div>
                    <!-- Add more FAQ items as needed -->
                </div>
            </div>

            <!-- Contact Form -->
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h4 class="h5 mb-4">Send us a Message</h4>
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Your Name</label>
                                <input type="text" class="form-control" id="name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                            <div class="col-12">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" class="form-control" id="subject" required>
                            </div>
                            <div class="col-12">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" rows="4" required></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Chat Modal -->
        <div class="modal fade" id="chatModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Chat with Support</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="chat-container"
                            style="height: 300px; overflow-y: auto; margin-bottom: 1rem; border: 1px solid #dee2e6; border-radius: 0.375rem; padding: 1rem;">
                            <!-- Chat messages will appear here -->
                            <div class="text-center text-muted py-5">
                                <p>Our support team will be with you shortly...</p>
                            </div>
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Type your message...">
                            <button class="btn btn-primary" type="button">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('custom-js')
    <script>
    </script>
@endsection
