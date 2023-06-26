
@extends('frontend.layouts.app')

@section('content')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="frontend/assets/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{ __('Search Result') }}</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('/') }}">{{ __('Home') }}</a>
                            <span>{{ __('Search') }}</span>
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
                                    <select id="sort-products" onchange="sortProducts(this)" class="sort-product">
                                        <option value="default"{{ $selectedSort === 'default' ? ' selected' : '' }}>{{ __('Default') }}</option>
                                        <option value="price_low_high"{{ $selectedSort === 'price_low_high' ? ' selected' : '' }}>{{ __('Price(Low > High)') }}</option>
                                        <option value="price_high_low"{{ $selectedSort === 'price_high_low' ? ' selected' : '' }}>{{ __('Price(High > Low)') }}</option>
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
                            <div class="col-lg-4 col-md-6 col-sm-6">
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

                    {{-- <div class="col-lg-12">
                        <div class="product__pagination">
                            {{ $products->links('frontend.partials.custom-pagination') }}
                             {{ $products->appends(request()->except('page'))->links('frontend.partials.custom-pagination') }}
                        </div>
                    </div> --}}

                    <div class="col-lg-12">
                        <div class="product__pagination">
                            {{-- {{ $products->appends(request()->query())->links('frontend.partials.custom-pagination') }} --}}
                            {{ $products->links('frontend.partials.custom-pagination') }}
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

@endsection

@push('script')

    <!-- Add this script to initialize the price range slider -->
    <script>
        var rangeSlider = $(".price-range"),
            minamount = $("#minamount"),
            maxamount = $("#maxamount"),
            minPrice = rangeSlider.data('min'),
            maxPrice = rangeSlider.data('max'),
            initialMinPrice = parseInt("{{ $minPrice }}"), // Set the initial minimum price value from the backend
            initialMaxPrice = parseInt("{{ $maxPrice }}"); // Set the initial maximum price value from the backend

        rangeSlider.slider({
            range: true,
            min: minPrice,
            max: maxPrice,
            values: [initialMinPrice, initialMaxPrice],
            slide: function (event, ui) {
                minamount.val(ui.values[0]);
                maxamount.val(ui.values[1]);
            }
        });

        minamount.val(rangeSlider.slider("values", 0));
        maxamount.val(rangeSlider.slider("values", 1));

        $("#price-filter-btn").click(function() {
            applyPriceFilter();
        });

        function applyPriceFilter() {
            var minPriceVal = parseInt(minamount.val());
            var maxPriceVal = parseInt(maxamount.val());

            // Perform the necessary action with the selected price range
            // You can submit a form, make an AJAX request, or reload the page with the updated URL parameters
            // Example:
            var url = "{{ route('frontend.shop') }}?min_price=" + minPriceVal + "&max_price=" + maxPriceVal;
            window.location.href = url;
        }

    </script>

    {{-- Sort by --}}
    <script>
        function sortProducts(selectElement) {
            var selectedValue = selectElement.value;
            var currentUrl = window.location.href;

            // Create an anchor element to parse the URL
            var url = document.createElement('a');
            url.href = currentUrl;

            // Remove any existing 'sort' parameter from the URL
            var params = new URLSearchParams(url.search);
            params.delete('sort');

            if (selectedValue) {
                params.set('sort', selectedValue);
            }

            // Set the updated search parameters
            url.search = params.toString();

            // Navigate to the new URL
            window.location.href = url.href;
        }
    </script>

@endpush


