<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login | AslaMed</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('src/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('src/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- jsGrid -->
    <link rel="stylesheet" href="{{ asset('src/plugins/jsgrid/jsgrid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('src/plugins/jsgrid/jsgrid-theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('src/plugins/toastr/toastr.min.css') }}">

    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('src/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('src/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('src/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('src/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('src/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('src/plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('src/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('src/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('src/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('src/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
</head>

<style type="text/css">
    /* .gas {
        background-image: url("dashboard/dist/img/bg.jpg");
        height: 100 %;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        background-color: #eee;
    } */

    .gas {
        background-image: url("src/img/bg-login.jpg");
        /* filter: blur(3px);
        -webkit-filter: blur(3px); */
        box-shadow: 0 15px 25px;
        border-radius: 4px;
        backdrop-filter: blur(4px);
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: center;
        /* background-color: #ffff; */
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        /* background: linear-gradient(80deg, white, #AAA1FB); */

    }

    .card-body {

        background-color: transparent;
        /* display: grid;
grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); */
        box-shadow: 0 35px 55px rgba(129, 124, 124, 0.8);
        border-radius: 0px;
        backdrop-filter: blur(9px);
        /* padding: 10px; */

    }

    /* .body {
        background-color: blanchedalmond;
    } */
</style>

<body class="gas hold-transition login-page">
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-purple">
            <div class="card-header text-center">
                <a href="../../index2.html" class="h1"><b>ASLA</b>Med</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="{{ url('/ProsesLogin') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Username" name="email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                {{-- <label for="remember">
                                    Remember Me
                                </label> --}}
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-success btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                {{-- <div class="social-auth-links text-center mt-2 mb-3">
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                    </a>
                </div> --}}


                {{-- <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="register.html" class="text-center">Register a new membership</a>
                </p> --}}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->


    <!-- Bootstrap 4 -->
    <script src="{{ asset('src/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('src/dist/js/ajax.min.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js') }}"></script> --}}
    <script src="{{ asset('src/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('src/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('src/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('src/plugins/jsgrid/jsgrid.min.js') }}"></script>
    {{-- <script src="{{ asset('srcplugins/jsgrid/demos/db.js') }}"></script> --}}
    <!-- ChartJS -->
    <script src="{{ asset('src/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('src/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('src/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('src/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('src/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('src/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('src/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('src/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('src/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('src/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('src/dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('src/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('src/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('src/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('src/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('src/plugins/Assesment/signature_pad.min.js') }}"></script>
    <script src="{{ asset('src/plugins/Assesment/pencoretan.v3.min.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js') }}"></script> --}}
    {{-- <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js') }}"></script> --}}
    @stack('scripts')
</body>

</html>
