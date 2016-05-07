@extends('adminmaster')


@section('css')

<link href="{{URL::asset('bower_components/fullcalendar/dist/fullcalendar.css')}}" rel="stylesheet" type="text/css" />

<style>

    .fc-day:hover{
        background:lightblue;
    }
</style>
@endsection



@section('title')


Calander

@endsection


@section('page_title')
CALENDAR
@endsection



@section('breadcrumbs')


<li  class="">
    <a href="#">Admin</a>
</li>
<li  class="active">
    <a href="#">Calendar</a>
</li>

@endsection

 


@section('content')
<div ng-app="dashboard" ng-controller ="DashboardController">

    <div class="col-lg-6">

        <div  class="panel panel-border panel-success">
<div class="panel-heading">
										<h3 class="panel-title">EVENT SCHEDULE - ROOMS</h3>
									</div>
            <div class="panel-body">


                <div ui-calendar="uiConfig.calendar" ng-model="eventSources">

                </div>
            </div>



        </div>

    </div>


        <div class="col-lg-6">

        <div  class="panel panel-border panel-primary">
<div class="panel-heading">
										<h3 class="panel-title">EVENT SCHEDULE - HALLS</h3>
									</div>
            <div class="panel-body">


                <div ui-calendar="uiConfig2.calendar" ng-model="eventSources2">

                </div>
            </div>



        </div>

    </div>

    <div class="modal inmodal fade" id="info" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Event Information</h4>

                </div>
                <div class="modal-body">
                   <div id="reserveInfo"></div>

                </div>
            </div>
        </div>

    </div>
    <div class="modal inmodal fade" id="addHall" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Event Information</h4>

                </div>
                <div class="modal-body">
                    info here...

                </div>
            </div>
        </div>

    </div>
    <div class="modal inmodal fade" id="addRoom" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Add Room Reservation</h4>

                </div>
                <div class="modal-body">
                    <div class="row" ng-init="ResShow='1'">
                        <div ng-show="ResShow=='1'">
                            <form class="form-horizontal">
                                <div class="col-md-12">



                                    <div class="form-group">

                                        <label class="control-label col-md-2"> Check In</label>
                                        <div class="col-md-2">

                                            <input type="text" class="form-control" name="checkin" id="checkout">
                                        </div>


                                        <label class="control-label col-md-2"> Check Out</label>
                                        <div class="col-md-2">

                                            <input type="text" class="form-control" name="checkout" id="checkin">
                                        </div>

                                        <label class="control-label col-md-2"> Room Type</label>
                                        <div class="col-md-2">

                                            <select type="text" onchange="getBookings(this.value)" class="form-control" name="type" id="rt">

                                                @foreach($roomTypes as $r)

                                                <option value="{{$r->room_type_id}}">{{$r->type_name}} </option>

                                                @endforeach
                                            </select>
                                        </div>



                                    </div>






                                    <div class="form-group">

                                        <label class="control-label col-md-2"> Adults</label>
                                        <div class="col-md-2">

                                            <input type="text" class="form-control" id="adults" name="adults">
                                        </div>

                                        <label class="control-label col-md-2"> Kids</label>
                                        <div class="col-md-2">

                                            <input type="text" class="form-control" id="kids" name="kids">


                                        </div>

                                        <div class="col-md-3 col-md-offset-1">

                                            <button type="button" class="btn btn-block btn-warning" onclick="reserveList()">Check Availability</button>
                                        </div>

                                    </div>



                                    <div class="form-group">

                                        <label class="control-label col-md-2"> Rooms Reserved</label>
                                        <div class="col-md-2">

                                            <input type="text" readonly class="form-control" id="rooms" name="rooms">
                                        </div>

  <label class="control-label col-md-2"> Remarks </label>
                                        <div class="col-md-6">

                                            <textarea type="text"  class="form-control" id="remarks" name="remarks"></textarea>
                                        </div>
                                        
                                    </div>
                                    
                                            <div class="form-group">

                                        <label class="control-label col-md-2"> Booking Type</label>
                                        <div class="col-md-10">

                                        <select id="booking"></select>
                                        </div>
 
                                        
                                    </div>
//admin_getbookings



                                </div>
                                <div class="col-md-12">

                                    <table class="table table-striped table-bordered table-hover dataTables-example" id="dd" plugin="datatable" >
                                        <thead>
                                            <tr>

                                                <th>Room_No.</th>
                                                <th>Size</th>
                                                <th>Status</th>
                                                <th>Remarks</th>
                                                <th ></th>
                                                <th ></th>

                                            </tr>
                                        </thead>
                                        <tbody>


                                        </tbody>

                                    </table>
                                </div>
                            </form>
                        </div>

                        <div class="" ng-show="ResShow == '2'">

                            <form class="form-horizontal">


                                <div class="form-group">

                                    <label class="col-md-2 control-label">Select Customer</label>
                                    <div class="col-md-10">
                                        <select class="form-control" id="customer" onchange="cusSelect(this.value)">
                                            <option value="0" selected> Add New Customer</option>
                                            @foreach($customers as $c)
                                            <option value="{{$c->cus_id}}"> {{$c->name}} - {{$c->NIC_passport_num}} </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>


                                <div class="form-group">

                                    <label class="col-md-2 control-label">Customer Name</label>
                                    <div class="col-md-10">
                                        <input class="form-control customer" id="cus_name" name="cus_name">
                                    </div>

                                </div>


                                <div class="form-group">

                                    <label class="col-md-2 control-label">Customer NIC</label>
                                    <div class="col-md-10">
                                        <input class="form-control customer" id="cus_nic" name="cus_nic">
                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-md-2 control-label">Customer Phone</label>
                                    <div class="col-md-10">
                                        <input class="form-control customer" id="cus_phone" name="cus_phone">
                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-md-2 control-label">Customer Email</label>
                                    <div class="col-md-10">
                                        <input class="form-control customer" id="cus_email" name="cus_email">
                                    </div>

                                </div>

                            </form>


                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>

                    <button ng-click="ResShow = '2'" ng-show="ResShow=='1'" class="btn btn-primary">Next</button>
                    <button ng-click="ResShow = '1'" ng-show="ResShow=='2'" class="btn btn-warning">Previous</button>
                    <button   ng-show="ResShow=='2'" class="btn btn-success" onclick="saveRoom()">Confirm and Save</button>

                </div>

            </div>
        </div>

    </div>



    @endsection



    @section('js')



    <script src="{{URL::asset('angular/dashboard/dashboard.module.js')}}"></script>

    <script>


        var roomList = [];

        $(document).ready(function(){

            $('#checkin').datepicker({
                clearBtn : true,
                disableTouchKeyboard : true,
                format:'yyyy-mm-dd'

            });

            $('#checkout').datepicker({
                clearBtn : true,
                disableTouchKeyboard : true,
                format:'yyyy-mm-dd'

            });


            cusSelect(0);
        });
        function reserveList(){
            roomList = [];

            reserveListInfo();

        }


        function reserveListInfo(){


            var checkin = $('#checkin').val();
            var checkout = $('#checkout').val();
            var rt = $('#rt').val();

            var oTable = $('#dd').DataTable();
            oTable.destroy();

            $('#dd').DataTable( {
                "ajax": "getReservationDate?checkin="+checkin+"&checkout="+checkout+"&rt="+rt,
                "columns": [

                    { "data": "room_num" },

                    { "data": "room_size" },
                    {"data" : null,
                     "mRender": function(data, type, full) {


                         if(data.status == '0'){

                             return "<span class='label label-warning'> Not Assigned </span>";

                         }else{

                             return data.status;

                         }

                     }
                    },
                    { "data": "remarks" },
                    {"data" : null,
                     "mRender": function(data, type, full) {

                         var i = roomList.indexOf(data.room_id,0);

                         if(i<0){

                             return '<button class="btn btn-success  btn-animate btn-animate-side btn-block btn-sm" onclick="addBlock('+data.room_id+',this)"  id="save'+data.room_id+'">Save </button>' ;

                         }else{

                             return '<button class="btn btn-success  btn-animate btn-animate-side btn-block btn-sm" disabled onclick="addBlock('+data.room_id+',this)"  id="save'+data.room_id+'">Save</button>';

                         }


                     }
                    },
                    {"data" : null,
                     "mRender": function(data, type, full) {

                         var i = roomList.indexOf(data.room_id,0);

                         if(i>0){

                             return '<button class="btn btn-danger  btn-animate btn-animate-side btn-block btn-sm" onclick="delBlock('+data.room_id+',this)" id="remove'+data.room_id+'">Remove </button>' ;

                         }else{

                             return '<button class="btn btn-danger  btn-animate btn-animate-side btn-block btn-sm" disabled onclick="delBlock('+data.room_id+',this)"   id="remove'+data.room_id+'">Remove</button>';

                         }


                     }
                    }
                ]
            } );

        }


        function addBlock(id,elm){ 

            document.getElementById("save"+id).disabled = true;
            document.getElementById("remove"+id).disabled = false;
            roomList.push(id);

            $('#rooms').val( roomList.length);

        }


        function delBlock(id,elm){ 

            document.getElementById("save"+id).disabled = false;
            document.getElementById("remove"+id).disabled = true;
            console.log(roomList);
            var a = roomList.indexOf(id);
            roomList.splice(a,1);

            console.log(roomList);
            $('#rooms').val( roomList.length);

        }


        function cusSelect(elm){

            var list = $('.customer');

            if(elm == '0'){



                for(var i = 0; i<list.length; i++){


                    list[i].disabled = false;


                }


            }else{


                for(var i = 0; i<list.length; i++){


                    list[i].disabled = true;


                }


            }

        }



        function saveRoom(){


            var checkin = $('#checkin').val();
            var checkout = $('#checkout').val();
            var rt = $('#rt').val();
            var kids = $('#kids').val();
            var adults = $('#adults').val();

            //roomList;

            var cus = $('#customer').val();
            var cus_name = $('#cus_name').val();
            var cus_nic = $('#cus_nic').val();
            var cus_email = $('#cus_email').val();
            var cus_phone = $('#cus_phone').val();
            var remarks = $('#remarks').val();


            var data = {
                checkin : checkin,
                checkout: checkout,
                rt:rt,
                kids:kids,
                adults:adults,
                cus:cus,
                cus_name:cus_name,
                cus_nic:cus_nic,
                cus_email:cus_email,
                cus_phone:cus_phone,
                data:roomList,
                remarks:remarks
            };


            $.ajax({

                url:"admin_reserve_room",
                data:data,
                type:"get",
                success:function(){

                    swal("success","","success");

                },
                error:function(err){

                    console.log(err);
                }



            });

        }


    </script>


    @endsection