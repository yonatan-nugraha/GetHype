@extends('layouts.app')

@section('content')

<div class="container">
	<p>{{ $collection->name }}</p>
	<p>{{ $collection->description }}</p>
</div>

@endsection