@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/event-collection.css') }}">
@endsection

@section('content')
<div class="row-fluid">
    <div class="col-md-6">
        <div class="collection-content">
            <h1>{{ $collection->name }}</h1>

            <p>{!! nl2br(e($collection->description)) !!}</p>
        </div>
    </div>

    <div class="col-md-6 no-padding">
        <div class="image-right">
        	@foreach ($collection->event_collections as $event_collection)
            <div class="image-right-list">
                <img src="{{ asset('images/events/'.$event_collection->event->image()) }}" class="img-responsive" alt="">
                <div class="hover-button">
                    <h3>{{ $event_collection->event->name }}</h3>
                    <p>{{ Carbon\Carbon::parse($event_collection->event->started_at)->format('l, M d, Y | h.i A') }}</p>
                    <a href="{{ url('events/'.$event_collection->event->slug) }}" class="btn btn-hover">View Event</a> 
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection