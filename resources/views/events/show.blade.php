<style>
/**************************************/
/*************** Banner ***************/
/**************************************/

.banner-event img {
	width: 100%;
	max-height: 450px;
}

/**************************************/
/*********** Event Detail *************/
/**************************************/

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

.event-date-start, .event-date-end {
	font-size: 22px;
	font-weight: 400;
}

.event-date {
	margin-bottom: 15px;
}

.event-time {
	display: block;
	line-height: 70%;
	font-size: 17px;
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

/**************************************/
/*********** Event Subject ************/
/**************************************/

.event-subject {
    background: #D33E40 url("/images/banners/banner-event.jpg");
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

/**************************************/
/*********** Event Guests *************/
/**************************************/

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

/**************************************/
/************ Buy Ticket **************/
/**************************************/

#buy-ticket .modal-header {
	
}

#buy-ticket .modal-body {
	color: #0F3844;
	min-height: 200px;
}

#buy-ticket form {
	margin: 0;
}

#buy-ticket .ticket-row {
	margin: 10px 0;
}

#buy-ticket .modal-title {
	text-align: center;
	font-size: 17px;
	font-weight: 400;
}

#buy-ticket .modal-footer {
	background-color: #0F3844;
	text-align: left;
}

.ticket-name {
	font-size: 13px;
	font-weight: 400;
}

.ticket-price {
	font-size: 12px;
	font-weight: 300;
}

.ticket-quantity {
	font-size: 12px;
}

.ticket-total {
	font-size: 12px;
	font-weight: 300;
}

.ticket-grand-total {
	color: #fff;
	margin-top: 10px;
}

.ticket-submit {
    border-radius: 0 !important;
    background-color: #0F3844 !important;
    border-color: #0F3844 !important;
    color: #EBD38C !important;
    font-size: 15px !important;
}

</style>

@extends('layouts.app')

@section('content')

<div class="row banner-event">
    <img src="{{ asset('/images/banners/banner-event.jpg') }}">
</div>

<div class="row event-main">
	<div class="container">
	    <div class="col-xs-12 col-md-6">
	    	<div class="event-share">
		    	<p class="event-share-text">Share with People</p>
		    	<img class="event-sosmed" src="{{ asset('/images/icons/bookmark.png') }}">
		    	<img class="event-sosmed" src="{{ asset('/images/icons/facebook.png') }}">
		    	<img class="event-sosmed" src="{{ asset('/images/icons/twitter.png') }}">
		    	<img class="event-sosmed" src="{{ asset('/images/icons/instagram.png') }}">
		    </div>
		    <div class="event-time-venue">
		    	<div class="event-date">
		    		<p class="event-date-start">{{ Carbon\Carbon::parse($event->started_at)->format('d // M') }}</p>
		    		@if (Carbon\Carbon::parse($event->started_at)->format('d // M') != Carbon\Carbon::parse($event->ended_at)->format('d // M'))
		    		<hr class="event-date-line" align="left">
		    		<p class="event-date-end">{{ Carbon\Carbon::parse($event->ended_at)->format('d // M') }}</p>
		    		@endif
		    	</div>
	    		<div class="event-time">
	    			<span>{{ Carbon\Carbon::parse($event->started_at)->format('g:m A') }} </span>
	    			@if (Carbon\Carbon::parse($event->started_at)->format('g:m A') != Carbon\Carbon::parse($event->ended_at)->format('g:m A'))
	    			<span> - {{ Carbon\Carbon::parse($event->ended_at)->format('g:m A') }}</span>
	    			@endif
	    		</div>
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
          		<h4 class="modal-title">{{ $event->name }}</h4>
        	</div>
        	<form action="{{ url('events/'.$event->id.'/bookTicket') }}" method="POST">
                {!! csrf_field() !!}
                {{ method_field('PATCH') }}
	        	<div class="modal-body">
			  		@foreach ($event->ticket_groups as $ticket_group)
			  		<input type="hidden" id="ticket-price-{{ $ticket_group->id }}" value="{{ $ticket_group->price }}">
			  		<div class="row ticket-row">
				  		<div class="col-xs-3">
		         			<p class="ticket-name">{{ $ticket_group->name }}</p>
		         		</div>
		         		<div class="col-xs-3">
		         			<p class="ticket-price">{{ 'Rp '. number_format($ticket_group->price) }}</p>
		         		</div>
	         			<div class="col-xs-3">QTY 
		         			<select class="ticket-quantity" id="{{ $ticket_group->id }}" name="ticket_quantity_{{ $ticket_group->id }}">
		         				@for ($i = 1; $i <= 10; $i++)
		         					<option value="{{ $i }}">{{ $i }}</option>
		         				@endfor
		         			</select>
	         			</div>
	         			<div class="col-xs-3">
		         			<p class="ticket-total" id="ticket-total-{{ $ticket_group->id }}">{{ 'Rp '. number_format($ticket_group->price) }}</p>
	         			</div>
	         		</div>
         			@endforeach
			  	</div>
	        	<div class="modal-footer">
	        		<div class="col-xs-9">
	          			<button type="submit" class="btn btn-primary ticket-submit">Checkout</button>
	          		</div>
	          		<div class="col-xs-3">
	          			<p class="ticket-grand-total"></p>
	          		</div>
	        	</div>
        	</form>
      	</div>
      
    </div>
</div>

@endsection