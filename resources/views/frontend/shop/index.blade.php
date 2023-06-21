
@extends('frontend.layouts.app')

@section('content')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="frontend/assets/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{ __('Organi Shop') }}</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('/') }}">{{ __('Home') }}</a>
                            <span>{{ __('Shop') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    @include('frontend.partials.shop-aside')
                </div>
                <div class="col-lg-9 col-md-7">

                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>{{ __('Sort By') }}</span>
                                    <select>
                                        <option value="0">Default</option>
                                        <option value="0">Default</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6><span>{{ $products->count() }}</span> {{ __('Products found') }}</h6>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3">
                                <div class="filter__option">
                                    <span class="icon_grid-2x2"></span>
                                    <span class="icon_ul"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                         @forelse ($products as $product)
                            <div class="col-lg-4 col-md-6 col-sm-6 {{ $product->productCategory->slug }}">
                                <div class="featured__item">
                                    <div class="featured__item__pic set-bg" data-setbg="{{ $product->featured_image }}">
                                        <ul class="featured__item__pic__hover">

                                            <!-- Start add to wishlist button -->
                                            <li>
                                                <!-- Check if the product is already in the user's wishlist -->
                                                @if(auth()->check() && auth()->user()->wishlist->contains('product_id', $product->id))
                                                    <form action="{{ route('wishlist.remove', $product->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger wishlist-btn"><i class="fa fa-heart"></i></button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('wishlist.add', $product->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-danger wishlist-btn"><i class="fa fa-heart"></i></button>
                                                    </form>
                                                @endif
                                            </li>
                                            <!-- End add to wishlist button -->

                                            <li><button class="btn compare-btn"><i class="fa fa-retweet"></i></button></li>
                                            <li class="add-to-cart-btn">
                                                <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" value="{{ $product->id }}" name="id">
                                                    <input type="hidden" value="{{ $product->name }}" name="name">
                                                    <input type="hidden" value="{{ $product->price }}" name="price">
                                                    <input type="hidden" value="{{ $product->featured_image }}" name="featured_image">
                                                    <input type="hidden" value="1" name="quantity">
                                                    <button class="border-0"><i class="fa fa-shopping-cart"></i></button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="featured__item__text">
                                        <h6><a href="{{ route('frontend.productDetails', $product->slug) }}">{{ $product->name }}</a></h6>
                                        <h5>${{ $product->price }}</h5>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-lg-12">
                                <p>{{ __('No products found.') }}</p>
                            </div>
                        @endforelse

                    </div>

                    <div class="col-lg-12">
                        <div class="product__pagination">
                            {{ $products->links('frontend.partials.custom-pagination') }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

@endsection
