<style>
.password-reset {
    margin-top: 50px;
    padding-bottom: 50px !important;
}

.password-reset .panel {
    border-radius: 0;
    border-color: #0F3844;
}

.password-reset .panel-heading {
    background-color: #0F3844;
    border-radius: 0;
    color: #fff;
    font-size: 18px;
    font-weight: 300;
    letter-spacing: 0.05em;
}

.password-reset .panel-body {
    padding: 20px 30px 0 30px;
}

.password-reset label, .password-reset span {
    font-size: 12px;
    font-weight: 400;
}

.password-reset input {
    border-radius: 0;
    border: 1px solid #0F3844;
    font-size: 12px;
}

.password-reset button {
    border-radius: 0;
    background-color: red;
    border-color: red;
    color: #fff;
    font-size: 15px;
    margin-top: 15px;
    margin-bottom: 20px;
    padding: 10px 30px;
}

.password-reset hr {
    height: 2px;
    border-top: 1px solid #0F3844;
    border-bottom: 1px solid #0F3844;
}

.help-block p {
    color: red;
    font-weight: 300;
    font-size: 12px;
}
</style>

@extends('layouts.app')

@section('content')
<div class="container password-reset">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel">
                <div class="panel-heading">Reset Password</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <label>Email Address</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

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

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <label>Confirm Password</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <p>{{ $errors->first('password_confirmation') }}</p>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    Reset Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
