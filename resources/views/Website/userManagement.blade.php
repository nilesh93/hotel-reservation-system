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
    <div class="col-md-5 col-md-offset-7">
        <button type="button" class="btn btn-success waves-effect btn-block waves-light pull-right" data-toggle="modal" data-target="#addAdmin">
        <span class="btn-label pull-left"><i class="fa fa-plus"></i>
        </span>Edit Admin Email</button>
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


                <table class="table table-striped table-bordered table-hover dataTables-example" id="udt" plugin="datatable" >
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>NIC/ Passport No.</th>
                        <th>Email address</th>
                        <th>Telephone No.</th>
                        <th>Block Status</th>
                        <th>Address</th>
                        <th>Country</th>
                        <th class="col-md-1">Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>


            </div>
            <div class="tab-pane active" id="admin">

                @if(session('status'))
                    <ul class="list-group text-center">
                        <li class="list-group-item list-group-item-success"><strong>{{ session('status') }}</strong></li>
                    </ul>
                @endif


                <table class="table table-striped table-bordered table-hover dataTables-example" id="adt" plugin="datatable" >
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Admin email</th>
                        <th class="col-md-">Last login</th>
                        <th class="col-md-1">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>

                </table>


            </div>
        </div>
    </div>



    <div class="modal inmodal fade" id="addAdmin" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Create New Admin</h4>

                </div>
                <form class="form-horizontal" method="post" action="{{URL::to('/new_admin')}}"{{--id="newAdmin" onsubmit="return addnewAdmin()"--}}>
                    <div class="modal-body">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Email address</label>
                            <div class="col-lg-9">
                                <input placeholder="New Admin's email" class="form-control" type="email" name="email" required placeholder="New Admin's email">
                                @if ($errors->has('email')) <p class="text-danger">{{ $errors->first('email') }}</p>@endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label"> </label>
                            <div class="col-lg-9">

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label"> </label>
                            <div class="col-lg-9">

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

            {{--<script>
                function activateDel(id){
                    document.getElementById("delete"+id).removeAttribute("disabled",false);
                }

            </script>--}}

            <script>
                @if(count($errors)>0){
                    $('#addAdmin').modal('show');
                }
                @endif
            </script>

            <script>
                $('document').ready(function(){

                    document.getElementById('management').click();
                    document.getElementById('UM').setAttribute('class','active');

                    dataLoad();
                    adminDataLoad();

                });

                function dataLoad(){

                    var oTable = $('#udt').DataTable();
                    oTable.destroy();

                    $('#udt').DataTable(
                            {
                                "ajax": "fill_data",
                                "columns": [
                                    { "data": "name" },
                                    { "data": "NIC_passport_num" },
                                    { "data": "email"},
                                    { "data": "telephone_num" },
                                    { "data": "block_status"},
                                    { "data": "address_line_1",
                                        "render":function(data, type, full, meta){
                                            return full.address_line_1 +", "+ full.address_line_2 +", "+ full.city +", "+ full.province_state +", "+ full.zip_code;
                                        }
                                    },
                                    { "data": "country"},
                                    { "data": null,
                                        "mRender": function (data, type, full) {
                                            if(data.block_status == "1")
                                                return '<button class="btn btn-success  btn-animate btn-animate-side btn-block btn-sm" onclick="unblock(' + data.cus_id + ')"> Unblock </button>';
                                            else
                                                return '<button class="btn btn-danger  btn-animate btn-animate-side btn-block btn-sm" onclick="block(' + data.cus_id + ')"> Block </button>';
                                        }
                                    }
                                ]
                            }
                    );
                }

                function adminDataLoad(){

                    var oTable = $('#adt').DataTable();
                    oTable.destroy();

                    $('#adt').DataTable(
                            {
                                "ajax": "fill_data_admin",
                                "columns": [
                                    { "data": "emp_id" },
                                    { "data": "email" },
                                    { "data": "last_login_ts" },
                                    { "data": null,
                                        "mRender":function (data, type, full) {

                                            function getThisAdmin(){
                                                var admin;
                                                $.ajax({
                                                    async: false,
                                                    url: '{{URL::to('fill_data_admin')}}',
                                                    dataType: 'json',
                                                    success: function(res){
                                                        admin = (res.thisAdmin);
                                                    }
                                                });

                                                return admin;
                                            }
                                            //if(data.emp_id == getThisAdmin())
                                                //return '<button class="btn btn-danger  btn-animate btn-animate-side btn-block btn-sm" onclick="removeAdmin(' + data.emp_id + ')"> Remove </button>';
                                            //else
                                                //return '<button class="btn btn-danger  btn-animate btn-animate-side btn-block btn-sm" onclick="removeAdmin(' + data.emp_id + ')" disabled> Remove </button>';
                                            return '<a class="btn btn-danger  btn-animate btn-animate-side btn-block btn-sm" href="{{URL::to('change_password')}}"> Change Password </a>';
                                        }
                                    }
                                ]
                            }
                    );
                }

                /*function addnewAdmin(){
                    $.ajax({
                        type: "post",
                        url: 'new_admin',
                        data: $('#newAdmin').serialize(),

                        success : function(data){
                            $('#addAdmin').modal('hide');
                            swal('Success','Successfully Added!', 'success');
                            adminDataLoad();

                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            console.log(thrownError);
                        }
                    });
                    return false;
                }*/

                function block(cus_id){
                    swal(
                            {title: "Block this Customer?",
                                text: "",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "Block",
                                cancelButtonText: "Cancel",
                                closeOnConfirm: false
                            },
                            function(isConfirm){
                                if (isConfirm) {
                                    $.ajax(
                                            {
                                        type: "get",
                                        url: 'block_customer',
                                        data: {cus_id:cus_id},

                                        success : function(data){
                                            swal("User has been blocked.", "", "success");
                                            dataLoad();
                                        },
                                        error: function(xhr, ajaxOptions, thrownError) {
                                            console.log(thrownError);

                                            swal("Ooops!", "Something Went Wrong! ("+thrownError+")", "error");
                                        }
                                    });
                                }
                            }
                    );
                }


                function unblock(cus_id){
                    swal(
                            {title: "Unblock this Customer?",
                                text: "",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "Unblock",
                                cancelButtonText: "Cancel",
                                closeOnConfirm: false
                            },
                            function(isConfirm){
                                if (isConfirm) {
                                    $.ajax({
                                        type: "get",
                                        url: 'unblock_customer',
                                        data: {cus_id:cus_id},

                                        success : function(data){
                                            swal("User has been unblocked.", "", "success");
                                            dataLoad();
                                        },
                                        error: function(xhr, ajaxOptions, thrownError) {
                                            console.log(thrownError);

                                            swal("Ooops!", "Something Went Wrong! ("+thrownError+")", "error");
                                        }
                                    });
                                }
                            }
                    );
                }

                function removeAdmin(emp_id){
                    swal(
                            {title: "Remove this Admin?",
                                text: "",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "Remove",
                                cancelButtonText: "Cancel",
                                closeOnConfirm: false
                            },
                            function(isConfirm){
                                if (isConfirm) {
                                    $.ajax({
                                        type: "get",
                                        url: 'delete_admin',
                                        data: {emp_id:emp_id},

                                        success : function(data){
                                            swal("Admin has been removed.", "", "success");
                                            adminDataLoad();
                                        },
                                        error: function(xhr, ajaxOptions, thrownError) {
                                            console.log(thrownError);

                                            swal("Ooops!", "Something Went Wrong! ("+thrownError+")", "error");
                                        }
                                    });
                                }
                            }
                    );
                }

            </script>
@endsection