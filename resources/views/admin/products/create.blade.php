@extends('admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-8">
            <div class="profile-box">
                <div class="grid-margin stretch-card">

                    <div class="container">
                        <h1>Create Product</h1>

                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Add your form fields and inputs here -->
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Select Category</label>
                                <select name="product_category_id" class="form-control">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea name="description" id="description" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="information">Information:</label>
                                <textarea name="information" id="information" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="text" name="price" id="price" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="discount">Discount:</label>
                                <input type="text" name="discount" id="discount" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity:</label>
                                <input type="text" name="quantity" id="quantity" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="featured_image">Featured Image:</label>
                                <input type="file" name="featured_image" id="featured_image" class="form-control-file">
                            </div>
                            <div class="form-group">
                                <label for="gallery_images">Gallery Images:</label>
                                <input type="file" name="gallery_images[]" id="gallery_images" class="form-control-file" multiple>
                            </div>
                            <div class="form-group">
                                <label for="weight">Weight:</label>
                                <input type="text" name="weight" id="weight" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="shipping_duration">Shipping Duration:</label>
                                <input type="text" name="shipping_duration" id="shipping_duration" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="shipping_charge">Shipping Charge:</label>
                                <input type="text" name="shipping_charge" id="shipping_charge" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>
                                    <input type="hidden" name="is_featured" value="0">
                                    <input type="checkbox" name="is_featured" value="1">
                                    <span class="check-box-tex ml-2 d-inline-block">{{ __('Is Featured') }}</span>
                                </label>
                            </div>

                            <!-- Color Selection -->
                            <div class="form-group">
                                <label for="colors">Colors</label>
                                <select name="colors[]" id="colors" class="form-control multiple-select" multiple>
                                    @foreach($colors as $color)
                                        <option value="{{ $color->id }}">{{ $color->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Size Selection -->
                            <div class="form-group">
                                <label for="sizes">Sizes</label>
                                <select name="sizes[]" id="sizes" class="form-control multiple-select" multiple>
                                    @foreach($sizes as $size)
                                        <option value="{{ $size->id }}">{{ $size->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="status">Status:</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Create</button>
                            <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
