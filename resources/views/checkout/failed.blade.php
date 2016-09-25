<style>
body {
	background-color: #F1F2F2 !important;
}

.checkout-failed {
	margin-top: 50px;
	padding-bottom: 50px !important;
}

.checkout-failed .panel {
	border-radius: 0;
	border-color: #F1F2F2;
}

.checkout-failed .panel-heading {
	border-radius: 0;
	background-color: #0F3844;
}

.checkout-failed .panel-body {
	padding: 10px 0;
}

.checkout-failed-title {
	font-size: 25px;
	font-weight: 600;
}

.checkout-failed-content {
	font-size: 12px;
	font-weight: 300;
}

</style>

@extends('layouts.app')

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
