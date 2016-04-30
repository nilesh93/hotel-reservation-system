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

    RESERVATION

@endsection

@section('page_buttons')

@endsection

@section('breadcrumbs')

<li>
    <a href="#">Management</a>
</li>
<li  class="active">
    <a href="#">Reservation General Info</a>
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
                    <a href="#hall_reservation" data-toggle="tab" aria-expanded="false" >
                        <span class="visible-xs"><i class="fa fa-user"></i></span>
                        <span class="hidden-xs">Hall Reservation</span>
                    </a>
                </li>


                <div class="indicator" style="right: 367px; left: 0px;"></div></ul>
                <div class="tab-content">
                <div class="tab-pane " id="hall_reservation">


                    <!-- hall tab--->
                    <div class="row">
                        <div class="col-md-2"></div>

                        <div class="col-md-2">
                          Time Slot 1
                        </div>

                        <div class="col-md-1"> : </div>

                        <div class="col-md-3" id="time_slot_1">
                            From <input id="time_slot_1_non_from" type="time" value={{ $general_info->hall_time_slot_1_from }} disabled >
                        </div>

                        <div class="col-md-2">
                           To <input id="time_slot_1_non_to" type="time" value={{ $general_info->hall_time_slot_1_to }} disabled >
                        </div>

                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary" onclick="editCHKIN('hall_time1')">Edit</button>
                        </div>

                    </div>

                    <br>

                    <div class="row">
                        <div class="col-md-2"></div>

                        <div class="col-md-2">
                            Time Slot 2
                        </div>

                        <div class="col-md-1"> : </div>

                        <div class="col-md-3">
                            From <input id="time_slot_2_non_from" type="time" value={{ $general_info->hall_time_slot_2_from  }} readonly >
                        </div>

                        <div class="col-md-2">
                            To <input id="time_slot_2_non_to" type="time" value={{ $general_info->hall_time_slot_2_to  }} readonly>
                        </div>

                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary" onclick="editCHKIN('hall_time2')">Edit</button>
                        </div>

                    </div>

                    <br>
                </div>

                    <div class="tab-pane active" id="room_reservation">

                       {{--room_tab--}}
                        <div class="row">
                            <div class="col-md-3"></div>

                            <div class="col-md-2">
                                Check-In Time
                            </div>

                            <div class="col-md-1"> : </div>

                            <div class="col-md-2">
                                <input id="timepicker1" type="time" value={{ $general_info->check_in }} disabled >
                            </div>

                            <div class="col-md-3">
                                <button type="button" class="btn btn-primary" onclick="editCHKIN('chk_in')">Edit</button>
                            </div>

                        </div>

                        <br>
                        <div class="row">
                            <div class="col-md-3"></div>

                            <div class="col-md-2">
                                Check-Out Time
                            </div>

                            <div class="col-md-1"> : </div>

                            <div class="col-md-2">
                                <input id="timepicker2" type="time" value={{ $general_info->check_out }} disabled>
                            </div>

                            <div class="col-md-3">
                                <button class="btn btn-primary" onclick="editCHKIN('chk_out')" >Edit</button>
                            </div>

                        </div>

                        <br>
                        <div class="row">
                            <div class="col-md-3"></div>

                            <div class="col-md-2">
                                No of Adults
                            </div>

                            <div class="col-md-1"> : </div>

                            <div class="col-md-2">
                                {{ $general_info->no_of_adults}}
                            </div>

                            <div class="col-md-3">
                                <button class="btn btn-primary" onclick="editCHKIN('adults')">Edit</button>
                            </div>

                        </div>

                        <br>
                        <div class="row">
                            <div class="col-md-3"></div>

                            <div class="col-md-2">
                                No of Kids
                            </div>

                            <div class="col-md-1"> : </div>

                            <div class="col-md-2">
                                {{ $general_info->no_of_kids}}
                            </div>

                            <div class="col-md-3">
                                <button class="btn btn-primary" onclick="editCHKIN('kids')">Edit</button>
                            </div>

                        </div>

                        <br>
                        <div class="row">
                            <div class="col-md-3"></div>

                            <div class="col-md-2">
                                Selectable Rooms
                            </div>

                            <div class="col-md-1"> : </div>

                            <div class="col-md-2">
                                {{ $general_info->selectable_no_of_rooms}}
                            </div>

                            <div class="col-md-3">
                                <button class="btn btn-primary" onclick="editCHKIN('rooms')">Edit</button>
                            </div>

                        </div>

                    </div>
                </div>
    </div>


    {{--Check-In/Check-Out Edit Modal--}}
    <div class="modal inmodal fade" id="editMD" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Edit Reservation General Info</h4>

                </div>

                    <div class="modal-body">


                        <div class="form-group" id="edit_field">


                        </div>

                    </div>

                    <div class="modal-footer" id="save_changes">




                    </div>


            </div>


        </div>
    </div>



@endsection


@section('js')

    <script>

        $('document').ready(function(){

            document.getElementById('management').click();
            document.getElementById('RGI').setAttribute('class','active');

        });

        function editCHKIN(id)
        {
            if(id == 'chk_in') {
                document.getElementById('edit_field').innerHTML = '<div class="row"><div class="col-md-3"></div><div class="col-md-3">Check-In Time </div><div class="col-md-1"> : </div>'+
                                                                    '<div class="col-md-2">'+
                                                                        '<input id="timepicker_chkin" type="time" value="{{ $general_info->check_in }}" >'+
                                                                    '</div></div>';
                document.getElementById('save_changes').innerHTML = '<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>' +
                                                                    '<button type="button" class="btn btn-primary" onclick=saveCHAN("'+id+'")>Save changes</button>';
            } else if(id == 'chk_out') {

                document.getElementById('edit_field').innerHTML = '<div class="row"><div class="col-md-3"></div><div class="col-md-3">Check-Out Time </div><div class="col-md-1"> : </div>'+
                        '<div class="col-md-2">'+
                        '<input id="timepicker_chkout" type="time" value="{{ $general_info->check_out }}">'+
                        '</div></div>';

                document.getElementById('save_changes').innerHTML = '<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>' +
                                                                     '<button type="button" class="btn btn-primary" onclick=saveCHAN("'+id+'")>Save changes</button>';


            } else if(id == 'adults') {
                document.getElementById('edit_field').innerHTML = '<div class="row"> <div class="col-md-3"></div>'+
                                                                    ' <div class="col-md-3">'+
                                                                        'No of Adults'+
                                                                    '</div>'+
                                                                    '<div class="col-md-1"> : </div>'+
                                                                    '<div class="col-md-2">'+
                                                                        '<input type="number" id="no_of_adults" style="width: 50%" value="{{ $general_info->no_of_adults }}" min="1" max="30">'+
                                                                    '</div></div>';

                document.getElementById('save_changes').innerHTML = '<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>' +
                                                                    '<button type="button" class="btn btn-primary" onclick=saveCHAN("'+id+'")>Save changes</button>';

            } else if(id == 'kids') {
                document.getElementById('edit_field').innerHTML = '<div class="row"> <div class="col-md-3"></div>'+
                        ' <div class="col-md-3">'+
                        'No of Kids'+
                        '</div>'+
                        '<div class="col-md-1"> : </div>'+
                        '<div class="col-md-2">'+
                        '<input type="number" id="no_of_kids" style="width: 50%" value="{{ $general_info->no_of_kids}}" min="0" max="30">'+
                        '</div></div>';

                document.getElementById('save_changes').innerHTML = '<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>' +
                                                                    '<button type="button" class="btn btn-primary" onclick=saveCHAN("'+id+'")>Save changes</button>';


            } else if (id == 'rooms') {
                document.getElementById('edit_field').innerHTML = '<div class="row"> <div class="col-md-3"></div>'+
                        ' <div class="col-md-3">'+
                        'Selectable Rooms'+
                        '</div>'+
                        '<div class="col-md-1"> : </div>'+
                        '<div class="col-md-2">'+
                        '<input type="number" id="select_rooms" style="width: 50%" value="{{ $general_info->selectable_no_of_rooms}}" min="0" max="30">'+
                        '</div></div>';

                document.getElementById('save_changes').innerHTML = '<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>' +
                                                                    '<button type="button" class="btn btn-primary" onclick=saveCHAN("'+id+'")>Save changes</button>';

            } else if (id == 'hall_time1') {


                var time1_from = document.getElementById('time_slot_1_non_from').value;
                var time1_to =  document.getElementById('time_slot_1_non_to').value;

                document.getElementById('edit_field').innerHTML = '<div class="row"> <div class="col-md-1"></div>'+
                        ' <div class="col-md-3">'+
                        'Time Slot 1'+
                        '</div>'+
                        '<div class="col-md-1"> : </div>'+
                        '<div class="col-md-3">'+
                            'From <input id="time_slot_1_from" type="time" value='+time1_from+'>'+
                        '</div>'+
                        '<div class="col-md-3">'+
                        'To <input id="time_slot_1_to" type="time" value='+ time1_to+' >'+
                        '</div>'+
                        '</div>';

                document.getElementById('save_changes').innerHTML = '<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>' +
                        '<button type="button" class="btn btn-primary" onclick=saveCHAN("'+id+'")>Save changes</button>';

            } else if (id == 'hall_time2') {
                var time2_from = document.getElementById('time_slot_2_non_from').value;
                var time2_to =  document.getElementById('time_slot_2_non_to').value;

                document.getElementById('edit_field').innerHTML = '<div class="row"> <div class="col-md-1"></div>'+
                        ' <div class="col-md-3">'+
                        'Time Slot 2'+
                        '</div>'+
                        '<div class="col-md-1"> : </div>'+
                        '<div class="col-md-3">'+
                        'From <input id="time_slot_2_from" type="time" value='+time2_from+'>'+
                        '</div>'+
                        '<div class="col-md-3">'+
                        'To <input id="time_slot_2_to" type="time" value='+time2_to+' >'+
                        '</div>'+
                        '</div>';

                document.getElementById('save_changes').innerHTML = '<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>' +
                        '<button type="button" class="btn btn-primary" onclick=saveCHAN("'+id+'")>Save changes</button>';

            }


            $('#editMD').modal('show');

        }

        function saveCHAN(id)
        {
                if(id == 'chk_in') {
                    var check_in = document.getElementById('timepicker_chkin').value;

                    if (check_in == "") {
                        swal({
                            title: "<div class='alert alert-danger'> <strong>Warning! </strong> </div>",
                            text: "<span style='color:#ff2222'>Please provide a valid time <span>",
                            html: true
                        });

                        return false;
                    } else {

                        update(id,check_in);

                        return true;
                    }
                } else if(id == 'chk_out') {
                    var check_out = document.getElementById('timepicker_chkout').value;

                    if (check_out == "") {
                        swal({
                            title: "<div class='alert alert-danger'> <strong>Warning! </strong> </div>",
                            text: "<span style='color:#ff2222'>Please provide a valid time <span>",
                            html: true
                        });

                        return false;
                    } else {

                        update(id,check_out);

                        return true;
                    }

                } else if(id == 'adults') {
                    var adults = document.getElementById('no_of_adults').value;

                    if (adults  == "" || adults < 1 || adults > 40) {
                        swal({
                            title: "<div class='alert alert-danger'> <strong>Warning! </strong> </div>",
                            text: "<span style='color:#ff2222'>Please provide a valid input <span>",
                            html: true
                        });

                        return false;
                    } else {

                        update(id,adults);

                        return true;
                    }
                } else if(id == 'kids') {
                    var kids = document.getElementById('no_of_kids').value;

                    if (kids  == "" || kids < 1 || kids > 40) {
                        swal({
                            title: "<div class='alert alert-danger'> <strong>Warning! </strong> </div>",
                            text: "<span style='color:#ff2222'>Please provide a valid input <span>",
                            html: true
                        });

                        return false;
                    } else {

                        update(id,kids);

                        return true;
                    }
                } else if(id == 'rooms') {
                    var rooms = document.getElementById('select_rooms').value;

                    if (rooms  == "" || rooms < 1 || rooms > 40) {
                        swal({
                            title: "<div class='alert alert-danger'> <strong>Warning! </strong> </div>",
                            text: "<span style='color:#ff2222'>Please provide a valid input <span>",
                            html: true
                        });

                        return false;
                    } else {

                        update(id,rooms);

                        return true;
                    }
                } else if(id == 'hall_time1') {
                    var time_from = document.getElementById('time_slot_1_from').value;
                    var time_to =  document.getElementById('time_slot_1_to').value;
                    var time2_from = document.getElementById('time_slot_2_non_from').value;
                    var time2_to =  document.getElementById('time_slot_2_non_to').value;
                    

                    if((time_from >= time2_from) && (time_from <= time2_to) || (time_to >= time2_from && time_to <= time2_to) ||
                            (time_from <= time2_from && time_to >= time2_to) )
                    {
                        swal({
                            title: "<div class='alert alert-danger'> <strong>Warning! </strong> </div>",
                            text: "<span style='color:#ff2222'>Please provide a valid time,this time slot is conflicting with the other one <span>",
                            html: true
                        });

                        return false;

                    }



                    if (time_from == "" || time_to == "") {
                        swal({
                            title: "<div class='alert alert-danger'> <strong>Warning! </strong> </div>",
                            text: "<span style='color:#ff2222'>Please provide a valid time <span>",
                            html: true
                        });

                        return false;
                    } else {

                        updateHall(id,time_from,time_to);

                        return true;
                    }

                }else if(id == 'hall_time2') {
                    var time_from = document.getElementById('time_slot_2_from').value;
                    var time_to =  document.getElementById('time_slot_2_to').value;
                    var time1_from = document.getElementById('time_slot_1_non_from').value;
                    var time1_to =  document.getElementById('time_slot_1_non_to').value;


                    if((time_from >= time1_from) && (time_from <= time1_to) || (time_to >= time1_from && time_to <= time1_from) ||
                            (time_from <= time1_from && time_to >= time1_to) )
                    {
                        swal({
                            title: "<div class='alert alert-danger'> <strong>Warning! </strong> </div>",
                            text: "<span style='color:#ff2222'>Please provide a valid time,this time slot is conflicting with the other one <span>",
                            html: true
                        });

                        return false;

                    }


                    if (time_from == "" || time_to == "") {
                        swal({
                            title: "<div class='alert alert-danger'> <strong>Warning! </strong> </div>",
                            text: "<span style='color:#ff2222'>Please provide a valid time <span>",
                            html: true
                        });

                        return false;
                    } else {

                        updateHall(id,time_from,time_to);

                        return true;
                    }

                }
        }


        function update(field,value)
        {
            swal({
                        title: "Are you sure?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Okay",
                        cancelButtonText: "Cancel",
                        closeOnConfirm: false,
                        closeOnCancel: true,
                        showLoaderOnConfirm: true
                    },
                    function(isConfirm)
                    {
                        if (isConfirm) {

                            $.ajax({

                                url: 'admin_edit_reservation_info',
                                type: 'get',
                                data: {
                                    'field': field,
                                    'value': value

                                },
                                success : function(data){
                                    swal("Updated!", "", "success");
                                    $('#editMD').modal('hide');
                                    document.location.reload(true);



                                },
                                error: function(xhr, ajaxOptions, thrownError) {
                                    console.log(thrownError);

                                    swal("Ooops!", "Something Went Wrong! ("+thrownError+")", "error");
                                }


                            });
                        }
                    });
        }

        function updateHall(field,value1,value2)
        {
            swal({
                        title: "Are you sure?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Okay",
                        cancelButtonText: "Cancel",
                        closeOnConfirm: false,
                        closeOnCancel: true,
                        showLoaderOnConfirm: true
                    },
                    function(isConfirm)
                    {
                        if (isConfirm) {

                            $.ajax({

                                url: 'admin_edit_reservation_info',
                                type: 'get',
                                data: {
                                    'field': field,
                                    'value': value1,
                                    'value_b':value2
                                },
                                success : function(data){
                                    swal("Updated!", "", "success");
                                    $('#editMD').modal('hide');

                                    if(field == 'hall_time1') {
                                        document.getElementById('time_slot_1_non_from').value = value1;
                                        document.getElementById('time_slot_1_non_to').value = value2;
                                    } else if(field == 'hall_time2') {
                                        document.getElementById('time_slot_2_non_from').value = value1;
                                        document.getElementById('time_slot_2_non_to').value = value2;
                                    }


                                },
                                error: function(xhr, ajaxOptions, thrownError) {
                                    console.log(thrownError);

                                    swal("Ooops!", "Something Went Wrong! ("+thrownError+")", "error");
                                }


                            });
                        }
                    });
        }



    </script>

<script src="{{ URL::asset('BackEnd/assets/plugins/cropping/cropper.min.js') }}"></script>
<script src="{{ URL::asset('CustomJs/roomtypeImg.js') }}"></script>



@endsection