@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-7">

            <div class="humberger__menu__logo text-center mb-3">
                <a href="{{ url('/') }}"><img src="frontend/assets/img/logo.png" alt=""></a>
            </div>

            <div class="card">
                {{-- <h5 class="card-header">{{ __('Register') }}</h5> --}}

                <div class="card-body p-4">

                    <h5 class="text-center">{{ __('Register') }}</h5>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="first_name" class="col-md-4 col-form-label">{{ __('First Name') }}</label>

                                <div class="col-md-12">
                                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="last_name" class="col-md-4 col-form-label">{{ __('Last Name') }}</label>

                                <div class="col-md-12">
                                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="mb-3">
                            <label for="email" class="col-md-4 col-form-label">{{ __('Email Address') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="col-md-4 col-form-label">{{ __('Password') }}</label>

                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password-confirm" class="col-md-12 col-form-label">{{ __('Confirm Password') }}</label>

                                <div class="col-md-12">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="primary-btn border-0 w-100">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12 text-center mt-3">
                                @if (Route::has('register'))
                                    <span class="">{{ __('Already registered?') }}</span>
                                    <a class="fw-bold btn btn-link" href="{{ route('login') }}">{{ __('Login') }}</a>
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
