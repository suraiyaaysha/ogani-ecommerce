
@extends('frontend.layouts.app')

@section('content')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ url($cms->page_banner_img) }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{ __('Contact Us') }}</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('/') }}">{{ __('Home') }}</a>
                            <span>{{ __('Contact Us') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_phone"></span>
                        <h4>{{ __('Phone') }}</h4>
                        <p>{{ $cms->site_mobile }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_pin_alt"></span>
                        <h4>{{ __('Address') }}</h4>
                        <p>{{ $cms->site_address }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_clock_alt"></span>
                        <h4>{{ __('Open time') }}</h4>
                        <p>{{ $cms->business_open_time }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_mail_alt"></span>
                        <h4>{{ __('Email') }}</h4>
                        <p>{{ $cms->site_email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

    <!-- Map Begin -->
    <div class="map">
        <iframe
            src="{{ $cms->google_map_url }}"
            height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        <div class="map-inside">
            <i class="icon_pin"></i>
            <div class="inside-widget">
                <h4>{{ $cms->site_country }}</h4>
                <ul>
                    <li>Phone: {{ $cms->site_mobile }}</li>
                    <li>Add: {{ $cms->site_address}}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Map End -->

    <!-- Contact Form Begin -->
    <div class="contact-form spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact__form__title">
                        <h2>{{ __('Leave Message') }}</h2>
                    </div>
                </div>
            </div>
            <form action="{{ route('frontend.storeContactForm') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        {{-- <input type="text" placeholder="Your name" name="name" value="{{ auth()->check() ? auth()->user()->name : old('name') }}"> --}}
                        <input type="text" placeholder="Your name" name="name" value="{{ auth()->check() ? auth()->user()->first_name . ' ' . auth()->user()->last_name : old('name') }}">
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <input type="email" placeholder="Your Email" name="email" value="{{ auth()->check() ? auth()->user()->email : old('email') }}">
                    </div>
                    <div class="col-lg-12 text-center">
                        <textarea placeholder="Your message" name="message"></textarea>
                        <button type="submit" class="site-btn">{{ __('SEND MESSAGE') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Contact Form End -->

@endsection

