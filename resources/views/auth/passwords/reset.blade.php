@extends('layouts.layout') @section('content')
<header class="row">
    <div class="small-12 flex-align-sb-c">
        <img src="{{ asset('img/IMDB_Logo_2016.svg.png') }}" alt="IMDb Logo" class="logo">
    </div>
    <div class="panel-heading">
    <h3 class="reset-password">Enter our information to reset your password<h3>
    </div>
        <div class="panel-body">
            <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                {{ csrf_field() }}
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" placeholder="Email" value="{{ $email or old('email') }}" required autofocus>
                </div>
                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="reset-btn">
                            Reset Password
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</header>
@endsection 
