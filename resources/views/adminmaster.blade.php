
<?php date_default_timezone_set("Asia/Colombo"); ?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="#">

        <title>@yield('title')</title>

        <link href="{{URL::asset('BackEnd/assets/plugins/sweetalert/dist/sweetalert.css')}}" rel="stylesheet" type="text/css">

        <link href="{{URL::asset('BackEnd/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

        <link href="{{URL::asset('BackEnd/assets/css/core.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{URL::asset('BackEnd/assets/css/components.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{URL::asset('BackEnd/assets/css/icons.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{URL::asset('BackEnd/assets/css/pages.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{URL::asset('BackEnd/assets/css/responsive.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{URL::asset('BackEnd/assets/css/dropzone.css')}}" rel="stylesheet" type="text/css" />

        <link href="{{URL::asset('BackEnd/assets/plugins/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />

        <link href="{{URL::asset('BackEnd/assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet')}}">
        <link href="{{URL::asset('BackEnd/assets/plugins/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}" rel="stylesheet">
        <link href="{{URL::asset('BackEnd/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
        <link href="{{URL::asset('BackEnd/assets/plugins/clockpicker/dist/jquery-clockpicker.min.css')}}" rel="stylesheet">
        <link href="{{URL::asset('BackEnd/assets/plugins/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

<<<<<<< HEAD
        <link href="{{URL::asset('bower_components/angular-bootstrap-calendar/dist/css/angular-bootstrap-calendar.css')}}"> </link>
        <link href="{{URL::asset('bower_components/angular-chart.js/dist/angular-chart.css')}}"> </link>

=======
        <link href="{{URL::asset('bower_components/angular-bootstrap-calendar/dist/css/angular-bootstrap-calendar.css')}}"></link>
    <link href="{{URL::asset('bower_components/angular-chart.js/dist/angular-chart.css')}}"></link>
>>>>>>> origin/master


 
<!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
=======
        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>

        <!--Pusher.js Client-side js-->
        <script src="//js.pusher.com/2.2/pusher.min.js"></script>
 

@yield('css')
<script src="{{URL::asset('BackEnd/assets/js/modernizr.min.js')}}"></script>

</head>

<body class="fixed-left">

    <!-- Begin page -->
    <div id="wrapper" class="forced ">

        <!-- Top Bar Start -->
        <div class="topbar">

            <!-- LOGO -->
            <div class="topbar-left">
                <div class="text-center">
                    <a href="index.html" class="logo"><i class="icon-magnet icon-c-logo"></i><span>Admin Panel  </span></a>
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

                            <?php
                                $notification_count = DB::table('NOTIFICATIONS')
                                        ->select('notification')
                                        ->count();

                                $unread_notification_count = DB::table('NOTIFICATIONS')
                                        ->select('notification')
                                        ->where('readStatus', '=', '0')
                                        ->count();
                            ?>
                            @if($notification_count != 0)
                            <?php
                                $notifications = DB::table('NOTIFICATIONS')
                                        ->select('notification', 'body', 'readStatus')
                                        ->orderBy('created_at', 'desc')
                                        ->get();
                            ?>
                            @endif

                            <ul class="nav navbar-nav navbar-right pull-right">
                                <li class="dropdown hidden-xs">
                                    <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true" onclick="$('#notificationNum-alert').text(''); setReadStatus()">
                                        <i class="icon-bell"></i> <span class="badge badge-xs badge-danger" id="notificationNum-alert">@if($unread_notification_count != 0) {{$unread_notification_count}} @endif</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-lg">
                                        <li class="notifi-title"><span id="notificationNum" class="label label-default pull-right">{{$unread_notification_count}} New</span> Notifications</li>
                                        <li class="list-group nicescroll notification-list" id="notificationList">

                                            @if($notification_count != 0)
                                                @foreach($notifications as $notification)
                                                    @if($notification->readStatus == 0)
                                                        <a href="javascript:void(0);" class="list-group-item list-group-item-success">
                                                    @else
                                                        <a href="javascript:void(0);" class="list-group-item">
                                                    @endif
                                                        <div class="media">
                                                            <div class="pull-left p-r-10">
                                                                <em class="fa fa-cog fa-2x text-custom"></em>
                                                            </div>
                                                            <div class="media-body">
                                                                <h5 class="media-heading">{{$notification->notification}}</h5>
                                                                <p class="m-0">
                                                                    <small>{{$notification->body}}</small>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                @endforeach
                                            @endif
                                            
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
                                        <li><a href="{{URL::to('auth/logout')}}"><i class="ti-power-off m-r-5"></i> Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
            </div>
            <!-- Top Bar End -->
<<<<<<< HEAD
            <input class="number-only" hidden>

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
                                    <li id="ARS"><a href="admin_room_services">Room Services</a></li>
                                    <li id="HM"><a href="admin_halls">Hall Management</a></li>
                                    <li id="HS"><a href="hallServices">Hall Services</a></li>
                                    <li id="PR"><a href="admin_promotions">Promotions Management</a></li>
                                    <li id="MM"><a href="admin_menus">Menus Management</a></li>
                                    <li id="UM"><a href="{{URL::to('/admin_users')}}">User Management</a></li>
                                    <li id="FS"><a href="admin_facilities">Facilities Management</a></li>
                                    <li id="BS"><a href="admin_bookings_search">Bookings Search</a></li>
                                    <li id="RS"><a href="admin_rooms_search">Room Logs</a></li>
                                    <li id="CS"><a href="admin_customers_search">Customer Search</a></li>
                                    <li id="IG"><a href="admin_imageGallery">Image Gallery </a></li>
                                    <li id="WG"><a href="admin_webGallery">Web Home Gallery </a></li>
                                    <li id="PER"><a href="admin_pending_reservation">Pending Reservation </a></li>
                                    <li id="RGI"><a href="admin_reservation_general">Reservation Info </a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="#" class="waves-effect" id="siteAdmin"><i class="ti-home"></i> <span>Site Administration</span> </a>
                                <ul class="list-unstyled">
                                    <li id="BR"><a href="{{URL::to('get_backup')}}">Backup & Restore</a></li>
                                    <li id="AU"><a href="{{URL::to('admin_about_us')}}">Edit About Us</a></li>
                                </ul>
                            </li>


                        </ul>
                        <div class="clearfix"></div>
                    </div>
=======
           
        <!-- Top Bar End -->
       
        <!-- ========== Left Sidebar Start ========== -->

        <div class="left side-menu">
            <div class="sidebar-inner slimscrollleft">
                <!--- Divider -->
                <div id="sidebar-menu">
                    <ul>



                        <li class="has_sub">
                            <a href="#" class="waves-effect" id="management"><i class="ti-home"></i> <span> Rooms/Halls</span> </a>
                            <ul class="list-unstyled">
                                <li id="RM"><a href="admin_rooms">Room Management</a></li>
                                <li id="ARS"><a href="admin_room_services">Room Services</a></li>
                                <li id="HM"><a href="admin_halls">Hall Management</a></li>
                                <li id="HS"><a href="hallServices">Hall Services</a></li>

                            </ul>
                        </li>



                        <li class="has_sub">
                            <a href="#" class="waves-effect" id="siteAdmin"><i class="ti-home"></i> <span>Reservations</span> </a>
                            <ul class="list-unstyled">


                                <li id="BS"><a href="admin_bookings_search">Bookings Search</a></li>
                                <li id="RS"><a href="admin_rooms_search">Room Logs</a></li>

                                <li id="PER"><a href="admin_pending_reservation">Pending Reservation </a></li>

                            </ul>
                        </li>


                        <li class="has_sub">
                            <a href="#" class="waves-effect" id="siteAdmin"><i class="ti-home"></i> <span>Rates Administration</span> </a>
                            <ul class="list-unstyled">


                                <li id="PR"><a href="admin_promotions">Promotions Management</a></li>
                                <li id="MM"><a href="admin_menus">Menus Management</a></li>


                            </ul>
                        </li>





                        <li class="has_sub">
                            <a href="#" class="waves-effect" id="siteAdmin"><i class="ti-home"></i> <span> Gallery Management</span> </a>
                            <ul class="list-unstyled">
 

                                <li id="IG"><a href="admin_imageGallery">Image Gallery </a></li>
                                <li id="WG"><a href="admin_webGallery">Web Home Gallery </a></li>
                            </ul>
                        </li>

                        <li class="has_sub">
                            <a href="#" class="waves-effect" id="siteAdmin"><i class="ti-home"></i> <span>Site Administration</span> </a>
                            <ul class="list-unstyled">
                                <li id="BR"><a href="{{URL::to('get_backup')}}">Backup & Restore</a></li>
                                <li id="FS"><a href="admin_facilities">Edit Hotel Facilities</a></li>
                                <li id="AU"><a href="{{URL::to('admin_about_us')}}">Edit About Us</a></li>
                                <li id="RE"><a href="{{URL::to('admin_reviews')}}">Manage Reviews</a></li>
                            </ul>
                        </li>



                        <li class="has_sub">
                            <a href="#" class="waves-effect" id="siteAdmin"><i class="ti-home"></i> <span>Users Administration</span> </a>
                            <ul class="list-unstyled">


                                <li id="UM"><a href="{{URL::to('/admin_users')}}">User Management</a></li>
                                <li id="CS"><a href="admin_customers_search">Customer Search</a></li>



                            </ul>
                        </li>
                    </ul>
>>>>>>> origin/master
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




    <script src="{{URL::asset('BackEnd/assets/js/jquery.min.js')}}"></script>

    <script src="{{URL::asset('bower_components/moment/moment.js')}}"></script>
    <script src="{{URL::asset('bower_components/angular/angular.js')}}"></script>
    <script src="{{URL::asset('bower_components/angular-ui-calendar/src/calendar.js')}}"></script>


    <script src="{{URL::asset('bower_components/fullcalendar/dist/fullcalendar.min.js')}}"></script>
    <script src="{{URL::asset('bower_components/fullcalendar/dist/gcal.js')}}"></script>

    <script src="{{URL::asset('bower_components/Chart.js/Chart.js')}}"></script>
    <script src="{{URL::asset('bower_components/angular-chart.js/dist/angular-chart.js')}}"></script> 



    <script src="{{URL::asset('BackEnd/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('BackEnd/assets/js/detect.js')}}"></script>
    <script src="{{URL::asset('BackEnd/assets/js/fastclick.js')}}"></script>
    <script src="{{URL::asset('BackEnd/assets/js/jquery.slimscroll.js')}}"></script>
    <script src="{{URL::asset('BackEnd/assets/js/jquery.blockUI.js')}}"></script>
    <script src="{{URL::asset('BackEnd/assets/js/waves.js')}}"></script>
    <script src="{{URL::asset('BackEnd/assets/js/wow.min.js')}}"></script>
    <script src="{{URL::asset('BackEnd/assets/js/jquery.nicescroll.js')}}"></script>
    <script src="{{URL::asset('BackEnd/assets/js/jquery.scrollTo.min.js')}}"></script>
    <script src="{{URL::asset('BackEnd/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('BackEnd/assets/plugins/datatables/dataTables.bootstrap.js')}}"></script>

    <script src="{{URL::asset('BackEnd/assets/js/jquery.core.js')}}"></script>
    <script src="{{URL::asset('BackEnd/assets/js/jquery.app.js')}}"></script>

    <!-- Sweet-Alert  -->
    <script src="{{URL::asset('BackEnd/assets/plugins/sweetalert/dist/sweetalert.min.js')}}"></script>
    <script src="{{URL::asset('BackEnd/assets/pages/jquery.sweet-alert.init.js')}}"></script>

    <script src="{{URL::asset('BackEnd/assets/js/moment.min.js')}}"></script>
    <script src="{{URL::asset('BackEnd/assets/js/collapse.js')}}"></script>
    <script src="{{URL::asset('BackEnd/assets/js/sweetalert.patch.js')}}"></script>

    <script src="{{URL::asset('BackEnd/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

    <script src="{{URL::asset('BackEnd/assets/js/Dropzone.js')}}"></script>


    <script src="{{URL::asset('BackEnd/assets/plugins/moment/moment.js')}}"></script>
    <script src="{{URL::asset('BackEnd/assets/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
    <script src="{{URL::asset('BackEnd/assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
    <script src="{{URL::asset('BackEnd/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{URL::asset('BackEnd/assets/plugins/clockpicker/dist/jquery-clockpicker.min.js')}}"></script>
    <script src="{{URL::asset('BackEnd/assets/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

    <script src="{{URL::asset('BackEnd/assets/js/validation.js')}}"></script>

 
        <script>
            function setReadStatus() {
                $.ajax({url: "{{URL::to('setReadStatus')}}", success: function(result){
                    console.log("Success")
                }});
            }
        </script>

        <script>

            var notification_count = $('#notificationNum-alert').text();

            if($.trim($('#notification_count').html()) == ''){
                notification_count = 0;
            }


            var pusher = new Pusher('a9cc4ec8de7727809a37');

            var notificationsChannel = pusher.subscribe('notifications');

            notificationsChannel.bind('Reservation', function(res) {

                var message = res.message;
                $('#notificationNum-alert').text(notification_count + 1);
                $('#notificationNum').text(notification_count + 1+" New");
                $("#notificationList").prepend('<a href="javascript:void(0);" class="list-group-item list-group-item-success"> ' +
                        '<div class="media"> <div class="pull-left p-r-10"> ' +
                        '<em class="fa fa-cog fa-2x text-custom"></em> </div> ' +
                        '<div class="media-body"> <h5 class="media-heading">New Reservation</h5>' +
                        ' <p class="m-0"> <small>'+message+'</small> </p> </div> </div> </a>');
            });


        </script>

        @yield('js')
 


</body>
</html>