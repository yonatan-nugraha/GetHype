@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')
<div class="row-fluid banner-top no-padding">
    <div class="col-md-12 banner-row-1 no-padding">
        <div class="col-xs-12 no-padding">

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
                            <div class="banner-slider" style="background: url('{{ asset('images/banners/'.$carousel_banner->image()) }}') center center;"></div>
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

    <div class="row-fluid">
        <div class="col-md-12 no-padding">
            @foreach($small_banners as $small_banner)
            <a href="{{ $small_banner->link_url }}">
                <div class="col-xs-4 col-md-4 no-padding">
                    <img src="{{ asset('images/banners/'.$small_banner->image()) }}" class="img-responsive" alt="...">
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>

<div class="clearfix"></div>

<div class="search">
    <div class="container clearfix">
        <div class="row">
            <div class="col-md-12">
                <div class="row-fluid home-title">
                    <span>Find the Hype!</span>
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
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                <option value="{{ $event_type->id }}">{{ $event_type->name }}</option>
                                @endforeach
                            </select> 
                        </div>
                        <div class="form-group">
                            <span class="search-icon">
                                <i class="glyphicon glyphicon-map-marker"></i>
                            </span>
                            <select class="form-control search-location" name="location">
                                <option value="all">All Cities</option>
                                @foreach ($locations as $loc)
                                <option value="{{ $loc }}">{{ $loc }}</option>
                                @endforeach
                            </select>       
                        </div>
                        <div class="form-group">
                            <span class="search-icon">
                                <i class="glyphicon glyphicon-calendar"></i>
                            </span>
                            <input type="date" data-date="" data-date-format="DD MMMM YYYY" class="form-control search-date" name="date">
                        </div>
                        <div class="form-group">
                            <span class="search-icon">
                                <i class="glyphicon glyphicon-tag"></i>
                            </span>
                            <select class="form-control search-price" name="price">
                                <option value="all">All Price</option>
                                <option value="free">Free</option>
                                <option value="paid">Paid</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary search-submit">Search</button>
                    </form>
                </div>

                <div class="row gethype-line">
                    <img src="{{ asset('images/img-additional-2.png') }}">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12 whats-new">
    <div class="container">
        <div class="row home-title">
            <span>What's <br> New</span>
        </div>

        <div class="events">
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
            @if (count($events) > 8)
            <div class="view-more">
                <a href="{{ url('events/search') }}">view more</a>
            </div>
            @endif
        </div>
    </div>
</div>

@if (count($collections))
<div class="col-md-12 event-collection">
    <div class="container">
        <div class="row home-title">
            <span>Event <br> Collection</span>
        </div>

        <div class="events">
            <div class="row">
                @foreach ($collections as $collection)
                <div class="col-grid-5 collection-box">
                    <div class="thumbnail">
                        <a href="{{ url('/collections/'.$collection->slug) }}">
                            <div class="event-img-wrap">
                                <img class="event-image" src="{{ asset('/images/collections/'.$collection->image()) }}">
                            </div>
                        </a>
                    </div>
                    <div class="event-name">
                        <p class="event-title">{{ $collection->name }}</p>
                    </div>    
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif

<div class="col-md-12 banner-bottom no-padding">
    <div class="no-padding" id="banner-background">
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

        <div class="events">
            <div class="row">
                @foreach ($journals as $journal)
                <div class="col-grid-5 event-box journal-box">
                    <div class="thumbnail">
                        <a href="{{ url('/journals/'.$journal->slug) }}">
                            <div class="event-img-wrap">
                                <img class="event-image" src="{{ asset('/images/journals/'.$journal->image()) }}">
                            </div>
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

@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/home.js') }}"></script>
@endsection