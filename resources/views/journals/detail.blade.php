@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/journal-detail.css') }}">
@endsection

@section('content')
<div class="container">
{!! $journal->content !!}
</div>
@endsection