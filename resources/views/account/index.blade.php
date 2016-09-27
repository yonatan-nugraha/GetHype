<style>
body {
	background-color: #F1F2F2 !important;
}

/**************************************/
/************** Profile ***************/
/**************************************/

.account {
	margin-top: 50px;
	padding-bottom: 50px;
}

.account .help-block {
	color: red;
	font-size: 12px;
}

/**************************************/
/******** Profile Information *********/
/**************************************/

.profile-information {
	background-color: #fff;
	margin-left: 15px;
	max-width: 30%;
}

.profile-information p {
	color: #0f3844;
}

.profile-header {
	text-align: center;
}

.profile-image {
	margin: 15px auto;
}

.profile-image img {
	width: 120px;
	height: 120px;
	border-radius: 50%;
	cursor: pointer;
}

.profile-image > input {
    display: none !important;
}

.profile-name {
	font-size: 18px;
	margin-bottom: 50px;
}

.profile-body {
	font-size: 12px;
	margin-bottom: 20px;
}

.profile-body p {
	padding-bottom: 20px;
}

.profile-body span {
	padding-left: 5px;
}

/**************************************/
/*** Edit Profile & Change Password ***/
/**************************************/

.edit-profile {
	background-color: #fff;
	max-width: 60%;
	margin-left: 70px;
	padding: 0 30px !important;
}

.edit-profile .nav {
	margin-top: 20px;
	margin-bottom: 30px;
}

.edit-profile li.active a {
	border: 1px solid #fff !important;
	border-bottom: 3px solid #EBD38C !important;
}

.edit-profile li a {
	color: #0f3844;
}

.edit-profile input, .change-password input {
	border-radius: 0;
	border: 1px solid #0F3844;
	font-size: 12px;
}

.birthdate, .gender, .interest {
	margin-top: 10px;
}

.birthdate label, .gender label, .gender span, .interest label {
	font-size: 11px;
	font-weight: 300;
}

.birthday label, .interest label {
	margin-bottom: 10px;
}

.gender span {
	margin-left: 3px;
	margin-right: 15px;
}

.interest .label {
	background-color: #d3d3d3;
	color: #000;
	font-size: 12px;
	font-weight: 300;
	border-radius: 0;
	cursor: pointer;
}

.interest .selected {
	background-color: red !important;
	color: #fff;
	font-size: 12px;
	font-weight: 300;
	border-radius: 0;
	cursor: pointer;
}

.account button {
    border-radius: 0;
    background-color: red;
    border-color: red;
    color: #fff;
    text-transform: uppercase;
    font-size: 12px;
    margin: 20px 0 15px 0;
}

::-webkit-input-placeholder {
    font-size: 10px;
    text-transform: uppercase;
}
:-moz-placeholder {
	font-size: 10px;
    text-transform: uppercase;
}
::-moz-placeholder {
    font-size: 10px;
    text-transform: uppercase;
}
:-ms-input-placeholder {
    font-size: 10px;
    text-transform: uppercase;
}
</style>

@extends('layouts.app')

@section('content')

<div class="container"> 
	<div class="row account">
		<div class="col-xs-4 profile-information">
			<div class="profile-header">
				<input type="hidden" class="user_id" value="{{ Auth::user()->id }}">
				<div class="profile-image">
				    <label for="file-input">
				        <img src="{{ asset('/images/users/'.Auth::user()->photo()) }}">
				    </label>
				    <input id="file-input" class="edit-profile-image" type="file"/>
				</div>
				
				<p class="profile-name">
					<span>{{ Auth::user()->first_name }}</span>
					@if (Auth::user()->last_name)
					<span> {{ Auth::user()->last_name }}</span>
					@endif
				</p>
			</div>
			<div class="profile-body">
				<p>
					<span class="col-xs-3">Email</span>
					<span class="col-xs-9">: {{ Auth::user()->email }}</span>
				</p>
				<p>
					<span class="col-xs-3">Phone</span>
					<span class="col-xs-9">: {{ Auth::user()->phone }}</span>
				</p>
				<p>
					<span class="col-xs-3">Gender</span>
					<span class="col-xs-9">: 
						@if (Auth::user()->gender == 1) Male @else Female @endif
					</span>
				</p>
				<p>
					<span class="col-xs-3">Birthdate</span>
					<span class="col-xs-9">: {{ Carbon\Carbon::parse(Auth::user()->birthdate)->format('d M Y') }}</span>
				</p>
				<p>
					<span class="col-xs-3">Interests</span>
					<span class="col-xs-9">: @if ($user_interests_name) {{ $user_interests_name }} @else - @endif</span>
				</p>
			</div>
		</div>
		<div class="col-xs-8 edit-profile">
			<ul class="nav nav-tabs">
			  	<li class="active"><a data-toggle="tab" href="#edit-profile">Edit Profile</a></li>
			  	<li><a data-toggle="tab" href="#change-password">Change Password</a></li>
			</ul>

			<div class="tab-content">
			  	<div id="edit-profile" class="tab-pane fade in active">
			    	<form action="{{ url('account/update-profile') }}" method="POST">
						{!! csrf_field() !!}
						{{ method_field('PATCH') }}
						<div class="row">
							<div class="form-group col-xs-5">
					    		<input type="text" class="form-control" name="first_name" placeholder="First Name" value="{{ Auth::user()->first_name }}">
					    		@if ($errors->has('first_name'))
		                            <span class="help-block">
		                                <p>{{ $errors->first('first_name') }}</p>
		                            </span>
		                        @endif
					    	</div>
					    	<div class="form-group col-xs-5">
					    		<input type="text" class="form-control" name="last_name" placeholder="Last Name" value="{{ Auth::user()->last_name }}">
					    	</div>
				    	</div>
				    	<div class="row">
					    	<div class="form-group col-xs-5">
					    		<input type="text" class="form-control" name="email" placeholder="Email" value="{{ Auth::user()->email }}">
					    		@if ($errors->has('email'))
		                            <span class="help-block">
		                                <p>{{ $errors->first('email') }}</p>
		                            </span>
		                        @endif
					    	</div>
					    	<div class="form-group col-xs-5">
					    		<input type="text" class="form-control" name="phone" placeholder="Phone Number" value="{{ Auth::user()->phone }}">
					    		@if ($errors->has('phone'))
		                            <span class="help-block">
		                                <p>{{ $errors->first('phone') }}</p>
		                            </span>
		                        @endif
					    	</div>
					    </div>
					    <div class="row birthdate">
					    	<div class="form-group col-xs-5">
					    		<label>Your Birthdate</label>
					    		<input type="date" class="form-control" name="birthdate" value="{{ Auth::user()->birthdate }}">
					    	</div>
					    </div>
					    <div class="row gender">
					    	<div class="form-group col-xs-12">
					    		<label>Gender</label><br>
					    		<input type="radio" name="gender" value="1" @if (Auth::user()->gender == 1) checked @endif> 
					    		<span>Male</span>
  								<input type="radio" name="gender" value="2" @if (Auth::user()->gender == 2) checked @endif> 
  								<span>Female</span><br>
					    	</div>
					    </div>
					    <div class="row interest">
					    	<div class="form-group col-xs-12">
					    		<input type="hidden" class="interests" name="interests">
					    		<label>What is your interest</label><br>
					    		@foreach ($interests as $interest)
					    		<span class="label selected" id="{{ $interest->category_id }}">{{ $interest->category->name }}</span>
					    		@endforeach
					    		@foreach ($categories as $category)
					    		@if (!in_array($category->id, $user_interests))
					    		<span class="label" id="{{ $category->id }}">{{ $category->name }}</span>
					    		@endif
					    		@endforeach
					    	</div>
					    </div>
					  	<button type="submit" class="btn edit-submit">Save Changes</button>
					</form>
			  	</div>
			  	<div id="change-password" class="tab-pane fade">
			    	<form action="{{ url('account/update-password') }}" method="POST">
						{!! csrf_field() !!}
						{{ method_field('PATCH') }}
						<div class="row">
							<div class="form-group col-xs-5">
					    		<input type="password" class="form-control" name="current_password" placeholder="Current Password">
					    		@if ($errors->has('current_password'))
		                            <span class="help-block">
		                                <p>{{ $errors->first('current_password') }}</p>
		                            </span>
		                        @endif
					    	</div>
				    	</div>
				    	<div class="row">
					    	<div class="form-group col-xs-5">
					    		<input type="password" class="form-control" name="new_password" placeholder="New Password">
					    		@if ($errors->has('new_password'))
		                            <span class="help-block">
		                                <p>{{ $errors->first('new_password') }}</p>
		                            </span>
		                        @endif
					    	</div>
					    </div>
					    <div class="row">
					    	<div class="form-group col-xs-5">
					    		<input type="password" class="form-control" name="new_password_confirmation" placeholder="Confirm New Password">
					    		@if ($errors->has('new_password_confirmation'))
		                            <span class="help-block">
		                                <p>{{ $errors->first('new_password_confirmation') }}</p>
		                            </span>
		                        @endif
					    	</div>
					    </div>
					    <button type="submit" class="btn edit-submit">Save Changes</button>
					</form>
			  	</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('js/account.js') }}"></script>
@endsection