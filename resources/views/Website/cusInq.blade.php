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



    </script>

@endsection