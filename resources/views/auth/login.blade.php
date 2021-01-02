@extends('layouts.auth')
@section('text', "Sign up")
@section('url', route('register.index'))

@section('custom_styles')
    <link rel="stylesheet" href="{{ asset('custom/css/auth.css') }}">
@endsection

@section('content')
    <!--begin::Signin-->
    <div class="kt-login__form">
        <div class="kt-login__title">
            <h3>Sign In</h3>
        </div>

        <!--begin::Form-->
        <form class="kt-form" method="post" action="{{ route('login') }}" novalidate="novalidate" id="kt_login_form">
            {{ csrf_field() }}
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Email" name="email" autocomplete="off" value="{{ old('email') }}">
                @error('email')
                    <span class="invalid"><b>{{ $errors->first('email') }}</b></span>
                @enderror
            </div>
            <div class="form-group">
                <input class="form-control" type="password" placeholder="Password" name="password" autocomplete="off">
                @error('password')
                    <span class="invalid"><b>{{ $errors->first('password') }}</b></span>
                @enderror
            </div>

            <!--begin::Action-->
            <div class="kt-login__actions">
                <span></span>
                <button id="kt_login_signin_submit" type="submit" class="btn btn-primary btn-elevate kt-login__btn-primary">Sign In</button>
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
