<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TremGlobal | @yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="/plugins/summernote/summernote-bs4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="/plugins/toastr/toastr.min.css">

    <link rel="stylesheet" href="/css/app.css">

    <link rel="icon" href="/images/favicon.png" type="image/png">
    @yield('links')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="/images/favicon.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <form action="{{ route('logout') }}" method="POST" id="frmLogout">
                @csrf
            </form>
            <button onclick="$('#frmLogout').submit();" class="btn btn-block btn-danger btn-sm" style="display:flex;align-items:center;">Logout</button>

            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                    <i class="fas fa-th-large"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="/images/favicon.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Meeting</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="/dist/img/default.png" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{ route('admin') }}" class="nav-link {{ Route::current()->getName() == 'admin' ? 'active' : null }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item {{ in_array(Route::current()->getName(), ['meets', 'meet_add']) ? 'menu-is-opening menu-open' : null }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Toplantılar
                                <i class="fas fa-angle-left right"></i>
                                <span class="badge badge-info right">{{ $meetCount }}</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('meets') }}" class="nav-link {{ Route::current()->getName() == 'meets' ? 'active' : null }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Listele</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('meet_add') }}" class="nav-link {{ Route::current()->getName() == 'meet_add' ? 'active' : null }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Yeni Oluştur</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item {{ in_array(Route::current()->getName(), ['rooms', 'room_add']) ? 'menu-is-opening menu-open' : null }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Toplantı Odaları
                                <i class="fas fa-angle-left right"></i>
                                <span class="badge badge-info right">{{ $roomCount }}</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('rooms') }}" class="nav-link {{ Route::current()->getName() == 'rooms' ? 'active' : null }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Listele</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('room_add') }}" class="nav-link {{ Route::current()->getName() == 'room_add' ? 'active' : null }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Yeni Oluştur</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="/register" class="nav-link">
                            <i class="nav-icon fas fa-user-alt"></i>
                            <p>
                                Yeni Kullanıcı Kaydı
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
    @yield('content')
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
    <strong>Copyright &copy; 2021 <a href="https://www.tremglobal.com/">TremGlobal</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0.0
    </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/plugins/moment/moment-with-locales.min.js"></script>
<script src="/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/dist/js/pages/dashboard.js"></script>
<!-- Toastr -->
<script src="/plugins/toastr/toastr.min.js"></script>
@yield('scripts')
</body>
</html>

