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
			    		<p>Sorry, your payment was failed. Please contact us at support@gethype.co.id or our customer service at 0819-5151-1154 to get further informations. Thank you.</p>
			    	</span>
		    	</div>
		  	</div>
		</div>
	</div>
</div>
@endsection