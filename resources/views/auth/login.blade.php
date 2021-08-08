@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-12">
            <form class="form-signin" action="{{route('auth.authenticate')}}" method="post">
                @csrf
                @include('inc.flash-message')
                <h1 class="h3 mb-3 font-weight-normal">Sign In</h1>
                <label for="inputEmail" class="sr-only">Email address</label>
                <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address"
                       autofocus>
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" name="inputPassword" class="form-control"
                       placeholder="Password" >

                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>

            </form>

        </div>

    </div>

@endsection