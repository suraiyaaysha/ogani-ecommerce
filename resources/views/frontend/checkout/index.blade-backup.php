@extends('frontend.layouts.app')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ url('frontend/assets/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{ __('Checkout') }}</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('/') }}">{{ __('Home') }}</a>
                            <span>{{ __('Checkout') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <h6 class="mb-3"><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to
                        enter your code
                    </h6>

                    <div class="col-md-5 mb-5">
                        <form action="{{ route('checkout.apply-coupon') }}" method="post">
                            @csrf
                            <input type="text" name="coupon_code" placeholder="Coupon Code" required>
                            <button type="submit" class="filter-btn-sm site-btn mt-2">Apply Coupon</button>
                        </form>
                    </div>

                </div>
            </div>

            <div class="checkout__form">
                <h4>Billing Details</h4>
                <form action="{{ route('checkout.store') }}" method="post">
                    @csrf

                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>First Name<span>*</span></p>
                                        <input type="text" name="first_name" value="{{ old('first_name') }}" required>
                                        @error('first_name')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text" name="last_name" value="{{ old('last_name') }}" required>
                                        @error('last_name')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="checkout__input">
                                <p>Country<span>*</span></p>
                                <input type="text">
                            </div> --}}

                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" name="address_1" value="{{ old('address_1') }}"
                                    placeholder="Street Address" class="checkout__input__add">
                                <input type="text" name="address_2" value="{{ old('address_2') }}"
                                    placeholder="Apartment, suite, unite ect (optinal)">
                            </div>

                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input type="text" name="city" id="city" value="{{ old('city') }}" required>
                                @error('city')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="checkout__input">
                                <p>Country/State<span>*</span></p>
                                <input type="text" name="state" id="state" value="{{ old('state') }}" required>
                                @error('state')
                                    <span>{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="checkout__input">
                                <p>Country<span>*</span></p>
                                <input type="text" name="country" id="country" value="{{ old('country') }}" required>
                                @error('country')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input type="text" name="zip" id="zip" value="{{ old('zip') }}" required>
                                @error('zip')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                                            required>
                                        @error('phone')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div> --}}

                            </div>

                            {{-- <div>
                                <label for="payment_method">Payment Method</label>
                                <select name="payment_method" id="payment_method" required>
                                    <option value="">Select Payment Method</option>
                                    <option value="paypal">PayPal</option>
                                    <!-- Add more options for payment methods if needed -->
                                </select>
                                @error('payment_method')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div> --}}

                            <div class="checkout__input">
                                <p>Order notes<span>*</span></p>
                                <input type="text" name="notes" value="{{ old('notes') }}"
                                    placeholder="Notes about your order, e.g. special notes for delivery.">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order items</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <ul>
                                    @foreach ($cartItems as $cartItem)
                                        <li>{{ $cartItem->name }} - Qty: {{ $cartItem->quantity }} <span>Price:
                                                ${{ $cartItem->price }}</span></li>
                                    @endforeach
                                </ul>
                                <div class="checkout__order__subtotal">Subtotal <span>${{ $subtotal }}</span></div>
                                <div class="checkout__order__total">Total <span>${{ $total }}</span></div>

                                <p>Lorem ipsum dolor sit amet, consectetur adip elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore magna aliqua.</p>

                                <div class="checkout__input__checkbox">
                                    <label for="payment">
                                        Check Payment
                                        <input type="radio" id="payment">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="paypal">
                                        Paypal
                                        <input type="radio" id="paypal">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" required id="cash_on_delivery"
                                        value="option1" checked>
                                    <label class="form-check-label" for="cash_on_delivery">
                                        Default radio
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" required id="stripe" value="option2">
                                    <label class="form-check-label" for="stripe">
                                        Second default radio
                                    </label>
                                </div>

                                <div>
                                    <label for="payment_method">Payment Method</label>
                                    <div>
                                        <select name="payment_method" id="payment_method" required>
                                            <option value="">Select Payment Method</option>
                                            <option value="stripe">Stripe</option>
                                            <option value="cash_on_delivery">Cash On Delivery</option>
                                            <!-- Add more options for payment methods if needed -->
                                        </select>
                                        @error('payment_method')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
