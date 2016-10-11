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
			  		<p class="checkout-success-title">Checkout Success!</p>
			    	<span class="checkout-success-content">
			    		<p>We have sent a confirmation email to {{ Auth::user()->email }}</p>
			    		<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
			    		<p>Order Number #{{ $order->id }}. For detail of your ticket purchase, please check <a href="{{ url('tickets') }}" target="_blank">here</a></p>
			    	</span>
		    	</div>
		  	</div>
		</div>
	</div>
</div>
@endsection