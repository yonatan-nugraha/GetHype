@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/service.css') }}">
@endsection

@section('content')
<div class="col-md-12 no-padding main-banner" style="background:url('{{ asset('images/services/banner-service.jpg') }}') center center no-repeat;">
    <div class="caption-banner">
        <h1>Let the Hype Begin</h1>
        <p>Start to spread the Hype now or create your own with our professional help.</p>
        <p>Make your event be extraordinary and unforgettable with us.</p>
    </div>
</div>

<div class="wrapper">
    <div class="service-list">
        <div class="service-img service-img-left">
            <img src="{{ asset('images/services/service-1.jpg') }}" alt="" class="img-responsive">
        </div>
        <div class="service-content service-content-right">
            <div class="content">
                <div class="content-default">
                    <h2>Advertise your event with us</h2>
                    <p>Advertise your Event in Gethype, by posting them just for free here. You can also design your own ticketing system at ease. Grab a chance for having a bigger and better market with us!</p>
                
                    <div class="content-button">
                        <a class="btn-create btn btn-default">Start Now</a>
                    </div>
                </div>

                <div class="content-form">
                    <a class="cancel-form" ><i class="glyphicon glyphicon-remove"></i></a>
                    <h2>Advertise your event with us</h2>
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-5 col-md-5">
                            <input class="form-control" type="text" name="advertise_first_name" placeholder="First name">
                            <span class="error-block" id="advertise-first-name-error"> </span>
                        </div>
                        <div class="form-group col-xs-12 col-sm-5 col-md-5">
                            <input class="form-control" type="text" name="advertise_last_name" placeholder="Last name">
                            <span class="error-block" id="advertise-last-name-error"> </span>
                        </div>

                        <!-- update add clearfix -->
                        <div class="clearfix"></div>
                        <div class="form-group col-xs-12 col-sm-5 col-md-5">
                            <input class="form-control" type="email" name="advertise_email" placeholder="Email">
                            <span class="error-block" id="advertise-email-error"> </span>
                        </div>
                        <div class="form-group col-xs-12 col-sm-5 col-md-5">
                            <input class="form-control" type="text" name="advertise_phone" placeholder="Mobile phone">
                            <span class="error-block" id="advertise-phone-error"> </span>
                        </div>
                        <div class="form-group col-xs-12">
                            <textarea name="advertise_description" rows="5" class="form-control description" placeholder="Event description"></textarea>
                            <span class="error-block" id="advertise-description-error"> </span>
                        </div>
                        <input type="hidden" name="advertise_subject" value="Advertise Event">
                        <div class="col-xs-12">
                            <button class="message-submit btn-submit btn btn-default" id="advertise">Submit</button>
                            <span class="error-block" id="advertise-error"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="service-list">
        <div class="service-img service-img-right">
            <img src="{{ asset('images/services/service-2.jpg') }}" alt="" class="img-responsive">
        </div>
        <div class="service-content service-content-left">
            <div class="content">
                <div class="content-default">
                    <h2>Promote your event</h2>
                    <p>Double your chance to attract more traffic and awareness by getting featured on our front banner and social media. What are you waiting for?</p>
                
                    <div class="content-button">
                        <a class="btn-create btn btn-default">Start Now</a>
                    </div>
                </div>

                <div class="content-form">
                    <a class="cancel-form" ><i class="glyphicon glyphicon-remove"></i></a>
                    <h2>Promote your event</h2>
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-5 col-md-5">
                            <input class="form-control" type="text" name="posting_first_name" placeholder="First name">
                            <span class="error-block" id="posting-first-name-error"> </span>
                        </div>
                        <div class="form-group col-xs-12 col-sm-5 col-md-5">
                            <input class="form-control" type="text" name="posting_last_name" placeholder="Last name">
                            <span class="error-block" id="posting-last-name-error"> </span>
                        </div>

                        <!-- update add clearfix -->
                        <div class="clearfix"></div>
                        <div class="form-group col-xs-12 col-sm-5 col-md-5">
                            <input class="form-control" type="email" name="posting_email" placeholder="Email">
                            <span class="error-block" id="posting-email-error"> </span>
                        </div>
                        <div class="form-group col-xs-12 col-sm-5 col-md-5">
                            <input class="form-control" type="text" name="posting_phone" placeholder="Mobile phone">
                            <span class="error-block" id="posting-phone-error"> </span>
                        </div>
                        <div class="form-group col-xs-12">
                            <textarea name="posting_description" rows="5" class="form-control description" placeholder="Event description"></textarea>
                            <span class="error-block" id="posting-description-error"> </span>
                        </div>
                        <input type="hidden" name="posting_subject" value="Event Posting">
                        <div class="col-xs-12">
                            <button class="message-submit btn-submit btn btn-default" id="posting">Submit</button>
                            <span class="error-block" id="posting-error"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="service-list">
        <div class="service-img service-img-left">
            <img src="{{ asset('images/services/service-3.jpg') }}" alt="" class="img-responsive">
        </div>
        <div class="service-content service-content-right">
            <div class="content">
                <div class="content-default">
                    <h2>Consult with our event planner</h2>
                    <p>The key of success of an event lies on how well you prepare for it. Let our expert help you to plan & organize your event to be more professional, efficient, and exciting at once.</p>
                
                    <div class="content-button">
                        <a class="btn-create btn btn-default">Start Now</a>
                    </div>
                </div>

                <div class="content-form"> 
                    <a class="cancel-form" ><i class="glyphicon glyphicon-remove"></i></a>
                    <h2>Consult with our event planner</h2>
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-5 col-md-5">
                            <input class="form-control" type="text" name="planner_first_name" placeholder="First name">
                            <span class="error-block" id="planner-first-name-error"> </span>
                        </div>
                        <div class="form-group col-xs-12 col-sm-5 col-md-5">
                            <input class="form-control" type="text" name="planner_last_name" placeholder="Last name">
                            <span class="error-block" id="planner-last-name-error"> </span>
                        </div>

                        <!-- update add clearfix -->
                        <div class="clearfix"></div>
                        <div class="form-group col-xs-12 col-sm-5 col-md-5">
                            <input class="form-control" type="email" name="planner_email" placeholder="Email">
                            <span class="error-block" id="planner-email-error"> </span>
                        </div>
                        <div class="form-group col-xs-12 col-sm-5 col-md-5">
                            <input class="form-control" type="text" name="planner_phone" placeholder="Mobile phone">
                            <span class="error-block" id="phone-error"> </span>
                        </div>
                        <div class="form-group col-xs-12">
                            <textarea name="planner_description" rows="5" class="form-control description" placeholder="Event description"></textarea>
                            <span class="error-block" id="planner-description-error"> </span>
                        </div>
                        <input type="hidden" name="planner_subject" value="Event Planner">
                        <div class="col-xs-12">
                            <button class="message-submit btn-submit btn btn-default" id="planner">Submit</button>
                            <span class="error-block" id="planner-error"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="service-list">
        <div class="service-img service-img-right">
            <img src="{{ asset('images/services/service-4.jpg') }}" alt="" class="img-responsive">
        </div>
        <div class="service-content service-content-left">
            <div class="content">
                <div class="content-default">
                    <h2>Write a journal of your event</h2>
                    <p>Ready to make your event to be more memorable? We will write a journal and publish it on our website.</p>
                
                    <div class="content-button">
                        <a class="btn-create btn btn-default">Start Now</a>
                    </div>
                </div>

                <div class="content-form">
                    <a class="cancel-form" ><i class="glyphicon glyphicon-remove"></i></a>
                    <h2>Write a journal of your event</h2>
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-5 col-md-5">
                            <input class="form-control" type="text" name="journal_first_name" value="" placeholder="First name">
                            <span class="error-block" id="journal-first-name-error"></span>
                        </div>
                        <div class="form-group col-xs-12 col-sm-5 col-md-5">
                            <input class="form-control" type="text" name="journal_last_name" value="" placeholder="Last name">
                            <span class="error-block" id="journal-last-name-error"></span>
                        </div>

                        <!-- update add clearfix -->
                        <div class="clearfix"></div>
                        <div class="form-group col-xs-12 col-sm-5 col-md-5">
                            <input class="form-control" type="email" name="journal_email" value="" placeholder="Email">
                            <span class="error-block" id="journal-email-error"></span>
                        </div>
                        <div class="form-group col-xs-12 col-sm-5 col-md-5">
                            <input class="form-control" type="text" name="journal_phone" value="" placeholder="Mobile phone">
                            <span class="error-block" id="journal-phone-error"></span>
                        </div>
                        <div class="form-group col-xs-12">
                            <textarea name="journal_description" rows="5" class="form-control description" placeholder="Event description"></textarea>
                            <span class="error-block" id="journal-description-error"></span>
                        </div>
                        <input type="hidden" name="journal_subject" value="Write Journal">
                        <div class="col-xs-12">
                            <button class="message-submit btn-submit btn btn-default" id="journal">Submit</button>
                            <span class="error-block" id="journal-error"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="after-effect message">
    <div class="after-effect-content">
    Your message has been sent
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/home.js') }}"></script>
@endsection