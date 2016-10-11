@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/event-collection.css') }}">
@endsection

@section('content')

<div class="container">
	<p>{{ $collection->name }}</p>
	<p>{{ $collection->description }}</p>
</div>

@endsection