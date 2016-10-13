@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')
<div class="col-md-12 banner-top no-padding">
    <div class="col-md-12 banner-row-1 no-padding">
        <div class="col-xs-12 no-padding">

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

    <div class="col-md-12 banner-row-2 no-padding">
        <div class="col-xs-12 col-md-4 no-padding">
            <img src="{{ asset('images/banners/small-banner-1.jpg') }}" alt="...">
        </div>
        <div class="col-xs-12 col-md-4 no-padding">
            <img src="{{ asset('images/banners/small-banner-2.jpg') }}" alt="...">
        </div>
        <div class="col-xs-12 col-md-4 no-padding">
            <img src="{{ asset('images/banners/small-banner-3.jpg') }}" alt="...">
        </div>
    </div>
</div>

<div class="col-md-12 search">
    <div class="container">
        <div class="row home-title">
            <span>Find the Hype!</span>
        </div>
        
        <div class="row search-bar">
            <form action="{{ url('events/search') }}" method="GET">
                <select class="form-control search-category" name="category">
                    <option value="all">All Categories</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <select class="form-control search-type" name="event_type">
                    <option value="all">All Event Types</option>
                    @foreach ($event_types as $event_type)
                    <option value="{{ $event_type->id }}">{{ $event_type->name }}</option>
                    @endforeach
                </select>
                <select class="form-control search-location" name="location">
                    <option value="all">All Cities</option>
                    @foreach ($locations as $loc)
                    <option value="{{ $loc }}">{{ $loc }}</option>
                    @endforeach
                </select>
                <div>
                    <input type="date" class="form-control search-date" name="date">
                </div>
                <select class="form-control search-price" name="price">
                    <option value="all">All Price</option>
                    <option value="free">Free</option>
                    <option value="paid">Paid</option>
                </select>
                <button type="submit" class="btn btn-primary search-submit">Search</button>
            </form>
        </div>

        <div class="row gethype-line">
            <img src="{{ asset('images/img-additional-2.png') }}">
        </div>
    </div>
</div>

<div class="col-md-12 whats-new">
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
                            <img class="event-image" src="{{ asset('/images/events/'.$event->image()) }}">
                            <div class="event-caption">
                                <div class="event-caption-head">
                                    <span class="event-name">{{ $event->name }}</span>
                                </div>
                                <span class="event-time clearfix">{{ Carbon\Carbon::parse($event->started_at)->format('l, M d, Y | g.i A') }}</span>
                                <p class="event-price">
                                    @if ($event->min_price == 0 && $event->max_price == 0) Free
                                    @elseif ($event->min_price == 0 && $event->max_price > 0) IDR {{ $event->max_price/1000 . 'K' }} 
                                    @else IDR {{ $event->min_price/1000 . 'K' }} 
                                    @endif 
                                </p>
                                <span class="label label-default event-tag">{{ $event->category->name }}</span>
                                <span class="label label-default event-tag">{{ $event->event_type->name }}</span>
                            </div>
                        </a>
                    </div>      
                </div>
                @endforeach
            </div>
            <div class="view-more">
                <a href="{{ url('events/search') }}">view more</a>
            </div>
        </div>
    </div>
</div>

@if (count($collections))
<div class="col-md-12 event-collection">
    <div class="container">
        <div class="row home-title">
            <span>Event <br> Collection</span>
        </div>

        <div class="row events">
            <div class="row">
                @foreach ($collections as $collection)
                <div class="col-xs-12 col-md-3 event-box">
                    <div class="thumbnail">
                        <a href="{{ url('/collections/'.$collection->slug) }}">
                            <img class="event-image" src="{{ asset('/images/collections/'.$collection->image()) }}">
                        </a>
                    </div>
                    <div class="event-name">
                        <span>{{ $collection->name }}</span>
                    </div>    
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif

<div class="col-md-12 banner-bottom no-padding">
    <div class="col-xs-12 no-padding" id="bottomBanner">
        <div class="first"><img class="banner-additional" src="{{ asset('/images/img-additional-1.png') }}"></div>
        <a href="{{ url('services') }}"><p class="banner-title">Create Your Event with Gethype</p></a>
        <div class="banner-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
    </div>
</div>

@if (count($journals))
<div class="col-md-12 journal">
    <div class="container">
        <div class="row home-title">
            <span>Gethype <br> Journal</span>
        </div>

        <div class="row events">
            <div class="row">
                @foreach ($journals as $journal)
                <div class="col-xs-12 col-md-3 event-box">
                    <div class="thumbnail">
                        <a href="{{ url('/journals/'.$journal->slug) }}">
                            <img class="event-image" src="{{ asset('/images/journals/'.$journal->image()) }}">
                            <div class="event-caption">
                                <p class="event-name">{{ $journal->title }}</p>
                                <span class="event-description">{{ strip_tags($journal->content) }}</span>
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
@endif

</div>
@endsection
