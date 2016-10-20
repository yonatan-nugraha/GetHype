@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/auth-login.css') }}">
@endsection

@section('content')
<div class="container login">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        @if ($errors->has('error'))
                        <span class="help-block">
                           <p>{{ $errors->first('error') }}</p>
                        </span>
                        @endif

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <label>Email Address</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <p>{{ $errors->first('email') }}</p>
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

                        <div class="form-group">
                            <div class="col-md-6">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <a class="btn btn-link pull-right forget-password" href="{{ url('/password/reset') }}">
                                    Forget Password?
                                </a>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary login-submit">
                                    Login
                                </button><hr>
                            </div>
                        </div>
                    </form>
                    <div class="row login-sosmed">
                        <div class="col-md-12">
                            <p>Or, login with</p>
                        </div>
                        <div class="col-md-12 login-facebook">
                            <a href="{{ url('auth/facebook/redirect') }}"><button><i class="fa fa-facebook-f pull-left"></i> Facebook</button></a>
                        </div>
                        <div class="col-md-12 login-google">
                            <a href="{{ url('auth/google/redirect') }}"><button><i class="fa fa-google-plus pull-left"></i> Google</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
