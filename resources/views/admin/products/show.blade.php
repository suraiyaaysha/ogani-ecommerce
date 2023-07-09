@extends('admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-8">
            <div class="profile-box">
                <div class="grid-margin stretch-card">

                    <div class="container">
        <h1>Product Details</h1>

        <p><strong>ID:</strong> {{ $product->id }}</p>
        <p><strong>Name:</strong> {{ $product->name }}</p>
        <p><strong>Description:</strong> {{ $product->description }}</p>
        <p><strong>Information:</strong> {{ $product->information }}</p>
        <p><strong>Price:</strong> {{ $product->price }}</p>
        <p><strong>Discount:</strong> {{ $product->discount }}</p>
        <p><strong>Quantity:</strong> {{ $product->quantity }}</p>
        <p><strong>Featured Image:</strong> <img src="{{ asset(url($product->featured_image)) }}" alt="Featured Image" width="200"></p>
        <p><strong>Gallery Images:</strong></p>
        <div class="row">
            @foreach ($product->gallery_images as $image)
                <div class="col-md-3">
                    <img src="{{ asset(url($image)) }}" alt="Gallery Image" width="150">
                </div>
            @endforeach
        </div>
        <p><strong>Weight:</strong> {{ $product->weight }}</p>
        <p><strong>Shipping Duration:</strong> {{ $product->shipping_duration }}</p>
        <p><strong>Shipping Charge:</strong> {{ $product->shipping_charge }}</p>
        <p><strong>Is Featured:</strong> {{ $product->is_featured ? 'Yes' : 'No' }}</p>
        <p><strong>Status:</strong> {{ $product->status }}</p>

        <a href="{{ route('products.edit', $product) }}" class="btn btn-secondary">Edit</a>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
