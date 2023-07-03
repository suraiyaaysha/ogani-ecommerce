@extends('admin.layouts.app')

@section('content')
    {{-- <h1>{{ __('Edit Product Category') }}</h1> --}}

    {{-- <div class="row">
        <div class="col-md-8">
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
        </div>
    </div> --}}

    <div class="row">
        <div class="col-md-8">
            <div class="profile-box">
                <div class="grid-margin stretch-card">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Product Category</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('product-categories.update', $productCategory) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ $productCategory->name }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="thumbnail">Thumbnail</label>
                                    <input type="file" name="thumbnail" id="thumbnail" class="form-control-file">
                                    @if($productCategory->thumbnail)
                                        <img src="{{ asset($productCategory->thumbnail) }}" alt="Thumbnail" class="admin-product-cat-img mt-2" style="max-width: 200px;">
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="active" {{ $productCategory->status === 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ $productCategory->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="is_featured">Featured</label>
                                    <select name="is_featured" id="is_featured" class="form-control" required>
                                        <option value="1" {{ $productCategory->is_featured ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ !$productCategory->is_featured ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
