@extends('layouts.guest')
@section('content')
@include('flash-message')
{!! Toastr::message() !!}
    <div class="registration-form">
        <form  action="" method="POST">
            @csrf
            <div class="form-icon">
                <span><i class="icon icon-user"></i></span>
            </div>
           <div class="form-group">
                <input type="text" name="email" class="form-control item" placeholder="Email" value="{{ old('email') }}">
                @if ($errors->has('email'))
                <span style="color: red;">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control item" placeholder="Password">
                @if ($errors->has('password'))
                <span style="color: red">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="form-group">
                <input type="submit"  class="btn btn-block create-account" value="Login">
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div><hr>
            <div class="form-group" style="text-align: center">
                <a href="{{ route('auth/google') }}" class="btn btn-warning"><i class="fa fa-google" aria-hidden="true"></i></a>
                <a href="{{ route('instagramLogin') }}" class="btn btn-danger"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="{{ route('authFacebook') }}" class="btn btn-primary"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
                <a href="{{ route('githubLogin') }}" class="btn btn-dark"><i class="fa fa-github-square" aria-hidden="true"></i></i></a>
            </div>
        </form>
        <div class="social-media">
            <h5>If you don't have an account? <a href="{{ route('signup.post') }}">Register Here
            </a></h5>
        </div>
    </div>

     @endsection

