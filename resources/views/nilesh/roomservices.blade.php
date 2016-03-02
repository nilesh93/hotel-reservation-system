@extends('adminmaster')


@section('css')

@endsection



@section('title')


Rooms

@endsection


@section('page_title')

ROOM SERVICES



@endsection

@section('page_buttons')
<div class="col-md-4 col-md-offset-4">
    <button type="button" class="btn btn-success waves-effect btn-block waves-light pull-right" data-toggle="modal" data-target="#addRSM">
        <span class="btn-label pull-left"><i class="fa fa-plus"></i>
        </span> SERVICES</button>
</div>
<div class="col-md-4">
    <button type="button" class="btn btn-primary waves-effect btn-block waves-light pull-right" data-toggle="modal" data-target="#addRFM">
        <span class="btn-label pull-left"><i class="fa fa-plus"></i>
        </span>FURNISHING</button></div>
@endsection

@section('breadcrumbs')

<li>
    <a href="#">Management</a>
</li>
<li  class="active">
    <a href="#">Room Services</a>
</li>

@endsection



@section('content')

<div class="col-lg-12"> 


    <div id="test"></div>
    <ul class="nav nav-tabs tabs" style="width: 100%;">
        <li class="active tab" style="width: 25%;">
            <a href="#rooms" data-toggle="tab" aria-expanded="false" class="active"> 
                <span class="visible-xs"><i class="fa fa-home"></i></span> 
                <span class="hidden-xs">Room Services</span> 
            </a> 
        </li> 
        <li class="tab" style="width: 25%;"> 
            <a href="#roomtypes" data-toggle="tab" aria-expanded="false"> 
                <span class="visible-xs"><i class="fa fa-user"></i></span> 
                <span class="hidden-xs">Room Furnishing</span> 
            </a> 
        </li> 


        <div class="indicator" style="right: 367px; left: 0px;"></div></ul> 
    <div class="tab-content"> 
        <div class="tab-pane " id="roomtypes"> 

            <table class="table table-striped table-bordered table-hover dataTables-example" id="ddt" plugin="datatable" >
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Furnish Name</th>
                        <th>Rate</th>
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
                        <th>Service Name</th>

                        <th>Rate</th>


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



<div class="modal inmodal fade" id="addRSM" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Add A Room Service</h4>

            </div>
            <form class="form-horizontal" id="addRS" onsubmit="return insertRS()">
                <div class="modal-body">






                    <div class="form-group">

                        <label class="col-lg-3 control-label">Service Name</label>

                        <div class="col-lg-9">
                            <input placeholder="Enter Room Service Name" class="form-control" type="text" required id="rsname" name="rsname" required>
                        </div>
                    </div>

                    <div class="form-group">

                        <label class="col-lg-3 control-label"> Additional Price </label>

                        <div class="col-lg-9">
                            <input type="text" placeholder="If Free, Enter 0" class="form-control" type="text" required id="rsrate" name="rsrate" pattern="[-+]?[0-9]*\.?[0-9]+" title="Float value needed" >

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
<div class="modal inmodal fade" id="addRFM" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Add  Room Furnishing</h4>

            </div>
            <form class="form-horizontal" id="addRF" onsubmit="return insertRF()">
                <div class="modal-body">






                    <div class="form-group">

                        <label class="col-lg-3 control-label">Furnish Name</label>

                        <div class="col-lg-9">
                            <input placeholder="Enter Room Furnish Name" class="form-control" type="text" required id="rfname" name="rfname" required>
                        </div>
                    </div>

                    <div class="form-group">

                        <label class="col-lg-3 control-label"> Additional Price </label>

                        <div class="col-lg-9">
                            <input type="text" placeholder="If Free, Enter 0" class="form-control" type="text" required id="rfrate" name="rfrate" pattern="[-+]?[0-9]*\.?[0-9]+" title="Float value needed" >

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




<div class="modal inmodal fade" id="addRSME" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Edit Room Service</h4>

            </div>
            <form class="form-horizontal" id="editRS" onsubmit="return editRS()">
                <div class="modal-body">






                    <div class="form-group">

                        <label class="col-lg-3 control-label">Service Name</label>

                        <div class="col-lg-9">
                            <input placeholder="Enter Room Service Name" class="form-control" type="text" required id="ersname" name="rsname" required>
                        </div>
                    </div>

                    <div class="form-group">

                        <label class="col-lg-3 control-label"> Additional Price </label>

                        <div class="col-lg-9">
                            <input type="text" placeholder="If Free, Enter 0" class="form-control" type="text" required id="ersrate" name="rsrate" pattern="[-+]?[0-9]*\.?[0-9]+" title="Float value needed" >

                        </div>               
                    </div>
                    <input type="text" id="ersid" name="rsid" hidden="true">



                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </div>

            </form>
    </div>
</div>
<div class="modal inmodal fade" id="addRFME" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Edit Room Furnishing</h4>

            </div>
            <form class="form-horizontal" id="editRF" onsubmit="return editRF()">
                <div class="modal-body">



                    <input type="text" id="erfid" name="rfid" hidden="true">


                    <div class="form-group">

                        <label class="col-lg-3 control-label">Furnish Name</label>

                        <div class="col-lg-9">
                            <input placeholder="Enter Room Furnish Name" class="form-control" type="text" required id="erfname" name="rfname" required>
                        </div>
                    </div>

                    <div class="form-group">

                        <label class="col-lg-3 control-label"> Additional Price </label>

                        <div class="col-lg-9">
                            <input type="text" placeholder="If Free, Enter 0" class="form-control" type="text" required id="erfrate" name="rfrate" pattern="[-+]?[0-9]*\.?[0-9]+" title="Float value needed" >

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
        document.getElementById('ARS').setAttribute('class','active');

        dataLoad();
    });

    function dataLoad(){

        var oTable = $('#dd').DataTable();
        oTable.destroy();

        $('#dd').DataTable( {
            "ajax": "admin_get_room_services",
            "columns": [
                { "data": "rs_id" },
                { "data": "name" },

                {"data" : null,
                 "mRender": function(data, type, full) {

                     if(data.rate == 0){

                         return "<span class='label label-success'> FREE </span>";

                     }else{

                         return "<span class='label label-success'> Rs."+data.rate+" </span>";

                     }

                 }
                },
                {"data" : null,
                 "mRender": function(data, type, full) {
                     return '<button class="btn btn-primary  btn-animate btn-animate-side   btn-sm" onclick="editMainRS('+data.rs_id+')"> Edit </button>' ;
                 }
                },
                {"data" : null,
                 "mRender": function(data, type, full) {
                     return '<button class="btn btn-danger  btn-animate btn-animate-side   btn-sm" onclick="delRS('+data.rs_id+')"> Delete </button>' ;
                 }
                }
            ]
        } );


        var oTable = $('#ddt').DataTable();
        oTable.destroy();

        $('#ddt').DataTable( {
            "ajax": "admin_get_room_furnish",
            "columns": [
                { "data": "rf_id" },
                { "data": "name" },

                {"data" : null,
                 "mRender": function(data, type, full) {

                     if(data.rate == 0){

                         return "<span class='label label-success'> FREE </span>";

                     }else{

                         return "<span class='label label-success'> Rs."+data.rate+" </span>";

                     }

                 }
                },
                {"data" : null,
                 "mRender": function(data, type, full) {
                     return '<button class="btn btn-primary  btn-animate btn-animate-side   btn-sm" onclick="editMainRF('+data.rf_id+')"> Edit </button>' ;
                 }
                },
                {"data" : null,
                 "mRender": function(data, type, full) {
                     return '<button class="btn btn-danger  btn-animate btn-animate-side   btn-sm" onclick="delRF('+data.rf_id+')"> Delete </button>' ;
                 }
                }
            ]
        } );



    }
    function insertRS(){


        $.ajax({
            type: "get",
            url: 'admin_room_service_add',
            data: $('#addRS').serialize(),

            success : function(data){
                $('#addRSM').modal('hide');
                swal('Success','Successfully Added!', 'success');
                dataLoad();

            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError);
            }	 
        });



        return false; 


    }
    function insertRF(){


        $.ajax({
            type: "get",
            url: 'admin_room_furnish_add',
            data: $('#addRF').serialize(),

            success : function(data){
                $('#addRFM').modal('hide');
                swal('Success','Successfully Added!', 'success');
                dataLoad();


            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError);
            }	 
        });



        return false; 


    }
    function editMainRF(id){

        $.ajax({
            type: "get",
            url: 'admin_getRF_info',
            data: {
                id:id
            },

            success : function(data){

                $('#addRFME').modal('show');
                document.getElementById('erfname').value = data.name;
                document.getElementById('erfrate').value = data.rate;
                document.getElementById('erfid').value = data.rf_id;

            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError);

                swal("Ooops!", "Cannot generate room number! ("+thrownError+")", "error");   
            }	 
        });



    }
    function editMainRS(id){

        $.ajax({
            type: "get",
            url: 'admin_getRS_info',
            data: {
                id:id
            },

            success : function(data){

                $('#addRSME').modal('show');
                document.getElementById('ersname').value = data.name;
                document.getElementById('ersrate').value = data.rate;
                document.getElementById('ersid').value = data.rs_id;



            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError);

                swal("Ooops!", "Cannot generate room number! ("+thrownError+")", "error");   
            }	 
        });



    }
    function editRS(){



        $.ajax({
            type: "get",
            url: 'admin_updateRS',
            data:$('#editRS').serialize(),

            success : function(data){

                $('#addRSME').modal('hide');
                swal("Successfully Updated","","success");
                dataLoad();



            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError);

                swal("Ooops!", "Cannot generate room number! ("+thrownError+")", "error");   
            }	 
        });

        return false;



    }
    function editRF(){



        $.ajax({
            type: "get",
            url: 'admin_updateRF',
            data:$('#editRF').serialize(),

            success : function(data){

                $('#addRFME').modal('hide');
                swal("Successfully Updated","","success");
                dataLoad();



            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError);

                swal("Ooops!", "Cannot generate room number! ("+thrownError+")", "error");   
            }	 
        });

        return false;



    }
    function delRF(id){


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
                url: 'admin_delRF',
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
    function delRS(id){


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
                url: 'admin_delRS',
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







</script>

@endsection