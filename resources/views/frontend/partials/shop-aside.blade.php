<div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Department</h4>
                            <ul>
                                @foreach ($categories as $category)
                                    <li><a href="#">{{ $category->name }}</a></li>
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
                            <h4>Colors</h4>

                            {{-- <div class="sidebar__item__color sidebar__item__color--white">
                                <label for="white">
                                    White
                                    <input type="radio" id="white">
                                </label>
                            </div> --}}

                            @foreach($colors as $color)
                                <div class="sidebar__item__color sidebar__item__color--{{ $color->slug }}">
                                    <label for="{{ $color->slug }}">
                                        {{ $color->name }}
                                        <input type="radio" id="{{ $color->slug }}">
                                    </label>
                                </div>
                            @endforeach

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
                            @foreach($sizes as $size)
                                <div class="sidebar__item__size">
                                    <label for="{{ $size->slug }}">
                                        {{ $size->name }}
                                        <input type="radio" id="{{ $size->slug }}">
                                    </label>
                                </div>
                            @endforeach

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
