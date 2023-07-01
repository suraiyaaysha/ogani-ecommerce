
@extends('frontend.layouts.app')

@section('content')

    <!-- Hero Section Begin -->
    <section class="hero hero-banner-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                </div>
                <div class="col-lg-9">
                    <div class="hero__item set-bg" data-setbg="{{ $cms->banner_img }}">
                        <div class="hero__text">
                            <span>{{ $cms->banner_category_name }}</span>
                            <h2>{!! $cms->banner_title !!}</h2>
                            <p>{{ $cms->banner_text }}</p>
                            <a href="{{ route('frontend.shop') }}" class="primary-btn">{{ __('SHOP NOW') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    @foreach ($categories as $category)
                        <div class="col-lg-3">
                            <div class="categories__item set-bg" data-setbg="{{ asset(url($category->thumbnail)) }}">
                                <h5><a href="{{ route('frontend.productsByCategory', $category->slug) }}">{{ $category->name }}</a></h5>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>{{ __('Featured Product') }}</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            @foreach ($categoriesHasFeaturedProducts as $category)
                                <li data-filter=".{{ $category->slug }}">{{ $category->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">

                @foreach ($featuredProducts as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6 mix {{ $product->productCategory->slug }}">
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
                                                <button type="submit" class="btn wishlist-btn"><i class="fa fa-heart"></i></button>
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
                @endforeach

            </div>
        </div>
    </section>
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="{{ url('frontend/assets/img/banner/banner-1.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="{{ url('frontend/assets/img/banner/banner-2.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <!-- Latest Product Section Begin -->
    <section class="latest-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>{{ __('Latest Products') }}</h4>
                        <div class="latest-product__slider owl-carousel">

                            @foreach ($latestProducts->chunk(3) as $chunk)
                                <div class="latest-prdouct__slider__item">
                                    @foreach ($chunk as $product)
                                        <a href="{{ route('frontend.productDetails', $product->slug) }}" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="{{ $product->featured_image }}" alt="{{ $product->name }}">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>{{ $product->name }}</h6>
                                                <span>{{ $product->price }}</span>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>{{ __('Top Rated Products') }}</h4>
                        <div class="latest-product__slider owl-carousel">
                            @foreach ($reviewedProducts->chunk(3) as $chunk)
                                <div class="latest-prdouct__slider__item">
                                    @foreach ($chunk as $product)
                                        <a href="{{ route('frontend.productDetails', $product->slug) }}" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="{{ $product->featured_image }}" alt="{{ $product->name }}">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>{{ $product->name }}</h6>
                                                <span>{{ $product->price }}</span>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>{{ __('Review Products') }}</h4>
                        <div class="latest-product__slider owl-carousel">
                            @foreach ($reviewedProducts->chunk(3) as $chunk)
                                <div class="latest-prdouct__slider__item">
                                    @foreach ($chunk as $product)
                                        <a href="{{ route('frontend.productDetails', $product->slug) }}" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="{{ $product->featured_image }}" alt="{{ $product->name }}">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>{{ $product->name }}</h6>
                                                <span>{{ $product->price }}</span>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Product Section End -->

    <div class="product__discount">
        <div class="container">

            <div class="section-title product__discount__title">
                <h2>{{ __('Sale Off') }}</h2>
            </div>

            <div class="row">
                <div class="product__discount__slider owl-carousel">
                    @foreach ($discountedProducts as $product)
                        <div class="col-lg-4">
                            <div class="product__discount__item">
                                <div class="product__discount__item__pic set-bg"
                                    data-setbg="{{ $product->featured_image }}">
                                    <div class="product__discount__percent">-{{ $product->discount }}%</div>
                                    <ul class="product__item__pic__hover">
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
                                                    <button type="submit" class="btn wishlist-btn"><i class="fa fa-heart"></i></button>
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
                                <div class="product__discount__item__text">
                                    <span>{{ $product->productCategory->name }}</span>
                                    <h5><a href="{{ route('frontend.productDetails', $product->slug) }}">{{ $product->name }}</a></h5>
                                    <div class="product__item__price">${{ $product->discounted_price }} <span>${{ $product->price }}</span></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>

    <!-- Blog Section Begin -->
    <section class="from-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>{{ __('From The Blog') }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($latestAllBlog as $blog)
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="blog__item">
                            <div class="blog__item__pic">
                                <img src="{{ $blog->thumbnail }}" alt="">
                            </div>
                            <div class="blog__item__text">
                                <ul>
                                    <li><i class="fa fa-calendar-o"></i> {{ $blog->created_at->format('F j, Y') }}</li>
                                    <li><i class="fa fa-comment-o"></i> {{ $blog->comments->count() }}</li>
                                </ul>
                                <h5><a href="{{ url('blog/' . $blog->slug) }}">{!! Str::limit($blog->title, 20) !!}</a></h5>
                                <p>{!! Str::limit($blog->details, 30) !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Blog Section End -->

@endsection

