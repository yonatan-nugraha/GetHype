@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/myevent-register.css') }}">
@endsection

@section('content')
<div class="register-success">
	<div class="container">
		<div class="row">
            <div class="col-sm-12">

				<h3>Register for the Event</h3>
				<p>Hi, let's register your ticket now. Make sure to re-check your ticket code before entering the code below.</p>

				<div class="form-group ticket-code">
					<div class="input-group">
	                    <h3>Ticket Code</h3>
	                    <form action="{{ url('myevents/'.$event->id.'/register') }}" method="POST">
						{!! csrf_field() !!}
		                    <input type="text" class="form-control ticket-code-input" name="code" value="{{ session('register')['code'] }}">
		                    <button class="btn btn-primary ticket-code-button" type="submit">Submit</button>
		                </form>
	                </div>
	            </div>
	        </div>
		</div>
	</div>
</div>

@if (session('register'))
<div class="register-info">
	<div class="container">
		@if (session('register')['success'] == '1')
		<div class="row">
			<div class="register-info-status">
				<img src="{{ asset('/images/icons/failed.png') }}" alt="" width="70" class="pull-left">
				<h3 class="register-info-title pull-left">Register Failed !!</h3>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
                <div class="register-info-failed">
					Sorry, your registration is failed. Please re-check your ticket code.<br> If there’s still some issues going on with your registration process, kindly contac us at 021-xxx. Thank you.
				</div>
			</div>
		</div>
		@elseif (session('register')['success'] == '2')
		<div class="row">
            <div class="col-sm-4 col-sm-offset-4">
                <div class="register-info-status">
                    <img src="{{ asset('/images/icons/success.png') }}" alt="" width="70" class="pull-left">
                    <h3 class="register-info-title pull-left">Register Success !!</h3>
                    <div class="clearfix"></div>
                </div>
                <div class="register-info-table">
                    <table class="table">
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td>{{ session('register')['name'] }}</td>
                        </tr>
                        <tr>
                            <td>Ticket</td>
                            <td>:</td>
                            <td>{{ session('register')['ticket_group'] }}</td>
                        </tr>
                        <tr>
                            <td>Ticket Code</td>
                            <td>:</td>
                            <td>{{ session('register')['code'] }}</td>
                        </tr>
                        <tr>
                            <td>Order Number</td>
                            <td>:</td>
                            <td>{{ session('register')['order_id'] }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        @endif
	</div>
</div>
@endif
	
@endsection