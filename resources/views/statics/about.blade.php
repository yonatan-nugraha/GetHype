@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/about.css') }}">
@endsection

@section('content')
<div class="about-us">
    <div class="col-md-12 no-padding banner" style="background: url('{{ asset('images/about/about-banner.jpg') }}') center center no-repeat;">
        	<div class="banner-title">
                <h1>Gethype is a one stop solution platform for you who like to explore and create some hype on your daily life. We provide you with the latest news about every hype that is going all around you and also work professionally in assisting all your needs.</h1>
            </div>
    </div>

    <div class="col-md-10 col-md-offset-1 content">
    	
        <h2>What we do</h2>
        <br>

        <h4>1. Attractive</h4>
        <p>In Gethype, we provide you with a platform not only for you to find some hype, but to create one of it! What makes us different lies on our high quality design and system to ease your needs in finding or creating some hype.</p>

        <h4>2. Flexible</h4>
        <p>Events have no boundaries on the number of age and people. Everyone could find and create any kind of events as they would. In Gethype, we have various kind of events, and it is free for you to explore all of them according to your needs.</p>

        <h4>3. Professional</h4>
        <p>We are ready to help you anytime, just as you need to create an event or simply to just look around for some cool and fun events in Gethype.</p>
    </div>
@endsection