@extends('layouts.auth')
@section('text', "Sign In")
@section('url', route('login.index'))

@section('custom_styles')
    <link rel="stylesheet" href="{{ asset('custom/css/auth.css') }}">
@endsection

@section('content')
    <!--begin::Signin-->
    <div class="kt-login__form">
        <div class="kt-login__title">
            <h3>Sign Up</h3>
        </div>

        <!--begin::Form-->
        <form class="kt-form" method="post" action="{{ route('register') }}" novalidate="novalidate" id="kt_login_form">
            {{ csrf_field() }}
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Name" name="name" autocomplete="off" value="{{ old('name') }}">
                @error('name')
                    <span class="invalid"><b>{{ $errors->first('name') }}</b></span>
                @enderror
            </div>
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Surname" name="surname" autocomplete="off" value="{{ old('surname') }}">
                @error('surname')
                    <span class="invalid"><b>{{ $errors->first('surname') }}</b></span>
                @enderror
            </div>
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Email" name="email" autocomplete="off" value="{{ old('email') }}">
                @error('email')
                    <span class="invalid"><b>{{ $errors->first('email') }}</b></span>
                @enderror
            </div>
            <div class="form-group">
                <input class="form-control" type="password" placeholder="Password" name="password" autocomplete="off" value="{{ old('password') }}">
                @error('password')
                    <span class="invalid"><b>{{ $errors->first('password') }}</b></span>
                @enderror
            </div>

            <!--begin::Action-->
            <div class="kt-login__actions">
                <span></span>
                <button id="kt_login_signin_submit" type="submit" class="btn btn-primary btn-elevate kt-login__btn-primary">Register</button>
            </div>
            <!--end::Action-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Signin-->
@endsection

@section('custom_scripts')
    <script src="{{ asset('custom/js/auth.js') }}"></script>
@endsection
