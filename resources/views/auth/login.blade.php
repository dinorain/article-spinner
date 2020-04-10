@extends('layouts.app')

@section('content')
<div class="flex-center position-ref full-height">

        <div class="content">
            <!-- ============================================================== -->
            <!-- login page  -->
            <!-- ============================================================== -->
            <div class="splash-container">
                <div class="card ">
                    <div class="card-header text-center"><a class="navbar-brand" href="#">{{ config('app.name', 'Article Spinner') }}</a></div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <input class="form-control form-control-lg" id="username" type="text" placeholder="Username" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input class="form-control form-control-lg" id="password" type="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox"><span class="custom-control-label">Remember Me</span>
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Log in</button>
                        </form>
                    </div>
                    <div class="card-footer bg-white p-0  ">
                        {{-- <div class="card-footer-item card-footer-item-bordered">
                            <a href="sign-up.html" class="footer-link">Create an Account</a></div>
                        <div class="card-footer-item card-footer-item-bordered">
                            <a href="forgot-password.html" class="footer-link">Forgot Password</a>
                        </div> --}}

                    </div>
                </div>
            </div>

            <!-- ============================================================== -->
            <!-- end login page  -->
            <!-- ============================================================== -->
        </div>
    </div>
@endsection
