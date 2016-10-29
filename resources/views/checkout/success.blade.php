@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/checkout-success.css') }}">
@endsection

@section('content')
<div class="container checkout-success">
	<div class="row">
		<div class="panel">
		  	<div class="panel-heading"></div>
		  	<div class="panel-body">
		  		<div class="col-xs-12">
			  		<p class="checkout-success-title">Checkout Success!
			  		<span class="event-share">Share:
		    			<a href="http://www.facebook.com/sharer/sharer.php?u={{ url('/events/'.$order->event->slug) }}" onclick="window.open(this.href,'targetWindow','toolbar=no,location=0,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=250'); return false;" target="_blank">
				    		<img class="event-sosmed" src="{{ asset('/images/icons/facebook.png') }}">
				    	</a>

				    	<a href="http://twitter.com/intent/tweet?text={{ urlencode($order->event->name . ' | Gethype' )}}&url={{ url('/events/'.$order->event->slug) }}&hashtags=Gethype&via=Gethype" onclick="window.open(this.href,'targetWindow','toolbar=no,location=0,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=450'); return false;" target="_blank">
				    		<img class="event-sosmed" src="{{ asset('/images/icons/twitter.png') }}">
				    	</a>
		    		</span>
			  		</p>
			    	<span class="checkout-success-content">
			    		@if ($order->payment_method == 'bank_transfer' && $order->order_status == 1)
			    		<p>Congrats, your checkout is success. Please go to <a href="{{ url('orders') }}">My Order</a> Page to see your order details. Thank you.</p>
			    		@else
			    		<p>Congrats, your checkout is success. Please check your email to get the tickets and go to <a href="{{ url('orders') }}">My Order</a> Page to see your order details. Thank you.</p>
			    		@endif
			    	</span>
		    	</div>
		  	</div>
		</div>
	</div>
</div>
@endsection