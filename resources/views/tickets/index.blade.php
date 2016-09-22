<style>
body {
	background-color: #F1F2F2 !important;
}

.order-tickets {
	margin-top: 30px;
	padding-bottom: 20px !important;
}

.order-header {
	margin-bottom: 30px;
	margin-left: 0 !important;
}

.order-title {
	font-size: 20px;
	font-weight: 600;
	color: #0F3844;
	margin-bottom: 0;
}

.order-content {
	font-size: 14px;
	font-weight: 300;
	color: #0F3844;
}

.order-body {
	padding-bottom: 50px;
}

/**************************************/
/********** Ticket Sidebar ************/
/**************************************/

.order-sidebar li {
	border-radius: 0;
	background-color: #fff;
}

.order-sidebar a {
	color: #0F3844;
	background-color: #fff;
	font-size: 13px;
}

.order-sidebar li.active:after {
    content: "";
    display: block;
    height: 3px;
    width: 90%;
    background: #EBD38C;
    margin: 0 auto;
}

.order-sidebar li.active a {
	background-color: #fff !important;
	color: #0F3844 !important;
}

.order-sidebar li.active a:hover {
    background-color: #F1F2F2 !important;
}

.order-list {
	max-width: 77%;
	margin-left: 60px;
}

.order-row {
	border-left: 4px solid #EBD38C;
	background-color: #fff;
}

.order-row .thumbnail {
	border-radius: 0;
    border-style: none;
    margin-bottom: 0;
}

.event-header {
	margin-top: 5px;
	margin-bottom: 0;
}

.event-name {
	font-size: 22px;
	font-weight: 400;
}

.event-share {
	font-size: 12px;
	padding-top: 5px;
}

.event-share img {
	max-height: 13px;
	margin-left: 7px;
}

.event-time {
	font-size: 11px;
	font-weight: 400;
}

.order-row-footer {
	padding-top: 20px;
	font-size: 11px;
	margin-bottom: 0;
}

.order-invoice img {
	width: 10px;
}

.ticket-print {
	margin-left: 30px;
}

.ticket-print img {
	width: 13px;
}

.order-number {
	margin-left: 20px;
	padding-left: 20px;
	border-left: 1px solid black;
}

.show-hide img {
	width: 11px;
}

/**************************************/
/************ Order Detail ************/
/**************************************/

.order-detail-row {
	margin-top: 10px;
}

.order-detail {
	background-color: #fff;
}

.order-detail-title {
	margin-top: 10px;
	border-bottom: 1px solid black;
}

.order-detail-title p {
	margin-bottom: 5px;
	margin-left: 20px;
	font-size: 12px;
	font-weight: 300;
}

.order-detail-body {
	margin: 10px 0;
	padding-left: 5px;
}

.ticket-detail-col {
	border-right: 1px solid black;
}

.ticket-detail-row {
	margin-bottom: 0;
}

.ticket-quantity {
	font-size: 28px;
	font-weight: 600;
}

.ticket-name {
	font-size: 14px;
	font-weight: 500;
}

.contact-details {
	padding-top: 5px !important;
	padding-left: 40px !important;
	font-size: 11px;
	font-weight: 400;
}
</style>

@extends('layouts.app')

@section('content')

<div class="container order-tickets">
	<div class="row order-header">
		<p class="order-title">Find Your Happiness!</p>
		<p class="order-content">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
	</div>
	<div class="row order-body">
		<div class="col-xs-2 order-sidebar">
			<ul class="nav nav-pills nav-stacked">
			  	<li class="active"><a href="#">Upcoming Events</a></li>
			  	<li><a href="#">Past Events</a></li>
			  	<li><a href="#">Bookmark Events</a></li>
			</ul>
		</div>
		<div class="col-xs-10 order-list">
			@foreach ($orders as $order)
			<div class="row order-row">
				<div class="col-xs-2 thumbnail">
					<img src="{{ asset('/images/events/event-1.jpg') }}">
				</div>
				<div class="col-xs-10">
			    	<p class="event-header">
			    		<span class="event-name">{{ $order->event->name }}</span>
			    		<span class="pull-right event-share">Share:
			    			<img src="{{ asset('images/sosmed/facebook.png') }}">
			    			<img src="{{ asset('images/sosmed/twitter.png') }}">
			    			<img src="{{ asset('images/sosmed/instagram.png') }}">
			    		</span>
			    	</p>
			    	<p class="event-time">{{ Carbon\Carbon::parse($order->event->started_at)->format('l, M d, Y | g.i A') }}</p>
			    	<p class="order-row-footer">
			    		<span class="order-invoice">
			    			<img src="{{ asset('images/icons/invoice.png') }}"> Invoice
			    		</span>
			    		<span class="ticket-print"> 
			    			<img src="{{ asset('images/icons/print-ticket.png') }}"> Print Ticket
			    		</span>
			    		<span class="order-number"> 
			    			Order Number #{{ $order->id }}
			    		</span>
			    		<span class="show-hide pull-right"> 
			    			Hide <img src="{{ asset('images/icons/hide.png') }}">
			    		</span>
			    	</p>
			   </div>
			</div>
			<div class="row order-detail-row">
				<div class="col-xs-10 col-xs-offset-2 order-detail">
					<div class="row order-detail-title">
			    		<p>Order Information</p>
			    	</div>
			    	<div class="row order-detail-body">
				    	<div class="col-xs-4 ticket-detail-col">
				    		@foreach ($order->order_details as $order_detail)
				    		<p class="ticket-detail-row">
				    			<span class="ticket-quantity">{{ $order_detail->quantity }}</span>
				    			<span class="ticket-name">{{ $order_detail->ticket_group->name }} tickets</span>
				    		</p>
				    		@endforeach
				    	</div>

				    	<div class="col-xs-8 contact-details">
				    		<p>Name: {{ Auth::user()->first_name }}</p>
				    		<p>Email: {{ Auth::user()->email }}</p>
				    		<p>Phone: {{ Auth::user()->phone }}</p>
				    	</div>
				    </div>
			   </div>
			</div>
			@endforeach
		</div>
	</div>
</div>

@endsection
