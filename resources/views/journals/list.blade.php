@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/journal-list.css') }}">
@endsection

@section('content')
<div class="col-md-12 no-padding main-banner" style="background:url('{{ asset('images/journals/banner-journal.jpg') }}') center center no-repeat;">
    <div class="caption-banner">
        <p>We inspire one another by stories that we write in our journal.</p>
        <p>We bring you the joy of a blissful events that happen around us.</p>
    </div>
</div>

<div class="container journals">

    <div class="row">
        <div class="col-sm-12 col-md-8">
            <form action="{{ url('journals') }}" method="GET">
                <div class="form-group journal-search">
                    <div class="input-group">
                      	<div class="input-group-btn">
                        	<div class="select">
                                <select class="form-control" name="archive">
                                    <option value="all">Archive</option>
                                    <option value="12">December</option>
                                    <option value="11">November</option>
                                    <option value="10">October</option>
                                    <option value="9">September</option>
                                    <option value="8">August</option>
                                    <option value="7">July</option>
                                    <option value="6">June</option>
                                    <option value="5">May</option>
                                    <option value="4">April</option>
                                    <option value="3">March</option>
                                    <option value="2">February</option>
                                    <option value="1">January</option>
                                </select>
                                <span class="caret"></span>
                            </div>
                        </div>
                      	<input type="text" class="form-control journal-search-input" name="tag">
                      	<button class="btn btn-primary journal-search-button">Search</button>
                    </div>
                </div>
            </form>
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
                        <p><span class="title">{{ $journal->tag }}</span> <span class="date">| {{ Carbon\Carbon::parse($journal->created_at)->format('M d, Y') }}</span></p>
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