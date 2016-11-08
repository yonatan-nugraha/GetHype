@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/about.css') }}">
@endsection

@section('content')
<div class="about-us">
    <div class="col-md-12 no-padding banner" style="background: url('{{ asset('images/about/about-banner.jpg') }}') center center no-repeat;">
        	<div class="banner-title">
                <h1>Gethype is a one stop solution platform for you who likes to add and find some hype on your daily life. We provide you the lastest news about every hype that was going all around you and also works professionally making some event for you needs.</h1>
            </div>
    </div>

    <div class="col-md-10 col-md-offset-1 content">
    	
        <h2>What we do</h2>
        <br>

        <h4>1. Attractive</h4>
        <p>In Gethype, we provide you a platform not only for you to find some hype, but to create one of it! What makes us different is we also facilitate a high quality design and system to assist your needs in finding or creating some hype.</p>

        <h4>2. Flexible</h4>
        <p>Events have no boundaries on the number of age and people. Everyone could find and create any kind of events as they would. In Gethype, we have various kind of events, and it is free for you to choose any kind of categories in our website.</p>

        <h4>3. Professional</h4>
        <p>We are ready to help you anytime, just as you need to create an event or simply to just look around for some cool and fun events in Gethype. We believe the key to success on creating an event lies on how well you prepare for it, so to be said, you can try consulting with our event planner to had a joyful and well planned event.</p>
    </div>
@endsection