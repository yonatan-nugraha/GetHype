<style>
/**************************************/
/************* Banner Top *************/
/**************************************/

.banner-1, .banner-2, .banner-3, .banner-4 {
    padding-left: 0 !important;
}

.banner-1 .thumbnail, .banner-2 .thumbnail, .banner-3 .thumbnail, .banner-4 .thumbnail {
    padding: 0 !important;
}

.no-padding {
    padding: 0 !important;
}

/**************************************/
/************* Home Title *************/
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
    background-color: #F1F2F2;
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

.search-bar button:hover {
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
/************* What's New *************/
/**************************************/

.whats-new {
    background-color: #F1F2F2;
    padding-bottom: 30px;
}

.whats-new .events {
    margin-bottom: 20px;
}

.whats-new .event-box {
    cursor: pointer;
}

.whats-new .event-box a {
    color: #000;
}

.whats-new .event-box .thumbnail {
    padding: 0;
    border-radius: 0;
    border-style: none;
}

.whats-new .event-box a:hover {
    text-decoration: none;
}

.whats-new .event-caption {
    margin: 10px 15px;
    padding-bottom: 10px;
}

.whats-new .event-caption-head {
    margin-bottom: 7px;
}

.whats-new .event-name {
    color: #0F3844;
}

.whats-new .event-price {
    color: red;
    font-size: 12px;
    font-weight: 500;
}

.whats-new .event-time {
    margin-top: 10px !important;
    font-weight: 100;
    font-size: 12px;
}

.whats-new .event-tag {
    background-color: #E6E6E6;
    color: #000000;
    font-weight: 200;
    font-size: 8px;
}


/**************************************/
/*********** Event Collection *********/
/**************************************/

.event-collection {
    background-color: #fff;
}

.event-collection .events{
    margin-bottom: 70px;
}

.event-collection .thumbnail {
    padding: 0;
    border-radius: 0;
    border-style: none;
}

.event-collection .event-image {
    width: 100%;
}

.event-collection .event-name {
    border: 1px solid #EBD38C;
    padding: 18px;
    text-align: center;
    color: #0F3844;
    font-weight: 500;
    font-size: 20px;
}

/**************************************/
/************** Journal ***************/
/**************************************/

.journal{
    background-color: #F1F2F2;
}

.journal .events {
    margin-bottom: 50px;
}

.journal .event-box {
    cursor: pointer;
}

.journal .thumbnail {
    padding: 0;
    border-radius: 0;
    border-style: none;
}

.journal .event-image {
    width: 100%;
}

.journal .event-caption {
    margin: 10px 15px;
}

.journal .event-name {
    text-transform: uppercase;
    color: #0F3844;
    font-weight: 500;
    font-size: 13px;
}

.journal .event-description {
    text-overflow: ellipsis;
    max-width: 170px;
    overflow: hidden; 
    white-space: nowrap;
    display: inline-block;
    font-weight: 100;
    font-size: 12px;
    color: #000000;
    margin-bottom: 10px;
}

.journal .event-read {
    color: red;
    font-weight: 400;
}

/**************************************/
/************* Banner Bottom **********/
/**************************************/

.banner-bottom .banner-additional {
    z-index: 100;
    position: absolute;
    top: 32%;
    left: 30%;

}

.banner-bottom .banner-title {
    z-index: 100;
    position: absolute;
    color: #EBD38C;
    font-size: 32px;
    font-weight: 300;
    padding: 24px;
    border: 1px solid #EBD38C;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.banner-bottom .banner-description {
    z-index: 100;
    position: absolute;
    color: #EBD38C;
    font-size: 15px;
    font-weight: 200;
    top: 70%;
    left: 59%;
    transform: translate(-70%, -59%);
}

</style>

@extends('layouts.app')

@section('content')

<div class="row banner-top">
    <div class="row banner-row-1">
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

    <div class="row banner-row-2">
        <div class="col-xs-12 col-md-5 no-padding">
            <div id="small-carousel" class="carousel slide small-carousel" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#small-carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#small-carousel" data-slide-to="1"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="{{ asset('images/banners/banner-2.jpg') }}" alt="...">
                    </div>
                    <div class="item">
                        <img src="{{ asset('images/banners/banner-2.jpg') }}" alt="...">
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
        <div class="col-xs-12 col-md-7 no-padding">
            <div class="col-xs-12 col-md-6 no-padding">
                <img src="{{ asset('images/banners/banner-3.jpg') }}" alt="...">
            </div>
            <div class="col-xs-12 col-md-6 no-padding">
                <img src="{{ asset('images/banners/banner-4.jpg') }}" alt="...">
            </div>
            <div class="col-xs-12 col-md-6 no-padding">
                <img src="{{ asset('images/banners/banner-5.jpg') }}" alt="...">
            </div>
            <div class="col-xs-12 col-md-6 no-padding">
                <img src="{{ asset('images/banners/banner-6.jpg') }}" alt="...">
            </div>
            </div>
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
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <select class="form-control search-type" name="event_type">
                    <option value="all">Event Type</option>
                    @foreach ($event_types as $event_type)
                    <option value="{{ $event_type->id }}">{{ $event_type->name }}</option>
                    @endforeach
                </select>
                <select class="form-control search-location" name="location">
                    <option value="all">Location</option>
                    @foreach ($locations as $loc)
                    <option value="{{ $loc }}">{{ $loc }}</option>
                    @endforeach
                </select>
                <div>
                    <input type="date" class="form-control search-date" name="date">
                </div>
                <select class="form-control search-price" name="price">
                    <option>Price</option>
                    <option>Free</option>
                    <option>Paid</option>
                </select>
                <button type="submit" class="btn btn-primary search-submit">Search</button>
            </form>
        </div>

        <div class="row">
            <img class="gethype-line" src="{{ asset('images/img-additional-2.png') }}">
        </div>
    </div>
</div>

<div class="row whats-new">
    <div class="container">
        <div class="row home-title">
            <span>What's <br> New</span>
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

<div class="row event-collection">
    <div class="container">
        <div class="row home-title">
            <span>Event <br> Collection</span>
        </div>

        <div class="row events">
            <div class="row">
                @foreach ($collections as $collection)
                <div class="col-xs-12 col-md-3 event-box">
                    <div class="thumbnail">
                        <a href="{{ url('/events/'.$collection->slug) }}">
                            <img class="event-image" src="{{ asset('/images/collections/collection-'.$collection->id.'.jpg') }}">
                        </a>
                    </div>
                    <div class="event-name">
                        <span>Body, Soul, & Spirit</span>
                    </div>    
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="row banner-bottom">
    <div class="col-xs-12 no-padding">
        <img src="{{ asset('/images/img-event-planner.jpg') }}">
        <img class="banner-additional" src="{{ asset('/images/img-additional-1.png') }}">
        <p class="banner-title">Create Your Event with Gethype</p>
        <span class="banner-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span>
    </div>
</div>

<div class="row journal">
    <div class="container">
        <div class="row home-title">
            <span>Gethype <br> Journal</span>
        </div>

        <div class="row events">
            <div class="row">
                @foreach ($journals as $journal)
                <div class="col-xs-12 col-md-3 event-box">
                    <div class="thumbnail">
                        <a href="{{ url('/events/'.$journal->slug) }}">
                            <img class="event-image" src="{{ asset('/images/journals/journal-'.$journal->id.'.jpg') }}">
                            <div class="event-caption">
                                <p class="event-name">What a Summer Festival in Jakarta</p>
                                <span class="event-description">{{ $journal->description }}</span>
                                <span class="event-read pull-right">Read</span>
                            </div>
                        </a>
                    </div>      
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

</div>
@endsection
