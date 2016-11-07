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
                    <h2>Advertise your events with Us.</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi praesentium reiciendis repudiandae voluptatum pariatur, voluptatibus illo, accusantium ratione quidem repellendus, libero explicabo quaerat architecto nihil dicta doloremque, asperiores animi ea?</p>
                
                    <div class="content-button">
                        <a class="btn-create btn btn-default">Create Event</a>
                    </div>
                </div>

                <div class="content-form">
                    <h2>Gethype Advertisement</h2>
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-5 col-md-5">
                            <input class="form-control" type="text" name="first_name" value="" placeholder="First name">
                            <span class="error-block" id="first-name-error">this is error message </span>
                        </div>
                        <div class="form-group col-xs-12 col-sm-5 col-md-5">
                            <input class="form-control" type="text" name="last_name" value="" placeholder="Last name">
                            <span class="error-block" id="last-name-error">this is error message </span>
                        </div>

                        <!-- update add clearfix -->
                        <div class="clearfix"></div>
                        <div class="form-group col-xs-12 col-sm-5 col-md-5">
                            <input class="form-control" type="email" name="email" value="" placeholder="Email">
                            <span class="error-block" id="email-error">this is error message </span>
                        </div>
                        <div class="form-group col-xs-12 col-sm-5 col-md-5">
                            <input class="form-control" type="text" name="phone" value="" placeholder="Mobile phone">
                            <span class="error-block" id="phone-error">this is error message </span>
                        </div>
                        <div class="form-group col-xs-12">
                            <textarea name="" rows="5" class="form-control description" placeholder="Event description"></textarea>
                            <span class="error-block" id="phone-error">this is error message </span>
                        </div>
                        <div class="col-xs-12">
                            <button class="btn-submit btn btn-default">Submit</button>
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
                    <h2>Advertise your events with Us.</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi praesentium reiciendis repudiandae voluptatum pariatur, voluptatibus illo, accusantium ratione quidem repellendus, libero explicabo quaerat architecto nihil dicta doloremque, asperiores animi ea?</p>
                
                    <div class="content-button">
                        <a class="btn-create btn btn-default">Create Event</a>
                    </div>
                </div>

                <div class="content-form">
                    <h2>Gethype Advertisement</h2>
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-5 col-md-5">
                            <input class="form-control" type="text" name="first_name" value="" placeholder="First name">
                            <span class="error-block" id="first-name-error">this is error message </span>
                        </div>
                        <div class="form-group col-xs-12 col-sm-5 col-md-5">
                            <input class="form-control" type="text" name="last_name" value="" placeholder="Last name">
                            <span class="error-block" id="last-name-error">this is error message </span>
                        </div>

                        <!-- update add clearfix -->
                        <div class="clearfix"></div>
                        <div class="form-group col-xs-12 col-sm-5 col-md-5">
                            <input class="form-control" type="email" name="email" value="" placeholder="Email">
                            <span class="error-block" id="email-error">this is error message </span>
                        </div>
                        <div class="form-group col-xs-12 col-sm-5 col-md-5">
                            <input class="form-control" type="text" name="phone" value="" placeholder="Mobile phone">
                            <span class="error-block" id="phone-error">this is error message </span>
                        </div>
                        <div class="form-group col-xs-12">
                            <textarea name="" rows="5" class="form-control description" placeholder="Event description"></textarea>
                            <span class="error-block" id="phone-error">this is error message </span>
                        </div>
                        <div class="col-xs-12">
                            <button class="btn-submit btn btn-default">Submit</button>
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
                    <h2>Advertise your events with Us.</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi praesentium reiciendis repudiandae voluptatum pariatur, voluptatibus illo, accusantium ratione quidem repellendus, libero explicabo quaerat architecto nihil dicta doloremque, asperiores animi ea?</p>
                
                    <div class="content-button">
                        <a class="btn-create btn btn-default">Create Event</a>
                    </div>
                </div>

                <div class="content-form">
                    <h2>Gethype Advertisement</h2>
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-5 col-md-5">
                            <input class="form-control" type="text" name="first_name" value="" placeholder="First name">
                            <span class="error-block" id="first-name-error">this is error message </span>
                        </div>
                        <div class="form-group col-xs-12 col-sm-5 col-md-5">
                            <input class="form-control" type="text" name="last_name" value="" placeholder="Last name">
                            <span class="error-block" id="last-name-error">this is error message </span>
                        </div>

                        <!-- update add clearfix -->
                        <div class="clearfix"></div>
                        <div class="form-group col-xs-12 col-sm-5 col-md-5">
                            <input class="form-control" type="email" name="email" value="" placeholder="Email">
                            <span class="error-block" id="email-error">this is error message </span>
                        </div>
                        <div class="form-group col-xs-12 col-sm-5 col-md-5">
                            <input class="form-control" type="text" name="phone" value="" placeholder="Mobile phone">
                            <span class="error-block" id="phone-error">this is error message </span>
                        </div>
                        <div class="form-group col-xs-12">
                            <textarea name="" rows="5" class="form-control description" placeholder="Event description"></textarea>
                            <span class="error-block" id="phone-error">this is error message </span>
                        </div>
                        <div class="col-xs-12">
                            <button class="btn-submit btn btn-default">Submit</button>
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
                    <h2>Advertise your events with Us.</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi praesentium reiciendis repudiandae voluptatum pariatur, voluptatibus illo, accusantium ratione quidem repellendus, libero explicabo quaerat architecto nihil dicta doloremque, asperiores animi ea?</p>
                
                    <div class="content-button">
                        <a class="btn-create btn btn-default">Create Event</a>
                    </div>
                </div>

                <div class="content-form">
                    <h2>Gethype Advertisement</h2>
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-5 col-md-5">
                            <input class="form-control" type="text" name="first_name" value="" placeholder="First name">
                            <span class="error-block" id="first-name-error">this is error message </span>
                        </div>
                        <div class="form-group col-xs-12 col-sm-5 col-md-5">
                            <input class="form-control" type="text" name="last_name" value="" placeholder="Last name">
                            <span class="error-block" id="last-name-error">this is error message </span>
                        </div>

                        <!-- update add clearfix -->
                        <div class="clearfix"></div>
                        <div class="form-group col-xs-12 col-sm-5 col-md-5">
                            <input class="form-control" type="email" name="email" value="" placeholder="Email">
                            <span class="error-block" id="email-error">this is error message </span>
                        </div>
                        <div class="form-group col-xs-12 col-sm-5 col-md-5">
                            <input class="form-control" type="text" name="phone" value="" placeholder="Mobile phone">
                            <span class="error-block" id="phone-error">this is error message </span>
                        </div>
                        <div class="form-group col-xs-12">
                            <textarea name="" rows="5" class="form-control description" placeholder="Event description"></textarea>
                            <span class="error-block" id="phone-error">this is error message </span>
                        </div>
                        <div class="col-xs-12">
                            <button class="btn-submit btn btn-default">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/home.js') }}"></script>
@endsection