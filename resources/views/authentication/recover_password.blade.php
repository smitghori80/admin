@extends('components.authentication_layout')
@section('title','Recover password')

@section('content')

    <body>
        <div class="main-wrapper">
            <!-- ============================================================== -->
            <!-- Preloader - style you can find in spinners.css -->
            <!-- ============================================================== -->
            <div class="preloader">
                <div class="lds-ripple">
                    <div class="lds-pos"></div>
                    <div class="lds-pos"></div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- Preloader - style you can find in spinners.css -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Login box.scss -->
            <!-- ============================================================== -->
            <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
                <div class="auth-box bg-dark border-top border-secondary">
                    <div id="loginform">
                        <div class="text-center pt-3 pb-3">

                        </div>
                        <div id="recoverform">
                            <div class="text-center">
                                <span class="text-white"></span>
                            </div>
                            <div class="card">
                                <div class="card-body login-card-body">
                                    <p class="login-box-msg">You are only one step a way from your new password, recover
                                        your password now.</p>

                                    <form action="{{ route('ResetPasswordFormSubmit') }}" method="post">
                                        @csrf
                                        <input type="hidden" class="form-control" name="email" id="email"
                                            value="{{ $email }}">
                                        <input type="hidden" class="form-control" name="token" id="token"
                                            value="{{ $token }}">

                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control" value="{{ old('password') }}"
                                                placeholder="Password" name="password" id="password">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-lock"></span>
                                                </div>
                                            </div>
                                        </div>
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control"
                                                value="{{ old('password_confirmation') }}" placeholder="Confirm Password"
                                                id="passwordConfirmation" name="password_confirmation">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-lock"></span>
                                                </div>
                                            </div>
                                        </div>
                                        @error('password_confirmation')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                        <div class="row">
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary btn-block">Change
                                                    password</button>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                    </form>

                                    <p class="mt-3 mb-1">
                                        <a href="{{ route('loginForm') }}">Login</a>
                                    </p>
                                </div>
                                <!-- /.login-card-body -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Login box.scss -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Page wrapper scss in scafholding.scss -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Page wrapper scss in scafholding.scss -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right Sidebar -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right Sidebar -->
                <!-- ============================================================== -->
            </div>
    </body>
@endsection

