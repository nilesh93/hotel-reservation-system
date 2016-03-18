@extends('adminmaster')


@section('css')

@endsection



@section('title')
    Search Rooms - Admin Panel
@endsection


@section('page_title')
    Search Rooms
@endsection



@section('breadcrumbs')
    <li>
        <a href="#">Admin</a>
    </li>
    <li  class="active">
        <a href="#">Search Booking</a>
    </li>
@endsection



@section('content')
    <div class="col-lg-12">
        <div id="test"></div>
        <ul class="nav nav-tabs tabs" style="width: 100%;">
            <li class="active tab" style="width: 25%;">
                <a href="#rooms" data-toggle="tab" aria-expanded="false" class="active">
                    <span class="visible-xs"><i class="fa fa-home"></i></span>
                    <span class="hidden-xs">Previous Logs</span>
                </a>
            </li>
            <li class="tab" style="width: 25%;">
                <a href="#roomtypes" data-toggle="tab" aria-expanded="false">
                    <span class="visible-xs"><i class="fa fa-user"></i></span>
                    <span class="hidden-xs">Bookings</span>
                </a>
            </li>

            <div class="indicator" style="right: 367px; left: 0px;"></div></ul>
        <div class="tab-content">
            <div class="tab-pane " id="roomtypes">

                <table class="table table-striped table-bordered table-hover dataTables-example" id="ddt" plugin="datatable" >
                    <thead>
                    <tr>
                        <th>Reservation ID</th>
                        <th>Remarks</th>
                        <th>Customer ID</th>
                        <th>Total Amount</th>
                        <th>Checked In</th>
                        <th>Created At</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>
            <div class="tab-pane active" id="rooms">
                <table class="table table-striped table-bordered table-hover dataTables-example" id="dd" plugin="datatable" >
                    <thead>
                    <tr>
                        <th>Reservation ID</th>
                        <th>Remarks</th>
                        <th>Customer ID</th>
                        <th>Total Amount</th>
                        <th>Checked In</th>
                        <th>Created At</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <div  class="modal fade" id="update_menus_modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Update Menu</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" enctype="multipart/form-data" onsubmit="" method="post">

                        <div class="row">
                            <div class="form-group">
                                <label for="quantity" class="col-lg-5 control-label">Menu Category</label>
                                <div class="col-lg-6">
                                    <input class="form-control" id="menu_cat_edit" placeholder="Menu Category" type="text">
                                    <input type="text" id="rownumber" hidden>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <label for="item" class="col-lg-5 control-label">Menu Description</label>
                                <div class="col-lg-6">
                                    <input class="form-control" id="menu_desc_edit" placeholder="Description" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <label for="item" class="col-lg-5 control-label">Rate</label>
                                <div class="col-lg-6">
                                    <input class="form-control" id="menu_rate_edit" placeholder="Rate" type="text">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="alert alert-dismissible alert-success" id="addedsuccessfully" hidden="true">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong> Added Successfully!</strong>
                </div>
                <div class="alert alert-dismissible alert-success" id="adderror" hidden="true">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong> Adding Fail!</strong>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="update_menu()" class="btn btn-primary" name="submit" >Update Promotion</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('js')
    <script>

        $('document').ready(function(){
            document.getElementById("management").click();
            document.getElementById("RS").setAttribute("class","active");
            dataLoad();
            dataLoadBooking();
        });

        function dataLoad(){
            var oTable = $('#abc').DataTable();
            oTable.destroy();

            $('#dd').DataTable( {
                "ajax": "admin_search/roomlogspast",
                "columns": [
                    { "data": "room_reservation_id" },
                    { "data": "remarks"},
                    { "data": "cus_id" },
                    { "data": "total_amount" },
                    { "data": "check_in"},
                    { "data": "created_at"}
                ]
            } );


        }

        function dataLoadBooking(){
            var oTable = $('#ab').DataTable();
            oTable.destroy();

            $('#ddt').DataTable( {
                "ajax": "admin_search/roomlogsfuture",
                "columns": [
                    { "data": "room_reservation_id" },
                    { "data": "remarks"},
                    { "data": "cus_id" },
                    { "data": "total_amount" },
                    { "data": "check_in"},
                    { "data": "created_at"}
                ]
            } );


        }

    </script>

@endsection