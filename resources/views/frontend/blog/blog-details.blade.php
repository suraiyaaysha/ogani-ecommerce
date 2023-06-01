
@extends('frontend.layouts.app')

@section('content')

    <!-- Blog Details Hero Begin -->
    <section class="blog-details-hero set-bg" data-setbg="{{ asset(url($blog->thumbnail)) }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog__details__hero__text">
                        <h2>{{ $blog->title }}</h2>
                        <ul>
                            <li>By {{ $blog->user->first_name }} {{ $blog->user->last_name }}</li>
                            <li>{{ $blog->created_at->format('F j , Y') }}</li>
                            <li>{{ $blog->comments->count() }} {{ __('Comments') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Hero End -->

    <!-- Blog Section Begin -->
    <section class="blog-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5">
                    @include('frontend.partials.blog-aside')
                </div>
                <div class="col-lg-8 col-md-7 order-md-1 order-1">

                    <div class="blog__details__text">
                        {{ $blog->details }}
                    </div>

                    <div class="blog__details__content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="blog__details__author">
                                    <div class="blog__details__author__pic">
                                        @if ($blog->user->profile_photo)
                                            <img src="{{ asset($blog->user->profile_photo) }}" alt="">
                                        @else
                                            <img src="{{ Avatar::create($blog->user()->first_name)->toBase64() }}" alt="Avatar">
                                        @endif
                                    </div>
                                    <div class="blog__details__author__text">
                                        <h6>{{ $blog->user->first_name }} {{ $blog->user->last_name }}</h6>
                                        <span>
                                            @if ($blog->user->is_admin)
                                            {{ __('Admin') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="blog__details__widget">
                                    <ul>
                                        <li><span>{{ __('Categories') }}:</span> {{ $blog->blogCategory->name }}</li>
                                        <li>
                                            <span>{{ __('Tags') }}:</span>
                                            {{ __('All') }}
                                            {{-- First check if blogs has tags then execute retrive tags --}}
                                            @if ($blog->tags->count() > 1)
                                                ,
                                                @foreach ($blog->tags as $tag)
                                                    {{ $tag->name }}
                                                    {{-- Add comma(,) after every tags except last tag --}}
                                                    @if (!$loop->last)
                                                        ,
                                                    @endif
                                                @endforeach

                                            @endif

                                        </li>
                                    </ul>
                                    <div class="blog__details__social">
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                        <a href="#"><i class="fa fa-google-plus"></i></a>
                                        <a href="#"><i class="fa fa-linkedin"></i></a>
                                        <a href="#"><i class="fa fa-envelope"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->

    <!-- Related Blog Section Begin -->
    <section class="related-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related-blog-title">
                        <h2>{{ __('Post You May Like') }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">

                @foreach ($relatedBlogs as $blog)
                    <div class="col-lg-4 col-md-4 col-sm-6">
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
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- Related Blog Section End -->

@endsection

