@extends('layouts.app')

@section('content')
<div class="container user-login-area">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-7">

            <div class="humberger__menu__logo text-center mb-3">
                <a href="{{ url('/') }}"><img src="frontend/assets/img/logo.png" alt=""></a>
            </div>

            <div class="card">
                {{-- <h5 class="card-header">{{ __('User Login') }}</h5> --}}


                <div class="card-body p-4">

                    <h3 class="text-center">{{ __('Login') }}</h3>

                    {{-- <form method="POST" action="{{ route('login') }}"> --}}

                    @isset($route)
                            <form method="POST" action="{{ $route }}">
                        @else
                            <form method="POST" action="{{ route('login') }}">
                    @endisset

                        @csrf

                        <div class="mb-3">
                            <label for="email" class="col-md-4 col-form-label">{{ __('Email Address') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="col-md-4 col-form-label">{{ __('Password') }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 text-end">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="primary-btn border-0 w-100">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-12 text-center mt-3">
                                @if (Route::has('register'))
                                    <span class="">{{ __('Don\'t have account?') }}</span>
                                    <a class="fw-bold btn btn-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
