@extends('adminmaster')


@section('css')

@endsection



@section('title')
User Management
@endsection


@section('page_title')
User Management
@endsection

@section('page_buttons')
    <div class="col-md-4 col-md-offset-8">
        <button type="button" class="btn btn-success waves-effect btn-block waves-light pull-right" data-toggle="modal" data-target="#addRoom">
        <span class="btn-label pull-left"><i class="fa fa-plus"></i>
        </span>ADD ADMIN</button>
    </div>
@endsection

@section('breadcrumbs')

    <li>
        <a href="#">Management</a>
    </li>
    <li  class="active">
        <a href="#">User Management</a>
    </li>

@endsection



@section('content')

    <div class="col-lg-12">


        <div id="test"></div>
        <ul class="nav nav-tabs tabs" style="width: 100%;">
            <li class="active tab" style="width: 25%;">
                <a href="#admin" data-toggle="tab" aria-expanded="false" class="active">
                    <span class="visible-xs"><i class="fa fa-home"></i></span>
                    <span class="hidden-xs">Admin Users</span>
                </a>
            </li>
            <li class="tab" style="width: 25%;">
                <a href="#guest" data-toggle="tab" aria-expanded="false">
                    <span class="visible-xs"><i class="fa fa-user"></i></span>
                    <span class="hidden-xs">Guest Users</span>
                </a>
            </li>


            <div class="indicator" style="right: 367px; left: 0px;"></div></ul>
        <div class="tab-content">
            <div class="tab-pane " id="guest">


                {{--<table class="table table-striped table-bordered table-hover dataTables-example" id="ddt" plugin="datatable" >
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

                </table>--}}


            </div>
            <div class="tab-pane active" id="admin">


                <table class="table table-striped table-bordered table-hover dataTables-example" id="dd" plugin="datatable" >
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Admin email</th>
                        <th class="col-md-">Last login</th>
                        <th class="col-md-1">Activate Actions</th>
                        <th class="col-md-1">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($admins as $data)
                        <tr>
                            <td>
                                {{sprintf('%04d', $data->emp_id)}}
                            </td>
                            <td>
                                {{$data->email}}
                            </td>
                            <td>
                                {{$data->last_login_ts}}
                            </td>
                            <td>
                                <button type="button" class="btn btn-warning" onclick="activateDel({{$data->emp_id}})">Activate Actions</button>
                            </td>
                            <td>
                                <a href="{{'/delete_admin/'.$data->emp_id}}" class="btn btn-danger" id="delete{{$data->emp_id}}" disabled>Remove this Admin</a>
                            </td>
                        </tr>
                    @endforeach
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
                    <h4 class="modal-title">Create New Admin</h4>

                </div>
                <form class="form-horizontal" method="post" action="{{URL::to('/new_admin')}}">
                    <div class="modal-body">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Email address</label>
                            <div class="col-lg-9">
                                <input placeholder="New Admin's email" class="form-control" type="email" name="email" required placeholder="New Admin's email" title="Check the email again">
                            </div>
                        </div>

                        <input type="hidden" name="role" value="admin">

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Password</label>
                            <div class="col-lg-9">
                                <input type="password" class="form-control" name="password" id="password" pattern="{6,}" title="6 Characters minimum" required placeholder="Password should be minimum 6 characters long">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Confirm Password</label>
                            <div class="col-lg-9">
                                <input type="password" class="form-control" name="password_confirmation" id="password" pattern="{6,}" title="6 Characters minimum" required placeholder="Password should be minimum 6 characters long">
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
                $(document).ready(function(){
                    {
                        $({{"delete"}}).attr("disabled", true);
                    };
                });
            </script>

            <script>
                $(document).ready(function(){
                    $({{"activate"}}).click(function(){
                        $({{"delete"}}).attr("disabled", false);
                        /*$('#chkOut').removeProp("disabled");*/
                    });
                });
            </script>

        <script>
            function activateDel(id){



                document.getElementById("delete"+id).removeAttribute("disabled",false);


            }


        </script>

            {{--<script>
                $('document').ready(function(){

                    document.getElementById('management').click();
                    document.getElementById('UM').setAttribute('class','active');

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

            </script>
--}}
@endsection