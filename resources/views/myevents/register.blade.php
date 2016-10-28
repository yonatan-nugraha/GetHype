@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/myevent-register.css') }}">
@endsection

@section('content')
<div class="row register-head">
	<div class="col-xs-12">
		<div class="container">
			<p class="title">Event Register !!</p>
			<p class="description">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>

			<p class="title">Ticket Code</p>
			<form action="{{ url('myevents/'.$event->id.'/register') }}" method="POST">
				{!! csrf_field() !!}
				<div class="input-group col-xs-6 register-form">
				   	<input type="text" class="form-control" name="code">
				   	<span class="input-group-btn">
				        <button class="btn btn-default" type="submit">Submit</button>
				   </span>
				</div>
			</form>
		</div>
	</div>
</div>

@if (session('register_success'))
<div class="row register-bottom">
	<div class="col-xs-12">
		<div class="container">
			@if (session('register_success') == '2')
			<p class="title">
				<img src="{{ asset('/images/icons/success.png') }}">
				Register Success
			</p>

			<p class="description">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>

			@else
			<p class="title">
				<img src="{{ asset('/images/icons/failed.png') }}">
				Register Failed
			</p>

			<p class="description">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
			@endif
		</div>
	</div>
</div>
@endif
	
@endsection
