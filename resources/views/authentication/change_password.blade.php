@extends('components.layout')
@section('title','Chanege password')

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

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title ">Change password</h3>
                                    <a href="{{ route('dashboard') }}" class="btn btn-danger float-right p-2"><i
                                            class="fas fa-backward"></i>
                                        Back</a>
                                </div>
                                <form action="{{ route('ChangePasswordFormSubmit') }}" method="post">
                                    @csrf

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">Old password</label>
                                            <input type="password" class="form-control" value="{{ old('oldPassword') }}"
                                                placeholder="Old password" name="oldPassword" id="oldPassword">
                                        </div>
                                    </div>
                                    @error('oldPassword')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">Password</label>
                                            <input type="password" class="form-control" value="{{ old('password') }}"
                                                placeholder="password" name="password" id="password">
                                        </div>
                                    </div>
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">Retype password</label>
                                            <input type="password" class="form-control"
                                                value="{{ old('password_confirmation') }}" placeholder="Retype password"
                                                name="password_confirmation" id="password_confirmation">
                                        </div>
                                    </div>
                                    @error('password_confirmation')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                    <div class="card-footer text-muted">
                                        <button type="submit" id="submit" name="submit" class="btn btn-primary ">Change
                                            Password</button>
                                    </div>
                                </form>
                                <a href={{ route('loginForm') }} class="text-center text-muted">I already have a
                                    membership</a>
                            </div>
                            <!-- /.form-box -->
                        </div><!-- /.card -->
                    </div>
                </div>
            </section>
            <!-- /.login-card-body -->
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






