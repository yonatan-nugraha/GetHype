@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/auth-password-email.css') }}">
@endsection

@section('content')
<div class="password-email" style="background: url('{{ asset('images/bg-auth.jpg') }}') center center no-repeat;">
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
