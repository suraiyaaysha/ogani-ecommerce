@extends('frontend.layouts.app')

@section('content')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ url($cms->page_banner_img) }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{ __('Shopping Cart') }}</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('/') }}">{{ __('Home') }}</a>
                            <span>{{ __('Shopping Cart') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @if ($message = Session::get('success'))
                        <div class="p-4 mb-3 bg-green-400 rounded alert-success">
                            <p class="text-green-800 m-0">{{ $message }}</p>
                        </div>
                    @endif
                    {{-- coupon message --}}
                    @if (session('coupon_error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>

                    <div class="col-lg-12">
                        <div class="shoping__cart__table">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="shoping__product">Products</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItems as $item)
                                        <tr>
                                            <td class="shoping__cart__item">
                                                <img src="{{ $item->attributes->featured_image }}" alt="">

                                                <h5>{{ $item->name }}</h5>
                                            </td>
                                            <td class="shoping__cart__price">
                                                ${{ $item->price }}
                                            </td>
                                            <td class="shoping__cart__quantity">
                                                <div class="quantity">
                                                    <form action="{{ route('cart.update') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $item->id}}">
                                                        <div class="pro-qty">
                                                            <input type="text" name="quantity" value="{{ $item->quantity }}">
                                                        </div>
                                                        <button class="site-btn filter-btn-sm">Update</button>
                                                    </form>

                                                </div>
                                            </td>
                                            <td class="shoping__cart__total">
                                                ${{ $item->price }}
                                            </td>
                                            {{-- <td class="shoping__cart__total">
                                                ${{ $item->price * $item->quantity }}
                                            </td> --}}
                                            <td class="shoping__cart__item__close">
                                                <form action="{{ route('cart.remove') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" value="{{ $item->id }}" name="id">
                                                    <button class="border-0"><span class="icon_close"></span></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="shoping__cart__btns text-right">
                            <a href="{{ url('shop/') }}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        </div>
                    </div>

            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="{{ route('cart.applyCoupon') }}" method="POST">
                                @csrf
                                <input type="text" placeholder="Enter your coupon code" name="coupon_code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>

                    </div>
                </div>

                <div class="col-lg-6">

                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        @if (isset($subtotal) || session()->has('discount'))

                        {{-- <ul>
                            <li>Subtotal: ${{ isset($subtotal) ? $subtotal : \Cart::session(auth()->id())->getSubTotal() }}</li>

                            <li>
                            @if (session()->has('discount'))
                                Discount Amount: - ${{ isset($subtotal) ? $subtotal - session('total') : \Cart::session(auth()->id())->getSubTotal() - session('total') }}
                            @endif

                                @if (session()->has('discountAmount'))
                                    <span>{{ session('discountAmount') }}% based on coupon code</span>
                                @endif
                            </li>

                            <li>Total: ${{ session('total', \Cart::session(auth()->id())->getTotal()) }}</li>
                        </ul> --}}

                        <ul>
                            <li>Subtotal: ${{ isset($subtotal) ? $subtotal : \Cart::session(auth()->id())->getSubTotal() }}</li>
                            @if (session()->has('discount'))
                                <li>Discount Amount: - ${{ isset($subtotal) ? $subtotal - session('total') : \Cart::session(auth()->id())->getSubTotal() - session('total') }}</li>
                            @endif
                            <li>Total: ${{ session('total', \Cart::session(auth()->id())->getTotal()) }}</li>

                        </ul>

                        @endif
                        <a href="{{ route('checkout.index') }}" class="primary-btn">{{ __('PROCEED TO CHECKOUT') }}</a>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->

@endsection
