<style>
.register {
    margin-top: 50px;
    padding-bottom: 50px !important;
}

.register .panel {
    border-radius: 0;
    border-color: #0F3844;
}

.register .panel-heading {
    background-color: #0F3844;
    border-radius: 0;
    color: #fff;
    font-size: 18px;
    font-weight: 300;
    letter-spacing: 0.05em;
}

.register .panel-body {
    padding: 20px 30px 0 30px;
}

.register label, .register span {
    font-size: 12px;
    font-weight: 400;
}

.register input {
    border-radius: 0;
    border: 1px solid #0F3844;
    font-size: 12px;
}

.register .gender {
    margin-right: 20px;
}

.register .gender input {
    margin-right: 5px;
}

.register button {
    border-radius: 0;
    background-color: red;
    border-color: red;
    color: #fff;
    font-size: 15px;
    margin-top: 15px;
    margin-bottom: 20px;
    padding: 10px 30px;
}

.register hr {
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
                                <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>

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
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

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
                                <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" required>

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
