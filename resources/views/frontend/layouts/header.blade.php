<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ogani | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset(url('frontend/assets/css/bootstrap.min.css')) }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="{{ asset(url('frontend/assets/css/font-awesome.min.css')) }}">

{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.js"></script>
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css"> --}}

    <link href="
    https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css
    " rel="stylesheet">

    <link rel="stylesheet" href="{{ asset(url('frontend/assets/css/elegant-icons.css')) }}">
    <link rel="stylesheet" href="{{ asset(url('frontend/assets/css/nice-select.css')) }}">
    <link rel="stylesheet" href="{{ asset(url('frontend/assets/css/jquery-ui.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(url('frontend/assets/css/owl.carousel.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(url('frontend/assets/css/slicknav.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(url('frontend/assets/css/style.css')) }}">

    @stack('style')

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="{{ url('/') }}"><img src="{{ $cms->site_logo }}" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li>
                    <a href="#">
                        <i class="fa fa-heart"></i>
                        @if(auth()->check())
                            <span>show wishlist item quantity</span>
                        @else
                            <span>0</span>
                        @endif
                    </a>
                </li>
                <li>
                    <a href="{{ route('cart.list') }}">
                        <i class="fa fa-shopping-bag"></i>
                        @if(auth()->check())
                            <span>{{ Cart::getTotalQuantity()}}</span>
                        @else
                            <span>0</span>
                        @endif
                    </a>
                </li>
            </ul>
            <div class="header__cart__price">{{ __('item:') }}
                @if(auth()->check())
                    <span>${{ session('total', \Cart::session(auth()->id())->getTotal()) }}</span>
                @else
                    <span>0</span>
                @endif
            </div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                <img src="frontend/assets/img/language.png" alt="">
                <div>{{ __('English') }}</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">{{ __('Spanis') }}</a></li>
                    <li><a href="#">{{ __('English') }}</a></li>
                </ul>
            </div>
            <div class="header__top__right__language header__top__right__auth">
                 <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}"><i class="fa fa-user"></i>{{ __('Login') }}</a>
                    @endif

                    {{-- @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif --}}
                @else
                <div>{{ Auth::user()->first_name }}</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="{{ url('profile') }}">{{ __('Profile') }}</a></li>
                    <li>
                        <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
                @endguest
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                <li><a href="{{ url('shop') }}">{{ __('Shop') }}</a></li>
                <li><a href="{{ url('/blog') }}">{{ __('Blog') }}</a></li>
                <li><a href="{{ url('/contact') }}">{{ __('Contact') }}</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="{{ $cms->facebook_url }}"><i class="fa fa-facebook"></i></a>
            <a href="{{ $cms->twitter_url }}"><i class="fa fa-twitter"></i></a>
            <a href="{{ $cms->linkedin_url }}"><i class="fa fa-linkedin"></i></a>
            <a href="{{ $cms->pinterest_url }}"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> {{ $cms->site_email }}</li>
                <li>{{ $cms->free_shipping_text }}</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> {{ $cms->site_email }}</li>
                                <li>{{ $cms->free_shipping_text }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="{{ $cms->facebook_url }}"><i class="fa fa-facebook"></i></a>
                                <a href="{{ $cms->twitter_url }}"><i class="fa fa-twitter"></i></a>
                                <a href="{{ $cms->linkedin_url }}"><i class="fa fa-linkedin"></i></a>
                                <a href="{{ $cms->pinterest_url }}"><i class="fa fa-pinterest-p"></i></a>
                            </div>
                            <div class="header__top__right__language">
                                <img src="frontend/assets/img/language.png" alt="">
                                <div>{{ __('English') }}</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="#">{{ __('Spanis') }}</a></li>
                                    <li><a href="#">{{ __('English') }}</a></li>
                                </ul>
                            </div>
                            <div class="header__top__right__auth header__top__right__language">
                                {{-- <a href="#">Login</a> --}}


                                <!-- Authentication Links -->
                                @guest
                                    @if (Route::has('login'))
                                        <a href="{{ route('login') }}"><i class="fa fa-user"></i>{{ __('Login') }}</a>
                                    @endif

                                    {{-- @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                        </li>
                                    @endif --}}
                                    @else
                                        <div>{{ Auth::user()->first_name }}</div>
                                        <span class="arrow_carrot-down"></span>
                                        <ul>
                                            <li><a href="{{ url('profile') }}">{{ __('Profile') }}</a></li>
                                            <li>
                                                <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>
                                @endguest

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="{{ url('/') }}"><img src="{{ $cms->site_logo }}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li><a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : '' }}">{{ __('Home') }}</a></li>
                            <li><a href="{{ url('shop') }}" class="{{ Request::is('/shop') ? 'active' : '' }}">{{ __('Shop') }}</a></li>
                            <li><a href="{{ url('/blog') }}" class="{{ Request::is('/blog') ? 'active' : '' }}">{{ __('Blog') }}</a></li>
                            <li><a href="{{ url('/contact') }}" class="{{ Request::is('/contact') ? 'active' : '' }}">{{ __('Contact') }}</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">

                    <div class="header__cart">
                        <ul>
                            <li>
                                 <a href="{{ route('wishlist') }}">
                                    <i class="fa fa-heart"></i>
                                    <span>{{ auth()->check() ? auth()->user()->wishlist->count() : 0 }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('cart.list') }}">
                                    <i class="fa fa-shopping-bag"></i>
                                    @if(auth()->check())
                                        <span>{{ Cart::getTotalQuantity()}}</span>
                                    @else
                                        <span>0</span>
                                    @endif
                                </a>
                            </li>
                        </ul>
                        <div class="header__cart__price">{{ __('item:') }}
                            @if(auth()->check())
                                <span>${{ session('total', \Cart::session(auth()->id())->getTotal()) }}</span>
                            @else
                                <span>0</span>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>{{ __('All departments') }}</span>
                        </div>
                        <ul style="@if (!request()->is('/')) display: none; @endif">

                            @foreach ($categories as $category)
                                <li><a href="{{ route('frontend.productsByCategory', $category->slug) }}">{{ $category->name }}</a></li>
                            @endforeach

                        </ul>
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="hero__search">

                        <div class="hero__search__form">
                            <form action="{{ route('product.search') }}" method="GET">
                                <div class="hero__search__categories">
                                    <select class="hero-search border-0 bg-transparent" name="category">
                                        <option value="">{{ __('All Categories') }}</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $categoryID == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="text" name="search" placeholder="What do you need?">
                                <button type="submit" class="site-btn">{{ __('SEARCH') }}</button>
                            </form>
                        </div>

                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>{{ $cms->site_mobile }}</h5>
                                <span>{{ $cms->site_support_text }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->
