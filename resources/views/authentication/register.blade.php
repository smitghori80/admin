@extends('components.authentication_layout')
@section('title','register')

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
                    <div>
                        <div class="text-center pt-3 pb-3">
                            <span class="db"><img src={{ asset('assets/images/logo.png') }} alt="logo" /></span>
                        </div>
                        <!-- Form -->
                        <form class="form-horizontal mt-3" action="register" method="post">
                            @csrf
                            <div class="row pb-4">
                                <div class="col-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-success text-white h-100" id="basic-addon1"><i
                                                    class="ti-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control form-control-lg" id="name" name="name"
                                            placeholder="Username" aria-label="Username" value="{{ old('name') }}"
                                            aria-describedby="basic-addon1">
                                    </div>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                    <!-- email -->
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-danger text-white h-100" id="basic-addon1"><i
                                                    class="ti-email"></i></span>
                                        </div>
                                        <input type="email" class="form-control form-control-lg"
                                            value="{{ old('email') }}" name="email" id="email" placeholder="Email Address"
                                            aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-warning text-white h-100" id="basic-addon2"><i
                                                    class="ti-pencil"></i></span>
                                        </div>
                                        <input type="password" class="form-control form-control-lg"
                                            value="{{ old('password') }}" name="password" id="password"
                                            placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
                                    </div>
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-info text-white h-100" id="basic-addon2"><i
                                                    class="ti-pencil"></i></span>
                                        </div>
                                        <input type="password" class="form-control form-control-lg"
                                            value="{{ old('password_confirmation') }}" name="password_confirmation"
                                            id="password_confirmation" placeholder="Confirm Password"
                                            aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                @error('password_confirmation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                                <button class="btn btn-success float-end text-white " id="submit" name="submit"
                                    type="submit">Sign Up</button>
                            </div>
                            <div class="row border-top border-secondary">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="pt-3 d-grid col-md-3">
                                            <a href={{ route('loginForm') }}
                                                class="btn btn-block btn-lg btn-info">Login</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
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
        <!-- ============================================================== -->
        <!-- All Required js -->
        <!-- ============================================================== -->

    </body>
@endsection

