@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/event-collection.css') }}">
@endsection

@section('content')
<div class="row-fluid">
    <div class="col-md-6">
        <div class="collection-content">
            <h1>{{ $collection->name }}</h1>

            <p>{{ $collection->description }}</p>
        </div>
    </div>

    <div class="col-md-6 no-padding">
        <div class="image-right">
        	@foreach ($collection->event_collections as $event_collection)
            <a href="{{ url('events/'.$event_collection->event->slug) }}"><div class="image-right-list">
                <img src="{{ asset('images/events/'.$event_collection->event->image()) }}" class="img-responsive" alt="">
            </div></a>
            @endforeach
        </div>
    </div>
</div>

@endsection