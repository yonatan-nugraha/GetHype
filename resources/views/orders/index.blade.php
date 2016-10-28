@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/order-index.css') }}">
@endsection

@section('content')
<div class="container orders">
	<div class="row orders-content">
		<div class="col-xs-12 col-sm-4 orders-sidebar">
			<ul class="nav nav-pills nav-stacked">
				@foreach ($orders as $order)
			  	<li class="@if ($loop->first) active @endif">
			  		<a data-toggle="tab" href="#order-detail-{{ $order->id }}">
			  			<div class="col-xs-4 col-sm-12 col-md-4  thumbnail">
							<img src="{{ asset('/images/events/'.$order->event->image()) }}">
						</div>
						<div class="col-xs-8 col-sm-12 col-md-8">
							<p class="event-name">{{ $order->event->name }}</p>
							<p class="event-date">{{ Carbon\Carbon::parse($order->event->started_at)->format('l, M d, Y | g.i A') }}</p>
						</div>
						<span class="clearfix"></span>
			  		</a>
			  	</li>
			  	@endforeach
			</ul>
		</div>
		<div class="col-xs-12 col-sm-8 orders-detail">
			<div class="tab-content">
				@foreach ($orders as $order)
				<div class="tab-pane fade in @if ($loop->first) active @endif" id="order-detail-{{ $order->id }}">
					<div class="row row-1">
						<div class="col-xs-4 col-md-4 col-1">
							<p class="title">Ordered By:</p>
							<p class="description">{{ $order->first_name . ' ' . $order->last_name }}</p>
						</div>
						<div class="col-xs-4 col-2">
							<p class="title">Order Date:</p>
							<p class="description">{{ Carbon\Carbon::parse($order->created_at)->format('d M, Y') }}</p>
						</div>
						<div class="col-xs-4 col-3">
							<p class="title">Ordered Time:</p>
							<p class="description">{{ Carbon\Carbon::parse($order->created_at)->format('g.i A') }}</p>
						</div>
					</div>
					<div class="row row-2">
						<div class="col-xs-6 col-sm-3 col-1 payment-method">
							<p class="title">Payment Method:</p>
							<p class="description">@if ($order->payment_method == 'credit_card') Credit Card @elseif ($order->payment_method == 'bank_transfer') Virtual Account @else Free @endif</p>
						</div>
						<div class="col-xs-6 col-sm-6 ticket-type">
							<p class="title">Ticket:</p>
							<p class="description">
							@foreach ($order->order_details as $order_detail)
								<span>{{ $order_detail->quantity }}</span>
								<span>{{ $order_detail->ticket_group->name }}</span><br>
							@endforeach
							</p>
						</div>
						<div class="col-xs-6 col-sm-3 col-3 payment-ammount">
							<p class="title">Payment Amount:</p>
							<p class="description">{{ 'Rp '. number_format($order->payment_amount) }}</p>
						</div>
					</div>
					<div class="row row-3">
						<div class="col-xs-6 col-1">
							@if (in_array($order->payment_status, [4,5]))
							<img class="status-icon" src="{{ asset('/images/icons/success.png') }}">
							<p class="">Payment Success</p>
							@else
							<img class="status-icon" src="{{ asset('/images/icons/failed.png') }}">
							<p class="">Payment Failed</p>
							@endif
						</div>
						<div class="col-xs-6 col-2">
							@if ($order->order_status == 2)
							<img class="status-icon" src="{{ asset('/images/icons/success.png') }}">
							<p class="">Order Success</p>
							@else
							<img class="status-icon" src="{{ asset('/images/icons/success.png') }}">
							<p class="">Order Success</p>
							@endif
						</div>
					</div>
					<div class="row row-4">
						<div class="col-xs-12 col-1">
							<p class="title">Notes:</p>
							<p class="">
							@if (in_array($order->payment_status, [4,5]) && $order->order_status != 2)
							Your order failed. The transaction amount will be refunded to your bank account.
							@elseif (in_array($order->payment_status, [4,5]) && $order->order_status == 2)
							The transaction is success. You can check your ticket <a href="{{ url('tickets') }}">here</a>
							@elseif ($order->payment_status == 6 && $order->order_status == 2)
							Your transaction has been refunded.
							@endif
							</p>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>

	<div class="row orders-bottom">
		<div class="col-xs-12">
			<p>For any question, please email us at support@gethype.co.id, or you can call us at +62891238116</p>
		</div>
	</div>

</div>
@endsection