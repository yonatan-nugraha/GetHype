@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/event-detail.css') }}">
@endsection

@section('metas')
<meta property="og:url" content="{{ Request::url() }}" />
<meta property="og:type" content="event" />
<meta property="og:title" content="{{ $event->name . ' | Gethype' }}" />
<meta property="og:description" content="Lorem ipsum dolor sit amet, propriae mnesarchum deterruisset sea ei. Te sit oportere theophrastus, sea an invidunt deterruisset. Atqui viris consequuntur per te, est quot adversarium eu. Malis deleniti pertinacia te quo, vim id libris epicurei adversarium. Putant causae ne mei, sumo bonorum mei te." />
<meta property="og:image" content="{{ asset('/images/events/event-'.$event->id.'.jpg') }}" />

<meta name="twitter:card" content="event" />
<meta name="twitter:site" content="@Gethype" />
<meta name="twitter:title" content="{{ $event->name . ' | Gethype' }}" />
<meta name="twitter:description" content="Lorem ipsum dolor sit amet, propriae mnesarchum deterruisset sea ei. Te sit oportere theophrastus, sea an invidunt deterruisset. Atqui viris consequuntur per te, est quot adversarium eu. Malis deleniti pertinacia te quo, vim id libris epicurei adversarium. Putant causae ne mei, sumo bonorum mei te." />
<meta name="twitter:image" content="{{ asset('/images/events/event-'.$event->id.'.jpg') }}" />
@endsection

@section('content')

<div class="row banner-event">
    <img src="{{ asset('/images/events/'.$event->banner()) }}">
</div>

<div class="row event-main">
	<div class="container">
	    <div class="col-xs-12 col-md-6">
	    	<div class="event-share">
		    	<p class="event-share-text">Share with People</p>
		    	<a class="add-bookmark" id="{{ $event->id }}"><img class="event-sosmed" src="{{ asset('/images/icons/bookmark.png') }}"></a>
		    	<a href="http://www.facebook.com/sharer/sharer.php?u={{ url('/events/'.$event->slug) }}" onclick="window.open(this.href,'targetWindow','toolbar=no,location=0,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=250'); return false;" target="_blank">
		    		<img class="event-sosmed" src="{{ asset('/images/icons/facebook.png') }}">
		    	</a>

		    	<a href="http://twitter.com/intent/tweet?text={{ urlencode($event->name . ' | Gethype' )}}&url={{ url('/events/'.$event->slug) }}&hashtags=Gethype&via=Gethype" onclick="window.open(this.href,'targetWindow','toolbar=no,location=0,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=450'); return false;" target="_blank">
		    		<img class="event-sosmed" src="{{ asset('/images/icons/twitter.png') }}">
		    	</a>
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
	    		<span class="event-location">{!! nl2br(e($event->location)) !!}</span>
	    	</div>
	    	<div class="buy-ticket">
	    		@if (count($event->ticket_groups) > 0)
	    		<button class="btn" data-toggle="modal" data-target="#buy-ticket">Buy Ticket</button>
	    		@else
	    		<button>Free</button>
	    		@endif
	    	</div>
	    </div>
	    <div class="col-xs-12 col-md-6">
	    	<p class="event-name">{{ $event->name }}</p>
	    	<p class="event-description">{!! nl2br(e($event->description)) !!}</p>
	    </div>
	</div>
</div>

<div class="row event-subject" style="background: #D33E40 url({{ '/images/events/'.$event->banner() }});">
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

@if (count($event->ticket_groups) > 0)
<div class="row investments">
	<div class="container">
	    <div class="col-xs-12 no-padding">
	    	<p class="event-title">Investment</p>

            <ul>
            	@foreach ($event->ticket_groups as $ticket_group)
                <li>Untuk tiket {{ $ticket_group->name }} dikenakan biaya {{ 'Rp '. number_format($ticket_group->price) }} per orang</li>
                @endforeach
            </ul>

            <button data-toggle="modal" data-target="#buy-ticket">Buy Ticket</button>
        </div>
    </div>
</div>
@endif

<!-- Modal -->
<div class="modal fade" id="buy-ticket" role="dialog">
    <div class="modal-dialog">
    
      	<!-- Modal content-->
      	<div class="modal-content">
        	<div class="modal-header">
          		<button type="button" class="close" data-dismiss="modal">&times;</button>
          		<h4 class="modal-title">{{ $event->name }}</h4>
        	</div>
	        	<div class="modal-body">
	        		<div class="alert alert-danger ticket-message">
	                	<p></p>
	              	</div>
			  		@foreach ($event->ticket_groups as $ticket_group)
			  		@if ($ticket_group->status == 1)
			  		<input type="hidden" id="ticket-price-{{ $ticket_group->id }}" value="{{ $ticket_group->price }}">
			  		<div class="row ticket-row">
				  		<div class="col-xs-3">
		         			<p class="ticket-name">{{ $ticket_group->name }}</p>
		         		</div>
		         		<div class="col-xs-3">
		         			<p class="ticket-price">{{ 'Rp '. number_format($ticket_group->price) }}</p>
		         		</div>
	         			<div class="col-xs-3">
	         				@if (count($ticket_group->tickets_available) > 0 && Carbon\Carbon::now() >= $ticket_group->started_at && Carbon\Carbon::now() <= $ticket_group->ended_at)
	         				<span>QTY </span> 
		         			<select class="ticket-quantity" id="{{ $ticket_group->id }}" name="ticket_quantity_{{ $ticket_group->id }}">
		         				@if (count($ticket_group->tickets_available) > 5)
		         				@for ($i = 0; $i <= 5; $i++)
		         					<option value="{{ $i }}">{{ $i }}</option>
		         				@endfor
		         				@else
		         				@for ($i = 0; $i <= count($ticket_group->tickets_available); $i++)
		         					<option value="{{ $i }}">{{ $i }}</option>
		         				@endfor
		         				@endif
		         			</select>
		         			@else
		         			<span>Sold Out</span>
		         			@endif
	         			</div>
	         			<div class="col-xs-3">
		         			<p class="ticket-total" id="ticket-total-{{ $ticket_group->id }}">{{ 'Rp '. number_format($ticket_group->price) }}</p>
	         			</div>
	         		</div>
	         		@endif
         			@endforeach
			  	</div>
	        	<div class="modal-footer">
	        		<div class="col-xs-6">
	          			<button type="button" id="{{ $event->id }}" class="btn ticket-checkout">Checkout</button>
	          		</div>
	          		<div class="col-xs-3">
	          			<p class="ticket-quantity-total">QTY: 0</p>
	          		</div>
	          		<div class="col-xs-3">
	          			<p class="ticket-grandtotal">{{ 'Rp '. number_format(0) }}</p>
	          		</div>
	        	</div>
      	</div>
      
    </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('js/event.js') }}"></script>
@endsection