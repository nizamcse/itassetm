<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">

    <link rel="stylesheet" href="{{ asset('plugins/iCheck/flat/blue.css') }}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ asset('plugins/morris/morris.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    <!-- bootstrap datepicker -->
    <!--for grid-->

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>LT</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Admin</b>LTE</span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">

                                <p>
                                    {{ Auth::user()->name }}
                                    <small>{{ Auth::user()->email }}</small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="row">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>

        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar" style="height: auto;">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">MAIN NAVIGATION</li>
                <li><a href="/"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-cog"></i> <span>Master Data</span>
                        <span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
					</span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="{{ route('admin.organizations') }}"><i class="fa fa-circle-o"></i> Organization</a></li>
                        <li class="active"><a href="{{ route('admin.departments') }}"><i class="fa fa-circle-o"></i> Department</a></li>
                        <li class="active"><a href="{{ route('admin.sections') }}"><i class="fa fa-circle-o"></i> Section</a></li>
                        <li class="active"><a href="{{ route('admin.employees') }}"><i class="fa fa-circle-o"></i> Employe</a></li>
                        <li class="active"><a href="{{ route('admin.locations') }}"><i class="fa fa-circle-o"></i> Location</a></li>
                        <li class="active"><a href="{{ route('admin.asset-types') }}"><i class="fa fa-circle-o"></i> Assets Type</a></li>
                        <li class="active"><a href="{{ route('admin.vendors') }}"><i class="fa fa-circle-o"></i> Vendor</a></li>
                        <li class="active"><a href="{{ route('admin.services-type') }}"><i class="fa fa-circle-o"></i> Service Type</a></li>
                        <li class="active"><a href="{{ route('admin.manufacturers') }}"><i class="fa fa-circle-o"></i> Manufacturer</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-cog"></i> <span>Assets</span>
                        <span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
					</span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active">
                            <a href="{{ route('assets') }}"><i class="fa fa-circle-o"></i> Asset Detail</a>
                        </li>
                        <li class="active">
                            <a href="{{ route('sub-assets') }}"><i class="fa fa-circle-o"></i> Sub Assets</a>
                        </li>

                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-cog"></i> <span>Budget</span>
                        <span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
					</span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active">
                            <a href="{{ route('budget-head') }}"><i class="fa fa-circle-o"></i> Budget Head</a>
                        </li>
                        <li class="active">
                            <a href="{{ route('budget-type') }}"><i class="fa fa-circle-o"></i> Budget Type</a>
                        </li>
                        <li class="active">
                            <a href="{{ route('budget-type-approval') }}"><i class="fa fa-circle-o"></i> Budget Type Approval</a>
                        </li>
                        <li class="active">
                            <a href="{{ route('budget-declear') }}"><i class="fa fa-circle-o"></i> Budget Declar</a>
                        </li>


                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-cog"></i> <span>Purchase Requisition</span>
                        <span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
					</span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active">
                            <a href="{{ route('purchase-requisition') }}"><i class="fa fa-circle-o"></i> Purchase Requisition</a>
                        </li>
                        <li>
                            <a href="{{ route('purchase-requisition-details') }}"><i class="fa fa-circle-o"></i> Purchase Requisition Details</a>
                        </li>


                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-cog"></i> <span>Purchase &amp; Receive</span>
                        <span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
					</span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="/?option=Purchase_Requisition_Request"><i class="fa fa-circle-o"></i> Purchase Requisition Request</a></li>	<li class="active"><a href="/?option=Receive"><i class="fa fa-circle-o"></i> Receive</a></li>

                    </ul>
                </li>

            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Version 2.0</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            @yield('content')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.3.8
        </div>
        <strong>Copyright @2017 MbizTech.</strong> All rights
        reserved.
    </footer>


</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/app.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
<script src="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- SlimScroll 1.3.0 -->
<script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- ChartJS 1.0.1 -->
<script src="{{ asset('plugins/chartjs/Chart.min.js') }}"></script>

<script src="http://js-grid.com/js/jsgrid.min.js"></script>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<!--<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>-->
<script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>

<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ asset('plugins/morris/morris.min.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/knob/jquery.knob.js') }}"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/app.min.js') }}"></script>

<script src="{{ asset('dist/js/main.js') }}"></script>
<script src="{{ asset('dist/js/grid.js') }}"></script>
<script src="{{ asset('dist/js/ReceiveGrid.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.10/handlebars.min.js"></script>
<script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
@yield('script')

</body>
</html>
