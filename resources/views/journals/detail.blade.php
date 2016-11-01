@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/journal-detail.css') }}">
@endsection

@section('metas')
<meta property="og:url" content="{{ Request::url() }}" />
<meta property="og:type" content="journal" />
<meta property="og:title" content="{{ $journal->title . ' | Gethype' }}" />
<meta property="og:description" content="Lorem ipsum dolor sit amet, propriae mnesarchum deterruisset sea ei. Te sit oportere theophrastus, sea an invidunt deterruisset. Atqui viris consequuntur per te, est quot adversarium eu. Malis deleniti pertinacia te quo, vim id libris epicurei adversarium. Putant causae ne mei, sumo bonorum mei te." />
<meta property="og:image" content="{{ asset('/images/journals/'.$journal->image()) }}" />

<meta name="twitter:card" content="journal" />
<meta name="twitter:site" content="@gethype.id" />
<meta name="twitter:title" content="{{ $journal->title . ' | Gethype' }}" />
<meta name="twitter:description" content="Lorem ipsum dolor sit amet, propriae mnesarchum deterruisset sea ei. Te sit oportere theophrastus, sea an invidunt deterruisset. Atqui viris consequuntur per te, est quot adversarium eu. Malis deleniti pertinacia te quo, vim id libris epicurei adversarium. Putant causae ne mei, sumo bonorum mei te." />
<meta name="twitter:image" content="{{ asset('/images/journals/'.$journal->image()) }}" />
@endsection

@section('content')
<section class="journal-detail">
    <div class="container">

        <div class="row">
            
            <div class="col-md-8">
                <div class="feature-img">
                    <img src="{{ asset('images/journals/'.$journal->image()) }}" alt="" class="img-responsive">
                </div>
                <div class="detail-content">
                    <h1 class="title">{{ $journal->title }}</h1>
                    <div class="cate-date">
                        <span class="category">{{ $journal->tag }}</span> |
                        <span class="date">{{ Carbon\Carbon::parse($journal->created_at)->format('M d, Y') }}</span> 
                    </div>

                    {!! $journal->content !!}

                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus illum ratione error sit tenetur reprehenderit cumque reiciendis, dolores deleniti, ducimus amet laborum a iure dicta nam laudantium fugit maxime quibusdam.
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor rem, hic, eos magni reprehenderit a voluptates magnam quas fugit ex! Porro dolorem nisi ex rem doloremque ad corrupti earum quas.
                    </p>

                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus illum ratione error sit tenetur reprehenderit cumque reiciendis, dolores deleniti, ducimus amet laborum a iure dicta nam laudantium fugit maxime quibusdam.
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor rem, hic, eos magni reprehenderit a voluptates magnam quas fugit ex! Porro dolorem nisi ex rem doloremque ad corrupti earum quas.
                    </p>

                    <div class="point">
                        <span class="number">1.</span>
                        <span class="subtitle">Creative Talk Nge-Vlog Sekutt Bareng Gofar Hilman</span>
                    </div>

                    <img src="{{ asset('images/journals/'.$journal->image()) }}" alt="" class="img-responsive">
                    <div class="img-desc">
                        nulla dolor in deserunt illo repellendus minus nostrum modi soluta.
                    </div>

                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus illum ratione error sit tenetur reprehenderit cumque reiciendis, dolores deleniti, ducimus amet laborum a iure dicta nam laudantium fugit maxime quibusdam.
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor rem, hic, eos magni reprehenderit a voluptates magnam quas fugit ex! Porro dolorem nisi ex rem doloremque ad corrupti earum quas.
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus illum ratione error sit tenetur reprehenderit cumque reiciendis, dolores deleniti, ducimus amet laborum a iure dicta nam laudantium fugit maxime quibusdam.
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor rem, hic, eos magni reprehenderit a voluptates magnam quas fugit ex! Porro dolorem nisi ex rem doloremque ad corrupti earum quas.
                    </p>

                    <div class="point">
                        <span class="number">2.</span>
                        <span class="subtitle">Photo Exhibition: Glameseekers</span>
                    </div>

                    <img src="{{ asset('images/journals/'.$journal->image()) }}" alt="" class="img-responsive">
                    <div class="img-desc">
                        nulla dolor in deserunt illo repellendus minus nostrum modi soluta.
                    </div>

                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus illum ratione error sit tenetur reprehenderit cumque reiciendis, dolores deleniti, ducimus amet laborum a iure dicta nam laudantium fugit maxime quibusdam.
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor rem, hic, eos magni reprehenderit a voluptates magnam quas fugit ex! Porro dolorem nisi ex rem doloremque ad corrupti earum quas.
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus illum ratione error sit tenetur reprehenderit cumque reiciendis, dolores deleniti, ducimus amet laborum a iure dicta nam laudantium fugit maxime quibusdam.
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor rem, hic, eos magni reprehenderit a voluptates magnam quas fugit ex! Porro dolorem nisi ex rem doloremque ad corrupti earum quas.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box-share">
                    <ul>
                        <li>
                            <a href="http://www.facebook.com/sharer/sharer.php?u={{ url('/journals/'.$journal->slug) }}" onclick="window.open(this.href,'targetWindow','toolbar=no,location=0,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=250'); return false;" target="_blank">
                                <img class="event-sosmed" src="{{ asset('/images/icons/facebook.png') }}" height="25">
                            </a>
                        </li>
                        <li>
                            <a href="http://twitter.com/intent/tweet?text={{ urlencode($journal->title . ' | Gethype' )}}&url={{ url('/journals/'.$journal->slug) }}&hashtags=Gethype&via=gethype.id" onclick="window.open(this.href,'targetWindow','toolbar=no,location=0,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=450'); return false;" target="_blank">
                                <img class="event-sosmed" src="{{ asset('/images/icons/twitter.png') }}" height="25">
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>

                <div class="related-article">
                    <h3>Related Article</h3>
                
                    @foreach ($journals as $journal)
                    <div class="list-related-article">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="img">
                                    <a href=""><img src="{{ asset('images/journals/'.$journal->image()) }}" alt="" class="img-responsive"></a>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <a href="" class="title">{{ $journal->title }}</a>
                                <p class="cate"><a href="" >{{ $journal->tag }}</a></p>
                                <p class="date">{{ Carbon\Carbon::parse($journal->created_at)->format('l, M d') }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="box-subscribe">
                    <h3>Subscribe</h3>
                    <input type="text" class="form-control">
                    <button class="btn btn-subscribe">Submit</button>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        
    </div>
</section>
@endsection