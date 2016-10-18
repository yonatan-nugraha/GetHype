<link rel="stylesheet" href="{{ asset('css/ticket-invoice.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-3.3.7-dist/css/bootstrap.min.css') }}">

<div class="row invoice-header">
	<div class="col-md-2 logo">
		<img src="{{ asset('images/logo-dark.png') }}">
	</div>
	<div class="col-md-4">
		<span>Jl. Surya Wahana Blok 3J No.2,
		Sunrise Garden, Jakarta Barat 11520</span>
	</div>
	<div class="col-md-3">
		<span>+62 819 5151 154
		+62 812 8149 5749</span>
	</div>
	<div class="col-md-3">
		<span>gethype.co.id</span>
	</div>
</div>

<div class="row invoice-contact">
	<p>Customer Detail</p>
	<table class="table">
		<tbody>
			<tr>
				<td>Name</td>
				<td>{{ $order->first_name . ' ' . $order->last_name }}</td>
				<td>Receipt Number</td>
				<td>{{ $order->id }}</td>
			</tr>
			<tr>
				<td>Email</td>
				<td>{{ $order->email }}</td>
				<td>Receipt Date</td>
				<td>{{ Carbon\Carbon::parse($order->created_at)->format('d M, Y') }}</td>
			</tr>
			<tr>
				<td>Phone</td>
				<td>{{ $order->phone }}</td>
				<td>Receipt Time</td>
				<td>{{ Carbon\Carbon::parse($order->created_at)->format('g.i A') }}</td>
			</tr>
		</tbody>
	</table>
</div>

<div class="row invoice-payment">
	<p>Payment Detail</p>
	<table class="table">
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
	<p>Purchase Detail</p>
	<table class="table">
		<thead>
			<tr>
				<th>No</th>
				<th>Event</th>
				<th>Ticket</th>
				<th>Qty</th>
				<th>Price per unit (Rp)</th>
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
				<td>{{ number_format($order_detail->ticket_group->price) }}</td>
				<td>{{ number_format($order_detail->quantity * $order_detail->ticket_group->price) }}</td>
			</tr>
			@endforeach
			<tr>
				<td colspan="4"></td>
				<td>Total (Rp)</td>
				<td>{{ number_format($order->order_amount) }}</td>
			</tr>
			<tr>
				<td colspan="4"></td>
				<td>Administration Fee</td>
				<td>{{ number_format($order->administration_fee) }}</td>
			</tr>
			<tr>
				<td colspan="4"></td>
				<td>Payment Amount</td>
				<td>{{ number_format($order->payment_amount) }}</td>
			</tr>
		</tbody>
	</table>
</div>

<div class="row invoice-bottom">
	<div class="col-xs-12">
		<p>If you have any question. please contact us via email at: support@gethype.co.id, or call us at: 021 1234 5678</p>
	</div>
</div>