@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection

@section('content')
<div class="col-md-12 no-padding contact">
	<div class="col-md-6 no-padding left-side">
		<img src="{{ url('images/contact/contact-banner.jpg') }}">
	</div>
	<div class="col-md-6 right-side">
		<h1>Contact Us</h1>
		<p class="description">Hi! Need some help?<br>
            Please fill out this form below or contact us at:<br>
            Call center: 0819-5151-154<br>
            Monday - Friday (work hours)<br>
            Or email us at: support@gethype.co.id</p>
		<p>We'd be more than happy to assist you!</p>
        <div class="col-md-12 no-padding">
            <div class="row">
                <div class="form-group col-xs-12 col-sm-5 col-md-5">
                    <input type="text" name="contact_first_name" placeholder="Name" class="form-control">
                    <p class="contact-error" id="contact-first-name-error"></p>
                </div>
                <div class="form-group col-xs-12 col-sm-5 col-md-5">
                    <input type="email" name="contact_email" placeholder="Email" class="form-control">
                    <p class="contact-error" id="contact-email-error"></p>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-xs-12 col-sm-10 col-md-10">
                <input type="text" name="contact_subject" placeholder="Subject" class="form-control">
                <p class="contact-error" id="contact-subject-error"></p>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-xs-12 col-sm-10 col-md-10">
                <textarea name="contact_description" placeholder="Message" class="form-control" rows="5"></textarea>
                <p class="contact-error" id="contact-description-error"></p>
                </div>
            </div>
            <input type="hidden" name="contact_last_name" value="">
            <input type="hidden" name="contact_phone" value="">
            <button class="message-submit btn" id="contact">Send</button>
            <p class="contact-error" id="contact-error"></p>
        </div>
	</div>
</div>

<div class="after-effect message">
    <div class="after-effect-content">
    Your message has been sent
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/home.js') }}"></script>
@endsection