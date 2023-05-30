<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ ('Update Password') }}</h4>

            <form class="form-horizontal" method="POST" action="{{ route('frontend.change_password') }}">
                {{ csrf_field() }}

                <div class="row">

                    <div class="col-lg-6">
                        <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                            <label for="new-password" class="col-md-12 control-label">Current Password</label>

                            <div class="">
                                <input id="current-password" type="password" class="" name="current-password" required>

                                @if ($errors->has('current-password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current-password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                            <label for="new-password" class="col-md-12 control-label">New Password</label>

                            <div class="col-md-12">
                                <input id="new-password" type="password" class="" name="new-password" required>

                                @if ($errors->has('new-password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new-password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <label for="new-password-confirm" class="col-md-12 control-label">Confirm New Password</label>

                    <div class="">
                        <input id="new-password-confirm" type="password" class="" name="new-password_confirmation" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="">
                        <button type="submit" class="site-btn">
                            Update Password
                        </button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>
