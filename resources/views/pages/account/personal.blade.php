@extends('layouts.app')

@section('content')
    <div class="flex-center position-ref full-height">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Edit Profile</div>

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
                                id="edit-personal-info"
                                method="POST"
                                action="{{ route('account.personal.update') }}"
                                data-parsley-validate
                            >
                                @csrf
                                <div class="form-group row">
                                    <label for="username" class="col-sm-3 col-form-label">Username</label>
                                    <div class="col-sm-9">
                                        <input
                                            id="username"
                                            type="text"
                                            class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                            name="username"
                                            value="{{ $user->username }}"
                                            pattern="^[A-Za-z0-9_.]+"
                                            data-parsley-maxlength="30"
                                            data-parsley-pattern-message="This value is limited to 30 characters must contain only letters, numbers, periods, and underscores."
                                        />
                                        @if ($errors->has('username'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label">E-mail address</label>
                                    <div class="col-sm-9">
                                        <input
                                            id="email"
                                            type="email"
                                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            name="email"
                                            value="{{ $user->email }}"
                                        />
                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>

                                <div class="form-group pt-1">
                                    <button type="submit" class="btn btn-primary">Submit</a>
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
