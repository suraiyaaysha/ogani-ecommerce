@extends('frontend.layouts.app')

@section('content')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ url('frontend/assets/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{ __('Wishlist') }}</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('/') }}">{{ __('Home') }}</a>
                            <span>{{ __('Wishlist') }}</span>
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
                </div>

                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allWishlist as $item)
                                    <tr>
                                        <td class="shoping__cart__item">
                                            <a href="{{ route('frontend.productDetails', $item->product->slug) }}">
                                                <img src="{{ $item->product->featured_image }}" alt="">

                                                <h5>{{ $item->product->name }}</h5>
                                            </a>
                                        </td>
                                        <td class="shoping__cart__price">
                                            ${{ $item->product->price }}
                                        </td>
                                        <td>
                                            <div class="add-to-cart-btn">
                                                <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" value="{{ $item->product->id }}" name="id">
                                                    <input type="hidden" value="{{ $item->product->name }}" name="name">
                                                    <input type="hidden" value="{{ $item->product->price }}" name="price">
                                                    <input type="hidden" value="{{ $item->product->featured_image }}" name="featured_image">
                                                    <input type="hidden" value="1" name="quantity">
                                                    <button class="border-0 d-inline"><i class="fa fa-shopping-cart"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->

@endsection
