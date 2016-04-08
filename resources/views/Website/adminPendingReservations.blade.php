@extends('adminmaster')


@section('css')

<script src="{{ URL::asset('BackEnd/assets/plugins/upload/jquery-pack.js') }}"></script>
<script src="{{ URL::asset('BackEnd/assets/plugins/upload/jquery.imgareaselect.min.js') }}"></script>

<link rel="stylesheet" href="{{ URL::asset('BackEnd/assets/css/crop/animate.min.css')}}">
<link rel="stylesheet" href="{{ URL::asset('BackEnd/assets/css/crop/custom.css')}}">
<link rel="stylesheet" href="{{ URL::asset('BackEnd/assets/css/crop/icheck/flat/green.css')}}">

@endsection



@section('title')
    Reservations
@endsection


@section('page_title')

PENDING RESERVATION

@endsection

@section('page_buttons')

@endsection

@section('breadcrumbs')

<li>
    <a href="#">Management</a>
</li>
<li  class="active">
    <a href="#">Pending Reservation</a>
</li>

@endsection



@section('content')

    <div class="col-lg-12">

        <div id="test"></div>
            <ul class="nav nav-tabs tabs" style="width: 100%;">
                <li class="active tab" style="width: 25%;">
                    <a href="#room_reservation" data-toggle="tab" aria-expanded="false" class="active">
                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                        <span class="hidden-xs">Room Reservation</span>
                    </a>
                </li>

                <li class="tab" style="width: 25%;">
                    <a href="#hall_reservation" data-toggle="tab" aria-expanded="false">
                        <span class="visible-xs"><i class="fa fa-user"></i></span>
                        <span class="hidden-xs">Hall Reservation</span>
                    </a>
                </li>


                <div class="indicator" style="right: 367px; left: 0px;"></div></ul>
                <div class="tab-content">
                <div class="tab-pane " id="hall_reservation">


                    <table class="table table-striped table-bordered table-hover dataTables-example" id="dth" plugin="datatable" >
                        <thead>
                        <tr>
                            <th class="col-md-4">Date</th>
                            <th class="col-md-4">Reservation No</th>
                            <th class="col-md-3">Time Slot</th>
                            <th class="col-md-1"></th>

                        </tr>
                        </thead>

                        <tbody>

                        </tbody>

                    </table>

                </div>

                    <div class="tab-pane active" id="room_reservation">

                        <table class="table table-striped table-bordered table-hover dataTables-example" id="dtr" plugin="datatable" >
                            <thead>
                                <tr>
                                    <th class="col-md-4">Date</th>
                                    <th class="col-md-4">Reservation No</th>
                                    <th class="col-md-1"></th>

                                </tr>
                            </thead>

                            <tbody>

                            </tbody>

                        </table>

                    </div>
                </div>
    </div>


    <!-- Room Reservation Individual -->
    <div class="modal inmodal fade" id="roomRS" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content" style="background-color:aliceblue">
                <div class="modal-header" >
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" ><div align="center" id="reservation_id"></div></h4>

                </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-2"><b>Date : </b></div>
                            <div class="col-md-3" id="date"> </div>

                            <div class="col-md-1"></div>

                            <div class="col-md-3"><b>Customer Name :</b></div>
                            <div class="col-md-3" id="customer_name"> </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-2"><b>Check-In :</b></div>
                            <div class="col-md-3" id="check_in"></div>

                            <div class="col-md-1"></div>

                            <div class="col-md-3"><b>Check-Out :</b></div>
                            <div class="col-md-3" id="check_out"></div>
                        </div>

                        <br>
                        <div class="row">
                            <div class="col-md-12"><b>Booked Room Types & Count</b></div>
                            <br>
                            <br>
                            <div class="col-md-12" id="roomtypesCount"></div>
                        </div>

                        <br>
                        <br>
                        <div class="row">
                            <div class="col-md-3"><b>Total Rooms : </b></div>
                            <div class="col-md-1" id="total_rooms"></div>

                            <div class="col-md-1"></div>

                            <div class="col-md-2"><b>Adults : </b></div>
                            <div class="col-md-1" id="adults"></div>

                            <div class="col-md-1"></div>

                            <div class="col-md-2"><b>Kids : </b></div>
                            <div class="col-md-1" id="kids"></div>
                        </div>

                        <br>
                        <div class="row" id="available_room_types">

                        </div>



                    </div>

                    <div class="modal-footer">
                        <div class="col-md-12">
                            <div class="col-md-2" id="check_room_availability">
                            </div>

                            <div class="col-md-6"></div>

                            <div class="col-md-2" id="room_accept_button">

                            </div>

                            <div class="col-md-2" id="room_reject_button">

                            </div>
                        </div>

                    </div>

            </div>


        </div>
    </div>


    <!-- Hall Reservation Individual -->
    <div class="modal inmodal fade" id="hallRS" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content" style="background-color:aliceblue">
                <div class="modal-header" >
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" ><div align="center"><div id="hall_reservation_id"> </div></div></h4>

                </div>
                <form class="form-horizontal" id="addRS" onsubmit="return insertRS()">
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-2"><b>Date : </b></div>
                            <div class="col-md-4" id="hall_date"> </div>



                            <div class="col-md-3"><b>Customer Name :</b></div>
                            <div class="col-md-3" id="hall_customer_name"> Rishanthakumar Rasarathinam</div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-3"><b>Event Date :</b></div>
                            <div class="col-md-4" id="event_date"></div>
                        </div>
                        <BR>

                        <div class="row">
                            <div class="col-md-3"><b>Time Slot :</b></div>
                            <div class="col-md-4" id="timeSlot"></div>
                        </div>

                        <br>


                        <div class="row">
                            <div class="col-md-3"><b>Hall : </b></div>
                            <div class="col-md-4" id="hall"></div>
                        </div>

                        <br>
                        <div class="row" id="available_halls">

                        </div>



                    </div>

                    <div class="modal-footer">
                        <div class="col-md-12">
                            <div class="col-md-2" id="check_hall_availability">

                            </div>

                            <div class="col-md-6"></div>

                            <div class="col-md-2" id = "hall_accept_button">

                            </div>

                            <div class="col-md-2" id="hall_reject_button">

                            </div>
                        </div>

                    </div>

                </form>
            </div>


        </div>
    </div>


    <!-- Reject Reason -->
    <div class="modal inmodal fade" id="rejectRS" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content" style="background-color:aliceblue">
                <div class="modal-header" >
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" align="center">Reason for Rejection</h4>

                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">Reservation No</div><div class="col-md-1"> : </div>
                        <div class="col-md-2" id="reject_reservation_id"> </div>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-md-4">Customer Name</div><div class="col-md-1"> : </div>
                        <div class="col-md-4" id="reject_customer_name"> </div>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-md-4">Customer email</div><div class="col-md-1">  : </div>
                        <div class="col-md-4" id="reject_customer_mail"> </div>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-md-4">Customer contact No</div><div class="col-md-1">  : </div>
                        <div class="col-md-4" id="reject_customer_contact"> </div>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-md-4">Reason </div><div class="col-md-1">:</div>
                        <div class="col-md-7">
                            <textarea id = "rejectReason" rows="4" cols="43" name="comment" form="usrform"></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer" id="reject_mail_button">


                </div>

            </div>


        </div>
    </div>

@endsection


@section('js')

<script src="{{ URL::asset('BackEnd/assets/plugins/cropping/cropper.min.js') }}"></script>
<script src="{{ URL::asset('CustomJs/roomtypeImg.js') }}"></script>

<script>

    $('document').ready(function(){

        document.getElementById('management').click();
        document.getElementById('PER').setAttribute('class','active');

        dataLoadRoom();
        dataLoadHall();


    });

    function dataLoadRoom(){

        var oTable = $('#dtr').DataTable();
        oTable.destroy();

        $('#dtr').DataTable( {
            "ajax": "admin_get_pending_room_reservations",
            "columns": [
                { "data": "created_at" },
                { "data": "room_reservation_id" },

                { "data": null,
                    "mRender":function(data,type,full){
                        return '<button class="btn btn-primary btn-animate btn-animate-side btn-block btn-sm" onclick="viewRoomRS('+data.room_reservation_id+')"> View</button>';

                    }
                }
            ]
        } );

    }

    function dataLoadHall(){

        var oTable = $('#dth').DataTable();
        oTable.destroy();

        $('#dth').DataTable({
            "ajax":"admin_get_pending_hall_reservations",
            "columns":[
                {"data":"created_at"},
                {"data":"hall_reservation_id"},
                {"data":"time_slot"},

                {"data":null,
                    "mRender":function(data,type,full){
                        return '<button class="btn btn-primary btn-animate btn-animate-side btn-block btn-sm" onclick="viewHallRS('+data.hall_reservation_id+')">View</button>'
                    }
                }
            ]

        });

    }

    function viewRoomRS(id){

        document.getElementById('available_room_types').innerHTML = "";

        $.ajax({

            url:'admin_individual_reservation',
            type:'get',
            data:{
              'reservation_id':id

            },

            success : function(data){

                console.log(data);

                document.getElementById('reservation_id').innerHTML = "Reservation No: "+data.reservation_details['room_reservation_id'];
                document.getElementById('customer_name').innerHTML = data.customer_details['name'];
                document.getElementById('date').innerHTML = data.reservation_details['created_at'];
                document.getElementById('check_in').innerHTML = data.reservation_details['check_in'];
                document.getElementById('check_out').innerHTML = data.reservation_details['check_out'];

                var room_types_content = "";

                for(var i=0;i<data.room_types.length;i++)
                {
                   room_types_content += '<div class="col-md-3">'+data.room_types[i].type_name+'</div><div class="col-md-1"> :</div><div class="col-md-2"> '+data.room_types[i].count +'</div><br>'

                }

                document.getElementById('roomtypesCount').innerHTML = room_types_content;
                document.getElementById('total_rooms').innerHTML = data.reservation_details['num_of_rooms'];
                document.getElementById('adults').innerHTML = data.reservation_details['adults'];
                document.getElementById('kids').innerHTML = data.reservation_details['children'];
                document.getElementById('room_accept_button').innerHTML = '<button type="button" class="btn btn-success" onclick="acceptRoomRS('+id+')">Accept</button>';
                document.getElementById('room_reject_button').innerHTML ='<button type="button" class="btn btn-danger" onclick="rejectRoomRS('+id+')">Reject</button>';
                document.getElementById('check_room_availability').innerHTML = '<button type="button" class="btn btn-primary" onclick="checkRoom('+id+')">Check Availability</button>';

            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError);

                swal("Ooops!", "Something Went Wrong! ("+thrownError+")", "error");
            }



        });

        $('#roomRS').modal('show');

    }


    function viewHallRS(id)
    {
        document.getElementById('available_halls').innerHTML = "";

        $.ajax({

            url:'admin_individual_hall_reservation',
            type:'get',
            data:{
                'hall_reservation_id':id

            },

            success : function(data){

                console.log(data);

                document.getElementById('hall_reservation_id').innerHTML = "Reservation No: "+data.hall_reservation_details['hall_reservation_id'];
                document.getElementById('hall_customer_name').innerHTML = data.customer_details['name'];
                document.getElementById('hall_date').innerHTML = data.hall_reservation_details['created_at'];
                document.getElementById('event_date').innerHTML = data.hall_reservation_details['reserve_date'];
                document.getElementById('timeSlot').innerHTML = data.hall_reservation_details['time_slot'];
                document.getElementById('hall').innerHTML = data.hall_reservation_details['title'];
                document.getElementById('hall_accept_button').innerHTML = '<button type="button" class="btn btn-success" onclick="acceptHallRS('+id+')">Accept</button>';
                document.getElementById('hall_reject_button').innerHTML ='<button type="button" class="btn btn-danger" onclick="rejectHallRS('+id+')">Reject</button>';
                document.getElementById('check_hall_availability').innerHTML = '<button type="button" class="btn btn-primary" onclick="checkHall('+id+')">Check Availability</button>';

            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError);

                swal("Ooops!", "Something Went Wrong! ("+thrownError+")", "error");
            }



        });

        $('#hallRS').modal('show');

    }

    function acceptRoomRS(id){

        swal({

            title: "Are you sure?",
            text: "Reservation will be confirmed",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "OK",
            cancelButtonText: "Cancel",
            closeOnConfirm: false,
            closeOnCancel: true,
            showLoaderOnConfirm: true

        },
         function(isConfirm){
             if (isConfirm) {

                 if(navigator.onLine) { // true|false
                     $.ajax({

                         url:'admin_accept_update_reservation',
                         type:'get',
                         data :{
                             'reservation_id':id
                         },

                         success:function(data){
                             console.log(data);
                             setTimeout(function(){
                                 swal("Accepted!", "Reservation has been confirmed", "success");
                                 $('#roomRS').modal('hide');
                                 dataLoadRoom();
                             }, 2000);

                         },
                         error:function(xhr,ajaxOptions,thrownError){
                             console.log(thrownError);

                             swal("Ooops!", "Something Went Wrong! ("+thrownError+")", "error");
                         }

                     });
                 }
                 else {

                     swal({
                         title: "Ooops!",
                         text: "Network Connectivity is lost, try again later",
                         type: "error",
                         timer: 2000

                     });


                 }

             }
         });

    }

    function acceptHallRS(id)
    {
        swal({

            title: "Are you sure?",
            text: "Reservation will be confirmed",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "OK",
            cancelButtonText: "Cancel",
            closeOnConfirm: false,
            closeOnCancel: true,
            showLoaderOnConfirm: true

        }, function(isConfirm){
            if (isConfirm) {
                if(navigator.onLine) { // true|false
                    $.ajax({

                        url:'admin_accept_hall_update_reservation',
                        type:'get',
                        data :{
                            'hall_reservation_id':id
                        },

                        success:function(data){
                            console.log(data);
                            setTimeout(function(){
                                swal("Accepted!", "Reservation has been confirmed", "success");
                                $('#hallRS').modal('hide');
                                dataLoadHall();
                            }, 2000);

                        },
                        error:function(xhr,ajaxOptions,thrownError){
                            console.log(thrownError);
                            swal("Ooops!", "Something Went Wrong! ("+thrownError+")", "error");
                        }

                    });
                }
                else {
                    swal({
                        title: "Ooops!",
                        text: "Network Connectivity is lost, try again later",
                        type: "error",
                        timer: 2000
                    });

                }
            }
        });

    }

    function rejectRoomRS(id){

        swal({
            title: "Are you sure?",
            text: "Reservation will be rejected!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Reject it!",
            cancelButtonText: "Cancel",
            closeOnConfirm: true,
            closeOnCancel: true
        },
                function(isConfirm)
                {
                    if (isConfirm) {
                        $('#roomRS').modal('hide');


                        $.ajax({

                            url: 'admin_individual_reservation',
                            type: 'get',
                            data: {
                                'reservation_id': id

                            },
                            success : function(data){
                                document.getElementById('rejectReason').value = "";
                                document.getElementById('reject_reservation_id').innerHTML = data.reservation_details['room_reservation_id'];
                                document.getElementById('reject_customer_name').innerHTML = data.customer_details['name'];
                                document.getElementById('reject_customer_mail').innerHTML = data.customer_details['email'];
                                document.getElementById('reject_customer_contact').innerHTML = data.customer_details['telephone_num'];
                                document.getElementById('reject_mail_button').innerHTML = ' <button type="button" class="btn btn-danger" onclick="mailRejectRS('+id+')">Reject & send an email</button>';

                                $('#rejectRS').modal('show');

                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                console.log(thrownError);

                                swal("Ooops!", "Something Went Wrong! ("+thrownError+")", "error");
                            }


                        });
                    }
                });
    }

    function rejectHallRS(id)
    {
        swal({
                    title: "Are you sure?",
                    text: "Reservation will be rejected!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, Reject it!",
                    cancelButtonText: "Cancel",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                function(isConfirm)
                {
                    if (isConfirm) {
                        $('#hallRS').modal('hide');


                        $.ajax({

                            url: 'admin_individual_hall_reservation',
                            type: 'get',
                            data: {
                                'hall_reservation_id': id

                            },
                            success : function(data){
                                document.getElementById('rejectReason').value = "";
                                document.getElementById('reject_reservation_id').innerHTML = data.hall_reservation_details['hall_reservation_id'];
                                document.getElementById('reject_customer_name').innerHTML = data.customer_details['name'];
                                document.getElementById('reject_customer_mail').innerHTML = data.customer_details['email'];
                                document.getElementById('reject_customer_contact').innerHTML = data.customer_details['telephone_num'];
                                document.getElementById('reject_mail_button').innerHTML = ' <button type="button" class="btn btn-danger" onclick="mailRejectHallRS('+id+')">Reject & send an email</button>';

                                $('#rejectRS').modal('show');

                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                console.log(thrownError);

                                swal("Ooops!", "Something Went Wrong! ("+thrownError+")", "error");
                            }


                        });
                    }
                });
    }





    function checkRoom(id)
    {


        $.ajax({
            url:'admin_check_room',
            type:'get',
            data:{
                'reservation_id':id

            },

            success: function(data){
                console.log(data);

                content = '<div class="col-md-12"><b>Available Room Types & Count</b></div>'+
                            '<br>'+
                            '<br>'+
                            '<div class="col-md-12">';

                for(var i=0;i<data.room_types.length;i++) {
                    content += '<div class="col-md-3">'+data.room_types[i].type_name+' </div><div class="col-md-1">:</div><div class="col-md-2"> '+data.room_type_available[data.room_types[i].room_type_id] +'</div><br>';

                }

                content += '</div>';

                document.getElementById('available_room_types').innerHTML = content;

            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError);

                swal("Ooops!", "Something Went Wrong! ("+thrownError+")", "error");
            }
        });

    }

    function checkHall(id)
    {
        $.ajax({
            url:'admin_check_hall',
            type:'get',
            data:{
                'hall_reservation_id':id

            },

            success: function(data){
                console.log(data);

                content = '<div class="col-md-12"><b>Available Halls & Status</b></div>'+
                        '<br>'+
                        '<br>'+
                        '<div class="col-md-12">';

                for(var i=0;i<data.halls.length;i++) {
                    content += '<div class="col-md-4">'+data.halls[i].title+' </div><div class="col-md-1">:</div><div class="col-md-4"> '+data.hall_status[data.halls[i].hall_id] +'</div><br>';

                }

                content += '</div>';

                document.getElementById('available_halls').innerHTML = content;

            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError);

                swal("Ooops!", "Something Went Wrong! ("+thrownError+")", "error");
            }
        });

    }

    function mailRejectRS(id)
    {
        var rejectReason = document.getElementById('rejectReason').value;

        if(rejectReason == null || rejectReason == "")
        {
            swal({
                title: "<div class='alert alert-danger'> <strong>Warning! </strong> </div>",
                text: "<span style='color:#ff2222'>Provide a reason to continue <span>",
                html: true
            });

            return false;
        } else {
            swal({
                        title: "Are you sure?",
                        text: "Reservation will be rejected!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, Reject it!",
                        cancelButtonText: "Cancel",
                        closeOnConfirm: false,
                        closeOnCancel: true,
                        showLoaderOnConfirm: true
                    },
                    function(isConfirm)
                    {
                        if (isConfirm) {

                            $.ajax({

                                url: 'admin_reject_room_reservation',
                                type: 'get',
                                data: {
                                    'room_reservation_id': id,
                                    'reason':rejectReason

                                },
                                success : function(data){
                                    swal("Rejected!", "Reservation has been rejected!", "success");
                                    $('#rejectRS').modal('hide');
                                    dataLoadRoom();



                                },
                                error: function(xhr, ajaxOptions, thrownError) {
                                    console.log(thrownError);

                                    swal("Ooops!", "Something Went Wrong! ("+thrownError+")", "error");
                                }


                            });
                        }
                    });
        }


    }

    function mailRejectHallRS(id)
    {
        var rejectReason = document.getElementById('rejectReason').value;

        if(rejectReason == null || rejectReason == "")
        {
            swal({
                title: "<div class='alert alert-danger'> <strong>Warning! </strong> </div>",
                text: "<span style='color:#ff2222'>Provide a reason to continue <span>",
                html: true
            });

            return false;
        } else {
            swal({
                        title: "Are you sure?",
                        text: "Reservation will be rejected!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, Reject it!",
                        cancelButtonText: "Cancel",
                        closeOnConfirm: false,
                        closeOnCancel: true,
                        showLoaderOnConfirm: true
                    },
                    function(isConfirm)
                    {
                        if (isConfirm) {

                            $.ajax({

                                url: 'admin_reject_hall_reservation',
                                type: 'get',
                                data: {
                                    'hall_reservation_id': id,
                                    'reason':rejectReason

                                },
                                success : function(data){
                                    swal("Rejected!", "Reservation has been rejected!", "success");
                                    $('#rejectRS').modal('hide');
                                    dataLoadHall();



                                },
                                error: function(xhr, ajaxOptions, thrownError) {
                                    console.log(thrownError);

                                    swal("Ooops!", "Something Went Wrong! ("+thrownError+")", "error");
                                }


                            });
                        }
                    });
        }
    }


</script>

@endsection