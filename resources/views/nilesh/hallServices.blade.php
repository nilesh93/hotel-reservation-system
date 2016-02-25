@extends('adminmaster')


@section('css')
    <link href="{{URL::asset('BackEnd/assets/plugins/dropzone/dist/dropzone.css')}}" rel="stylesheet" type="text/css" />

@endsection



@section('title')

    Hall Services

@endsection


@section('page_title')
    HALL SERVICES



@endsection

@section('page_buttons')
    <div class="col-md-4 col-md-offset-8">
        <button type="button" class="btn btn-success waves-effect btn-block waves-light pull-right" data-toggle="modal" data-target="#addService">
        <span class="btn-label pull-left"><i class="fa fa-plus"></i>
        </span>HALL SERVICES</button>
    </div>

@endsection

@section('breadcrumbs')

    <li>
        <a href="#">Management</a>
    </li>
    <li  class="active">
        <a href="#">Hall Services</a>
    </li>

@endsection



@section('content')

    <div class="col-lg-12">

        <div class="portlet">

            <div class="portlet-body">

                <table class="table table-striped table-bordered table-hover dataTables-example" id="hs" plugin="datatable" >
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Hall Service Name</th>
                        <th>Rate</th>
                        {{--<th class="col-md-1"></th>--}}
                        <th class="col-md-1"></th>
                    </tr>
                    </thead>
                    <tbody>


                    </tbody>

                </table>



            </div>

        </div>





    </div>



    <div class="modal inmodal fade" id="addService" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Add A Hall Service</h4>

                </div>
                <form class="form-horizontal" id="addH" onsubmit="return insertH()">
                    <div class="modal-body">

                    </div><div class="form-group">

                        <label class="col-lg-3 control-label">Service Name</label>

                        <div class="col-lg-9">
                            <input placeholder="Enter Hall Service Name" class="form-control" type="text" required id="name" name="name" required>
                        </div>
                    </div>

                    <div class="form-group">

                        <label class="col-lg-3 control-label"> Additional Price </label>

                        <div class="col-lg-9">
                            <input type="text" placeholder="If Free, Enter 0" class="form-control" type="text" required id="rate" name="rate" pattern="[-+]?[0-9]*\.?[0-9]+" title="Float value needed" >

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

    <script src="{{URL::asset('BackEnd/assets/plugins/dropzone/dist/dropzone.js')}}"></script>
    <script src="{{URL::asset('BackEnd/assets/plugins/bootstrap-filestyle/src/bootstrap-filestyle.min.js')}}"></script>
    <script>
        $('document').ready(function(){

            document.getElementById('management').click();
            document.getElementById('HS').setAttribute('class','active');

            dataLoad();




        });

        function dataLoad(){

            var oTable = $('#hs').DataTable();
            oTable.destroy();

            $('#hs').DataTable( {
                "ajax": "getHallServices",
                "columns": [
                    { "data": "hs_id" },
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
                    /*{"data" : null,
                        "mRender": function(data, type, full) {
                            return '<button class="btn btn-primary  btn-animate btn-animate-side btn-block btn-sm" onclick="edit('+data.hs_id+')"> Edit </button>' ;
                        }
                    },*/
                    {"data" : null,
                        "mRender": function(data, type, full) {
                            return '<button class="btn btn-danger  btn-animate btn-animate-side btn-block btn-sm" onclick="del('+data.hs_id+')"> Delete </button>' ;
                        }
                    }
                ]
            } );



        }

        function insertH(){
            $.ajax({
                type: "get",
                url: 'addHallService',
                data: $('#addH').serialize(),

                success : function(data){
                    $('#addService').modal('hide');
                    swal('Success','Successfully Added!', 'success');
                    dataLoad();

                },
                error: function(xhr, ajaxOptions, thrownError) {
                    swal("Ooops!", "Something Went Wrong! ("+thrownError+")", "error");
                    console.log(thrownError);
                }
            });
            return false;
        }


       function del(id){
            swal({
                        title: "Delete?",
                        text: "Are you sure you want to delete this rate? This might affect old business transactions.",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Delete",
                        cancelButtonText: "Cancel",
                        closeOnConfirm: false},
                    function(isConfirm){
                        if (isConfirm) {
                        $.ajax({
                            type: "get",
                            url: 'deleteHallService',
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
                        }
                    });
        }

        /*function delCancel(id){

            swal('Cannot delete!', 'Room type cannot be deleted because there are rooms associated with this room type. Please delete them or change them first!', 'error');


        }

        */

    </script>

@endsection