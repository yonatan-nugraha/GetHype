@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/checkout-failed.css') }}">
@endsection

@section('content')
<div class="container checkout-failed">
	<div class="row">
		<div class="panel">
		  	<div class="panel-heading"></div>
		  	<div class="panel-body">
		  		<div class="col-xs-12">
			  		<p class="checkout-failed-title">Checkout Failed!</p>
			    	<span class="checkout-failed-content">
			    		<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
			    		<p>Order Number #{{ $order->id }}. Your order is failed ...</p>
			    	</span>
		    	</div>
		  	</div>
		</div>
	</div>
</div>
@endsection