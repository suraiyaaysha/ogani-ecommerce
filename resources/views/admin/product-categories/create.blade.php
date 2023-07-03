@extends('admin.layouts.app')

@section('content')
    {{-- <h1>{{ __('Create Product Category') }}</h1> --}}

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
                            <h3 class="card-title">Add New Product Category</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('product-categories.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="thumbnail">Thumbnail</label>
                                    <input type="file" name="thumbnail" id="thumbnail" class="form-control-file">
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="is_featured">Featured</label>
                                    <select name="is_featured" id="is_featured" class="form-control" required>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
