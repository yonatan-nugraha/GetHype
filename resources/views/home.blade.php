<style>
.banner-row-1 {
    margin-bottom: 15px;
}

.small-carousel img {
    height: 535px !important;
}

.banner-1, .banner-2, .banner-3, .banner-4 {
    padding-left: 0 !important;
}

.banner-1 .thumbnail, .banner-2 .thumbnail, .banner-3 .thumbnail, .banner-4 .thumbnail {
    padding: 0 !important;
}

.home-title {
    margin-top: 30px; 
    text-transform: uppercase; 
    letter-spacing: 0.2em; 
    text-align: center;
    font-weight: 300;
    font-size: 20px;
}

.home-title h3 {
    margin-bottom: 0px;
}

.home-title:after {
    border-bottom: 3px solid #000;
    width: 30px;
    margin: 5px auto;
}

.events {
    width: 90%;
    text-align: center; 
    margin: 20px auto !important;
    transition: 1s;
}

.events .event-box {
    cursor: pointer;
}

.events .event-box a {
    color: #000;
}

.events .event-box a:hover {
    text-decoration: none;
}

.events .event-name {
    margin: 5px 0 0 0;
    text-transform: uppercase;
    font-weight: 300;
}

</style>

@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row banner-row-1">
        <div class="col-xs-12">

            <div id="big-carousel" class="carousel slide big-carousel" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#big-carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#big-carousel" data-slide-to="1"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="{{ asset('images/banner2.jpg') }}" alt="...">
                    </div>
                    <div class="item">
                        <img src="{{ asset('images/banner2.jpg') }}" alt="...">
                    </div>
                </div>
                <a class="left carousel-control" href="#big-carousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#big-carousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

        </div>
    </div>

    <div class="row banner-row-2">
        <div class="col-xs-4">

            <div id="small-carousel" class="carousel slide small-carousel" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#small-carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#small-carousel" data-slide-to="1"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="{{ asset('images/banner3.jpg') }}" alt="...">
                    </div>
                    <div class="item">
                        <img src="{{ asset('images/banner3.jpg') }}" alt="...">
                    </div>
                </div>
                <a class="left carousel-control" href="#small-carousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#small-carousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

        </div>
        <div class="col-xs-4 banner-1">
            <div class="thumbnail">
                <img src="{{ asset('images/banner4.jpg') }}" alt="...">
            </div>
        </div>
        <div class="col-xs-4 banner-2">
            <div class="thumbnail">
                <img src="{{ asset('images/banner4.jpg') }}" alt="...">
            </div>
        </div>
        <div class="col-xs-4 banner-3">
            <div class="thumbnail">
                <img src="{{ asset('images/banner4.jpg') }}" alt="...">
            </div>
        </div>
        <div class="col-xs-4 banner-4">
            <div class="thumbnail">
                <img src="{{ asset('images/banner4.jpg') }}" alt="...">
            </div>
        </div>
    </div>

    <div class="row home-title">
        <span>What's New</span>
    </div>

    <div class="row events">
        <div class="row">
            @foreach ($events as $event)
            <div class="col-xs-6 col-md-3 event-box">
                <div class="thumbnail">
                    <a href="{{ url('/event/'.$event->slug) }}">
                        <img src="{{ asset('/images/event'.$event->id.'.png') }}">
                        <p class="event-name">{{ $event->name }}</p>
                    </a>
                </div>      
            </div>
            @endforeach
        </div>
    </div>

    <div class="row home-title">
        <span>What's New</span>
    </div>

    <div class="row events">
        <div class="row">
            @foreach ($events as $event)
            <div class="col-xs-6 col-md-3 event-box">
                <div class="thumbnail">
                    <a href="{{ url('/event/'.$event->slug) }}">
                        <img src="{{ asset('/images/event'.$event->id.'.png') }}">
                        <p class="event-name">{{ $event->name }}</p>
                    </a>
                </div>      
            </div>
            @endforeach
        </div>
    </div>

</div>
@endsection
