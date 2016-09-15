@extends('layouts.app')

@section('content')

<div class="container">
<form action="{{ url('checkout/pay') }}" method="POST">
    {!! csrf_field() !!}
	@foreach ($order_details as $order_detail)
	<p>{{ $order_detail->ticket_group->name }}</p>
	<p>{{ $order_detail->quantity }}</p>
	@endforeach
	<p>{{ $amount }}</p>
	<button class"btn btn-primary" type="submit">Place Order</button>
</form>
</div>


@endsection

