@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/about.css') }}">
@endsection

@section('content')
<div class="col-md-12 no-padding" id="mainBanner" style="background: url('{{ asset('images/about/about-header.jpg') }}') center center no-repeat;">
    	<div class="banner-title">
            <h1>Gethype is a one stop solution platform for you who likes to add and find some hype on
            your daily life. We provide you the lastest news about every hype that was going all
            around you and also works professionally making some event for you needs.</h1>
        </div>
</div>

<div class="col-md-10 col-md-offset-1" id="mainContent">
	
    <h2>What we do</h2>
    <br>

    <h4>1. Attractive</h4>

    In Gethype, we are providing you a platform not only for you to find some hype, but create

    one of it ! What makes us different is we are not only providing you a platform, but also a high

    quality design and system to assist your needs in finding or creating some hype.

    <h4>2. Flexible</h4>

    Events comes with no certain number of ages and people. Everyone could find and create

    any kind of events as their would. In Gethype, we had various kind of event, and it’s free for you

    to choose any kind of categories in our website.

    <h4>3. Professional</h4>

    We are ready to help you anytime you need some help to make an event or searching for

    some cool and fun events in Gethype. We provided you one of our service which is where you

    can consult with our event planner to had a joyfull and well planned event.
</div>
@endsection