<!DOCTYPE html>
<html lang="en">

<head>
    <title>Gethype</title>
    <link rel="icon" href="{{ asset('images/logo-dark.png') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/ticket-print.css') }}">
</head>

<body>
	@foreach ($order->order_details as $order_detail)
	<div class="ticket page-break">
		<div class="left-side">
			<span class="ticket-corner corner-a"></span>
            <span class="ticket-corner corner-b"></span>
            <span class="ticket-corner corner-c"></span>
            <span class="ticket-corner corner-d"></span>

			<h1>
				<span class="qty">{{ $order_detail->quantity }}</span>Ticket
			</h1>
			<h3>{{ $order->event->name }}</h3>
			<p>{!! nl2br(e($order->event->location)) !!}</p>
			<p>{{ Carbon\Carbon::parse($order->event->started_at)->format('l, M d, Y | g.i A') }}</p>
		</div>
		<div class="right-side">
			<span class="ticket-corner corner-a"></span>
            <span class="ticket-corner corner-b"></span>
            <span class="ticket-corner corner-c"></span>
            <span class="ticket-corner corner-d"></span>

			<div class="ordered-by">
				<small class="label-title">Ordered by</small>
				<p class="value">{{ $order->first_name .' '.$order->last_name }}</p>
			</div>

			<div class="date-order">
				<small class="label-title">Order Date</small>
				<p class="value">{{ Carbon\Carbon::parse($order->created_at)->format('d M, Y') }}</p>
			</div>

			<div class="time-order">
				<small class="label-title">Order Time</small>
				<p class="value">{{ Carbon\Carbon::parse($order->event->started_at)->format('g.i A') }}</p>
			</div>

			<div class="payment-status">
				<small class="label-title">Payment</small>
				<p class="value">PAID</p>
			</div>

			<div class="clearfix"></div>
			
			<div class="ticket-type">
				<small class="label-title">Ticket Type</small>
				<p class="value">{{ $order_detail->ticket_group->name }}</p>
			</div>

			<div class="order-code">
				<small class="label-title">Order Number</small>
				<p class="value">{{ $order->id }}</p>
			</div>

			<div class="clearfix"></div>

			<div class="barcode">
				<img src="data:image/png;base64,{{DNS1D::getBarcodePNG('8696-9164-2345-2232', 'C128')}}" alt="barcode" /><br>
				<p>5389-1649-1927-1235-2587</p>
			</div>
		</div>
	</div>
	@endforeach
</body>


