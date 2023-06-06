<div class="sidebar">
    <div class="sidebar__item">
        <h4>{{ ('Department') }}</h4>
        <ul>
            @foreach ($categories as $category)
                <li><a href="{{ route('frontend.productsByCategory', $category->slug) }}">{{ $category->name }}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="sidebar__item">
        <h4>Price</h4>
        <div class="price-range-wrap">
            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                data-min="10" data-max="540">
                <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
            </div>
            <div class="range-slider">
                <div class="price-input">
                    <input type="text" id="minamount">
                    <input type="text" id="maxamount">
                </div>
            </div>
        </div>
    </div>

    <div class="sidebar__item sidebar__item__color--option">
        <h4>{{ __('Colors') }}</h4>

        {{-- <div class="sidebar__item__color sidebar__item__color--white">
            <label for="white">
                White
                <input type="radio" id="white">
            </label>
        </div> --}}
        <form action="{{ route('frontend.shop') }}" method="GET">
            @foreach($colors as $color)
                <div class="filter-color-item sidebar__item__color {{ in_array($color->id, $selectedColors) ? 'active' : '' }}"">
                    <label for="{{ $color->slug }}">
                        {{ $color->name }}
                        <input type="checkbox" id="{{ $color->slug }}" name="colors[]" value="{{ $color->id }}" @if(in_array($color->id, $selectedColors)) checked @endif>
                         <style>
                            label[for="{{ $color->slug }}"]::after {
                                background-color: {{ $color->name }};
                            }
                        </style>
                    </label>
                </div>
            @endforeach
            <button type="submit" class="border-0 site-btn btn-sm">Filter</button>
            @if(!empty($selectedColors))
                <a href="{{ route('frontend.shop') }}" class="border-0 site-btn btn-sm">Clear Filter</a>
            @endif
        </form>

    </div>

    <div class="sidebar__item">
        <h4>Popular Size</h4>

        {{-- <div class="sidebar__item__size">
            <label for="large">
                Large
                <input type="radio" id="large">
            </label>
        </div> --}}
        {{-- {{ dd($sizes) }} --}}
        {{-- @foreach($sizes as $size)
            <div class="sidebar__item__size">
                <label for="{{ $size->slug }}">
                    {{ $size->name }}
                    <input type="radio" id="{{ $size->slug }}">
                </label>
            </div>
        @endforeach --}}
{{--
        <form action="{{ route('frontend.shop') }}" method="GET">
            @foreach($sizes as $size)
                <div class="sidebar__item__size">
                    <label for="{{ $size->slug }}" class="{{ $selectedSize == $size->id ? 'active' : '' }}">
                        {{ $size->name }}
                        <input type="radio" id="{{ $size->slug }}" name="size" value="{{ $size->id }}" @if($selectedSize == $size->id) checked @endif>
                    </label>
                </div>
            @endforeach
            <button type="submit" class="border-0 site-btn btn-sm">Filter</button>
        </form> --}}

        <form action="{{ route('frontend.shop') }}" method="GET">
            @foreach($sizes as $size)
                <div class="sidebar__item__size">
                    <label for="{{ $size->slug }}" class="{{ $selectedSize == $size->id ? 'active' : '' }}"> {{--dynamically added class if a button is checked--}}
                        {{ $size->name }}
                        <input type="radio" id="{{ $size->slug }}" name="size" value="{{ $size->id }}" @if($selectedSize == $size->id) checked @endif>
                    </label>
                </div>
            @endforeach
            <button type="submit" class="border-0 site-btn btn-sm">Filter</button>
            @if(!empty($selectedSize))
                <a href="{{ route('frontend.shop') }}" class="border-0 site-btn btn-sm">Clear Filter</a>
            @endif
        </form>



    </div>

    <div class="sidebar__item">
        <div class="latest-product__text">
            <h4>Latest Products</h4>
            <div class="latest-product__slider owl-carousel">

                @foreach ($latestProducts->chunk(3) as $chunk)
                    <div class="latest-prdouct__slider__item">
                        @foreach ($chunk as $product)
                            <a href="#" class="latest-product__item">
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
