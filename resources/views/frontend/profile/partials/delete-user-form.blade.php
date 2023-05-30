<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ __('Delete Account') }}</h4>

            <p class="mt-1">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
            </p>


            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirm-user-deletion">
                {{ __('Delete Account') }}
            </button>

            <div class="modal fade" id="confirm-user-deletion" tabindex="-1" role="dialog" aria-labelledby="confirmUserDeletionLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="post" action="{{ route('frontend.profile.destroy') }}" class="p-6">
                            @csrf
                            @method('delete')

                            <div class="modal-header">
                                <h4 class="modal-title fw-600 text-black" id="confirmUserDeletionLabel">
                                    {{ __('Are you sure you want to delete your account?') }}
                                </h4>
                                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button> --}}
                            </div>

                            <div class="modal-body">
                                <p class="mt-1 text-sm text-gray-600 mt-2 font-18 fw-500">
                                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                                </p>

                                <div class="mt-6">
                                    <label for="password" class="form-label">{{ __('Password') }}</label>
                                    <input
                                        id="password"
                                        name="password"
                                        type="password"
                                        class="form-control"
                                        placeholder="{{ __('Password') }}"
                                    />

                                    @error('password', 'userDeletion')
                                        <div class="mt-2 text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="modal-footer text-end">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    {{ __('Cancel') }}
                                </button>

                                <button type="submit" class="btn btn-danger">
                                    {{ __('Delete Account') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@if ($errors->userDeletion->isNotEmpty())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var modal = new bootstrap.Modal(document.getElementById('confirm-user-deletion'), {
                focus: true
            });

            modal.show();
        });
    </script>
@endif
