@foreach ($products as $product)
    <div class="col-lg-4 col-md-6 col-sm-6 {{ $product->productCategory->slug }}">
        <div class="featured__item">
            <div class="featured__item__pic set-bg" data-setbg="{{ $product->featured_image }}">
                <ul class="featured__item__pic__hover">
                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                </ul>
            </div>
            <div class="featured__item__text">
                <h6><a href="{{ route('frontend.productDetails', $product->slug) }}">{{ $product->name }}</a></h6>
                <h5>${{ $product->price }}</h5>
                <h1>Id = {{ $product->id }}</h1>
            </div>
        </div>
    </div>
@endforeach

@if ($products->isEmpty())
    <div class="col-lg-12">
        <p>{{ __('No products found.') }}</p>
    </div>
@endif
