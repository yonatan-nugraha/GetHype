@extends('layouts.app')

@section('content')

<div class="container">
	<p>Checkout success! Has been send to {{ Auth::user()->email }}</p>
	@foreach ($order_details as $order_detail)
	<p>{{ $order_detail->quantity }}</p>
	@endforeach
</div>

@endsection
