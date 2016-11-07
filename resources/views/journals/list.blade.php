@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/journal-list.css') }}">
@endsection

@section('content')
<div class="col-md-12 no-padding main-banner" style="background:url('{{ asset('images/journals/banner-journal.jpg') }}') center center no-repeat;">
    <div class="caption-banner">
        <p>We are inspiring one another by stories that we write in our journal.</p>
        <p>We bring you the joy of a blissful events that happen around us.</p>
    </div>
</div>

<div class="container">

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="form-group journal-search">
                <div class="input-group">
                  	<div class="input-group-btn">
                    	<div class="select">
                            <select class="form-control">
                                <option value="">Archive</option>
                                <option value="">Archive</option>
                                <option value="">Archive</option>
                            </select>
                            <span class="caret"></span>
                        </div>
                    </div>
                  	<input type="text" class="form-control journal-search-input" name="tag">
                  	<button class="btn btn-primary journal-search-button">Search</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row gethype-line">
        <img src="images/img-additional-2.png">
    </div>

    <div class="row">
    	@foreach ($journals as $journal)
        <div class="col-xs-12 col-sm-6 col-md-4">
            <div class="list-journal">
                <a href="{{ url('journals/'.$journal->slug) }}">
                    <div class="img">
                        <img src="{{ url('images/journals/'.$journal->image()) }}" class="img-responsive">
                    </div>
                    <div class="desc">
                        <p><span class="title">{{ $journal->tag }}</span> | <span class="date">Oct 3 2017</span></p>
                        <p>{{ $journal->title }}</p>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
    
    <nav class="paging"> 
        {{ $journals->links() }}
    </nav>
</div>
@endsection