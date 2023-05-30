<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ ('Update Info') }}</h4>

            <form class="forms-sample" method="POST" action="{{ route('admin.profile', auth()->id()) }}"
                enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>{{ __('First Name') }}</label>
                    <input type="text" class="form-control" name="first_name" placeholder="First Name"
                        value="{{ old('first_name', auth()->user()->first_name) }}" required autocomplete="first_name">

                    @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{ __('Last Name') }}</label>
                    <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="{{ old('last_name', auth()->user()->last_name) }}" required autocomplete="last_name">

                    @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>{{ __('Email address') }}</label>
                    <input type="email" class="form-control" name="email" placeholder="Email Address" name="email" value="{{ old('email', auth()->user()->email) }}" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Change Profile Photo</label>
                    <div class="col-sm-12">
                        <img id="preview" src="#" alt="your image" class="mt-3 mb-3" style="display:none;" class="admin-profile-photo">
                        <input type="file" class="form-control" name="profile_photo" @error('profile_photo') is-invalid @enderror id="selectImage">

                        @error('profile_photo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        {{-- Show previous image --}}
                        <label class="col-12 mt-3 mb-3">Previous Profile Photo:</label>
                        @if(auth()->user()->profile_photo)

                            <img src="{{ asset(url(auth()->user()->profile_photo)) }}" class="admin-profile-photo">

                        @else
                            <p>No image found!</p>
                        @endif
                        {{-- Show previous image --}}

                    </div>
                </div>

                <button type="submit" class="btn btn-primary me-2">Update</button>
            </form>

        </div>
    </div>
</div>
