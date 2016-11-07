<!DOCTYPE html>
<html lang="en">

<head>
	<title>Gethype</title>
	<link rel="icon" href="{{ asset('images/logo-dark.png') }}">
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/ticket-invoice.css') }}">
</head>

<body>
	<div class="row invoice-header">
		<table class="table">
			<tbody>
				<tr>
					<td class="logo"><img src="{{ asset('images/logo-dark.png') }}"></td>
					<td class="address">Jl. Surya Wahana Blok 3J No.2,<br>Sunrise Garden, Jakarta Barat 11520</td>
					<td class="phone">+62 819 5151 154<br>+62 812 8149 5749</td>
					<td class="web">gethype.co.id</td>
				</tr>
			</tbody>
		</table>
	</div>

	<div class="row invoice-contact">
		<p class="title"><strong>Customer Detail</strong></p>
		<table class="table table-customer-detail">
			<tbody>
				<tr>
					<td><strong>Name</strong></td>
					<td>:</td>
					<td>{{ $order->first_name . ' ' . $order->last_name }}</td>
					<td><strong>Receipt Number</strong></td>
					<td>:</td>
					<td>{{ $order->id }}</td>
				</tr>
				<tr>
					<td><strong>Email</strong></td>
					<td>:</td>
					<td>{{ $order->email }}</td>
					<td><strong>Receipt Date</strong></td>
					<td>:</td>
					<td>{{ Carbon\Carbon::parse($order->created_at)->format('d M, Y') }}</td>
				</tr>
				<tr>
					<td><strong>Phone</strong></td>
					<td>:</td>
					<td>{{ $order->phone }}</td>
					<td><strong>Receipt Time</strong></td>
					<td>:</td>
					<td>{{ Carbon\Carbon::parse($order->created_at)->format('g.i A') }}</td>
				</tr>
			</tbody>
		</table>
	</div>

	<div class="row invoice-payment">
		<p class="title"><strong>Payment Detail</strong></p>
		<table class="table table-invoice-payment">
			<thead>
				<tr>
					<th>PO Number</th>
					<th>Method</th>
					<th>Status</th>
					<th>Terms</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>{{ $order->id }}</td>
					<td>
						@if ($order->payment_method == 'bank_transfer') Bank Transfer
						@elseif ($order->payment_method == 'credit_card') Credit Card
						@else Free
						@endif
					</td>
					<td>Paid</td>
					<td>Due on receipt</td>
				</tr>
			</tbody>
		</table>
	</div>

	<div class="row invoice-purchase">
		<p class="title"><strong>Purchase Detail</strong></p>
		<table class="table table-invoice-purchase">
			<thead>
				<tr>
					<th>No</th>
					<th>Event</th>
					<th>Ticket</th>
					<th>Qty</th>
					<th colspan="2">Price per unit (Rp)</th>
					<th>Total (Rp)</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($order->order_details as $order_detail)
				<tr>
					<td>{{ $loop->iteration }}</td>
					<td>{{ $order->event->name }}</td>
					<td>{{ $order_detail->ticket_group->name }}</td>
					<td>{{ $order_detail->quantity }}</td>
					<td colspan="2">{{ number_format($order_detail->ticket_group->price) }}</td>
					<td>{{ number_format($order_detail->quantity * $order_detail->ticket_group->price) }}</td>
				</tr>
				@endforeach
				<tr class="total border-top">
					<td class="no-border" colspan="4"></td>
					<td>Total (Rp)</td>
					<td>:</td>
					<td>{{ number_format($order->order_amount) }}</td>
				</tr>
				<tr class="total">
					<td class="no-border" colspan="4"></td>
					<td>Administration Fee</td>
					<td>:</td>
					<td>{{ number_format($order->administration_fee) }}</td>
				</tr>
				<tr class="total">
					<td class="no-border" colspan="4"></td>
					<td>Payment Amount</td>
					<td>:</td>
					<td>{{ number_format($order->payment_amount) }}</td>
				</tr>
			</tbody>
		</table>
	</div>

	<div class="row invoice-bottom">
		<div class="col-xs-12">
			<p>If you have any question. please contact us via email at:<br> support@gethype.co.id, or call us at: 021 1234 5678</p>
		</div>
	</div>
</body>