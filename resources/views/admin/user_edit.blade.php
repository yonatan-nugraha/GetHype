@extends('admin.index')

@section('content')
<form action="{{ url('users/'.$user->id) }}" method="POST">
    {!! csrf_field() !!}
    {{ method_field('PATCH') }}

    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit User</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" name="first_name" placeholder="First Name" required pattern=".{3,50}" value="{{ $user->first_name }}">
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" name="last_name" placeholder="Last Name" required pattern=".{3,50}" value="{{ $user->last_name }}">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Email" required pattern=".{3,50}" value="{{ $user->email }}">
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="phone" placeholder="Phone" required pattern=".{3,50}" value="{{ $user->phone }}">
                    </div>

                    <div class="form-group">
                        Gender<br>
                        <div class="radio">
                            <label>
                                <input type="radio" name="gender" value="1" @if ($user->gender == 1) checked @endif>Male
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="gender" value="2" @if ($user->gender == 2) checked @endif>Female
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Birthdate</label>
                        <input type="date" class="form-control" name="birthdate" value="{{ $user->birthdate }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>      
            </div>
        </div>
    </div>
</form>
@endsection

@section('scripts')
@endsection