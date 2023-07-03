@extends('admin.layouts.app')

@section('content')
    {{-- <h1>{{ __('Product Category Details') }}</h1> --}}

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
                            <h3 class="card-title">Product Category Details</h3>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $productCategory->id }}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $productCategory->name }}</td>
                                </tr>
                                <tr>
                                    <th>Thumbnail</th>
                                    <td>
                                        @if($productCategory->thumbnail)
                                            <img src="{{ asset($productCategory->thumbnail) }}" alt="Thumbnail" class="admin-product-cat-img" style="max-width: 200px;">
                                        @else
                                            No thumbnail available.
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{ ucfirst($productCategory->status) }}</td>
                                </tr>
                                <tr>
                                    <th>Featured</th>
                                    <td>{{ $productCategory->is_featured ? 'Yes' : 'No' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
