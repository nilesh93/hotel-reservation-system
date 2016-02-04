@extends('adminmaster')


@section('css')

@endsection



@section('title')


Search Booking - Admin Panel

@endsection


@section('page_title')
Search Booking
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


    <div class="row" id="temptable">
        <table class="table table-striped table-bordered table-hover dataTables-example" id="dd" plugin="datatable" >
                    <thead>
                        <tr>
                            
                            
                            <th>Reservation ID</th>
                            <th>Remarks</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Adults</th>
                            <th>Children</th>
                            <th>Rooms</th>
                            <th>Nights</th>
                            <th>Total Amount</th>
                            <th>Type</th>
                            <th class="col-md-1"></th>
                            <th class="col-md-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>

                </table>
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
        document.getElementById("BS").setAttribute("class","active");
        dataLoad();
});

function dataLoad(){

        var oTable = $('#dd').DataTable();
        oTable.destroy();

        $('#dd').DataTable( {
            "ajax": "admin_search/bookings",
            "columns": [
                { "data": "room_reservation_id" },
                { "data": "remarks"},
                { "data": "check_in" },
                { "data": "check_out" },
                { "data": "adults"},
                { "data": "children"},
                { "data": "num_of_rooms" },
                { "data": "num_of_nights"},
                { "data": "total_amount"},
                { "data": "type" },
                {"data" : null,
                 "mRender": function(data, type, full) {
                     return '<button class="btn btn-info  btn-animate btn-animate-side btn-block btn-sm" onclick="edit('+data.menu_id+')"> View </button>' ;
                 }
                },
                {"data" : null,
                 "mRender": function(data, type, full) {
                     return '<button class="btn btn-danger  btn-animate btn-animate-side btn-block btn-sm" onclick="delete_menu('+data.menu_id+')"> Delete </button>' ;
                 }
                }
            ]
        } );


    }

</script>

@endsection