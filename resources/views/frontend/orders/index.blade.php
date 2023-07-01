@extends('frontend.layouts.app')

@section('content')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ url($cms->page_banner_img) }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{ __('Your Orders') }}</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('/') }}">{{ __('Home') }}</a>
                            <span>{{ __('Orders') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <section class="orders-page spad">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Order Number</th>
                            <th scope="col">Order Status</th>
                            <th scope="col">Payment Method</th>
                            <th scope="col">Payment Status</th>
                            <th scope="col">Total Item</th>
                            <th scope="col">Grand Total</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if ($orders->count())

                                @foreach ($orders as $order)
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>{{ $order->order_number }}</td>
                                        <td>{{ $order->status }}</td>
                                        <td>{{ $order->payment_method }}</td>
                                        <td>{{ $order->payment_status }}</td>
                                        <td>{{ $order->item_count }}</td>
                                        <td>{{ $order->grand_total }}</td>
                                        <td><a href="{{ route('orders.show', $order) }}" class="site-btn filter-btn-sm">View Details</a></td>
                                    </tr>
                                @endforeach

                            @else
                                <tr>
                                    <td><h5>No Orders found!</h5></td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

@endsection
