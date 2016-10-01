<style>
.password-email {
    margin-top: 50px;
    padding-bottom: 50px !important;
}

.password-email .panel {
    border-radius: 0;
    border-color: #0F3844;
}

.password-email .panel-heading {
    background-color: #0F3844;
    border-radius: 0;
    color: #fff;
    font-size: 18px;
    font-weight: 300;
    letter-spacing: 0.05em;
}

.password-email .panel-body {
    padding: 20px 30px 0 30px;
}

.password-email label, .password-reset span {
    font-size: 12px;
    font-weight: 400;
}

.password-email input {
    border-radius: 0;
    border: 1px solid #0F3844;
    font-size: 12px;
}

.password-email button {
    border-radius: 0;
    background-color: red;
    border-color: red;
    color: #fff;
    font-size: 15px;
    margin-top: 15px;
    margin-bottom: 20px;
    padding: 10px 30px;
}

.password-email hr {
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

<!-- Main Content -->
@section('content')
<div class="container password-email">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel">
                <div class="panel-heading">Reset Password</div>
                <div class="panel-body">
                    @if (session('status'))
                        <span class="help-block">
                            <p>{{ session('status') }}</p>
                        </span>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <label for="email">Email Address</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <p>{{ $errors->first('email') }}</p>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
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
