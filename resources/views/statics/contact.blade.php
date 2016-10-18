@extends('layouts.app')

@section('styles')
	<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection

@section('content')
<div class="col-md-12 no-padding" class="contactContent">
	<div class="col-md-6 no-padding">
		<img src="{{ asset('images/contact/contact-banner-1.jpg') }}" class="banner">
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
				<input type="text" name="contact_first_name" placeholder="Name" class="form-control">
				<p class="contact-error" id="contact-first-name"></p>
			</div>
			<div class="row singleLine">
				<input type="email" name="contact_email" placeholder="Email" class="form-control">
				<p class="contact-error" id="contact-email"></p>
			</div>
			<div class="row singleLine">
				<input type="text" name="contact_subject" placeholder="Subject" class="form-control">
				<p class="contact-error" id="contact-subject"></p>
			</div>
			<div class="row singleLine">
				<textarea name="contact_content" placeholder="Message" class="form-control" rows="5"></textarea>
				<p class="contact-error" id="contact-content"></p>
			</div>
			<input type="hidden" name="contact_last_name">
			<input type="hidden" name="contact_phone">
			<button class="message-submit" id="contact">Send</button>
			<p class="contact-error" id="contact-error"></p>
		</div>
	</div>
	<div class="col-md-6 no-padding">
		<img src="{{ asset('images/contact/contact-banner-2.jpg') }}" class="banner">
	</div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/home.js') }}"></script>
@endsection