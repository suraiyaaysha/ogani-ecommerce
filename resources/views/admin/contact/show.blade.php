@extends('admin.layouts.app')

@section('content')
    <h1>{{ ('Contact List') }}</h1>

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
        <div class="col-md-12">
            <div class="profile-box">
                <div class="grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            {{-- <h3 class="card-title">{{ ('Contact List') }}</h3> --}}

                            <div class="card-body">
                                Name:{{ $contact->name }} <br>
                                Email:{{ $contact->email }} <br>
                                Message:{{ $contact->message }}
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
