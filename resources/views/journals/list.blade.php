@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/journal-list.css') }}">
@endsection

@section('content')
<div class="col-md-12 no-padding main-banner" >
    <img src="{{ url('images/journals/banner-journal.jpg') }}">
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
                    	<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Archive <span class="caret"></span></button>
                		<ul class="dropdown-menu">
                  			<li><a href="#">Action</a></li>
                  			<li><a href="#">Another action</a></li>
                  			<li><a href="#">Something else here</a></li>
                  			<li role="separator" class="divider"></li>
                  			<li><a href="#">Separated link</a></li>
                		</ul>
                  	</div>
                  	<input type="text" class="form-control journal-search-input" >
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
</div>
@endsection