
@extends('frontend.layouts.app')

@section('content')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="frontend/assets/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{ __('Blog') }}</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('/') }}">{{ __('Home') }}</a>
                            <span>{{ __('Blog') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5">
                    @include('frontend.partials.blog-aside')
                </div>
                <div class="col-lg-8 col-md-7">
                    <div class="row">

                        @foreach ($blogs as $blog)
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="blog__item">
                                    <div class="blog__item__pic">
                                        <img src="{{ $blog->thumbnail }}" alt="">
                                    </div>
                                    <div class="blog__item__text">
                                        <ul>
                                            <li><i class="fa fa-calendar-o"></i> {{ $blog->created_at->format('F j, Y') }}</li>
                                            <li><i class="fa fa-comment-o"></i> {{ $blog->comments->count() }}</li>
                                        </ul>
                                        <h5><a href="{{ url('blog/' . $blog->slug) }}">{!! Str::limit($blog->title, 20) !!}</a></h5>
                                        <p>{!! Str::limit($blog->details, 30) !!}</p>
                                        <a href="{{ url('blog/' . $blog->slug) }}" class="blog__btn">{{ __('READ MORE') }} <span class="arrow_right"></span></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {{-- <div class="col-lg-12">
                            <div class="product__pagination blog__pagination">
                                {{ $blogs->links('frontend.partials.custom-pagination')}}
                            </div>
                        </div> --}}

                        <div class="col-lg-12">
                            <div class="product__pagination blog__pagination">
                                {{  $blogs->withQueryString()->links('frontend.partials.custom-pagination') }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->

@endsection

