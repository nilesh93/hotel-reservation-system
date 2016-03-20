@extends('adminmaster')


@section('css')

<script src="{{ URL::asset('BackEnd/assets/plugins/upload/jquery-pack.js') }}"></script>
<script src="{{ URL::asset('BackEnd/assets/plugins/upload/jquery.imgareaselect.min.js') }}"></script>

<link rel="stylesheet" href="{{ URL::asset('BackEnd/assets/css/crop/animate.min.css')}}">
<link rel="stylesheet" href="{{ URL::asset('BackEnd/assets/css/crop/custom.css')}}">
<link rel="stylesheet" href="{{ URL::asset('BackEnd/assets/css/crop/icheck/flat/green.css')}}">

@endsection



@section('title')


Rooms

@endsection


@section('page_title')
ROOM MANAGEMENT



@endsection

@section('page_buttons')
<div class="col-md-4 col-md-offset-4">
    <button type="button" class="btn btn-success waves-effect btn-block waves-light pull-right" data-toggle="modal" data-target="#addRoom">
        <span class="btn-label pull-left"><i class="fa fa-plus"></i>
        </span> ROOMS</button>
</div>
<div class="col-md-4">
    <button type="button" class="btn btn-primary waves-effect btn-block waves-light pull-right" data-toggle="modal" data-target="#addRoomT">
        <span class="btn-label pull-left"><i class="fa fa-plus"></i>
        </span>ROOM TYPES</button></div>
@endsection

@section('breadcrumbs')

<li>
    <a href="#">Management</a>
</li>
<li  class="active">
    <a href="#">Room Management</a>
</li>

@endsection



@section('content')

<div class="col-lg-12"> 


    <div id="test"></div>
    <ul class="nav nav-tabs tabs" style="width: 100%;">
        <li class="active tab" style="width: 25%;">
            <a href="#rooms" data-toggle="tab" aria-expanded="false" class="active"> 
                <span class="visible-xs"><i class="fa fa-home"></i></span> 
                <span class="hidden-xs">Rooms</span> 
            </a> 
        </li> 
        <li class="tab" style="width: 25%;"> 
            <a href="#roomtypes" data-toggle="tab" aria-expanded="false"> 
                <span class="visible-xs"><i class="fa fa-user"></i></span> 
                <span class="hidden-xs">Room Types</span> 
            </a> 
        </li> 


        <div class="indicator" style="right: 367px; left: 0px;"></div></ul> 
    <div class="tab-content"> 
        <div class="tab-pane " id="roomtypes"> 


            <table class="table table-striped table-bordered table-hover dataTables-example" id="ddt" plugin="datatable" >
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Type</th>

                        <th>Rate (Rs)</th>
                        <th>Description</th>

                        <th>Count</th>
                        <th class="col-md-1"></th>
                        <th class="col-md-1"></th>
                        <th class="col-md-1"></th>
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
                        <th>#</th>
                        <th>Room_No.</th>
                        <th>Room Type</th>
                        <th>Size</th>
                        <th>status</th>
                        <th>Remarks</th>
                        <th ></th>
                        <th ></th>
                    </tr>
                </thead>
                <tbody>


                </tbody>

            </table>


        </div> 
    </div> 
</div>


<!-- add room -->
<div class="modal inmodal fade" id="addRoom" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Add A Room</h4>

            </div>
            <form class="form-horizontal" id="addR" onsubmit="return insertR()">
                <div class="modal-body">




                    <div class="form-group">
                        <label class="col-lg-3 control-label">Room Type</label>

                        <div class="col-lg-9"> <select class="form-control" onchange="getRoomNum(this.value)" id="rtype" name="rtype" required>



                            </select>
                        </div>
                    </div>

                    <div class="form-group" id="roomNumErr">

                        <label class="col-lg-3 control-label">Room No</label>

                        <div class="col-lg-9"><input placeholder="Enter Room Number" class="form-control" type="text" required id="rnum" name="rnum" required onchange="checkRoomNum(this.value,this)" onkeyup="checkRoomNum(this.value,this)">
                            <span id="helpBlock3" class="help-block">This should be unique.</span>
                        </div>
                    </div>

                    <div class="form-group">

                        <label class="col-lg-3 control-label">Size (SqFt)</label>

                        <div class="col-lg-9"><input type="text" placeholder="Enter Room Size" class="form-control" type="text" required id="rsize" name="rsize" pattern="[-+]?[0-9]*\.?[0-9]+" title="Float value needed" >

                        </div>               
                    </div>

                    <input type="text"  id="max" name="max" hidden="true">

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Status</label>

                        <div class="col-lg-9"> <select class="form-control" id="rstatus" name="rstatus">
                            <option value="AVAILABLE">Availabale</option>
                            <option value="PENDING">Pending</option>


                            </select>
                        </div>
                    </div>



                    <div class="form-group">
                        <label class="col-lg-3 control-label">Remarks</label>

                        <div class="col-lg-9"><textarea placeholder="Any special Comments?" class="form-control" type="text" required id="rremarks" name="rremarks"> </textarea>
                        </div>
                    </div>



                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </div>

            </form>
    </div>
</div>

<!-- add room type -->
<div class="modal inmodal fade" id="addRoomT" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Add A Room Type</h4>

            </div>
            <form class="form-horizontal" id="addRT" onsubmit="return insertRT()">
                <div class="modal-body">


                    <div class="form-group">

                        <label class="col-lg-3 control-label">Room Type Name</label>

                        <div class="col-lg-4"><input placeholder="Enter Room Type Name" class="form-control" type="text" required id="rtname" name="rtname">
                        </div>
                        <label class="col-lg-2 control-label">Type Code</label>

                        <div class="col-lg-3 " id="roomTErr"><input placeholder="Enter Short code  " class="form-control" type="text" required id="rtcode" name="rtcode" onchange="checkRTCode(this.value)" onkeyup="checkRTCode(this.value)">

                            <span id="helpBlock2" class="help-block">This should be unique.</span>

                        </div>
                    </div>

                    <input type="hidden" name="data1" id="data1">


                    <div class="form-group">
                        <label class="col-lg-3 control-label">Description</label>
                        <div class="col-lg-9">
                            <textarea id="rtdes" class="form-control"  name="rtdes" placeholder="Description of this Room Type"></textarea>
                        </div>

                        <div class="form-group" style="margin-top:1%">

                            <label class="col-lg-3 control-label">Services</label>
                            <div class="col-md-2">
                                <?php $rscount = 0; ?>

                                @if(count($rs) == 0)
                                <label class="  control-label">  <i>Not available</i> </label>

                                @endif

                                @foreach($rs as $r)


                                <div class="checkbox checkbox-primary">
                                    <input id="service{{$rscount}}" name="service{{$rscount}}" value="{{$r->rs_id}}" type="checkbox">
                                    <label for="service{{$rscount}}">
                                        {{ $r->name}}   
                                    </label>
                                </div>

                                <?php $rscount++; ?>

                                @endforeach

                                <input type="text" name="rscount" value="{{$rscount}}" hidden="true">

                            </div>

                            <label class="col-lg-3 control-label">Furnishing</label>
                            <div class="col-md-4">
                                <?php $rfcount = 0; ?>

                                @if(count($rf) == 0)
                                <label class="  control-label">  <i>Not available</i> </label>

                                @endif

                                @foreach($rf as $f)


                                <div class="checkbox checkbox-primary">
                                    <input id="furnish{{$rfcount}}" name="furnish{{$rfcount}}" value="{{$f->rf_id}}" type="checkbox">
                                    <label for="furnish{{$rfcount}}">
                                        {{ $f->name}}   
                                    </label>
                                </div>

                                <?php $rfcount++; ?>

                                @endforeach

                                <input type="text" name="rfcount" value="{{$rfcount}}" hidden="true">

                            </div>



                        </div>


                    </div>

                    <div class="modal-header" style="margin-bottom:2%">

                        <h4 class="modal-title">Add Booking Rates</h4>

                    </div>

                    <div class="form-group">

                        <label class="col-lg-2 control-label">Booking</label>
                        <div class="col-md-3" id="mealErr">

                            <select class=" form-control" id="rtmeal" name="rtmeal">
                                <option value="0">Select Option </option>
                                @foreach($meals as $m)
                                <option value="{{$m->meal_type_id}}" data-name="{{$m->meal_type_name}}">{{$m->meal_type_name}} </option>

                                @endforeach    
                            </select>
                            <span id="helpBlock2" class="help-block">Booking Type required.</span>

                        </div>
                        <label class="col-lg-1 control-label">Rate</label>

                        <div class="col-lg-3" id="rateErr"><input placeholder="Enter Price" class="form-control" type="text"   id="rtrate" name="rtrate"   title="Float value needed" aria-describedby="helpBlock2">
                            <span id="helpBlock2" class="help-block">A Float value is required.</span>
                        </div>

                        <div class="col-md-2">

                            <button  type="button" class="btn btn-success btn-block" onclick="rateAdd()">Add</button>
                        </div>
                    </div>

                    <div class="form-group" id="rateTBL">


                        <button type="reset" id="resetRT" hidden="true"></button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button class="" id="insertRTReset" type="reset" hidden="true"></button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- upload image -->
<div class="profile_img">

    <!-- end of image cropping -->
    <div id="crop-avatar">


        <div class="col-md-4 col-md-offset-8" hidden="true">
            <button type="button" class="btn btn-success waves-effect btn-block waves-light pull-right avatar-view1"  id="imgLoad" >
                <span class="btn-label pull-left"><i class="fa fa-plus"></i>
                </span>ADD IMAGE</button>
        </div>


        <!-- Cropping modal -->
        <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form class="avatar-form"    enctype="multipart/form-data"  onsubmit="return upload()" method="post" id="formID" name="formID">
                        <div class="modal-header">
                            <button class="close" data-dismiss="modal" type="button">&times;</button>
                            <h4 class="modal-title" id="avatar-modal-label">Upload Image</h4>
                        </div>
                        <div class="modal-body">
                            <div class="avatar-body">

                                <!-- Upload image and data -->
                                <div class="avatar-upload">
                                    <input class="avatar-src"  name="avatar_src"   id="avatar_src" type="hidden">
                                    <input class="avatar-data" name="avatar_data"  id="avatar_data"  type="hidden">
                                    <input type="hidden" id="imgid">
                                    <label for="avatarInput">Upload</label>
                                    <input class="avatar-input btn btn-success"  id="avatarInput" name="avatarInput" type="file">
                                </div>

                                <!-- Crop and preview -->
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="avatar-wrapper">

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="avatar-preview preview-lg" id="lg1"></div>
                                        <div class="avatar-preview preview-md"></div>
                                        <div class="avatar-preview preview-sm"></div>
                                    </div>
                                </div>
                                <div class="row avatar-btns">
                                    <div class="col-md-9">

                                    </div>
                                    <div class="col-md-3">
                                        <button  class="btn btn-primary btn-block avatar-save" type="submit" >Done</button>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <!-- <div class="modal-footer">
<button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
</div> -->
                    </form>
                </div>
            </div>
        </div>
        <!-- /.modal -->

        <!-- Loading state -->
        <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
    </div>
    <!-- end of image cropping -->

</div> 


<!-- edit room type -->
<div class="modal inmodal fade" id="editRoomT" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Edit A Room Type</h4>

            </div>
            <form class="form-horizontal" id="editRT" onsubmit="return saveEditRT()">
                <div class="modal-body">

                    <ul class="nav nav-tabs tabs" style="width: 100%;">
                        <li class="active tab" style="width: 25%;">
                            <a href="#rmtGI" data-toggle="tab" aria-expanded="true" id="giInfo" > 
                                <span class="visible-xs"><i class="fa fa-home"></i></span> 
                                <span class="hidden-xs">General Info</span> 
                            </a> 
                        </li> 
                        <li class="tab" style="width: 25%;"> 
                            <a href="#rmtImages" data-toggle="tab" aria-expanded="false"> 
                                <span class="visible-xs"><i class="fa fa-user"></i></span> 
                                <span class="hidden-xs">Images</span> 
                            </a> 
                        </li> 

                    </ul> 

                    <div class="tab-content"> 
                        <div class="tab-pane active " id="rmtGI"> 


                            <div class="form-group">

                                <label class="col-lg-2 control-label">Type Name</label>

                                <div class="col-lg-4"><input placeholder="Enter Room Type Name" class="form-control" type="text" required id="rrtname" name="rtname">
                                </div>

                                <label class="col-lg-2 control-label">  Code</label>

                                <div class="col-lg-4"><input placeholder="Enter Short code for Room Type" class="form-control" type="text" required id="rrtcode" name="rtcode" readonly>
                                </div>

                            </div>


                            <div class="form-group">
                                <label class="col-lg-2 control-label">Description</label>
                                <div class="col-lg-10">
                                    <textarea id="rrtdes" class="form-control"  name="rtdes" placeholder="Description of this Room Type"></textarea>
                                </div>
                                <input type="hidden" id="main_id" name="main_id" >


                                <div class="form-group" style="margin-top:1%">
                                    <label class="col-lg-2 control-label">Services</label>
                                    <div class="col-md-4" style="margin-left:1%">
                                        <?php $rrscount = 100; ?>

                                        @if(count($rs) == 0)
                                        <label class="  control-label">  <i>Not available</i> </label>

                                        @endif

                                        @foreach($rs as $r)


                                        <div class="checkbox checkbox-primary">
                                            <input class="service" id="service{{$rrscount}}" name="service{{$rrscount}}" value="{{$r->rs_id}}" type="checkbox">
                                            <label for="service{{$rrscount}}">
                                                {{ $r->name}}   
                                            </label>
                                        </div>

                                        <?php $rrscount++; ?>

                                        @endforeach

                                        <input type="text" name="rscount" value="{{$rrscount}}" hidden="true">

                                    </div>

                                    <label class="col-lg-2 control-label">Furnish</label>
                                    <div class="col-md-3">
                                        <?php $rrfcount = 100; ?>

                                        @if(count($rf) == 0)
                                        <label class="  control-label">  <i>Not available</i> </label>

                                        @endif

                                        @foreach($rf as $f)


                                        <div class="checkbox checkbox-primary">
                                            <input class="furnish" id="furnish{{$rrfcount}}" name="furnish{{$rrfcount}}" value="{{$f->rf_id}}" type="checkbox">
                                            <label for="furnish{{$rrfcount}}">
                                                {{ $f->name}}   
                                            </label>
                                        </div>

                                        <?php $rrfcount++; ?>

                                        @endforeach

                                        <input type="text" name="rfcount" value="{{$rrfcount}}" hidden="true">

                                    </div>
                                </div>





                            </div>

                            <div class="form-group">

                                <label class="col-lg-2 control-label">Booking</label>
                                <div class="col-md-3" id="mealErr1">

                                    <select class=" form-control" id="rtmeal1" name="rtmeal">
                                        <option value="0">Select Option </option>
                                        @foreach($meals as $m)
                                        <option value="{{$m->meal_type_id}}" data-name="{{$m->meal_type_name}}">{{$m->meal_type_name}} </option>

                                        @endforeach    
                                    </select>
                                    <span id="helpBlock2" class="help-block">Booking Type required.</span>

                                </div>
                                <label class="col-lg-1 control-label">Rate</label>

                                <div class="col-lg-3" id="rateErr1"><input placeholder="Enter Price" class="form-control" type="text"   id="rtrate1" name="rtrate"   title="Float value needed" aria-describedby="helpBlock2">
                                    <span id="helpBlock2" class="help-block">A Float value is required.</span>
                                </div>

                                <div class="col-md-2">

                                    <button  type="button" class="btn btn-success btn-block" onclick="rateAddEdit()">Add</button>
                                </div>
                            </div>

                            <div class="form-group" id="rateTBL1">



                            </div>

                        </div>



                        <input type="hidden" name="data1" id="data2">

                        <div class="tab-pane" id="rmtImages"> 


                            <div class="form-group"  id="img_load">




                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- edit rooms -->
<div class="modal inmodal fade" id="editRoom" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Edit A Room</h4>

            </div>
            <form class="form-horizontal" id="editR" onsubmit="return updateR()">
                <div class="modal-body">




                    <div class="form-group">
                        <label class="col-lg-3 control-label">Room Type</label>

                        <div class="col-lg-9"> <select class="form-control" onchange="getRoomNum(this.value)" id="rtype1" name="rtype" required>



                            </select>
                        </div>
                    </div>

                    <div class="form-group">

                        <label class="col-lg-3 control-label">Room No</label>

                        <div class="col-lg-9"><input placeholder="Enter Room Number" class="form-control" type="text" required id="rnum1" name="rnum" required  readonly>
                        </div>
                    </div>

                    <div class="form-group">

                        <label class="col-lg-3 control-label">Size (SqFt)</label>

                        <div class="col-lg-9"><input type="text" placeholder="Enter Room Size" class="form-control" type="text" required id="rsize1" name="rsize" pattern="[-+]?[0-9]*\.?[0-9]+" title="Float value needed" >

                        </div>               
                    </div>

                    <input type="text"  id="max1" name="max" hidden="true">

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Status</label>

                        <div class="col-lg-9"> <select class="form-control" id="rstatus1" name="rstatus">
                            <option value="AVAILABLE">Availabale</option>
                            <option value="PENDING">Pending</option>


                            </select>
                        </div>
                    </div>


                    <input id="room_id" name="id" hidden="true">
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Remarks</label>

                        <div class="col-lg-9"><textarea placeholder="Any special Comments?" class="form-control" type="text" required id="rremarks1" name="rremarks"> </textarea>
                        </div>
                    </div>



                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </div>

            </form>
    </div>
</div>


@endsection



@section('js')


<script src="{{ URL::asset('BackEnd/assets/plugins/cropping/cropper.min.js') }}"></script>
<script src="{{ URL::asset('CustomJs/roomtypeImg.js') }}"></script>

<script>


    //temp rates for room type add
    var tempRates = [];
    
    //temp rates for room type edit
    var tempRatesEdit = [];
    
    //img valdiation extensions
    var _validFileExtensions = [".jpg", ".jpeg", ".png"];

    //room codes for valdiation
    var roomNumbers = [];
    
    //room type codes for validation
    var rtCodes = [];

    //room trigger to save validation
    var roomTrigger = false;
    
    // room type trigger to save validation
    var rTrigger = false;

    //check room number validation
    function checkRoomNum(value,element){


        if(roomNumbers.indexOf(value) > -1){

            $('#roomNumErr').addClass("has-error"); 
            roomTrigger = true;

        } else{


            $('#roomNumErr').removeClass("has-error");
            roomTrigger = false;
        }

    } 
    
    //room type code validation
    function checkRTCode(value){

        if(rtCodes.indexOf(value) > -1){

            $('#roomTErr').addClass("has-error"); 
            rTrigger = true;

        } else{


            $('#roomTErr').removeClass("has-error");
            rTrigger = false;
        }


    } 
    
    //add temprates
    function rateAdd(){
        var rate = $('#rtrate').val();
        var meal = $('#rtmeal').val();
        var name = $('#rtmeal').children('option:selected').data('name');
        var patt = new RegExp("[-+]?[0-9]*\.?[0-9]+");



        if(meal === null || meal == "0"){
            $('#mealErr').addClass("has-error");
            return false;

        }else{
            $('#mealErr').removeClass("has-error");

        }
        if(!patt.test(rate)){

            $('#rateErr').addClass("has-error");
            return false;
        }else{
            $('#rateErr').removeClass("has-error");

        }



        $('#rtrate').val("");

        $("#rtmeal option[value='"+ meal + "']").attr("disabled","disabled");
        // $(" #rtmeal option:selected").removeAttr("selected");
        $("#rtmeal").val("0");
        tempRates.push({

            rate: rate,
            meal : meal,
            name : name

        });

        tableLoad();
    }
    
    //add temp rates for edit
    function rateAddEdit(){
        var rate = $('#rtrate1').val();
        var meal = $('#rtmeal1').val();
        var name = $('#rtmeal1').children('option:selected').data('name');
        var patt = new RegExp("[-+]?[0-9]*\.?[0-9]+");



        if(meal === null || meal == "0"){
            $('#mealErr1').addClass("has-error");
            return false;

        }else{
            $('#mealErr1').removeClass("has-error");

        }
        if(!patt.test(rate)){

            $('#rateErr1').addClass("has-error");
            return false;
        }else{
            $('#rateErr1').removeClass("has-error");

        }



        $('#rtrate1').val("");

        $("#rtmeal1 option[value='"+ meal + "']").attr("disabled","disabled");
        // $(" #rtmeal option:selected").removeAttr("selected");
        $("#rtmeal1").val("0");
        tempRatesEdit.push({

            rate: rate,
            meal : meal,
            name : name

        });

        tableLoadEdit();
    }
    
    //load table for add rates
    function tableLoad(){
        if(tempRates.length >0 ){

            var body ="<table class='table table-hover table-striped'> <thead> <th>#</th> <th> Meal Type </th>    <th>Rate (Rs.) </th> <th class='col-md-1'> </th> </thead> <tbody>  ";

            for(var i = 0; i<tempRates.length ; i++){

                body += "<tr> <td> "+(i+1)+" </td> <td> "+tempRates[i].name+"</td>  <td>"+parseFloat(tempRates[i].rate).toFixed(2)+" </td> <td> <button class='btn btn-danger btn-block btn-sm' onclick='delTemp("+i+","+tempRates[i].meal+")'> Delete </button></td>    </tr>";

            }

            body+= "</tbody> </table>";
            document.getElementById("rateTBL").innerHTML = body;
        }else{


            document.getElementById("rateTBL").innerHTML = '<div class="alert alert-warning alert-dismissable">  No rates Added Yet. Please Add rates </div>';
        }

    }
    
    //load table for edit rates
    function tableLoadEdit(){
        if(tempRatesEdit.length >0 ){

            var body ="<table class='table table-hover table-striped'> <thead> <th>#</th> <th> Meal Type </th>    <th>Rate (Rs.) </th> <th class='col-md-1'> </th> </thead> <tbody>  ";

            for(var i = 0; i<tempRatesEdit.length ; i++){

                body += "<tr> <td> "+(i+1)+" </td> <td> "+tempRatesEdit[i].name+"</td>  <td>"+parseFloat(tempRatesEdit[i].rate).toFixed(2)+" </td> <td> <button class='btn btn-danger btn-block btn-sm' onclick='delTemp1("+i+","+tempRatesEdit[i].meal+")'> Delete </button></td>    </tr>";

            }

            body+= "</tbody> </table>";
            document.getElementById("rateTBL1").innerHTML = body;
        }else{


            document.getElementById("rateTBL1").innerHTML = '<div class="alert alert-warning alert-dismissable">  No rates Added Yet. Please Add rates </div>';
        }

    }
    
    //delete temprate add row
    function delTemp(index,id){

        tempRates.splice(index,1);
        $("#rtmeal option[value='"+ id + "']").removeAttr("disabled","disabled");

        tableLoad();
    }
    
    //delete temp rate edit  row
    function delTemp1(index,id){

        tempRatesEdit.splice(index,1);
        $("#rtmeal1 option[value='"+ id + "']").removeAttr("disabled","disabled");

        tableLoadEdit();
    }
    
    //onload function
    $('document').ready(function(){

        document.getElementById('management').click();
        document.getElementById('RM').setAttribute('class','active');

        $('#avatarInput').change(function(){

            if (!hasExtension('avatarInput',_validFileExtensions)) {

                swal("Invalid File Type!","Please choose a jpg, jpeg or a png Image.","error");
                $('#avatarInput').val('');
                return false;
            }



        }); 


        dataLoad();
        loadTypes();

        tableLoad();

    });
    
    //initital dataload
    function dataLoad(){

        roomNumbers = [];
        rtCodes = [];


        var oTable = $('#dd').DataTable();
        oTable.destroy();

        $('#dd').DataTable( {
            "ajax": "admin_getrooms",
            "columns": [
                { "data": "room_id" },
                { "data": "room_num" },
                { "data": "type" },
                { "data": "room_size" },
                {"data" : null,
                 "mRender": function(data, type, full) {


                     roomNumbers.push(data.room_num);


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
                     return '<button class="btn btn-primary  btn-animate btn-animate-side btn-block btn-sm" onclick="edit('+data.room_id+')"> Edit </button>' ;
                 }
                },
                {"data" : null,
                 "mRender": function(data, type, full) {
                     return '<button class="btn btn-danger  btn-animate btn-animate-side btn-block btn-sm" onclick="del('+data.room_id+')"> Delete </button>' ;
                 }
                }
            ]
        } );


        var oTable = $('#ddt').DataTable();
        oTable.destroy();

        $('#ddt').DataTable( {
            "ajax": "admin_getroom_types",
            "columns": [
                { "data": "type_code" },
                { "data": "type_name" },
                { "data": "rate" },
                { "data": "description" },

                { "data": "count" },
                {"data" : null,
                 "mRender": function(data, type, full) {


                     rtCodes.push(data.type_code);

                     return '<button class="btn btn-success btn-animate btn-animate-side btn-block btn-sm" onclick="addimg('+data.room_type_id+')">  Images </button>' ;
                 }
                },
                {"data" : null,
                 "mRender": function(data, type, full) {
                     return '<button class="btn btn-primary  btn-animate btn-animate-side btn-block btn-sm" onclick="editRT('+data.room_type_id+')"> Edit </button>' ;
                 }
                },
                {"data" : null,
                 "mRender": function(data, type, full) {

                     if(data.count == 0){


                         return '<button class="btn btn-danger  btn-animate btn-animate-side btn-block btn-sm" onclick="delRT('+data.room_type_id+')"> Delete </button>' ;

                     }else{


                         return '<button class="btn btn-danger  btn-animate btn-animate-side btn-block btn-sm" onclick="delCancel('+data.room_type_id+')"> Delete </button>' ;
                     }
                 }
                }
            ]
        } );



    }
    
    //insert room
    function insertR(){


        if(roomTrigger){

            swal("You cannot use a previous used room code here","", "error");

            return false;
        }

        $.ajax({
            type: "get",
            url: 'admin_room_add',
            data: $('#addR').serialize(),

            success : function(data){
                $('#addRoom').modal('hide');
                swal('Success','Successfully Added!', 'success');
                dataLoad();

            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError);
            }	 
        });



        return false; 


    }
    
    //add image for room type
    function addimg(id){

        $('#imgLoad').click();
        document.getElementById("imgid").value = id;



    }
    
    //edit room type
    function editRT(id){

        console.log(id);
        $.ajax({

            url : "admin_edit_roomtype",
            type:"get",
            data:{
                id : id
            },
            success:function(data){

                //console.log(data.info.room_type_id);
                $('#main_id').val(data.info.room_type_id);
                $('#rrtname').val(data.info.type_name);
                $('#rrtcode').val(data.info.type_code);
                $('#rrtdes').val(data.info.description);

                if(data.rate.length > 0){


                    tempRatesEdit = [];

                    console.log(data.rate);
                    for(var a = 0; a<data.rate.length; a++){


                        $("#rtmeal1 option[value='"+ data.rate[a].meal_type_id + "']").attr("disabled","disabled");
                        // $(" #rtmeal option:selected").removeAttr("selected");
                        $("#rtmeal1").val("");
                        tempRatesEdit.push({

                            rate: data.rate[a].single_rates,
                            meal : data.rate[a].meal_type_id,
                            name : data.rate[a].meal

                        });


                    }
                    tableLoadEdit();

                } 

                $('#editRoomT').modal('show');
                $('#giInfo').click();

                for(var i = 0; i<data.rf.length; i++){

                    $('input:checkbox[class="furnish"][value="' + data.rf[i].furnish_id + '"]')
                        .attr('checked', 'checked');

                }

                for(var x = 0; x<data.rs.length; x++){

                    $('input:checkbox[class="service"][value="' + data.rs[x].service_id + '"]')
                        .attr('checked', 'checked');

                }

                var body = "";

                for(var t=0; t< data.images.length ; t++){


                    body+= '    <div class="col-sm-4" style="margin-bottom:2%">'+
                        '<img src="'+data.images[t].path+'" alt="image" class="img-responsive">'+
                        '<br>'+
                        '<button type="button" onclick="delImage('+data.images[t].room_image_id+','+data.images[t].room_type_id+')" class=" col-md-offset-8 col-md-4 btn btn-danger">Remove</button>'+

                        ' </div>';
                }
                if(data.images.length == 0){

                    body = '<div class="alert alert-danger alert-dismissable">  Sorry No Images Avaialble. </div>';

                }
                console.log(body);
                document.getElementById("img_load").innerHTML = body;
                console.log(data);
            },
            error:function(err){

                console.log(err);
            }

        });



    }
    
    //save edited room type
    function saveEditRT(){

        //admin_roomtype_update
        $('#data2').val(JSON.stringify(tempRatesEdit));
        console.log('admin_roomtype_add?'+ $('#editRT').serialize());
        $.ajax({
            type: "get",
            url: 'admin_roomtype_update',
            data: $('#editRT').serialize(),

            success : function(data){
                $('#editRoomT').modal('hide');
                swal('Success','Successfully Added!', 'success');
                dataLoad();
                loadTypes();

            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError);
            }	 


        });

        return false;

    }
    
    //ajax upload of image
    function upload(){


        if (!hasExtension('avatarInput',_validFileExtensions)) {

            swal("Invalid File Type!","Please choose a jpg, jpeg or a png Image.","error");
            return false;
        }

        swal({

            title: "Uploading...Please wait!",   
            text: "",   
            type: "info",  
            showCancelButton: false,   
            showConfirmButton: false


        });


        console.log(document.getElementById("avatar_data").value);

        var f =   new FormData();
        f.append('img',document.getElementById("avatarInput").files[0]);
        f.append('img_data',document.getElementById("avatar_data").value);
        f.append('imgid',document.getElementById("imgid").value);

        var url= "admin_roomtype_upload";
        $.ajax({
            url: url,
            type:"post",
            data: f,
            dataType:"JSON",
            processData: false,
            contentType: false,
            success: function (data, status)
            {
                console.log(data);
            },
            error: function (data)
            {

                if (data.status === 422) {

                    name_error.html(data.responseJSON.name);
                    link_error.html(data.responseJSON.link);
                    image_error.html(data.responseJSON.image);
                    swal("Upload Failed", "Something went wrong (code: "+data.status+")", "error");


                } else {
                    $('#avatar-modal').modal('hide');
                    swal("success","Image Successfully Uploaded","success");
                    console.log(data.status);
                    $('.avatar-wrapper img').removeAttr('src');
                    //$('.avatar-preview').html("");
                    $('#avatarInput').val("");

                    ('#avatarInput').fireEvent("onchange");
                }
            }
        });  



        return false;

    }  
    
    //image validation
    function hasExtension(inputID, exts) {
        var fileName = document.getElementById(inputID).value;
        return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
    }
    
    //delete image
    function delImage(id,originalid){

        $.ajax({

            url:"admin_rt_image_del",
            type:"get",
            data:{
                id:id,
                type_id:originalid
            },
            success:function(data){

                var body = "";

                for(var t=0; t< data.images.length ; t++){


                    body+= '<div class="col-sm-4" style="margin-bottom:2%">'+
                        '<img src="'+data.images[t].path+'" alt="image" class="img-responsive">'+
                        '<br>'+
                        '<button type="button" onclick="delImage('+data.images[t].room_image_id+','+data.images[t].room_type_id+')" class=" col-md-offset-8 col-md-4 btn btn-danger">Remove</button>'+

                        ' </div>';
                }
                if(data.images.length == 0){

                    body = '<div class="alert alert-danger alert-dismissable">  Sorry No Images Avaialble. </div>';

                }
                console.log(body);
                document.getElementById("img_load").innerHTML = body;
                console.log(data);
            },
            error: function (err){


                swal("Something went wrong","code("+err+")","error");
            }



        });




    }
    
    //insert room type
    function insertRT(){


        if(rTrigger){

            swal("You cannot use a previously used room type code here","", "error");
            return false;
        }

        $('#data1').val(JSON.stringify(tempRates));
        console.log('admin_roomtype_add?'+ $('#addRT').serialize());

        if(tempRates.length > 0){
            $.ajax({
                type: "get",
                url: 'admin_roomtype_add',
                data: $('#addRT').serialize(),

                success : function(data){
                    $('#addRoomT').modal('hide');
                    swal('Success','Successfully Added!', 'success');
                    dataLoad();
                    loadTypes();
                    $('#updateRTReset').click();
                    tempRates = [];
                    tableLoad();
                    $("#nsertRTReset").click();

                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(thrownError);
                }	 
            });

        }else{

            document.getElementById("rateTBL").innerHTML = '<div class="alert alert-danger alert-dismissable">  No rates Added Yet. Please Add rates. You cannot save without adding atleast one rate. </div>';
        }

        return false; 


    }
    
    //load dropdown for rooms
    function loadTypes(){



        $.ajax({
            type: "get",
            url: 'admin_getroom_types',
            data: '',

            success : function(data){

                var body = "<option value='0'> Select Type </option>";
                console.log(data.data);
                for(var i = 0; i<data.data.length; i++){

                    body += "<option value = '"+data.data[i].room_type_id+"'> "+data.data[i].type_name+"   </option>";


                }
                document.getElementById("rtype").innerHTML = body;
                document.getElementById("rtype1").innerHTML = body;

            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError);
            }	 
        });



    }
    
    //delete room types
    function delRT(id){


        swal({   
            title: "Delete?",   
            text: "",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Delete",   
            cancelButtonText: "Cancel",   
            closeOnConfirm: false}, 
             function(isConfirm){   if (isConfirm) {



            $.ajax({
                type: "get",
                url: 'admin_delete_room_type',
                data: {
                    id:id
                },

                success : function(data){


                    swal("Removed!", "", "success");
                    dataLoad();    

                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(thrownError);

                    swal("Ooops!", "Something Went Wrong! ("+thrownError+")", "error");   
                }	 
            });


        } });


    }
    
    //delete room
    function del(id){


        swal({   
            title: "Delete?",   
            text: "",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Delete",   
            cancelButtonText: "Cancel",   
            closeOnConfirm: false}, 
             function(isConfirm){   if (isConfirm) {



            $.ajax({
                type: "get",
                url: 'admin_delete_room',
                data: {
                    id:id
                },

                success : function(data){


                    swal("Deleted!", "", "success");  
                    dataLoad();    

                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(thrownError);

                    swal("Ooops!", "Something Went Wrong! ("+thrownError+")", "error");   
                }	 
            });


        } });


    }
    
    //cannot delete error message
    function delCancel(id){

        swal('Cannot delete!', 'Room type cannot be deleted because there are rooms associated with this room type. Please delete them or change them first!', 'error');


    }
    
    //autogenerate room number via ajax
    function getRoomNum(id){

        if(id == 0){

            document.getElementById('rnum').value = "";
            document.getElementById('max').value = "";
            return false;


        }

        $.ajax({
            type: "get",
            url: 'admin_getRoomNum',
            data: {
                id:id
            },

            success : function(data){

                document.getElementById('rnum').value = data.code;
                document.getElementById('max').value = data.max;
                console.log(data.max);

            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError);

                swal("Ooops!", "Cannot generate room number! ("+thrownError+")", "error");   
            }	 
        });



    }
    
    //deprecated funciton to validate room number
    function checknum(id,element){

        $.ajax({

            url : "admin_check_rnum",
            type:"get",
            data : {id : id},
            success: function(data){

                console.log(data);
            },
            error:function(err){

                console.log(data);
            }

        });

    }
    
    //edit room
    function edit(id){

        $('#room_id').val(id);

        $.ajax({
            url:"admin_get_room_update_details",
            type:"get",
            data:{id:id},
            success:function(data){

                $('#rtype1').val(data.room_type_id);
                $('#rnum1').val(data.room_num);
                $('#rsize1').val(data.room_size);
                $('#rstatus1').val(data.status);
                $('#rremarks1').val(data.remarks);

                $('#editRoom').modal('show');
            },
            error:function(err){


                swal("Somethi went wrong!","code("+err+").","error");

            }


        });




    } 
    
    //update room
    function updateR(){

        $.ajax({
            url:"admin_save_room_update_details",
            type:"get",
            data:$('#editR').serialize(),
            success:function(data){



                $('#editRoom').modal('hide');
                swal("successfully Updated","","success");
                dataLoad();
            },
            error:function(err){


                swal("Somethi went wrong!","code("+err+").","error");

            }


        });

        return false;
    }



</script>

@endsection