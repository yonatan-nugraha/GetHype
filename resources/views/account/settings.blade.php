@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/account-settings.css') }}">
@endsection

@section('content')
<div class="container"> 
	<div class="row account">
		<div class="col-xs-12 col-md-4 ">
			<div class="profile-information">
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
		</div>
		<div class="col-xs-12 col-md-8">
			<div class="edit-profile">
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
								<div class="form-group col-xs-12 col-sm-5 col-md-5">
						    		<input type="text" class="form-control" name="first_name" placeholder="First Name" value="{{ Auth::user()->first_name }}">
						    		@if ($errors->has('first_name'))
			                            <span class="help-block">
			                                <p>{{ $errors->first('first_name') }}</p>
			                            </span>
			                        @endif
						    	</div>
						    	<div class="form-group col-xs-12 col-sm-5 col-md-5">
						    		<input type="text" class="form-control" name="last_name" placeholder="Last Name" value="{{ Auth::user()->last_name }}">
						    		@if ($errors->has('last_name'))
			                            <span class="help-block">
			                                <p>{{ $errors->first('last_name') }}</p>
			                            </span>
			                        @endif
						    	</div>
					    	</div>
					    	<div class="row">
						    	<div class="form-group col-xs-12 col-sm-5 col-md-5">
						    		<input type="email" class="form-control" name="email" placeholder="Email" value="{{ Auth::user()->email }}">
						    		@if ($errors->has('email'))
			                            <span class="help-block">
			                                <p>{{ $errors->first('email') }}</p>
			                            </span>
			                        @endif
						    	</div>
						    	<div class="form-group col-xs-12 col-sm-5 col-md-5">
						    		<input type="text" class="form-control" name="phone" placeholder="Phone Number" value="{{ Auth::user()->phone }}">
						    		@if ($errors->has('phone'))
			                            <span class="help-block">
			                                <p>{{ $errors->first('phone') }}</p>
			                            </span>
			                        @endif
						    	</div>
						    </div>
						    <div class="row birthdate">
						    	<div class="form-group col-xs-12 col-sm-5 col-md-5">
						    		<label>Your Birthdate</label>
						    		<input type="date" data-date="" data-date-format="DD MMMM YYYY" class="form-control" name="birthdate" value="{{ Auth::user()->birthdate }}">
						    		@if ($errors->has('birthdate'))
			                            <span class="help-block">
			                                <p>{{ $errors->first('birthdate') }}</p>
			                            </span>
			                        @endif
						    	</div>
						    </div>
						    <div class="row gender">
						    	<div class="form-group col-xs-12">
						    		<label>Gender</label><br>
						    		<input type="radio" name="gender" value="1" @if (Auth::user()->gender == 1) checked @endif> 
						    		<span>Male</span>
	  								<input type="radio" name="gender" value="2" @if (Auth::user()->gender == 2) checked @endif> 
	  								<span>Female</span><br>
	  								@if ($errors->has('gender'))
			                            <span class="help-block">
			                                <p>{{ $errors->first('gender') }}</p>
			                            </span>
			                        @endif
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
								<div class="form-group col-xs-12 col-sm-5 col-md-5">
						    		<input type="password" class="form-control" name="current_password" placeholder="Current Password">
						    		@if ($errors->has('current_password'))
			                            <span class="help-block">
			                                <p>{{ $errors->first('current_password') }}</p>
			                            </span>
			                        @endif
						    	</div>
					    	</div>
					    	<div class="row">
						    	<div class="form-group col-xs-12 col-sm-5 col-md-5">
						    		<input type="password" class="form-control" name="new_password" placeholder="New Password">
						    		@if ($errors->has('new_password'))
			                            <span class="help-block">
			                                <p>{{ $errors->first('new_password') }}</p>
			                            </span>
			                        @endif
						    	</div>
						    </div>
						    <div class="row">
						    	<div class="form-group col-xs-12 col-sm-5 col-md-5">
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
</div>

@if (session('profile_updated'))
<div class="after-effect profile">
    <div class="after-effect-content">
    Your Profile Has Been Changed
    </div>
</div>
@endif

@if (session('password_updated'))
<div class="after-effect password">
    <div class="after-effect-content">
    Password Has Been Changed
    </div>
</div>
@endif

@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/account.js') }}"></script>
@endsection