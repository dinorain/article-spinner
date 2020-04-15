@extends('layouts.app')

@section('content')
    <div class="flex-center position-ref full-height">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Change Password</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @elseif (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form
                                id="change-password-form"
                                method="POST"
                                action="{{ route('account.password.update', ['id' => Auth::user()->id]) }}""
                                data-parsley-validate
                            >
                                @csrf
                                <div class="form-group row">
                                    <label for="current_password" class="col-sm-3 col-form-label">Current Password</label>
                                    <div class="col-sm-9">
                                        <input
                                            id="current_password"
                                            type="password"
                                            class="form-control{{ $errors->has('current_password') ? ' is-invalid' : '' }}"
                                            name="current_password"
                                            data-parsley-required
                                        />
                                        @if ($errors->has('current_password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('current_password') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-sm-3 col-form-label">New Password</label>
                                    <div class="col-sm-9">
                                        <input
                                            id="password"
                                            type="password"
                                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                            name="password"
                                            data-parsley-required
                                        />
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-sm-3 col-form-label">Confirm New Password</label>
                                    <div class="col-sm-9">
                                        <input
                                            id="password-confirm"
                                            type="password"
                                            class="form-control"
                                            name="password_confirmation"
                                            data-parsley-required
                                        />
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col col-lg-12 col-md-12 col-sm-12 col-12 mb-4">
                                    <span id="error_occured" class="parsley-errors-list">Your password and confirmation password do not match.</span>
                                </div>

                                <div class="form-group pt-1">
                                    <button type="submit" class="btn btn-primary">Reset Password</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        const $errorOccured = $('#error_occured');

        const $form = $('#change-password-form');

        window.Parsley.on('form:submit', function() {

            if ($form.find('#password').val() !== $form.find('#password-confirm').val()) {
                // toastr.error("Your password and confirmation password do not match.", "Error");
                $errorOccured.toggleClass("filled", true);
                return false;
            }
            else
            {
                $errorOccured.toggleClass("filled", false);
                return true;
            }
        });

    </script>
@endsection
