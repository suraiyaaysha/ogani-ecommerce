@extends('admin.layouts.app')

@section('content')
    <h1>Profile</h1>

    <div class="row">
        <div class="col-md-8">
            {{-- show message --}}
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            {{-- show message --}}
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="profile-box">
                @include('admin.profile.partials.update-profile-information-form')
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="profile-box">
                @include('admin.profile.partials.update-password-form')
            </div>
        </div>
    </div>

@endsection
