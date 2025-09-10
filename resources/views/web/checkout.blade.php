@extends('web.web-layout')

@section('header')
    <!-- SPECIFIC CSS -->
    <link href="{{ asset('assets/web/css/order-sign_up.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/web/css/detail-page.css') }}" rel="stylesheet">
@endsection

@section('main')
<div class="container margin_60_20 mt-6">
	<div class="row justify-content-center">
		<div class="col-xl-4 col-lg-6" id="sidebar_fixed">
			<div class="box_order">
				<div class="head">
					<h3>Order Summary</h3>
				</div>
				<!-- /head -->
				<div class="main d-flex flex-column justify-content-between">
					<div class="items-area">
						@forelse($items as $item)
						<div class="checkout-item d-flex justify-content-between align-items-center mb-3">
							<div class="d-flex">
								<figure class="me-2">
									<img class="img-fluid object-fit-cover" src="{{ asset('storage/' . $item->menuItem->images->first()->image_path) }}" alt="">
								</figure>
								<div>
									<p class="fw-semibold mb-0">{{ $item->menuItem->name }}</p>
									@if($item->variations->isNotEmpty())
										<small class="text-nowrap item-variation-name">
											@foreach($item->variations as $variation)
											{{ $variation->name }}
											@if(!$loop->last), @endif
											@endforeach
										</small>
									@endif
								</div>
							</div>
							<span>{{ $item->quantity }} x <b>{{ number_format($item->variations->first()->price * $item->quantity, 2) }}</b></span>
						</div>
						@empty
						<div class="text-center py-3">Your cart is empty</div>
						@endforelse
					</div>
					
					<div class="summary-area">
						<ul class="clearfix">
							<li>Subtotal<span id="checkout_subtotal">{{ config('app.currency') }}{{ number_format($cartTotal, 2) }}</span></li>
							<li class="total">Total<span id="checkout_total">{{ config('app.currency') }}{{ number_format($cartTotal, 2) }}</span></li>
						</ul>
						<a href="#" class="btn_1 gradient full-width mb_5">Order Now</a>
						<div class="text-center"><small>Or Call Us at <strong>0432 48432854</strong></small></div>
					</div>
				</div>
			</div>
			<!-- /box_booking -->
		</div>
		<!-- /col -->

		<div class="col-xl-6 col-lg-6">
			<div class="box_order_form">
				<div class="head">
					<div class="title">
						<h3>Personal Details</h3>
					</div>
				</div>
				<!-- /head -->
				<div class="main">
					<div class="form-group">
						<label>First and Last Name</label>
						<input class="form-control" placeholder="First and Last Name">
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Email Address</label>
								<input class="form-control" placeholder="Email Address">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Phone</label>
								<input class="form-control" placeholder="Phone">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Full Address</label>
						<input class="form-control" placeholder="Full Address">
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>City</label>
								<input class="form-control" placeholder="City">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Postal Code</label>
								<input class="form-control" placeholder="0123">
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /box_order_form -->
			<div class="box_order_form">
				<div class="head">
					<div class="title">
						<h3>Payment Method</h3>
					</div>
				</div>
				<!-- /head -->
				<div class="main">
					<div class="payment_select">
						<label class="container_radio">Credit Card
							<input type="radio" value="" checked name="payment_method">
							<span class="checkmark"></span>
						</label>
						<i class="icon_creditcard"></i>
					</div>
					<div class="form-group">
						<label>Name on card</label>
						<input type="text" class="form-control" id="name_card_order" name="name_card_order" placeholder="First and last name">
					</div>
					<div class="form-group">
						<label>Card number</label>
						<input type="text" id="card_number" name="card_number" class="form-control" placeholder="Card number">
					</div>
					<div class="row">
						<div class="col-md-6">
							<label>Expiration date</label>
							<div class="row">
								<div class="col-md-6 col-6">
									<div class="form-group">
										<input type="text" id="expire_month" name="expire_month" class="form-control" placeholder="mm">
									</div>
								</div>
								<div class="col-md-6 col-6">
									<div class="form-group">
										<input type="text" id="expire_year" name="expire_year" class="form-control" placeholder="yyyy">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label>Security code</label>
								<div class="row">
									<div class="col-md-4 col-6">
										<div class="form-group">
											<input type="text" id="ccv" name="ccv" class="form-control" placeholder="CCV">
										</div>
									</div>
									<div class="col-md-8 col-6">
										<img src="{{ asset('assets/web/img/icon_ccv.gif') }}" width="50" height="29" alt="ccv"><small>Last 3 digits</small>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--End row -->
					<div class="payment_select" id="paypal">
						<label class="container_radio">Pay with Paypal
							<input type="radio" value="" name="payment_method">
							<span class="checkmark"></span>
						</label>
					</div>
					<div class="payment_select">
						<label class="container_radio">Pay with Cash
							<input type="radio" value="" name="payment_method">
							<span class="checkmark"></span>
						</label>
						<i class="icon_wallet"></i>
					</div>
				</div>
			</div>
			<!-- /box_order_form -->
		</div>
		<!-- /col -->

	</div>
	<!-- /row -->
</div>
@endsection

@section('custom-js')
<script src="{{ asset('assets/web/js/sticky_sidebar.min.js') }}"></script>
<script>
	$('#sidebar_fixed').theiaStickySidebar({
		minWidth: 991,
		updateSidebarHeight: false,
		additionalMarginTop: 30
	});
</script>
@endsection