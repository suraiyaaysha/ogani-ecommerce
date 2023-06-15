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
                                        <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}" required>
                                        @error('first_name')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" required>
                                        @error('last_name')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" name="address_1" value="{{ old('address_1', $user->userDetails->address_1) }}"
                                    placeholder="Street Address" class="checkout__input__add">
                                <input type="text" name="address_2" value="{{ old('address_2', $user->userDetails->address_2) }}"
                                    placeholder="Apartment, suite, unite ect (optinal)">
                            </div>

                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input type="text" name="city" id="city" value="{{ old('city', $user->userDetails->city) }}" required>
                                @error('city')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="checkout__input">
                                <p>Country/State<span>*</span></p>
                                <input type="text" name="state" id="state" value="{{ old('state', $user->userDetails->state) }}" required>
                                @error('state')
                                    <span>{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="checkout__input">
                                <p>Country<span>*</span></p>
                                <input type="text" name="country" id="country" value="{{ old('country', $user->userDetails->country) }}" required>
                                @error('country')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input type="text" name="zip" id="zip" value="{{ old('zip', $user->userDetails->zip) }}" required>
                                @error('zip')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" name="phone" id="phone" value="{{ old('phone', $user->userDetails->phone) }}"
                                            required>
                                        @error('phone')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="checkout__input__checkbox">
                                <label for="diff-acc">
                                    {{ __('Ship to a different address?') }}
                                    <input type="checkbox" name="ship_to_different_address" id="diff-acc">
                                    <span class="checkmark"></span>
                                </label>
                            </div>

                            {{-- Shipping address fields start --}}
                            <div id="shipping-address-fields" style="display: none;">

                                <h4>Shipping Details</h4>

                                <div class="checkout__input">
                                    <p>Shipping Address<span>*</span></p>
                                    <input type="text" name="shipping_address_1" placeholder="Street Address" class="checkout__input__add">
                                    <input type="text" name="shipping_address_2" placeholder="Apartment, suite, unit, etc. (optional)">
                                </div>

                                <div class="checkout__input">
                                    <p>Shipping Town/City<span>*</span></p>
                                    <input type="text" name="shipping_city" id="shipping_city">
                                </div>

                                <div class="checkout__input">
                                    <p>Shipping Country/State<span>*</span></p>
                                    <input type="text" name="shipping_state" id="shipping_state">
                                </div>

                                {{-- <div class="checkout__input">
                                    <p>Shipping Country<span>*</span></p>
                                    <input type="text" name="shipping_country" id="shipping_country" required>
                                </div> --}}

                                <div class="checkout__input">
                                    <p>Shipping Postcode / ZIP<span>*</span></p>
                                    <input type="text" name="shipping_zip" id="shipping_zip">
                                </div>

                                <div class="checkout__input">
                                    <p>Shipping Phone<span>*</span></p>
                                    <input type="text" name="shipping_phone" id="shipping_zip">
                                </div>
                            </div>
                            {{-- Shipping address fields end --}}


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

                                <h5 class="mb-3">Select Payment Method:</h5>

                                <div class="form-group">
                                    <div class="form-group">
                                    <div class="checkout__input__checkbox">
                                        <label class="form-check-label" for="cash_on_delivery">
                                            Cash on delivery
                                            <input class="form-check-input" type="radio" name="payment_method" required
                                                id="cash_on_delivery" value="cash_on_delivery">

                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                     <div class="checkout__input__checkbox">
                                        <label class="form-check-label" for="stripe">
                                            Stripe
                                            <input class="form-check-input" type="radio" name="payment_method" required
                                                id="stripe" value="stripe">

                                            <span class="checkmark"></span>
                                        </label>
                                    </div>

                                    @error('payment_method')
                                        <span>{{ $message }}</span>
                                    @enderror

                                </div>

                                <div class="text-center">
                                    <button type="submit" class="site-btn" id="checkout-button">Place Order</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection


@push('script')
    <script>
        $(document).ready(function() {
            // Check the checkbox on page load if the shipping address is already different
            if ($("#diff-acc").is(":checked")) {
                $("#shipping-address-fields").show();
            }

            // Show/hide the shipping address fields based on checkbox state
            $("#diff-acc").change(function() {
                if ($(this).is(":checked")) {
                    $("#shipping-address-fields").show();
                } else {
                    $("#shipping-address-fields").hide();
                }
            });
        });
    </script>
@endpush

