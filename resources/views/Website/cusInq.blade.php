@extends('adminmaster')


@section('css')
    <link href="{{URL::asset('BackEnd/assets/plugins/dropzone/dist/dropzone.css')}}" rel="stylesheet" type="text/css" />

@endsection



@section('title')

    Customer Inquiries

@endsection


@section('page_title')
    CUSTOMER INQUIRIES



@endsection

{{--@section('page_buttons')
    <div class="col-md-4 col-md-offset-8">
        <button type="button" class="btn btn-success waves-effect btn-block waves-light pull-right" data-toggle="modal" data-target="#addService">
        <span class="btn-label pull-left"><i class="fa fa-plus"></i>
        </span>CUSTOMER INQUIRIES</button>
    </div>

@endsection--}}

@section('breadcrumbs')

    <li>
        <a href="#">User Administration</a>
    </li>
    <li  class="active">
        <a href="#">Customer Inquiries</a>
    </li>

@endsection



@section('content')

    <div class="col-lg-12">

        <div class="portlet">

            <div class="portlet-body">

                <table class="table table-striped table-bordered table-hover dataTables-example" id="hs" plugin="datatable" >
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Customer Name</th>
                        <th>Company</th>
                        <th>Customer Email</th>
                        <th class="col-md-4">Message</th>
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



    {{--<div class="modal inmodal fade" id="addService" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Reply To An Inquiry</h4>

                </div>
                <form class="form-horizontal" id="addH" onsubmit="return insertH()">
                    <div class="modal-body">

                    </div><div class="form-group">

                        <label class="col-lg-3 control-label">Reply</label>

                        <div class="col-lg-9">
                            <input placeholder="Enter Hall Service Name" class="form-control" type="text" required id="name" name="name" required>
                            <textarea placeholder="Enter the message" class="form-control" type="text" required id="name" name="name"></textarea>
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
--}}


@endsection



@section('js')

    <script src="{{URL::asset('BackEnd/assets/plugins/dropzone/dist/dropzone.js')}}"></script>
    <script src="{{URL::asset('BackEnd/assets/plugins/bootstrap-filestyle/src/bootstrap-filestyle.min.js')}}"></script>
    <script>
        $('document').ready(function(){

            document.getElementById('siteAdmin').click();
            document.getElementById('GI').setAttribute('class','active');

            dataLoad();




        });

        function dataLoad(){

            var oTable = $('#hs').DataTable();
            oTable.destroy();

            $('#hs').DataTable( {
                order: [[ 0, 'desc' ]],
                "ajax": "get_inquiries",
                "columns": [
                    { "data": "created_at" },
                    { "data": "name" },
                    { "data": "company" },
                    { "data": "email" },
                    { "data": "message" },
                    {"data" : null,
                        "mRender": function(data, type, full) {
                            return '<a target="_blank" class="btn btn-primary  btn-animate btn-animate-side btn-block btn-sm" href="https://mail.google.com/mail"> Reply </button>';
                        }
                    }
                ]
            } );



        }

        function reply(id, msg){
            $.ajax({
                type: "get",
                url: 'reply_inquiry/'+id,
                data: {reply:msg},

                success : function(data){
                    swal('Success','Reply Sent!', 'success');
                    dataLoad();

                },
                error: function(xhr, ajaxOptions, thrownError) {
                    swal("Ooops!", "Something Went Wrong! ("+thrownError+")", "error");
                    console.log(thrownError);
                }
            });
            return false;
        }


        /*function reply(id){
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
        }*/

        /*function delCancel(id){

         swal('Cannot delete!', 'Room type cannot be deleted because there are rooms associated with this room type. Please delete them or change them first!', 'error');


         }

         */

    </script>

@endsection