@extends('admin.layouts.app')

@section('content')
    {{-- <h1>{{ __('Product Category List') }}</h1> --}}

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
                            <h3 class="card-title">Product Categories</h3>
                            <div class="card-tools">
                                <a href="{{ route('product-categories.create') }}" class="btn btn-primary">Add New</a>
                            </div>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Featured</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($productCategories as $productCategory)
                                        <tr>
                                            <td>{{ $productCategory->id }}</td>
                                            <td>{{ $productCategory->name }}</td>
                                            <td>{{ ucfirst($productCategory->status) }}</td>
                                            <td>{{ $productCategory->is_featured ? 'Yes' : 'No' }}</td>
                                            <td>
                                                <a href="{{ route('product-categories.show', $productCategory) }}" class="btn btn-sm btn-info">View</a>
                                                <a href="{{ route('product-categories.edit', $productCategory) }}" class="btn btn-sm btn-primary">Edit</a>
                                                <form action="{{ route('product-categories.destroy', $productCategory) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this product category?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
