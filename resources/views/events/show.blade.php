<style>
.banner-event img {
	width: 100%;
	max-height: 450px;
}

.event-title {
	margin-top: 40px;
	margin-bottom: 30px;
	font-size: 30px;
	font-weight: 600;
	line-height: 120%;
}

.event-main {
	margin-top: 30px;
	padding-bottom: 40px;
}

.event-name {
	color: #D33E40;
	font-size: 30px;
	font-weight: 500;
	line-height: 120%;
	margin-bottom: 20px;
}

.event-description {
	color: #000;
	font-weight: 300;
}

.event-share {
	margin-bottom: 30px;
}

.event-share-text {
	font-weight: 200;
	font-size: 12px;
}

.event-sosmed {
	height: 25px;
	margin-right: 15px;
}

.event-time-venue {
	color: red;
	font-size: 20px;
	font-weight: 200;
}

.event-date-line {
    border-color: red;
    border-width: thin;
    width: 30px;
    margin: 10px 0;
}

.event-date-end {
	margin-bottom: 20px;
}

.event-time {
	display: block;
	line-height: 70%;
}

.buy-ticket {
	margin-top: 30px;
}

.buy-ticket button {
	background-color: white;
	border-radius: 5px;
	border-color: #0F3844;
	padding: 5px 10px;
}

.event-subject {
    background: #D33E40 url("/images/banner-event.jpg");
    height: 450px;
    background-blend-mode: multiply;
    color: #fff;
    vertical-align: middle;
}

.event-subject-description {
	line-height: 200%;
	font-size: 14px;
	font-weight: 200;
	letter-spacing: 0.1em;
}

.event-guests {
	color: #0F3844;
	background-color: #F1F2F2;
	padding-bottom: 50px;
}

.event-guests .thumbnail {
	border-style: none;
	background-color: #F1F2F2;
	margin-bottom: 5px;
}

.event-guests img {
	border-radius: 120px;
	width: 200px;
}

.guest-caption {
	text-align: center;
}

.guest-name {
	font-weight: 600;
	margin: 0;
}

.guest-title {
	font-weight: 100;
	margin: 0;
}


</style>

@extends('layouts.app')

@section('content')

<div class="row banner-event">
    <img src="{{ asset('/images/banner-event.jpg') }}">
</div>

<div class="row event-main">
	<div class="container">
	    <div class="col-xs-12 col-md-6">
	    	<div class="event-share">
		    	<p class="event-share-text">Share with People</p>
		    	<img class="event-sosmed" src="{{ asset('/images/sosmed/bookmark.png') }}">
		    	<img class="event-sosmed" src="{{ asset('/images/sosmed/facebook.png') }}">
		    	<img class="event-sosmed" src="{{ asset('/images/sosmed/twitter.png') }}">
		    	<img class="event-sosmed" src="{{ asset('/images/sosmed/instagram.png') }}">
		    	<img class="event-sosmed" src="{{ asset('/images/sosmed/whatsapp.png') }}">
		    </div>
		    <div class="event-time-venue">
	    		<p class="event-date-start">{{ Carbon\Carbon::parse($event->started_at)->format('d // M') }}</p>
	    		<hr class="event-date-line" align="left">
	    		<p class="event-date-end">{{ Carbon\Carbon::parse($event->ended_at)->format('d // M') }}</p>
	    		<span class="event-time">
	    			{{ Carbon\Carbon::parse($event->started_at)->format('g:m A') }} -
	    			{{ Carbon\Carbon::parse($event->ended_at)->format('g:m A') }}
	    		</span>
	    		<span class="event-location">{{ $event->location }}</span>
	    	</div>
	    	<div class="buy-ticket">
	    		<button data-toggle="modal" data-target="#buy-ticket">Buy Ticket</button>
	    	</div>
	    </div>
	    <div class="col-xs-12 col-md-6">
	    	<p class="event-name">{{ $event->name }}</p>
	    	<p class="event-description">{!! nl2br(e($event->description)) !!}</p>
	    </div>
	</div>
</div>

<div class="row event-subject">
	<div class="container">
	    <div class="col-xs-12 no-padding">
	    	<p class="event-title">Subject <br>Discussion</p>
	        <span class="event-subject-description">
				•Pengertian mengenai digital marketing.<br>
				•Proses langkah-demi-langkah untuk menjalankan kampanye pemasaran di Google AdWords.<br>
				•Fitur kunci dan kemampuan Google AdWords.<br>
				•Navigasi melalui antarmuka pengguna Google AdWords.<br>
				•Cara mengatur account, kampanye iklan, dan Grup iklan di Google AdWords. •Strategi kata kunci dan tool <br>untuk membangun daftar kata kunci yang ditargetkan. •Cara untuk melacak kinerja iklan dalam Google AdWords.
				•Optimasi dan tips Google AdWords.<br>
				•Google AdWords tingkat lanjut.<br>
			</span>
	    </div>
    </div>
</div>

<div class="row event-guests">
	<div class="container">
	    <div class="col-xs-12 no-padding">
	    	<p class="event-title">Guest Speaker</p>

            <div class="row">
            	@foreach ($guests as $guest)
                <div class="col-xs-12 col-md-3 event-box">
                    <div class="thumbnail">
                        <a href="">
                            <img class="event-image" src="{{ asset('/images/guests/guest-'.$loop->index.'.png') }}">
                        </a>
                    </div>
                    <div class="guest-caption">
                        <p class="guest-name">{{ $guest }}</p>
                        <p class="guest-title">Orang Terkenal</p>
                    </div> 
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="buy-ticket" role="dialog">
    <div class="modal-dialog">
    
      	<!-- Modal content-->
      	<div class="modal-content">
        	<div class="modal-header">
          		<button type="button" class="close" data-dismiss="modal">&times;</button>
          		<h4 class="modal-title">Select Tickets</h4>
        	</div>
        	<form action="{{ url('events/'.$event->id.'/bookTicket') }}" method="POST">
                {!! csrf_field() !!}
                {{ method_field('PATCH') }}
	        	<div class="modal-body">
	        		<div class="panel panel-default">
					  	<div class="panel-body">
					  		@foreach ($event->ticket_groups as $ticket_group)
					  		<div class="col-xs-9">
			         			<p>{{ $ticket_group->name }}</p>
			         			<p>{{ 'Rp '. number_format($ticket_group->price) }}</p>
			         			<p>{{ 'Quota: '.count($ticket_group->tickets) }}</p>
		         			</div>
		         			<div class="col-xs-3">
			         			<select name="ticket_quantity_{{ $ticket_group->id }}">
			         				@for ($i = 1; $i <= 10; $i++)
			         					<option value="{{ $i }}">{{ $i }}</option>
			         				@endfor
			         			</select>
		         			</div>
		         			@endforeach
					  	</div>
					</div>
	        	</div>
	        	<div class="modal-footer">
	          		<button type="submit" class="btn btn-primary">Checkout</button>
	        	</div>
        	</form>
      	</div>
      
    </div>
</div>

@endsection