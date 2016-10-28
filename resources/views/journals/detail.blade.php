@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/journal-detail.css') }}">
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
                            <img class="event-sosmed" src="http://gethype.co.id/images/icons/twitter.png" height="25">
                        </li>
                        <li>
                            <img class="event-sosmed" src="http://gethype.co.id/images/icons/facebook.png" height="25">
                        </li>
                        <li>
                            <img class="event-sosmed" src="http://gethype.co.id/images/icons/instagram.png" height="25">
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
                                <p class="cate"><a href="" >Art & Culture</a></p>
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