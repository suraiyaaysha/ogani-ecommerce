@extends('frontend.layouts.app')

@section('content')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ url($cms->page_banner_img) }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{ __('Order Details') }}</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('/') }}">{{ __('Home') }}</a>
                            <span>{{ __('Order Details') }}</span>
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
                    <h2 class="text-center mb-3">Order Details</h2>

                    <h5>Order Number: {{ $order->order_number }}</h5>
                    <h5>Total Amount: ${{ $order->grand_total }}</h5>
                    <h5 class="mb-3">Order Status: {{ $order->status }}</h5>

                    <h5 class="mb-3">Your Order Items:</h5>
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($order->orderItems as $item)
                                <tr>
                                    <th scope="row">1</th>
                                    <td> <img src="{{ $item->product->featured_image }}" alt="" class="product-sm-img mr-2"> {{ $item->product->name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>${{ $item->price }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                    <!-- Add more order details as needed -->
                </div>
            </div>
        </div>
    </section>

@endsection
