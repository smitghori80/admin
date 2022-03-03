@extends('components.authentication_layout')
@section('title','Forgot password')

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
                                <span class="text-white">Enter your e-mail address below and we will send you instructions
                                    how to recover a password.</span>
                            </div>
                            <div class="row mt-3">
                                <!-- Form -->
                                <form class="col-12" action={{ route('forgotPasswordFormSubmit') }} method="post">
                                    @csrf
                                    <!-- email -->
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-danger text-white h-100" id="basic-addon1"><i
                                                    class="ti-email"></i></span>
                                        </div>
                                        <input type="email" class="form-control form-control-lg" placeholder="Email Address"
                                            id="email" value="{{ old('email') }}" name="email" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                    <!-- pwd -->
                                    <div class="row mt-3 pt-3 border-top border-secondary">
                                        <div class="col-12">
                                            <a class="btn btn-success text-white" href={{ route('loginForm') }}
                                                id="to-login" name="action">Back To Login</a>
                                            <button class="btn btn-info float-end" type="submit" id="submit" name="submit"
                                                type="button">Recover</button>
                                        </div>
                                    </div>
                                </form>
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

