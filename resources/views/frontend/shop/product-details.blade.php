
@extends('frontend.layouts.app')

@section('content')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/assets/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{ __('Organi Shop') }}</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('/') }}">{{ __('Home') }}</a>
                            {{-- <a href="#">Product category</a> --}}
                            <span>{{ __('Product name') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">

            <div class="row">
                <div class="col-md-12">

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="{{ $product->featured_image }}" alt="">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">

                            @foreach ($product->gallery_images as $image)
                                <img data-imgbigurl="{{ $image }}" src="{{ $image }}" alt="">
                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">

                        <h3>{{ $product->name }}</h3>
                        <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <span>(18 {{ __('reviews') }})</span>
                        </div>

                        <div class="">

                            @if ($product->discounted_price)
                                <div class="product__details__price">
                                    ${{ $product->discounted_price }}
                                    <span class="product__details__price--original text-decoration-line-through d-inline h3">${{ $product->price }}</span>
                                </div>
                            @else
                              <div class="product__details__price">${{ $product->price }}</div>
                            @endif

                        </div>

                        <p>{!! Str::limit($product->description, 30) !!}</p>
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" value="1">
                                </div>
                            </div>
                        </div>
                        <div class="d-inline-block">
                            {{-- <a href="#" class="primary-btn">{{ __('ADD TO CARD') }}</a> --}}
                            <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data" class="d-inline">
                                @csrf
                                <input type="hidden" value="{{ $product->id }}" name="id">
                                <input type="hidden" value="{{ $product->name }}" name="name">
                                <input type="hidden" value="{{ $product->price }}" name="price">
                                <input type="hidden" value="{{ $product->featured_image }}" name="featured_image">
                                <input type="hidden" value="1" name="quantity">
                                <button class="border-0 primary-btn">{{ __('ADD TO CARD') }}</button>
                            </form>
                            {{-- <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a> --}}
                            <!-- Start add to wishlist button -->
                            <!-- Check if the product is already in the user's wishlist -->
                            @if(auth()->check() && auth()->user()->wishlist->contains('product_id', $product->id))
                                <form action="{{ route('wishlist.remove', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn heart-icon"><span class="icon_heart_alt"></span></button>
                                </form>
                            @else
                                <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn heart-icon"><span class="icon_heart_alt"></span></button>
                                </form>
                            @endif
                            <!-- End add to wishlist button -->
                        </div>
                        <ul>
                            <li><b>{{ __('Availability') }}</b> <span> @if($product->quantity > 0) {{ __('In Stock') }} @else {{ __('Out of stock') }} @endif</span> </li>
                            <li><b>{{ __('Shipping') }}</b> <span>01 {{ __('day shipping') }}. <samp>{{ __('Free pickup today') }}</samp></span></li>
                            <li><b>{{ __('Weight') }}</b> <span>{{ $product->weight }} kg</span></li>
                            <li><b>{{ __('Share on') }}</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">{{ __('Description') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false">{{ __('Information') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">{{ __('Reviews') }} <span>({{ $product->reviews->count() }})</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>{{ __('Products Description') }}</h6>
                                    <p>{{ $product->description }}</p>
                                </div>
                            </div>

                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>{{ __('Products Infomation') }}</h6>

                                    {{ $product->information }}

                                </div>
                            </div>

                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>{{ __('Products Reviews') }}</h6>

                                    <div class="container">
                                        <div class="row">
                                            <div class="col mt-4">
                                                <form class="py-2 px-4" action="{{ route('products.reviews.submit', $product->id) }}" style="box-shadow: 0 0 10px 0 #ddd;" method="POST" autocomplete="off">
                                                    @csrf
                                                    <p class="font-weight-bold">{{ __('Write Review') }}</p>
                                                    <div class="form-group row">
                                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                        <div class="col">
                                                            <div class="rate">
                                                                <input type="radio" id="star5" class="rate" name="rating" value="5"/>
                                                                <label for="star5" title="text">{{ __('5 stars') }}</label>
                                                                <input type="radio" checked id="star4" class="rate" name="rating" value="4"/>
                                                                <label for="star4" title="text">{{ __('4 stars') }}</label>
                                                                <input type="radio" id="star3" class="rate" name="rating" value="3"/>
                                                                <label for="star3" title="text">{{ __('3 stars') }}</label>
                                                                <input type="radio" id="star2" class="rate" name="rating" value="2">
                                                                <label for="star2" title="text">{{ __('2 stars') }}</label>
                                                                <input type="radio" id="star1" class="rate" name="rating" value="1"/>
                                                                <label for="star1" title="text">{{ __('1 star') }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mt-4">
                                                        <div class="col">
                                                            <textarea class="form-control" name="review" rows="6" placeholder="Review" maxlength="200"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3 text-right">
                                                        @auth
                                                            <button class="btn btn-sm py-2 px-3 site-btn">{{ __('Submit') }}</button>
                                                        @else
                                                            <a href="{{ route('login') }}" class="btn btn-sm py-2 px-3 site-btn">{{ __('Log in to Submit') }}</a>
                                                        @endauth
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    @if(!empty($product->reviews))
                                        <div class="container">
                                            <div class="row">
                                                <div class="col mt-4">
                                                    <p class="font-weight-bold">{{ __('Review From Buyer\'s') }}</p>
                                                    @foreach($product->reviews as $review)
                                                        <div class="form-group row">
                                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                            <div class="col">
                                                            <div class="rated">
                                                                @for($i=1; $i<=$review->star_rating; $i++)
                                                                <label class="star-rating-complete" title="text">{{$i}} {{ __('stars') }}</label>
                                                                @endfor
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row mt-4">
                                                            <div class="col">
                                                                <p>{{ $review->body }}</p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>{{ __('Related Product') }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($relatedProducts as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6 {{ $product->productCategory->slug }}">
                        <div class="featured__item">
                            <div class="featured__item__pic set-bg" data-setbg="{{ $product->featured_image }}">
                                <ul class="featured__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="featured__item__text">
                                {{-- <h6><a href="{{ /product/$product->product_slug }}}">{{ $product->name }}</a></h6> --}}
                                <h6><a href="{{ route('frontend.productDetails', $product->slug) }}">{{ $product->name }}</a></h6>

                                <h5>${{ $product->price }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->

@endsection

