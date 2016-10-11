@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/auth-register.css') }}">
@endsection

@section('content')
<div class="container register">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <label>First Name</label>
                                <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" autofocus>

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <p>{{ $errors->first('first_name') }}</p>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <label>Last Name</label>
                                <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <p>{{ $errors->first('last_name') }}</p>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <label>Email Address</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <p>{{ $errors->first('email') }}</p>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <label>Phone</label>
                                <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <p>{{ $errors->first('phone') }}</p>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <label>Gender</label><br>
                                <span class="gender" n><input type="radio" name="gender" value="1" checked> Male</span>
                                <span class="gender" n><input type="radio" name="gender" value="2"> Female</span>

                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <p>{{ $errors->first('gender') }}</p>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('birthdate') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <label>Birthdate</label>
                                <input type="date" class="form-control" name="birthdate" value="{{ old('birthdate') }}" selected>

                                @if ($errors->has('birthdate'))
                                    <span class="help-block">
                                        <p>{{ $errors->first('birthdate') }}</p>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <label>Password</label>
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <p>{{ $errors->first('password') }}</p>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <label>Confirm Password</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <p>{{ $errors->first('password_confirmation') }}</p>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary register-submit">
                                    Register
                                </button><hr>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
