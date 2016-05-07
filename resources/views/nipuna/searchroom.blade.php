@extends('adminmaster')


@section('css')

@endsection



@section('title')
Search Rooms - Admin Panel
@endsection


@section('page_title')
ROOM LOG
@endsection



@section('breadcrumbs')
<li>
    <a href="#">Admin</a>
</li>
<li  class="active">
    <a href="#">Search Booking</a>
</li>
@endsection

@section('page_buttons')
<div class="col-md-3">

    <b class="pull-right" style="padding-top:8%">  Room Number</b>
</div>
<div class="col-md-6">

    <select class="form-control" id="room_num">
        @foreach($rooms as $r)
        <option value="{{$r->room_id}}"> {{$r->room_num}} - {{$r->type_name}} </option>
        @endforeach

    </select>

</div>
<div class="col-md-3 ">
    <button onclick="dataLoad()" type="button" class="btn btn-success   waves-effect btn-block waves-light pull-right">

        SEARCH</button>
</div>

@endsection




@section('content')

<div class="col-lg-12">
    <div class="panel panel-success panel-border">
        <div class="panel-heading">
            <h3 class="panel-title">Current Status</h3>
        </div>
        <div class="panel-body">

            <div  id="current_status"></div>


        </div>
    </div>


</div>
<div class="col-lg-12">
    <div id="test"></div>
    <ul class="nav nav-tabs tabs" style="width: 100%;">
        <li class="active tab" style="width: 25%;">
            <a href="#rooms" data-toggle="tab" aria-expanded="false" class="active">
                <span class="visible-xs"><i class="fa fa-home"></i></span>
                <span class="hidden-xs">History</span>
            </a>
        </li>
        <li class="tab" style="width: 25%;">
            <a href="#roomtypes" data-toggle="tab" aria-expanded="false">
                <span class="visible-xs"><i class="fa fa-user"></i></span>
                <span class="hidden-xs">Upcoming</span>
            </a>
        </li>

        <div class="indicator" style="right: 367px; left: 0px;"></div></ul>
    <div class="tab-content">
        <div class="tab-pane " id="roomtypes">

            <table class="table table-striped table-bordered table-hover dataTables-example" id="ddt" plugin="datatable" >
                <thead>
                    <tr>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Customer</th>
                        <th>Contact</th>
                        
                        <th>No. of Nights</th>
                        <th></th>
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
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Customer</th>
                        <th>Contact</th>
                       
                        <th>No. of Nights</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>



<div class="modal inmodal fade" id="rView" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Room Information</h4>

            </div>
            <div class="modal-body">

                <div id="reserve_info"></div>





            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>

            </div>
        </div>


    </div>
</div>

@endsection



@section('js')
<script>

    $(document).ready(function(){
        document.getElementById("management").click();
        document.getElementById("RS").setAttribute("class","active");
        dataLoad();
        // dataLoadBooking();
     
        
        
    }); 

    function dataLoad(){

        document.getElementById("current_status").innerHTML = "Loading....";

        var rid =  $('#room_num').val();

        var oTable = $('#dd').DataTable();
        oTable.destroy();

        $('#dd').DataTable( {
            "ajax": "admin_room_search_past?rid="+rid,
            "columns": [
                { "data": "check_in" },
                { "data": "check_out"},
                { "data": "name" },
                { "data": "telephone_num" },
                { "data": "num_of_nights"},
                {"data" : null,
                 "mRender": function(data, type, full) {
                     return '<button class="btn btn-primary  btn-animate btn-animate-side btn-block btn-sm" onclick="viewInfo('+data.room_reservation_id+')"> Delete </button>' ;
                 }
                }
            ]
        } );



        var oTable = $('#ddt').DataTable();
        oTable.destroy();

        $('#ddt').DataTable( {
            "ajax": "admin_room_search_future?rid="+rid,
            "columns": [
                { "data": "room_reservation_id" },
                { "data": "remarks"},
                { "data": "cus_id" },
                { "data": "total_amount" },
                { "data": "check_in"},
           {"data" : null,
                 "mRender": function(data, type, full) {
                     return '<button class="btn btn-primary  btn-animate btn-animate-side btn-block btn-sm" onclick="viewInfo('+data.room_reservation_id+')"> View </button>' ;
                 }
                }
            ]
        } );


        $.ajax({
            url : "admin_room_search_current?rid="+rid,
            type:"get",
            data:{},
            success:function(data){

                document.getElementById("current_status").innerHTML = data;


            },
            error:function(err){

                console.log(err);
            }    


        });


    }

    function viewInfo(id){


      $.ajax({

            url:"admin_search_bookings_get",
            type:"get",
            data :{id:id},
            success:function(data){



                $('#rView').modal('show');
                document.getElementById("reserve_info").innerHTML = data;
            },
            error : function(err){
                console.log(err);
            }


        });
    }

</script>

@endsection