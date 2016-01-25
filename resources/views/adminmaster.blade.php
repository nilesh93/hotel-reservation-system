<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="assets/images/favicon_1.ico">

        <title>@yield('title')</title>

        <link href="BackEnd/assets/plugins/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css">

        <link href="BackEnd/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="BackEnd/assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="BackEnd/assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="BackEnd/assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="BackEnd/assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="BackEnd/assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <link href="BackEnd/assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

        <link href="BackEnd/assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
        <link href="BackEnd/assets/plugins/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">
        <link href="BackEnd/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link href="BackEnd/assets/plugins/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
        <link href="BackEnd/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>


<![endif]-->

        @yield('css')
        <script src="BackEnd/assets/js/modernizr.min.js"></script>

    </head>

    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper" class="forced ">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <a href="index.html" class="logo"><i class="icon-magnet icon-c-logo"></i><span>Ad<i class="md md-album"></i>min</span></a>
                    </div>
                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            <div class="pull-left">
                                <button class="button-menu-mobile open-left">
                                    <i class="ion-navicon"></i>
                                </button>
                                <span class="clearfix"></span>
                            </div>

                            <form role="search" class="navbar-left app-search pull-left hidden-xs">
                                <input type="text" placeholder="Search..." class="form-control">
                                <a href=""><i class="fa fa-search"></i></a>
                            </form>


                            <ul class="nav navbar-nav navbar-right pull-right">
                                <li class="dropdown hidden-xs">
                                    <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                                        <i class="icon-bell"></i> <span class="badge badge-xs badge-danger">3</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-lg">
                                        <li class="notifi-title"><span class="label label-default pull-right">New 3</span>Notification</li>
                                        <li class="list-group nicescroll notification-list">
                                            <!-- list item-->
                                            <a href="javascript:void(0);" class="list-group-item">
                                                <div class="media">
                                                    <div class="pull-left p-r-10">
                                                        <em class="fa fa-diamond fa-2x text-primary"></em>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">A new order has been placed A new order has been placed</h5>
                                                        <p class="m-0">
                                                            <small>There are new settings available</small>
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>

                                            <!-- list item-->
                                            <a href="javascript:void(0);" class="list-group-item">
                                                <div class="media">
                                                    <div class="pull-left p-r-10">
                                                        <em class="fa fa-cog fa-2x text-custom"></em>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">New settings</h5>
                                                        <p class="m-0">
                                                            <small>There are new settings available</small>
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>

                                            <!-- list item-->
                                            <a href="javascript:void(0);" class="list-group-item">
                                                <div class="media">
                                                    <div class="pull-left p-r-10">
                                                        <em class="fa fa-bell-o fa-2x text-danger"></em>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">Updates</h5>
                                                        <p class="m-0">
                                                            <small>There are <span class="text-primary font-600">2</span> new updates available</small>
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>

                                            <!-- list item-->
                                            <a href="javascript:void(0);" class="list-group-item">
                                                <div class="media">
                                                    <div class="pull-left p-r-10">
                                                        <em class="fa fa-user-plus fa-2x text-info"></em>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">New user registered</h5>
                                                        <p class="m-0">
                                                            <small>You have 10 unread messages</small>
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>

                                            <!-- list item-->
                                            <a href="javascript:void(0);" class="list-group-item">
                                                <div class="media">
                                                    <div class="pull-left p-r-10">
                                                        <em class="fa fa-diamond fa-2x text-primary"></em>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">A new order has been placed A new order has been placed</h5>
                                                        <p class="m-0">
                                                            <small>There are new settings available</small>
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>

                                            <!-- list item-->
                                            <a href="javascript:void(0);" class="list-group-item">
                                                <div class="media">
                                                    <div class="pull-left p-r-10">
                                                        <em class="fa fa-cog fa-2x text-custom"></em>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">New settings</h5>
                                                        <p class="m-0">
                                                            <small>There are new settings available</small>
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="list-group-item text-right">
                                                <small class="font-600">See all notifications</small>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="hidden-xs">
                                    <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="icon-size-fullscreen"></i></a>
                                </li>
                              
                                <li class="dropdown">
                                    <a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true"><img src="BackEnd/assets/images/users/avatar-1.jpg" alt="user-img" class="img-circle"> </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:void(0)"><i class="ti-user m-r-5"></i> Profile</a></li>
                                        <li><a href="javascript:void(0)"><i class="ti-settings m-r-5"></i> Settings</a></li>
                                        <li><a href="javascript:void(0)"><i class="ti-lock m-r-5"></i> Lock screen</a></li>
                                        <li><a href="javascript:void(0)"><i class="ti-power-off m-r-5"></i> Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->

            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <!--- Divider -->
                    <div id="sidebar-menu">
                        <ul>

                            <li class="text-muted menu-title">NAVIGATION</li>

                            <li class="has_sub">
                                <a href="#" class="waves-effect" id="management"><i class="ti-home"></i> <span> Management </span> </a>
                                <ul class="list-unstyled">
                                    <li id="RM"><a href="admin_rooms">Room Management</a></li>
                                    <li id="HM"><a href="dashboard_2.html">Hall Management</a></li>
                                    <li id="PR"><a href="admin_promotions">Promotions Management</a></li>
                                </ul>
                            </li>


                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-md-5">
                                <h4 class="page-title">@yield('page_title')</h4>
                                <ol class="breadcrumb">
                                    @yield('breadcrumbs')


                                </ol>
                            </div>
                            <div class="col-md-7">
                                @yield('page_buttons')


                            </div>
                        </div>


                        <div class="row">


                            @yield('content')

                        </div>


                    </div> <!-- end of container -->

                </div> <!-- content -->

                <footer class="footer">
                    {{date('Y')}} © SEP_SE_WE_003.
                </footer>

            </div>
          

        </div>
        <!-- END wrapper -->

        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->




        <script src="BackEnd/assets/js/jquery.min.js"></script>

        <script src="BackEnd/assets/js/bootstrap.min.js"></script>
        <script src="BackEnd/assets/js/detect.js"></script>
        <script src="BackEnd/assets/js/fastclick.js"></script>
        <script src="BackEnd/assets/js/jquery.slimscroll.js"></script>
        <script src="BackEnd/assets/js/jquery.blockUI.js"></script>
        <script src="BackEnd/assets/js/waves.js"></script>
        <script src="BackEnd/assets/js/wow.min.js"></script>
        <script src="BackEnd/assets/js/jquery.nicescroll.js"></script>
        <script src="BackEnd/assets/js/jquery.scrollTo.min.js"></script>
        <script src="BackEnd/assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="BackEnd/assets/plugins/datatables/dataTables.bootstrap.js"></script>


        <script src="BackEnd/assets/js/jquery.core.js"></script>
        <script src="BackEnd/assets/js/jquery.app.js"></script>

        <!-- Sweet-Alert  -->
        <script src="BackEnd/assets/plugins/sweetalert/dist/sweetalert.min.js"></script>
        <script src="BackEnd/assets/pages/jquery.sweet-alert.init.js"></script>

        <script src="BackEnd/assets/js/moment.min.js"></script>
        <script src="BackEnd/assets/js/collapse.js"></script>
        <script src="BackEnd/assets/js/bootstrap-datetimepicker.min.js"></script>
        
        <script src="BackEnd/assets/plugins/moment/moment.js"></script>
     	<script src="BackEnd/assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
     	<script src="BackEnd/assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
     	<script src="BackEnd/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
     	<script src="BackEnd/assets/plugins/clockpicker/dist/jquery-clockpicker.min.js"></script>
     	<script src="BackEnd/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>


        @yield('js')


    </body>
</html>