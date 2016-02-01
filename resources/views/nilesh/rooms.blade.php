@extends('adminmaster')


@section('css')

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

                        <th>Description</th>
                        <th>Services</th>
                        <th>Count</th>

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
                        <th class="col-md-1"></th>
                        <th class="col-md-1"></th>
                    </tr>
                </thead>
                <tbody>


                </tbody>

            </table>


        </div> 
    </div> 
</div>



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

                    <div class="form-group">

                        <label class="col-lg-3 control-label">Room No</label>

                        <div class="col-lg-9"><input placeholder="Enter Room Number" class="form-control" type="text" required id="rnum" name="rnum" required>
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
<div class="modal inmodal fade" id="addRoomT" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Add A Room Type</h4>

            </div>
            <form class="form-horizontal" id="addRT" onsubmit="return insertRT()">
                <div class="modal-body">


                    <div class="form-group">

                        <label class="col-lg-3 control-label">Type Name</label>

                        <div class="col-lg-9"><input placeholder="Enter Room Type Name" class="form-control" type="text" required id="rtname" name="rtname">
                        </div>
                    </div>

                    <div class="form-group">

                        <label class="col-lg-3 control-label">Type Code</label>

                        <div class="col-lg-9"><input placeholder="Enter Short code for Room Type" class="form-control" type="text" required id="rtcode" name="rtcode">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Description</label>
                        <div class="col-lg-9">
                            <textarea id="rtdes" class="form-control"  name="rtdes" placeholder="Description of this Room Type"></textarea>
                        </div>

                        <div class="form-group">

                            <label class="col-lg-3 control-label">Services</label>
                            <div class="col-md-2">

                                <div class="checkbox checkbox-primary">
                                    <input id="wifi" name="wifi" value="WiFi" type="checkbox">
                                    <label for="wifi">
                                        Wifi
                                    </label>
                                </div>
                            </div>


                            <div class="col-md-3">

                                <div class="checkbox checkbox-primary">
                                    <input id="tv" name="tv" value="Satelite TV" type="checkbox">
                                    <label for="tv">
                                        Satelite TV
                                    </label>
                                </div>
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



    <script>
        $('document').ready(function(){

            document.getElementById('management').click();
            document.getElementById('RM').setAttribute('class','active');

            dataLoad();
            loadTypes();

          

        });

        function dataLoad(){

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
                    { "data": "description" },
                    {"data" : null,
                     "mRender": function(data, type, full) {

                         var serviceArray = data.services_provided.split(";");  

                         var returnBody = "";

                         for (var i = 0; i< serviceArray.length; i++){

                             returnBody += "<label class='label label-primary' style='margin-right:1%'>"+serviceArray[i]+"</label>";

                         }


                         return returnBody;

                     }
                    },
                    { "data": "count" },

                    {"data" : null,
                     "mRender": function(data, type, full) {
                         return '<button class="btn btn-primary  btn-animate btn-animate-side btn-block btn-sm" onclick="edit('+data.room_id+')"> Edit </button>' ;
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

        function insertR(){


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


        function insertRT(){


            $.ajax({
                type: "get",
                url: 'admin_roomtype_add',
                data: $('#addRT').serialize(),

                success : function(data){
                    $('#addRoomT').modal('hide');
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

                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(thrownError);
                }	 
            });



        }

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

        function delCancel(id){

            swal('Cannot delete!', 'Room type cannot be deleted because there are rooms associated with this room type. Please delete them or change them first!', 'error');


        }

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


                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(thrownError);

                    swal("Ooops!", "Cannot generate room number! ("+thrownError+")", "error");   
                }	 
            });



        }

    </script>

    @endsection