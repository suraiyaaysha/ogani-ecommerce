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

                <button type="submit" class="btn btn-primary me-2">Update</button>
            </form>

        </div>
    </div>
</div>

