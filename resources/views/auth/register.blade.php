@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1>New User Register</h1>
            <div class="mt-5"></div>
            <form action="{{route('auth.store')}}" method="POST">
                @csrf
                @include('inc.flash-message')
                <div class="form-row">
                    <div class="form-group col-3">
                        <label>First Name</label>
                        <input type="text" class="form-control" name="fname" value="{{old('fname')}}"/>
                    </div>

                    <div class="form-group col-3">
                        <label>Medium Name</label>
                        <input type="text" class="form-control" name="mname" value="{{old('mname')}}"/>
                    </div>

                    <div class="form-group col-3">
                        <label>Last Name</label>
                        <input type="text" class="form-control" name="lname" value="{{old('lname')}}"/>
                    </div>

                    <div class="form-group col-3">
                        <label>Mobile</label>
                        <input type="text" class="form-control" name="mobile" value="{{old('mobile')}}"/>
                    </div>

                    <div class="form-group col-3">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" value="{{old('email')}}"/>
                    </div>
                    <div class="form-group col-3">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" value="{{old('password')}}"/>
                    </div>
                    <div class="form-group col-3">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation" value="{{old('password_confirmation')}}"/>
                    </div>

                    <input type="hidden" name="role" value="admin"/>


                </div>
                <div class="form-row">
                    <button type="submit" class="btn btn-success btn-md">Register</button>
                </div>
            </form>
        </div>
    </div>
@endsection