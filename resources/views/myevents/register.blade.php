@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/myevent-register.css') }}">
@endsection

@section('content')
<div class="register-success">
	<div class="container">
		<div class="row">
            <div class="col-sm-12">

				<h3>Event Register !!</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

				<div class="form-group ticket-code">
					<div class="input-group">
	                    <h4>Ticket Code</h4>
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
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium, veniam vero. Esse facilis, ex totam quae. Nobis asperiores, a facilis consequuntur consectetur? Nisi, voluptate. Assumenda dignissimos mollitia repudiandae nulla. Sequi.
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