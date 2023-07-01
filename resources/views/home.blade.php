@extends('frontend.layouts.app')

@section('content')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ url($cms->page_banner_img) }}">
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card user-dashboard-item mb-4">
                                <span class="icon_cart dashboard-item-icon"></span>
                                <div class="card-body text-center">
                                    <p class="card-text">All Order</p>
                                    <h4 class="card-title mb-0">6</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card user-dashboard-item mb-4">
                                <span class="icon_cart dashboard-item-icon"></span>
                                <div class="card-body text-center">
                                    <p class="card-text">Completed Order</p>
                                    <h4 class="card-title mb-0">0</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card user-dashboard-item mb-4">
                                <span class="icon_cart dashboard-item-icon"></span>
                                <div class="card-body text-center">
                                    <p class="card-text">Processing Order</p>
                                    <h4 class="card-title mb-0">0</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card user-dashboard-item mb-4">
                                <span class="icon_cart dashboard-item-icon"></span>
                                <div class="card-body text-center">
                                    <p class="card-text">Canceled Order</p>
                                    <h4 class="card-title mb-0">0</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card user-dashboard-item mb-4">
                                <span class="icon_cart dashboard-item-icon"></span>
                                <div class="card-body text-center">
                                    <p class="card-text">All Order</p>
                                    <h4 class="card-title mb-0">6</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
