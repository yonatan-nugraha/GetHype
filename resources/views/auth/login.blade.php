<style>
.login {
    margin-top: 50px;
    padding-bottom: 50px !important;
}

.login .panel {
    border-radius: 0;
    border-color: #0F3844;
}

.login .panel-heading {
    background-color: #0F3844;
    border-radius: 0;
    color: #fff;
    font-size: 18px;
    font-weight: 300;
    letter-spacing: 0.05em;
}

.login .panel-body {
    padding: 20px 30px 0 30px;
}

.login label {
    font-size: 12px;
    font-weight: 400;
}

.login input {
    border-radius: 0;
    border: 1px solid #0F3844;
    font-size: 12px;
}

.login button {
    border-radius: 0;
    background-color: red;
    border-color: red;
    color: #fff;
    font-size: 15px;
    margin-bottom: 20px;
    padding: 10px 30px;
}

.login hr {
    height: 2px;
    border-top: 1px solid #0F3844;
    border-bottom: 1px solid #0F3844;
}

.login .forget-password {
    font-size: 12px;
    color: red;
}

.login .login-sosmed {
    text-align: center;
    font-size: 12px;
}

.login-sosmed button {
    min-width: 200px;
    min-height: 50px;
    font-size: 18px;
}

.login-sosmed i {
    margin-right: 30px;
    margin-top: 5px;
}

.login-facebook button {
    background-color: #3b5998;
    border-color: #3b5998;
    border-style: none;
    margin-bottom: 10px;
}

.login-google button {
    background-color: #d34836;
    border-color: #d34836;
    border-style: none;
    margin-bottom: 30px;
}

.help-block p {
    color: red;
    font-weight: 300;
    font-size: 12px;
}
</style>

@extends('layouts.app')

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
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

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
                                <input id="password" type="password" class="form-control" name="password" required>

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
                            <button><i class="fa fa-facebook-f pull-left"></i> Facebook</button>
                        </div>
                        <div class="col-md-12 login-google">
                            <button><i class="fa fa-google-plus pull-left"></i> Google</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
