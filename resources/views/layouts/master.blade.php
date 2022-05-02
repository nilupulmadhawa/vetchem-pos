<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VET CHEM</title>
    {{-- <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap/dist/css/bootstrap.min.css" />--}}
    {{-- <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.css" />--}}
    <link rel="stylesheet" href="{{ mix('css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel=" stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel=" stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel=" stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel=" stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel=" stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel=" stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel=" stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <script defer src=" {{ mix('js/app.js') }}"></script>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        @if(Route::current()->getName() == 'dashboard')
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">

        </div>
        @endif

        <div id="app">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-dark">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <router-link active-class="active" to="/product-list" class="nav-link ">
                            Product List
                        </router-link>
                    </li>

                    <li class="nav-item d-none d-sm-inline-block">
                        <router-link active-class="active" to="/billing" class="nav-link ">
                            Billing
                        </router-link>
                    </li>
                </ul>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <!-- Navbar Search -->
                    <li class="nav-item">
                        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                            <i class="fas fa-search"></i>
                        </a>
                        <div class="navbar-search-block">
                            <form class="form-inline">
                                <div class="input-group input-group-sm">
                                    <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                    <div class="input-group-append">
                                        <button class="btn btn-navbar" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                        <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>
                    <!-- Notifications Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="fas fa-bell"></i>
                            <span class="badge badge-warning navbar-badge">{{sizeof($data)}}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-item dropdown-header">{{sizeof($data)}} Notifications</span>
                            @foreach ($data as $d)
                            <div class="dropdown-divider"></div>
                            <router-link class="dropdown-item" to="/edit-product/{{$d->product->id}}" class="nav-link ">
                                <i class="fas fa-info-circle mr-2"></i> {{$d->product->code}} - {{$d->product->name}}
                                <span class="float-right text-muted text-sm">QTY: {{$d->qty}}</span>
                            </router-link>
                            @endforeach
                    </li>
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
                <a href="dashboard.html" class="brand-link">
                    <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">

                    <span class="brand-text font-weight-light">VET CHEM</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="{{asset('dist/img/user2-160x160.png')}}" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                        </div>
                    </div>


                    <!-- SidebarSearch Form -->
                    <div class="form-inline">
                        <div class="input-group" data-widget="sidebar-search">
                            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-sidebar">
                                    <i class="fas fa-search fa-fw"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                            <li class="nav-item">
                                <router-link active-class="active" to="/dashboard" class="nav-link ">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-file-invoice"></i>
                                    <p>
                                        Invoice
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <router-link active-class="active" to="/billing" class="nav-link ">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Billing</p>
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link active-class="active" to="/invoices" class="nav-link ">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Invoice List</p>
                                        </router-link>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-box"></i>
                                    <p>
                                        Product
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <router-link active-class="active" to="/product-add" class="nav-link ">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Add Product</p>
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link active-class="active" to="/product-list" class="nav-link ">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Product List</p>
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link active-class="active" to="/product-exp" class="nav-link ">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Expiration Product</p>
                                        </router-link>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <router-link active-class="active" to="/supplier" class="nav-link ">
                                    <i class="fas fa-shopping-cart nav-icon"></i>
                                    <p>Supplier</p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link active-class="active" to="/customer" class="nav-link ">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p>Customer</p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link active-class="active" to="/report" class="nav-link ">
                                    <i class="fas fa-sticky-note nav-icon"></i>
                                    <p>Report</p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link active-class="active" to="/cashinout" class="nav-link ">
                                    <i class="fas fa-upload nav-icon"></i>
                                    <p>Cash In/Out</p>
                                </router-link>
                            </li>
                            <hr style="border-color:#ffff; border: size 3px;" />
                            <li class="nav-item">
                                <a active-class="active" href="/endofday" class="nav-link ">
                                    <i class="fas fa-window-close nav-icon"></i>
                                    <p>End of day</p>
                                </a>
                            </li>
                            <!-- <li class="nav-item">
                                <a active-class="active" href="/download" class="nav-link ">
                                    <i class="fas fa-window-close nav-icon"></i>
                                    <p>backup</p>
                                </a>
                            </li> -->
                            <li class="nav-item">

                                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); confirm('Do you want to logout?') ?  document.getElementById('logout-form').submit():document.getElementById('logout-form');">
                                    <i class="nav-icon fas fa-sign-out-alt"></i>
                                    <p>{{ __('Logout') }}</p>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none" onsubmit="return confirm('Do you want to logout?');">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                @yield('content')

            </div>
        </div>
        <!-- /.content-wrapper -->
        <!-- <footer class="main-footer">
            <strong>Copyright &copy; 2022 <a href="#">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.1.0
            </div>
        </footer> -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Select2 -->

    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="{{ asset('dist/js/demo.js') }}"></script>
</body>

</html>