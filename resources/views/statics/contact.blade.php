@extends('layouts.app')

@section('styles')
	<link rel="stylesheet" type="text/css" href="{{ URL::to('css/contact.css') }}">
@stop

@section('content')

<div class="col-md-12 no-padding" class="contactContent">
	<div class="col-md-6 no-padding">
		<img src="{{ URL::to('images/contact/contact-banner-1.jpg') }}" class="banner">
	</div>
	<div class="col-md-6" id="firstContent">
		<h1>Contact</h1>
		<p id="description">Contact our customer service team at hello@gethype.com<br>
		or ring us at +62 819 515 1154 / +62 819 3205 81111<br>
		(Monday to Friday 09.00 - 18.00, GMT+7 - Jakarta)</p>
		<p>We'd be more than happy to assist you!</p>
	</div>
</div>

<div class="col-md-12 no-padding" class="contactContent">
	<div class="col-md-6" id="secondContent">
		<p>We'd be more than happy to assist you!</p>
		<div class="col-md-12 no-padding">
			<div class="row singleLine">
				<input type="text" name="" placeholder="Full Name" class="form-control">
			</div>
			<div class="row singleLine">
				<input type="email" name="" placeholder="Email" class="form-control">
			</div>
			<textarea placeholder="Subject" class="form-control" rows="5"></textarea>
		</div>
	</div>
	<div class="col-md-6 no-padding">
		<img src="{{ URL::to('images/contact/contact-banner-2.jpg') }}" class="banner">
	</div>
</div>

@stop