@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/checkout-index.css') }}">
@endsection

@section('content')
<form action="@if ($order_amount > 0) {{ url('checkout/pay') }} @else {{ url('checkout/proceed') }} @endif" method="POST">
{!! csrf_field() !!}
	<div class="container checkout">
		<div class="row">
			<div class="col-xs-8 checkout-input">
				@if ($errors->has('error'))
					<div class="alert alert-dismissible alert-danger">
	                	<p>{{ $errors->first('error') }}</p>
	              	</div>
	            @endif
				<div class="panel contact-details">
				  	<div class="panel-heading">
				    	<h3 class="panel-title">Contact Details</h3>
				  	</div>
				  	<div class="panel-body">
				    	<div class="form-group col-xs-5">
						 	<label class="control-label">First Name</label>
						  	<input class="form-control" type="text" name="first_name" value="{{ Auth::user()->first_name }}">
						  	@if ($errors->has('first_name'))
	                        <span class="error-block">
	                        	{{ $errors->first('first_name') }}
	                        </span>
	                        @endif
						</div>
						<div class="form-group col-xs-5">
						 	<label class="control-label">Last Name</label>
						  	<input class="form-control" type="text" name="last_name" value="{{ Auth::user()->last_name }}">
						  	@if ($errors->has('first_name'))
	                        <span class="error-block">&nbsp;</span>
	                        @endif
						</div>

						<div class="form-group col-xs-5">
						  	<label class="control-label">Email</label>
						  	<input class="form-control" type="email" name="email" value="{{ Auth::user()->email }}">
						  	@if ($errors->has('email'))
	                        <span class="error-block">
	                        	{{ $errors->first('email') }}
	                        </span>
	                        @elseif ($errors->has('phone'))
	                        <span class="error-block">&nbsp;</span>
	                        @endif
						</div>
						<div class="form-group col-xs-5">
						  	<label class="control-label">Mobile Phone</label>
						  	<input class="form-control" type="text" name="phone" value="{{ Auth::user()->phone }}">
						  	@if ($errors->has('phone'))
	                        <span class="error-block">
	                        	{{ $errors->first('phone') }}
	                        </span>
	                        @elseif ($errors->has('email'))
	                        <span class="error-block">&nbsp;</span>
	                        @endif
						</div>
						<div class="col-xs-12">
							<span class="contact-alert">* make sure you contact detail is correct</span>
						</div>
				  	</div>
				</div>
				<div class="panel payment-options">
					<input type="hidden" class="payment-method" name="payment_method" value="">
				  	<div class="panel-heading">
				    	<h3 class="panel-title">Payment Options</h3>
				  	</div>
				  	<div class="panel-body">
				    	<div class="thumbnail payment-box @if ($order_amount == 0) payment-disabled @endif" id="bank_transfer">
				    		<img src="{{ asset('/images/payments/jcb.png') }}">
				    	</div>
				    	<div class="thumbnail payment-box @if ($order_amount == 0) payment-disabled @endif" id="credit_card">
				    		<img src="{{ asset('/images/payments/visa.png') }}">
				    	</div>
				    	<div class="thumbnail payment-box @if ($order_amount == 0) payment-disabled @endif" id="bca_klikpay">
				    		<img src="{{ asset('/images/payments/bca_klikpay.png') }}">
				    	</div>
				    	<div class="thumbnail payment-box @if ($order_amount == 0) payment-disabled @endif" id="mandiri_clickpay">
				    		<img src="{{ asset('/images/payments/mandiri_clickpay.png') }}">
				    	</div>
				    	<div class="thumbnail payment-box @if ($order_amount == 0) payment-disabled @endif" id="cimb_clicks">
				    		<img src="{{ asset('/images/payments/cimb_clicks.png') }}">
				    	</div>
				    	<div class="thumbnail payment-box @if ($order_amount == 0) payment-disabled @endif" id="epay_bri">
				    		<img src="{{ asset('/images/payments/epay_bri.png') }}">
				    	</div>
				    	<div class="thumbnail payment-box @if ($order_amount == 0) payment-disabled @endif" id="mandiri_ecash">
				    		<img src="{{ asset('/images/payments/mandiri_ecash.png') }}">
				    	</div>
				    	<div class="thumbnail payment-box @if ($order_amount == 0) payment-disabled @endif" id="indosat_dompetku">
				    		<img src="{{ asset('/images/payments/indosat_dompetku.png') }}">
				    	</div>
				    	<div class="thumbnail payment-box @if ($order_amount == 0) payment-disabled @endif" id="telkomsel_cash">
				    		<img src="{{ asset('/images/payments/telkomsel_cash.png') }}">
				    	</div>
				    	<div class="thumbnail payment-box @if ($order_amount == 0) payment-disabled @endif" id="xl_tunai">
				    		<img src="{{ asset('/images/payments/xl_tunai.png') }}">
				    	</div>
				  	</div>
				</div>
				<button class="btn pay-submit pull-right" type="submit">@if ($order_amount > 0) Pay @else Proceed @endif</button>
			</div>
			<div class="col-xs-4 order-details">
				<p class="order-summary">Order Summary</p>
				<p class="ticket-quantity-head">
					<span class="ticket-quantity-total">{{ $total_quantity }}</span>
					<span class="ticket-title">@if ($total_quantity > 1) Tickets @else Ticket @endif</span>
				</p>
				<p class="event-name">Digital Marketing with Google Ads</p>
				<div class="row event-details">
					<p class="event-location">{{ $event->location }}</p>
					<p class="event-date">{{ Carbon\Carbon::parse($event->started_at)->format('l, M d, Y') }}</p>
					<p class="event-time">{{ Carbon\Carbon::parse($event->started_at)->format('g.i A') }}</p>
				</div>
				<div class="ticket-list">
					@foreach ($order_details as $order_detail)
					<div class="row ticket-row">
						<span class="col-xs-5 ticket-name">{{ $order_detail->ticket_group->name }}</span>
						<span class="col-xs-3 ticket-quantity">{{ $order_detail->quantity }} @if ($order_detail->quantity > 1) tickets @else ticket @endif</span>
						<span class="col-xs-4 ticket-total-price">{{ 'Rp '. number_format($order_detail->quantity * $order_detail->ticket_group->price) }}</span>
					</div>
					@endforeach
				</div>
				<div class="row subtotal">
					<input type="hidden" class="subtotal-hidden" value="{{ $order_amount }}">
					<span class="col-xs-8 subtotal-title">Sub Total</span>
					<span class="col-xs-4 subtotal-price">{{ 'Rp '. number_format($order_amount) }}</span>
				</div>
				<div class="row adminfee">
					<p class="adminfee-plus">(+)</p>
					<span class="col-xs-8 adminfee-title">Administration Fee</span>
					<span class="col-xs-4 adminfee-price">{{ 'Rp '. number_format(0) }}</span>
					<p class="adminfee-vat">Including VAT</p>
				</div>
				<div class="row grandtotal">
					<span class="col-xs-8 grandtotal-title">Total</span>
					<span class="col-xs-4 grandtotal-price">{{ 'Rp '. number_format($order_amount) }}</span>
				</div>
			</div>
		</div>
	</div>
</form>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('js/checkout.js') }}"></script>
@endsection



