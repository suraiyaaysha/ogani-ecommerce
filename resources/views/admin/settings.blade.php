@extends('admin.layouts.app')

@section('content')
    <h1>{{ __('Settings') }}</h1>

    <div class="row">
        <div class="col-md-8">
            {{-- show message --}}
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            {{-- show message --}}
        </div>

    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="profile-box">
                <div class="grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">{{ ('Update Settings') }}</h3>

                            <form class="forms-sample" method="POST" action="{{ route('admin.cmsUpdate') }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="card-inner mb-3 p-3">
                                    <h4 class="mb-3">Header Settings</h4>
                                    <div class="form-group">
                                        <label>{{ __('Site Logo') }}</label>
                                        <input type="file" class="form-control" name="site_logo" placeholder="Post thumbnail">

                                        @if ($errors->has('site_logo'))
                                            <span class="text-danger">{{ $errors->first('site_logo') }}</span>
                                        @endif

                                        {{-- Show previous image --}}
                                        @if($cms->site_logo)

                                            <img src="{{ asset(url($cms->site_logo)) }}" class="admin-profile-photo mt-2 mb-2">

                                        @else
                                            <p>No image found!</p>
                                        @endif
                                        {{-- Show previous image --}}

                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Site Email') }}</label>
                                            <input type="email" class="form-control" name="site_email" placeholder="Site Email"
                                                value="{{ old('site_email', $cms->site_email) }}" autocomplete="site_email">

                                            @if ($errors->has('site_email'))
                                                <span class="text-danger">{{ $errors->first('site_email') }}</span>
                                            @endif
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('Site Mobile') }}</label>
                                                <input type="text" class="form-control" name="site_mobile" placeholder="Site Mobile"
                                                    value="{{ old('site_mobile', $cms->site_mobile) }}" autocomplete="site_mobile">

                                                @if ($errors->has('site_mobile'))
                                                    <span class="text-danger">{{ $errors->first('site_mobile') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('Site Suppor Text') }}</label>
                                                <input type="text" class="form-control" name="site_support_text" placeholder="Site Suppor Text"
                                                    value="{{ old('site_support_text', $cms->site_support_text) }}" autocomplete="site_support_text">

                                                @if ($errors->has('site_support_text'))
                                                    <span class="text-danger">{{ $errors->first('site_support_text') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('Free shipping text') }}</label>
                                                <input type="text" class="form-control" name="free_shipping_text" placeholder="Free shipping text"
                                                    value="{{ old('free_shipping_text', $cms->free_shipping_text) }}" autocomplete="free_shipping_text">

                                                @if ($errors->has('free_shipping_text'))
                                                    <span class="text-danger">{{ $errors->first('free_shipping_text') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('Facebook Url') }}</label>
                                                <input type="url" class="form-control" name="facebook_url" placeholder="Facebook Url"
                                                    value="{{ old('facebook_url', $cms->facebook_url) }}" autocomplete="facebook_url">

                                                @if ($errors->has('facebook_url'))
                                                    <span class="text-danger">{{ $errors->first('facebook_url') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('Twitter Url') }}</label>
                                                <input type="url" class="form-control" name="twitter_url" placeholder="Twitter Url"
                                                    value="{{ old('twitter_url', $cms->twitter_url) }}" autocomplete="twitter_url">

                                                @if ($errors->has('twitter_url'))
                                                    <span class="text-danger">{{ $errors->first('twitter_url') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('Linkedin Url') }}</label>
                                                <input type="url" class="form-control" name="linkedin_url" placeholder="Linkedin Url"
                                                    value="{{ old('linkedin_url', $cms->linkedin_url) }}" autocomplete="linkedin_url">

                                                @if ($errors->has('linkedin_url'))
                                                    <span class="text-danger">{{ $errors->first('linkedin_url') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('Pinterest Url') }}</label>
                                                <input type="url" class="form-control" name="pinterest_url" placeholder="Pinterest Url"
                                                    value="{{ old('pinterest_url', $cms->pinterest_url) }}" autocomplete="pinterest_url">

                                                @if ($errors->has('pinterest_url'))
                                                    <span class="text-danger">{{ $errors->first('pinterest_url') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-inner mb-3 p-3">

                                    <h4 class="mb-3">Footer Settings</h4>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('Copyright Text') }}</label>
                                                <input type="text" class="form-control" name="copyright_text" placeholder="Copyright Text"
                                                    value="{{ old('copyright_text', $cms->copyright_text) }}" autocomplete="copyright_text">

                                                @if ($errors->has('copyright_text'))
                                                    <span class="text-danger">{{ $errors->first('copyright_text') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('Footer Payment method image') }}</label>
                                                <input type="file" class="form-control" name="payment_method_img" placeholder="Post thumbnail">

                                                @if ($errors->has('payment_method_img'))
                                                    <span class="text-danger">{{ $errors->first('payment_method_img') }}</span>
                                                @endif

                                                {{-- Show previous image --}}
                                                @if($cms->payment_method_img)

                                                    <img src="{{ asset(url($cms->payment_method_img)) }}" class="admin-profile-photo mt-2 mb-2">

                                                @else
                                                    <p>No image found!</p>
                                                @endif
                                                {{-- Show previous image --}}

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('Newsletter Text') }}</label>
                                                <input type="text" class="form-control" name="newsletter_text" placeholder="Newsletter Text"
                                                    value="{{ old('newsletter_text', $cms->newsletter_text) }}" autocomplete="newsletter_text">

                                                @if ($errors->has('newsletter_text'))
                                                    <span class="text-danger">{{ $errors->first('newsletter_text') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="card-inner mb-3 p-3">

                                    <h4 class="mb-3">Contact Page Settings</h4>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('Site Address') }}</label>
                                                <input type="text" class="form-control" name="site_address" placeholder="Site Address"
                                                    value="{{ old('site_address', $cms->site_address) }}" autocomplete="site_address">

                                                @if ($errors->has('site_address'))
                                                    <span class="text-danger">{{ $errors->first('site_address') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('Site Country') }}</label>
                                                <input type="text" class="form-control" name="site_country" placeholder="Site Country"
                                                    value="{{ old('site_country', $cms->site_country) }}" autocomplete="site_country">

                                                @if ($errors->has('site_country'))
                                                    <span class="text-danger">{{ $errors->first('site_country') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('Business open time') }}</label>
                                                <input type="text" class="form-control" name="business_open_time" placeholder="Business open time"
                                                    value="{{ old('business_open_time', $cms->business_open_time) }}" autocomplete="business_open_time">

                                                @if ($errors->has('business_open_time'))
                                                    <span class="text-danger">{{ $errors->first('business_open_time') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('Google map url') }}</label>
                                                <input type="text" class="form-control" name="google_map_url" placeholder="Google map url"
                                                    value="{{ old('google_map_url', $cms->google_map_url) }}" autocomplete="google_map_url">

                                                @if ($errors->has('google_map_url'))
                                                    <span class="text-danger">{{ $errors->first('google_map_url') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="card-inner mb-3 p-3">

                                    <h4 class="mb-3">Home Banner Settings</h4>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('Banner category name') }}</label>
                                                <input type="text" class="form-control" name="banner_category_name" placeholder="Banner category name"
                                                    value="{{ old('banner_category_name', $cms->banner_category_name) }}" autocomplete="banner_category_name">

                                                @if ($errors->has('banner_category_name'))
                                                    <span class="text-danger">{{ $errors->first('banner_category_name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('Banner Title') }}</label>
                                                <input type="text" class="form-control" name="banner_title" placeholder="Banner Title"
                                                    value="{{ old('banner_title', $cms->banner_title) }}" autocomplete="banner_title">

                                                @if ($errors->has('banner_title'))
                                                    <span class="text-danger">{{ $errors->first('banner_title') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('Banner text') }}</label>
                                                <input type="text" class="form-control" name="banner_text" placeholder="Banner text"
                                                    value="{{ old('banner_text', $cms->banner_text) }}" autocomplete="banner_text">

                                                @if ($errors->has('banner_text'))
                                                    <span class="text-danger">{{ $errors->first('banner_text') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('Home Banner image') }}</label>
                                                <input type="file" class="form-control" name="banner_img" placeholder="Post thumbnail">

                                                @if ($errors->has('banner_img'))
                                                    <span class="text-danger">{{ $errors->first('banner_img') }}</span>
                                                @endif

                                                {{-- Show previous image --}}
                                                @if($cms->banner_img)

                                                    <img src="{{ asset(url($cms->banner_img)) }}" class="admin-profile-photo mt-2 mb-2">

                                                @else
                                                    <p>No image found!</p>
                                                @endif
                                                {{-- Show previous image --}}

                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="card-inner mb-3 p-3">

                                    <h4 class="mb-3">Page Banner image Settings</h4>

                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{ __('Page Banner image') }}</label>
                                                <input type="file" class="form-control" name="page_banner_img" placeholder="Page banner thumbnail">

                                                @if ($errors->has('page_banner_img'))
                                                    <span class="text-danger">{{ $errors->first('page_banner_img') }}</span>
                                                @endif

                                                {{-- Show previous image --}}
                                                @if($cms->page_banner_img)

                                                    <img src="{{ asset(url($cms->page_banner_img)) }}" class="admin-profile-photo mw-100 mt-2 mb-2">

                                                @else
                                                    <p>No image found!</p>
                                                @endif
                                                {{-- Show previous image --}}

                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <button type="submit" class="btn btn-primary me-2">{{ __('Update Now') }}</button>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
