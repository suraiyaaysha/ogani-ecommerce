@extends('frontend.layouts.app')

@section('content')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ url($cms->page_banner_img) }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>User Profile</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Profile</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <section class="spad">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    @include('frontend.partials.dashboard-sidebar')
                </div>

                <div class="col-md-8">

                    <div class="">
                        {{-- show message --}}
                        @if (session('error'))
                            <div class="alert alert-danger mb-3">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success mb-3">
                                {{ session('success') }}
                            </div>
                        @endif
                        {{-- show message --}}
                    </div>

                    <div class="profile-box mb-4">
                        @include('frontend.profile.partials.update-profile-information-form')
                    </div>

                    <div class="profile-box mb-4">
                        @include('frontend.profile.partials.update-password-form')
                    </div>

                    <div class="profile-box mb-4">
                        @include('frontend.profile.partials.delete-user-form')
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

{{-- Script for Uploaded image preview show --}}
@push('script')
    <script>
        selectImage.onchange = evt => {
            preview = document.getElementById('preview');
            preview.style.display = 'block';
            const [file] = selectImage.files
            if (file) {
                preview.src = URL.createObjectURL(file)
            }
        }
    </script>

@endpush
{{-- Script for Uploaded image preview show --}}
