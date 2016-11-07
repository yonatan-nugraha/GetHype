@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/help.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row help">
        <div class="col-xs-12">
            <div class="help-list">
                <div class="col-sm-5 help-list-button">
                    I want to buy ticket <span class="caret pull-right"></span>
                    <div class="clearfix"></div>
                </div>
                <div class="help-list-content">
                    <div class="help-list-content-list">
                        <h4 class="help-list-content-title">
                            1. How to buy event tickets in Gethype?
                        </h4>
                        <div class="help-list-content-text">
                            <ul>
                                <li>Click any event that you want</li>
                                <li>Click “Buy Ticket”</li>
                                <li>Review you order to make sure everything was as right, click “Checkout”</li>
                                <li>Completing your data</li>
                                <li>Choose payment method you want to use, click “Pay Now”</li>
                                <li>Filling out payment form, click “Buy”</li>
                            </ul>
                        </div>
                    </div>

                    <div class="help-list-content-list">
                        <h4 class="help-list-content-title">
                            2. What are the reason my payment was failed?
                        </h4>
                        <div class="help-list-content-text">
                            <p>Your payment was failed because of some reasons:</p>

                            <ul>
                                <li>Page check out was time out mungkin or maybe because there is some problem on our payment system</li>
                                <li>Your booking time was time out</li>
                                <li>Your Credit Card was detected as fraud</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="help-list">
                <div class="col-sm-5 help-list-button">
                    I want to buy ticket <span class="caret pull-right"></span>
                    <div class="clearfix"></div>
                </div>
                <div class="help-list-content">
                    <h4 class="help-list-content-title">
                        2. What are the reason my payment was failed?
                    </h4>
                        <div class="help-list-content-text">
                            <p>Your payment was failed because of some reasons:</p>

                            <ul>
                                <li>Page check out was time out mungkin or maybe because there is some problem on our payment system</li>
                                <li>Your booking time was time out</li>
                                <li>Your Credit Card was detected as fraud</li>
                            </ul>
                        </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/home.js') }}"></script>
@endsection