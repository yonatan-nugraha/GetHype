<style>
body {
	background-color: #F1F2F2 !important;
}

/**************************************/
/************** Checkout **************/
/**************************************/

.checkout {
	margin-top: 50px;
	padding-bottom: 80px;
}

.checkout .panel {
	border-radius: 0;
	border-color: #fff;
}

.checkout .panel-heading {
	background-color: #0F3844;
	border-radius: 0;
	color: #fff;
}

.checkout .panel-title {
	font-size: 14px;
}

.checkout label {
	font-size: 14px;
	font-weight: 300;
}

.checkout-input {
	padding-right: 40px !important;
}

/**************************************/
/*********** Contact Details **********/
/**************************************/

.contact-details .panel-body {
	padding: 20px 0;
}

.contact-alert {
	padding-top: 30px;
	font-size: 11px;
	font-weight: 300;
}

.contact-details input {
	border-radius: 0;
	border: 1px solid #0F3844;
	font-size: 12px;
}

/**************************************/
/********** Payments Options **********/
/**************************************/

.payment-options {
	border: 0 !important;
}

.payment-options .panel-body {
	padding: 0;
}

.payment-options .thumbnail {
	border-radius: 0;
	margin: 0
}

.payment-box {
    max-width: 20%;
    border: 1px solid black;
    float: left;
    min-height: 130px;
}

.payment-box img {
	width: 80%;
	max-height: 100%;
	margin-top: 35px;
}

.payment-box:hover {
	cursor: pointer;
	background-color: #F1F2F2;
}

.payment-selected {
	background-color: #F1F2F2 !important;
}

/**************************************/
/*********** Order Details ************/
/**************************************/

.order-details {
	background-color: #fff;
	max-width: 29%;
	margin-left: 30px;
}

.order-summary {
	text-transform: uppercase;
	letter-spacing: 0.1em;
	color: #0F3844;
	font-weight: 00;
	font-size: 14px;
	margin-top: 5px;
}

.ticket-quantity-head {
	margin-bottom: 0;
}

.ticket-quantity-total {
	font-size: 40px;
	color: #EBD38C;
	margin-right: 2px;
	font-weight: 500;
}

.ticket-title {
	color: #EBD38C;
}

.event-name {
	font-size: 31px;
	line-height: 120%;
	color: #0F3844;
	font-weight: 400;
	letter-spacing: 0.03em;
}

.event-details {
	padding: 20px 15px;
	border-bottom: 1px dotted black;
	letter-spacing: 0.04em;
}

.event-location, .event-date, .event-time {
	color: #0F3844;
	font-size: 12px;
	margin-bottom: 0px;
}

.ticket-list {
	margin-top: 20px;
	margin-bottom: 40px;
}

.ticket-row {
	padding-bottom: 3px;
}

.ticket-name, .ticket-quantity, .ticket-total-price {
	font-weight: 400;
	font-size: 12px;
}

.subtotal {
	padding-bottom: 15px;
	border-bottom: 1px dotted #ddd;
}

.subtotal-title {
	font-weight: 300;
	font-size: 11px;
}

.subtotal-price {
	font-weight: 400;
	font-size: 12px;
}

.adminfee {
	padding: 15px;
}

.adminfee-plus {
	font-weight: 300;
	font-size: 11px;
	letter-spacing: 0.2em;
}

.adminfee-title {
	font-weight: 400;
	font-size: 12px;
	padding-left: 0 !important;
}

.adminfee-price {
	font-weight: 400;
	font-size: 12px;
	padding-left: 20px !important;
}

.adminfee-vat {
	font-weight: 300;
	font-size: 10px;
}

.grandtotal {
	background-color: #EBD38C;
}

.grandtotal-title {
	text-transform: uppercase;
	font-size: 20px;
	letter-spacing: 0.1em;
	padding: 5px 0;
}

.grandtotal-price {
	font-weight: 400;
	font-size: 12px;
	padding-top: 10px;
}

.checkout button {
	background-color: red;
	color: #fff;
	border-radius: 7px;
	min-width: 100px;
	-webkit-appearance: none;
}
</style>

@extends('layouts.app')

@section('content')

<form action="{{ url('checkout/pay') }}" method="POST">
{!! csrf_field() !!}
	<div class="container checkout">
		<div class="row">
			<div class="col-xs-8 checkout-input">
				<div class="panel contact-details">
				  	<div class="panel-heading">
				    	<h3 class="panel-title">Contact Details</h3>
				  	</div>
				  	<div class="panel-body">
				    	<div class="form-group col-xs-5">
						 	<label class="control-label">First Name</label>
						  	<input class="form-control" type="text" value="{{ Auth::user()->first_name }}">
						</div>
						<div class="form-group col-xs-5">
						 	<label class="control-label">Last Name</label>
						  	<input class="form-control" type="text" value="{{ Auth::user()->last_name }}">
						</div>
						<div class="form-group col-xs-5">
						  	<label class="control-label">Email</label>
						  	<input class="form-control" type="text" value="{{ Auth::user()->email }}">
						</div>
						<div class="form-group col-xs-5">
						  	<label class="control-label">Mobile Phone</label>
						  	<input class="form-control" type="text" value="{{ Auth::user()->phone }}">
						</div>
						<div class="col-xs-12">
							<span class="contact-alert">* make sure you contact detail is correct</span>
						</div>
				  	</div>
				</div>
				<div class="panel payment-options">
					<input type="hidden" class="payment-type" name="payment_type" value="">
				  	<div class="panel-heading">
				    	<h3 class="panel-title">Payment Options</h3>
				  	</div>
				  	<div class="panel-body">
				    	<div class="thumbnail payment-box" id="bank_transfer">
				    		<img src="{{ asset('/images/payments/jcb.png') }}">
				    	</div>
				    	<div class="thumbnail payment-box" id="credit_card">
				    		<img src="{{ asset('/images/payments/visa.png') }}">
				    	</div>
				    	<div class="thumbnail payment-box" id="bca_klikpay">
				    		<img src="{{ asset('/images/payments/bca_klikpay.png') }}">
				    	</div>
				    	<div class="thumbnail payment-box" id="mandiri_clickpay">
				    		<img src="{{ asset('/images/payments/mandiri_clickpay.png') }}">
				    	</div>
				    	<div class="thumbnail payment-box" id="cimb_clicks">
				    		<img src="{{ asset('/images/payments/cimb_clicks.png') }}">
				    	</div>
				    	<div class="thumbnail payment-box" id="epay_bri">
				    		<img src="{{ asset('/images/payments/epay_bri.png') }}">
				    	</div>
				    	<div class="thumbnail payment-box" id="mandiri_ecash">
				    		<img src="{{ asset('/images/payments/mandiri_ecash.png') }}">
				    	</div>
				    	<div class="thumbnail payment-box" id="indosat_dompetku">
				    		<img src="{{ asset('/images/payments/indosat_dompetku.png') }}">
				    	</div>
				    	<div class="thumbnail payment-box" id="telkomsel_cash">
				    		<img src="{{ asset('/images/payments/telkomsel_cash.png') }}">
				    	</div>
				    	<div class="thumbnail payment-box" id="xl_tunai">
				    		<img src="{{ asset('/images/payments/xl_tunai.png') }}">
				    	</div>
				  	</div>
				</div>
				<button class="btn pay-submit pull-right" type="submit">Pay</button>
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
					<input type="hidden" class="subtotal-hidden" value="{{ $amount }}">
					<span class="col-xs-8 subtotal-title">Sub Total</span>
					<span class="col-xs-4 subtotal-price">{{ 'Rp '. number_format($amount) }}</span>
				</div>
				<div class="row adminfee">
					<p class="adminfee-plus">(+)</p>
					<span class="col-xs-8 adminfee-title">Administration Fee</span>
					<span class="col-xs-4 adminfee-price">{{ 'Rp '. number_format(0) }}</span>
					<p class="adminfee-vat">Including VAT</p>
				</div>
				<div class="row grandtotal">
					<span class="col-xs-8 grandtotal-title">Total</span>
					<span class="col-xs-4 grandtotal-price">{{ 'Rp '. number_format($amount) }}</span>
				</div>
			</div>
		</div>
	</div>
</form>


@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('js/checkout.js') }}"></script>
@endsection



