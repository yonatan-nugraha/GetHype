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
                                <li>Review your order to make sure everything was as right, click “Checkout”</li>
                                <li>Complete your data</li>
                                <li>Choose payment method you want to use, click “Pay Now”</li>
                                <li>Fill out payment form, click “Buy”</li>
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
                                <li>Page check out was time out maybe because there is some problem on our payment system</li>
                                <li>Your booking time was time out</li>
                                <li>Your Credit Card was detected as fraud</li>
                            </ul>
                        </div>
                    </div>

                    <div class="help-list-content-list">
                        <h4 class="help-list-content-title">
                            3. How do I get my refund?
                        </h4>
                        <div class="help-list-content-text">
                            <ul>
                                <li>Gethype team will contact you</li>
                                <li>Refund will take maksimum for 5 x 24 hours</li>
                            </ul>
                        </div>
                    </div>

                    <div class="help-list-content-list">
                        <h4 class="help-list-content-title">
                            4. What are Gethype Payment method choices?
                        </h4>
                        <div class="help-list-content-text">
                            <ul>
                                <li>Virtual Account (Permata & Mandiri)</li>
                                <li>Credit Card</li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="clearfix"></div>
            </div>

            <div class="help-list">
                <div class="col-sm-5 help-list-button">
                    I want to create an event <span class="caret pull-right"></span>
                    <div class="clearfix"></div>
                </div>
                <div class="help-list-content">
                    <div class="help-list-content-list">
                        <h4 class="help-list-content-title">
                            1. How to advertise?
                        </h4>
                        <div class="help-list-content-text">
                            <ul>
                                <li>Click Service Page on footer</li>
                                <li>Choose Advertise Your Event With Us</li>
                                <li>Click “Advertise Now”</li>
                                <li>Fill in the form</li>
                                <li>Click “Submit”</li>
                            </ul>
                        </div>
                    </div>

                    <div class="help-list-content-list">
                        <h4 class="help-list-content-title">
                            2. How to post & sell tickets in Gethype?
                        </h4>
                        <div class="help-list-content-text">
                            <ul>
                                <li>Click Service Page on footer</li>
                                <li>Choose Free Post & Event Ticketing</li>
                                <li>Click “Create Event”</li>
                                <li>Fill in the form</li>
                                <li>Click “Submit”</li>
                            </ul>
                        </div>
                    </div>

                    <div class="help-list-content-list">
                        <h4 class="help-list-content-title">
                            3. How to collab with our event planner?
                        </h4>
                        <div class="help-list-content-text">
                            <ul>
                                <li>Click Service Page on footer</li>
                                <li>Choose We Are Expert With Event Planner</li>
                                <li>Click “Consult Now”</li>
                                <li>Fill in the form</li>
                                <li>Click “Submit”</li>
                            </ul>
                        </div>
                    </div>

                    <div class="help-list-content-list">
                        <h4 class="help-list-content-title">
                            4. How to write a journal?
                        </h4>
                        <div class="help-list-content-text">
                            <ul>
                                <li>Click Service Page on footer</li>
                                <li>Choose Event Journalistic</li>
                                <li>Click Write Now”</li>
                                <li>Fill in the form</li>
                                <li>Click “Submit”</li>
                            </ul>
                        </div>
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