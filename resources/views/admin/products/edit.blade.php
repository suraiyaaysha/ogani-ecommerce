@extends('admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-8">
            <div class="profile-box">
                <div class="grid-margin stretch-card">

                <div class="container">
                    <h1>Edit Product</h1>

                    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Add your form fields and inputs here -->
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" required>
                        </div>

                        <div class="form-group">
                            <label>Select Category</label>
                            <select name="product_category_id" class="form-control">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->product_category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea name="description" id="description" class="form-control" required>{{ $product->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="information">Information:</label>
                            <textarea name="information" id="information" class="form-control" required>{{ $product->information }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="text" name="price" id="price" class="form-control" value="{{ $product->price }}" required>
                        </div>
                        <div class="form-group">
                            <label for="discount">Discount:</label>
                            <input type="text" name="discount" id="discount" class="form-control" value="{{ $product->discount }}">
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity:</label>
                            <input type="text" name="quantity" id="quantity" class="form-control" value="{{ $product->quantity }}" required>
                        </div>
                        <div class="form-group">
                            <label for="featured_image">Featured Image:</label>
                            <input type="file" name="featured_image" id="featured_image" class="form-control-file">

                            @if ($product->featured_image)
                                <img src="{{ asset(url($product->featured_image)) }}" alt="" class="admin-product-cat-img">
                            @endif

                        </div>
                        <div class="form-group">
                            <label for="gallery_images">Gallery Images:</label>
                            <input type="file" name="gallery_images[]" id="gallery_images" class="form-control-file" multiple>

                            @if ($product->gallery_images)
                                <div class="row">
                                    @foreach ($product->gallery_images as $image)
                                        <div class="col-md-3">
                                            <img src="{{ asset(url($image)) }}" alt="Gallery Image" width="150">
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                        </div>
                        <div class="form-group">
                            <label for="weight">Weight:</label>
                            <input type="text" name="weight" id="weight" class="form-control" value="{{ $product->weight }}">
                        </div>
                        <div class="form-group">
                            <label for="shipping_duration">Shipping Duration:</label>
                            <input type="text" name="shipping_duration" id="shipping_duration" class="form-control" value="{{ $product->shipping_duration }}">
                        </div>
                        <div class="form-group">
                            <label for="shipping_charge">Shipping Charge:</label>
                            <input type="text" name="shipping_charge" id="shipping_charge" class="form-control" value="{{ $product->shipping_charge }}">
                        </div>

                        <div class="form-group">
                            <label>
                                <input type="hidden" name="is_featured" value="0">
                                <input type="checkbox" name="is_featured" value="1" {{ $product->is_featured ? 'checked' : '' }}>
                                <span class="check-box-tex ml-2 d-inline-block">{{ __('Is Featured') }}</span>
                            </label>
                        </div>

                        <!-- Color Selection -->
                        <div class="form-group">
                            <label for="colors">Colors</label>
                            <select name="colors[]" id="colors" class="form-control multiple-select" multiple>
                                @foreach($colors as $color)
                                    <option value="{{ $color->id }}" {{ in_array($color->id, $product->colors->pluck('id')->toArray()) ? 'selected' : '' }}>
                                        {{ $color->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Size Selection -->
                        <div class="form-group">
                            <label for="sizes">Sizes</label>
                            <select name="sizes[]" id="sizes" class="form-control multiple-select" multiple>
                                @foreach($sizes as $size)
                                    <option value="{{ $size->id }}" {{ in_array($size->id, $product->sizes->pluck('id')->toArray()) ? 'selected' : '' }}>
                                        {{ $size->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="active" {{ $product->status === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $product->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
                    </form>

                </div>

                </div>
            </div>
        </div>
    </div>

@endsection
