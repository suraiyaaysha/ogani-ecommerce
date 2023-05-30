@extends('frontend.layouts.app')

@section('content')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="frontend/assets/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>User Dashboard</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Dashboard</span>
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
                    dashboard page content here
                </div>
            </div>
        </div>
    </section>
@endsection
