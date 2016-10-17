@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/event-search.css') }}">
@endsection

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
                    <option value="all">All Categories</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if ($category_id == $category->id) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
                <select class="form-control search-type" name="event_type">
                    <option value="all">All Event Type</option>
                    @foreach ($event_types as $event_type)
                    <option value="{{ $event_type->id }}" @if ($event_type_id == $event_type->id) selected @endif>{{ $event_type->name }}</option>
                    @endforeach
                </select>
                <select class="form-control search-location" name="location">
                    <option value="all">All Cities</option>
                    @foreach ($locations as $loc)
                    <option value="{{ $loc }}" @if ($location == $loc) selected @endif>{{ $loc }}</option>
                    @endforeach
                </select>
                <div>
                    <input type="date" class="form-control search-date" name="date">
                </div>
                <select class="form-control search-price" name="price">
                    <option value="all">All Budgets</option>
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
            <div class="pull-right">
                {{ $events->links() }}
            </div>
        </div>
    </div>
</div>
@endsection