<style>
/**************************************/
/************ Home Title **************/
/**************************************/

.home-title {
    color: #0F3844;
    margin: 50px 0 15px; 
    font-weight: 700;
    font-size: 25px;
    line-height: 120%;
}

/**************************************/
/************* Search Bar *************/
/**************************************/

.search {
    background-color: #fff;
}

.search-bar {
    margin-bottom: 40px;
}

.search-bar select, .search-bar input {
    float: left;
    -webkit-appearance: none;
    border: 2px solid #0F3844;
    border-radius: 0px;
    color: #0F3844;
}

.search-category, .search-type {
    max-width: 20%;
}

.search-location, .search-date, .search-price {
    max-width: 15%;
}

.search-bar button {
    width: 15%;
    border-radius: 0;
    background-color: red;
    border-color: red;
}

::-webkit-input-placeholder {
    color: #0F3844;
}
:-moz-placeholder {
    color: #0F3844;
}
::-moz-placeholder {
    color: #0F3844;
}
:-ms-input-placeholder {
    color: #0F3844;
}

/**************************************/
/*********** Search Events ************/
/**************************************/

.search-events {
    background-color: #fff;
    padding-bottom: 30px;
}

.search-events .events {
    margin-bottom: 20px;
}

.search-events .event-box {
    cursor: pointer;
}

.search-events .event-box a {
    color: #000;
}

.search-events .event-box .thumbnail {
    padding: 0;
    border-radius: 0;
    border-style: none;
    background-color: #F1F2F2;
}

.search-events .event-box a:hover {
    text-decoration: none;
}

.search-events .event-caption {
    margin: 10px 15px;
    padding-bottom: 10px;   
}

.search-events .event-caption-head {
    margin-bottom: 7px;
}

.search-events .event-name {
    color: #0F3844;
}

.search-events .event-price {
    color: red;
    font-size: 12px;
    font-weight: 500;
}

.search-events .event-time {
    margin-top: 10px !important;
    font-weight: 100;
    font-size: 12px;
}

.search-events .event-tag {
    background-color: #E6E6E6;
    color: #000000;
    font-weight: 200;
    font-size: 8px;
}

/**************************************/
/*********** Banner Bottom ************/
/**************************************/

.no-padding-left {
    padding-left: 0 !important;
}

.no-padding-right {
    padding-right: 0 !important;
}

.banner-bottom {
	padding-bottom: 50px;
}

.banner-bottom .container {
	padding: 0;
}

.banner-bottom .thumbnail {
	border-style: none;
}

.banner-bottom .thumbnail img {
    max-height: 100%;
    max-width: 100%;
}

</style>

@extends('layouts.app')

@section('content')

<div class="row banner-top">
    <div class="col-xs-12">

        <div id="big-carousel" class="carousel slide big-carousel" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#big-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#big-carousel" data-slide-to="1"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="{{ asset('images/banners/banner-1.jpg') }}" alt="...">
                </div>
                <div class="item">
                    <img src="{{ asset('images/banners/banner-1.jpg') }}" alt="...">
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

<div class="row search">
    <div class="container">
        <div class="row home-title">
            <span>Find Your Happiness!</span>
        </div>
        
        <div class="row search-bar">
            <form action="{{ url('events/search') }}" method="GET">
                <select class="form-control search-category" name="category">
                    <option value="all">Event Category <span class="glyphicon glyphicon-menu-down"></span> </option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if ($category_id == $category->id) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
                <select class="form-control search-type" name="event_type">
                    <option value="all">Event Type</option>
                    @foreach ($event_types as $event_type)
                    <option value="{{ $event_type->id }}" @if ($event_type_id == $event_type->id) selected @endif>{{ $event_type->name }}</option>
                    @endforeach
                </select>
                <select class="form-control search-location" name="location">
                    <option value="all">Location</option>
                    @foreach ($locations as $loc)
                    <option value="{{ $loc }}" @if ($location == $loc) selected @endif>{{ $loc }}</option>
                    @endforeach
                </select>
                <div>
                    <input type="date" class="form-control search-date" name="date">
                </div>
                <select class="form-control search-price" name="price">
                    <option value="all">Price</option>
                    <option value="free" @if ($price == 'free') selected @endif>Free</option>
                    <option value="paid" @if ($price == 'paid') selected @endif>Paid</option>
                </select>
                <button type="submit" class="btn btn-primary search-submit">Search</button>
            </form>
        </div>

        <div class="row">
            <img class="gethype-line" src="{{ asset('images/img-additional-2.png') }}">
        </div>
    </div>
</div>

<div class="row search-events">
    <div class="container">
        <div class="row home-title">
            <span>Find Interesting Events Near You!</span>
        </div>

        <div class="row events">
            <div class="row">
                @foreach ($events as $event)
                <div class="col-xs-12 col-md-3 event-box">
                    <div class="thumbnail">
                        <a href="{{ url('/events/'.$event->slug) }}">
                            <img class="event-image" src="{{ asset('/images/events/event-'.$event->id.'.jpg') }}">
                            <div class="event-caption">
                                <div class="event-caption-head">
                                    <span class="event-name">{{ $event->name }}</span>
                                    <span class="event-price pull-right">Free</span>
                                </div>

                                <span class="event-time clearfix">{{ Carbon\Carbon::parse($event->started_at)->format('l, M d, Y | g.i A') }}</span>
                                <span class="label label-default event-tag">{{ $event->category->name }}</span>
                                <span class="label label-default event-tag">{{ $event->event_type->name }}</span>
                            </div>
                        </a>
                    </div>      
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="row banner-bottom">
    <div class="container">
    	<div class="col-md-6 col-xs-12 no-padding-left">
    		<a class="thumbnail">
    			<img src="{{ asset('images/banners/banner-7.jpg') }}">
    		</a>
    	</div>
    	<div class="col-md-6 col-xs-12 no-padding-right">
    		<a class="thumbnail">
    			<img src="{{ asset('images/banners/banner-8.jpg') }}">
    		</a>
    	</div>
    </div>
</div>


@endsection