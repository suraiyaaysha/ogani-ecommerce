    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            {{-- <div>
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
            </div> --}}
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="{{ url('/') }}"><img src="{{ $cms->site_logo }}" alt=""></a>
                        </div>
                        <ul>
                            <li>{{ __('Address:') }} {{ $cms->site_address }}</li>
                            <li>{{ __('Phone:') }} {{ $cms->site_mobile }}</li>
                            <li>{{ __('Email:') }} {{ $cms->site_email }}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>{{ __('Useful Links') }}</h6>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">About Our Shop</a></li>
                            <li><a href="#">Secure Shopping</a></li>
                            <li><a href="#">Delivery infomation</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Our Sitemap</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Who We Are</a></li>
                            <li><a href="#">Our Services</a></li>
                            <li><a href="#">Projects</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Innovation</a></li>
                            <li><a href="#">Testimonials</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">

                        <h6>{{ __('Join Our Newsletter Now') }}</h6>
                        <p>{{ $cms->newsletter_text }}</p>
                        <form action="{{ route('subscribe') }}" method="POST">
                            @csrf
                           <div>
                                {{-- <input type="email" name="subscriber_email" placeholder="Enter your mail"> --}}
                                <input type="email" name="subscriber_email" placeholder="Enter your mail">
                                <button type="submit" class="site-btn">{{ __('Subscribe') }}</button>
                           </div>
                            @if($errors->any('subscriber_email'))
                                <div class="text-danger">{{ $errors->first('subscriber_email') }}</div>
                            @endif
                        </form>

                        <div class="footer__widget__social">
                            <a href="{{ $cms->facebook_url }}"><i class="fa fa-facebook"></i></a>
                            <a href="{{ $cms->twitter_url }}"><i class="fa fa-twitter"></i></a>
                            <a href="{{ $cms->linkedin_url }}"><i class="fa fa-linkedin"></i></a>
                            <a href="{{ $cms->pinterest_url }}"><i class="fa fa-pinterest-p"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text">
                            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> {{ $cms->copyright_text }}</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                            </div>
                        <div class="footer__copyright__payment"><img src="{{ $cms->payment_method_img }}" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="{{ asset(url('frontend/assets/js/jquery-3.3.1.min.js')) }}"></script>
    <script src="{{ asset(url('frontend/assets/js/bootstrap.min.js')) }}"></script>
    <script src="{{ asset(url('frontend/assets/js/jquery.nice-select.min.js')) }}"></script>
    <script src="{{ asset(url('frontend/assets/js/jquery-ui.min.js')) }}"></script>
    <script src="{{ asset(url('frontend/assets/js/jquery.slicknav.js')) }}"></script>
    <script src="{{ asset(url('frontend/assets/js/mixitup.min.js')) }}"></script>
    <script src="{{ asset(url('frontend/assets/js/owl.carousel.min.js')) }}"></script>

    <script src="
    https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js
    "></script>

    <script src="{{ asset(url('frontend/assets/js/main.js')) }}"></script>


    <script>
        toastr.options = {
            "progressBar" : true,
            "closeButton" : true,
        }

        @if(Session::has('success'))
                // toastr.success("{{ Session::get('success') }}", 'Success!', {timeOut:1200} );
                toastr.success("{{ Session::get('success') }}", 'Success!');
        @endif

        @if(Session::has('info'))
                toastr.info("{{ Session::get('info') }}", 'Info!' );
        @endif

        @if(Session::has('warning'))
                toastr.warning("{{ Session::get('warning') }}", 'Warning!');
        @endif

        @if(Session::has('error'))
                toastr.error("{{ Session::get('error') }}", 'Error!');
        @endif
    </script>

    @stack('script')

</body>

</html>
