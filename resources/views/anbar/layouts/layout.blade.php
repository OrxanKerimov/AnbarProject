
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('title')    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{asset('assets/main/index/css/index.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    @yield('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed" >
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{route('index.main')}}" class="nav-link">Home</a>
            </li>

        </ul>

        <!-- SEARCH FORM -->

    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="{{asset('assets/main/index/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">Anbar</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{route('index.main')}}" class="nav-link @yield('active1')">
                            <i class="fas fa-home nav-icon"></i>
                            <p>Home</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('profile.index')}}" class="nav-link @yield('active2')">
                            <i class="nav-icon far fa-id-card"></i>
                            <p>Profile</p>
                        </a>
                    </li>
                    @if(\App\Models\User::query()->where("email",session('Mail'))->value('admin_id') == 1)
                        <li class="nav-item">
                            <a href="{{route('employee.create')}}" class="nav-link @yield('active3')">
                                <i class="nav-icon material-icons">&#xe7fe;</i>
                                <p>Employees</p>
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a href="{{route('brand.create')}}" class="nav-link @yield('active4')">
                            <i class="nav-icon fa fa-shopping-bag"></i>
                            <p>Brands</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('product.create')}}" class="nav-link @yield('active5')">
                            <i class="nav-icon ion ion-pie-graph"></i>
                            <p>Products</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('client.create')}}" class="nav-link @yield('active6')">
                            <i class="nav-icon material-icons">&#xe7fe;</i>
                            <p>Clients</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('order.create')}}" class="nav-link @yield('active7')">
                            <i class="nav-icon ion ion-stats-bars"></i>
                            <p>Order</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('cost.create')}}" class="nav-link @yield('active8')">
                            <i class="nav-icon fas fa-box"></i>
                            <p>Additional costs</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('index.logout')}}" class="nav-link">
                            <i class="nav-icon fas fa-door-open"></i>
                            <p>Logout</p>
                        </a>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    @yield('content')
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong> <a href="#">Anbar</a> </strong>
         serves to add, store and process

    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{asset('assets/main/index/js/index.js')}}"></script>
@yield('scripts')
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });</script>
</body>
</html>
