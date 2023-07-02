@extends('admin.layouts.app')

@section('content')
    <h1>{{ ('Contact List') }}</h1>

    <div class="row">
        <div class="col-md-8">
            {{-- show message --}}
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
            {{-- show message --}}
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="profile-box">
                <div class="grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">

                            <div class="card-body">
                                <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>{{ __('User Name') }}</th>
                                        <th>{{ __('User email') }}</th>
                                        <th>{{ __('Message') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($contacts as $contact)
                                            <tr>
                                                <td>{{ $contact->name }}</td>
                                                <td>{{ $contact->email }}</td>
                                                <td>{!! Str::limit($contact->message, 15) !!}</td>

                                                <td>
                                                    <div class="d-inline-flex">

                                                        {{-- <a href="{{ route('admin.contactShow', $contact->id) }}" class="badge badge-success">View</a> --}}

                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="me-2 btn badge badge-success view-contact" data-contact-id="{{ $contact->id }}" data-bs-toggle="modal"
                                                            data-bs-target="#contact-modal">
                                                            {{ __('View') }}
                                                        </button>


                                                        {{-- <a href="" class="badge badge-danger">Delete</a> --}}
                                                        <form action="{{ route('admin.contact.destroy', $contact->id) }}" method="POST" class="delete-form mb-0">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="me-2 btn badge badge-danger delete-contact">{{ __('Delete') }}</button>
                                                        </form>
                                                    </div>
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
        </div>
    </div>
@endsection

<!-- Modal -->
<div class="modal fade" id="contact-modal" tabindex="-1" aria-labelledby="contact-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contact-modal-label">Contact Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="contact-details"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@push('script')
{{-- For contact details  --}}
<script>
        $('.view-contact').on('click', function () {
            var contactId = $(this).data('contact-id');

            $.ajax({
                url: '/admin/contact/' + contactId,
                method: 'GET',
                success: function (response) {
                    $('#contact-details').html(response);
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    </script>

    {{-- For sweet alert to delete confirmation --}}
    {{-- <script>
        $(document).ready(function () {
            $('.delete-contact').on('click', function (e) {
                e.preventDefault();
                var form = $(this).closest('form');
                var contactId = form.data('contact-id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script> --}}

    {{-- For sweet alert to delete confirmation and also show success for successfully delete item --}}
    <script>
    $(document).ready(function () {
        $('.delete-contact').on('click', function (e) {
            e.preventDefault();
            var form = $(this).closest('form');
            var contactId = form.data('contact-id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: form.attr('action'),
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            Swal.fire({
                                title: 'Deleted!',
                                text: response.message,
                                icon: 'success',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function (xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                }
            });
        });
    });
</script>

@endpush
