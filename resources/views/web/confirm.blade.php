@extends('web.web-layout')

@section('header')
    <!-- SPECIFIC CSS -->
    <link href="{{ asset('assets/web/css/order-sign_up.css') }}" rel="stylesheet">
@endsection

@section('main')
<div class="container margin_60_20 mt-6">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="box_order">
                <div class="head text-center">
                    <h3>Order Confirmation</h3>
                </div>
                <div class="main text-center">
                    @if(request('order'))
                        <div class="success-icon mb-4">
                            <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                        </div>
                        <h4 class="text-success mb-3">Order Placed Successfully!</h4>
                        
                        @if(request('payment') === 'cod')
                            <div class="alert alert-info mb-4">
                                <i class="fas fa-money-bill-wave me-2"></i>
                                <strong>Cash on Delivery</strong><br>
                                You will pay cash when your order is delivered.
                            </div>
                        @else
                            <p class="mb-4">Thank you for your order. We have received your order and will process it shortly.</p>
                        @endif
                        
                        <div class="order-details bg-light p-4 rounded mb-4">
                            <h5>Order Details</h5>
                            <p><strong>Order Number:</strong> {{ request('order') }}</p>
                            <p><strong>Order Date:</strong> {{ now()->format('M d, Y H:i') }}</p>
                            <p><strong>Payment Method:</strong> 
                                @if(request('payment') === 'cod')
                                    <span class="badge bg-warning">Cash on Delivery</span>
                                @else
                                    <span class="badge bg-success">Online Payment</span>
                                @endif
                            </p>
                        </div>

                        <div class="next-steps">
                            <h5>What's Next?</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-phone text-primary me-2"></i> We'll call you to confirm your order</li>
                                <li class="mb-2"><i class="fas fa-clock text-primary me-2"></i> Your order will be prepared and delivered</li>
                                @if(request('payment') === 'cod')
                                    <li class="mb-2"><i class="fas fa-money-bill-wave text-primary me-2"></i> Please keep exact change ready for delivery</li>
                                @endif
                                <li class="mb-2"><i class="fas fa-sms text-primary me-2"></i> You'll receive SMS updates on your order status</li>
                            </ul>
                        </div>

                        <div class="contact-info mt-4">
                            <p class="text-muted">Need help? Call us at <strong>0432 48432854</strong></p>
                        </div>

                        <div class="action-buttons mt-4">
                            <a href="{{ route('home') }}" class="btn btn-primary me-3">Continue Shopping</a>
                            <a href="#" class="btn btn-outline-primary" onclick="window.print()">Print Receipt</a>
                        </div>
                    @else
                        <div class="error-icon mb-4">
                            <i class="fas fa-exclamation-triangle text-warning" style="font-size: 4rem;"></i>
                        </div>
                        <h4 class="text-warning mb-3">Order Information Not Found</h4>
                        <p class="mb-4">We couldn't find the order information. Please contact us if you need assistance.</p>
                        
                        <div class="action-buttons mt-4">
                            <a href="{{ route('home') }}" class="btn btn-primary">Go to Home</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-js')
<script>
    // Auto-redirect to home after 30 seconds
    setTimeout(function() {
        if (confirm('Would you like to continue shopping?')) {
            window.location.href = '{{ route("home") }}';
        }
    }, 30000);
</script>
@endsection
