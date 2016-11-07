@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/event-search.css') }}">
@endsection

@section('content')
<div class="row banner-top">
    <div class="col-xs-12">

        <div id="big-carousel" class="carousel slide big-carousel" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach($carousel_banners as $carousel_banner)
                <li data-target="#big-carousel" data-slide-to="{{ $loop->index }}" class="@if ($loop->index == 0) active @endif"></li>
                @endforeach
            </ol>
            <div class="carousel-inner" role="listbox">
                @foreach($carousel_banners as $carousel_banner)
                <div class="item @if ($loop->index == 0) active @endif">
                    <a href="{{ $carousel_banner->link_url }}">
                        <img src="{{ asset('images/banners/'.$carousel_banner->image()) }}" alt="...">
                    </a>
                </div>
                @endforeach
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

<div class="search">
    <div class="container clearfix">
        <div class="row">
            <div class="col-md-12">
                <div class="row-fluid title">
                    <span>Find Your Happiness!</span>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="search-bar">
                    <form action="{{ url('events/search') }}" method="GET">
                        <div class="form-group">
                            <span class="search-icon">
                                <i class="glyphicon glyphicon-th-list"></i>
                            </span>
                            <select class="form-control search-category" name="category">
                                <option value="all">All Categories</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if (Request::get('category') == $category->id) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <span class="search-icon">
                                <i class="glyphicon glyphicon-bookmark"></i>
                            </span>
                            <select class="form-control search-type" name="event_type">
                                <option value="all">All Event Types</option>
                                @foreach ($event_types as $event_type)
                                <option value="{{ $event_type->id }}" @if (Request::get('event_type') == $event_type->id) selected @endif>{{ $event_type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <span class="search-icon">
                                <i class="glyphicon glyphicon-map-marker"></i>
                            </span>
                            <select class="form-control search-location" name="location">
                                <option value="all">All Cities</option>
                                @foreach ($locations as $location)
                                <option value="{{ $location }}" @if (Request::get('location') == $location) selected @endif>{{ $location }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <span class="search-icon">
                                <i class="glyphicon glyphicon-calendar"></i>
                            </span>
                            <input type="date" data-date="" data-date-format="DD MMMM YYYY" class="form-control search-date" name="date" value="{{ Request::get('date') }}">
                        </div>
                        <div class="form-group">
                            <span class="search-icon">
                                <i class="glyphicon glyphicon-tag"></i>
                            </span>
                            <select class="form-control search-price" name="price">
                                <option value="all">All Price</option>
                                <option value="free" @if (Request::get('price') == 'free') selected @endif>Free</option>
                                <option value="paid" @if (Request::get('price') == 'paid') selected @endif>Paid</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary search-submit">Search</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="row gethype-line">
            <img src="{{ asset('images/img-additional-2.png') }}">
        </div>
    </div>
</div>

<div class="events">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row-fluid events-title">
                    <span>Find Interesting Event in Jakarta!</span>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach ($events as $event)
            <div class="col-xs-12 col-sm-6 col-md-3 event-box">
                <div class="thumbnail">
                    <a href="{{ url('/events/'.$event->slug) }}">
                        <div class="event-img-wrap">
                            <img class="event-image" src="{{ asset('/images/events/'.$event->image()) }}">
                        </div>
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
        <nav class="paging">
            {{ $events->links() }}
        </nav>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/event.js') }}"></script>
@endsection