@extends('adminmaster')

@section('css')
@endsection


@section('title')
    Backup & Restore
@endsection


@section('page_title')
    Backup & Restore
@endsection


@section('page_buttons')
    <div class="col-md-4 col-md-offset-8">
        <button type="button" class="btn btn-success waves-effect btn-block waves-light pull-right" onclick="backupNow()">
        <span class="btn-label pull-left"><i class="fa fa-plus"></i>
        </span>Backup Now</button>
    </div>
@endsection


@section('breadcrumbs')

    <li>
        <a href="#">Site Administration</a>
    </li>
    <li  class="active">
        <a href="#">Backup & Restore</a>
    </li>
@endsection


@section('content')
    <div class="col-lg-12">
        <div class="portlet">
            <div class="portlet-body">

                @if(session('status'))
                    <ul class="list-group text-center">
                        <li class="list-group-item list-group-item-success"><strong>{{ session('status') }}</strong></li>
                    </ul>
                @endif
                    @if(session('wrong_pass'))
                        <ul class="list-group text-center">
                            <li class="list-group-item list-group-item-success"><strong>{{ session('wrong_pass') }}</strong></li>
                        </ul>
                    @endif

                <table class="table table-striped table-bordered table-hover dataTables-example" id="adt" plugin="datatable" >
                    <thead>
                    <tr>
                        <th class="col-md-2">Date</th>
                        <th class="col-md-2">Type</th>
                        <th>File Path</th>
                        <th class="col-md-1">Download</th>
                        <th class="col-md-1">Restore</th>
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
    <script>
        $('document').ready(function() {

            document.getElementById('siteAdmin').click();
            document.getElementById('BR').setAttribute('class','active');

            dataLoad();
        });


        function dataLoad() {

            var oTable = $('#adt').DataTable();
            oTable.destroy();

            $('#adt').DataTable(
                    {
                        "ajax": "get_backupData",
                        "columns": [
                            { "data": null,
                                "mRender": function (data, type, full) {
                                    var date = data.path.substring(data.path.indexOf("backup_") + 7, data.path.indexOf(".sql"));
                                    return date;
                                }
                            },
                            { "data": null,
                                "mRender": function (data, type, full) {
                                    if (data.path.indexOf("user_backup") >= 0) {
                                        return '<p class="text-primary">User Generated Backup</p>';
                                    }
                                    else {
                                        return '<p class="text-success">Auto Generated Backup</p>';
                                    }
                                }
                            },
                            {"data" : "path"},
                            { "data": null,
                                "mRender": function (data, type, full) {
                                    return '<a class="btn btn-primary btn-animate btn-animate-side btn-block btn-sm" href="{{URL::to('downloadDataDump')}}'+"/"+data.path.substring(8, 16)+'">Download</a>';
                                }
                            },
                            { "data": null,
                                "mRender": function (data, type, full) {
                                    return '<a class="btn btn-warning btn-animate btn-animate-side btn-block btn-sm" href={{URL::to('restore')}}'+"/"+data.path.substring(8, 16)+'">Restore This DataDump</a>';
                                }
                            }
                        ]
                    }
            );
        }

        function backupNow() {
            swal(
                    {title: "Backup Now?",
                        text: "",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Make Backup",
                        cancelButtonText: "Cancel",
                        closeOnConfirm: false
                    },
                    function(isConfirm){
                        if (isConfirm) {
                            $.ajax(
                                    {
                                        type: "get",
                                        url: 'make_backup',
                                        success : function(data){
                                            swal("Backup Successful!", "", "success");
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

        /*function download() {
            $.ajax(
                    {
                        type: "get",
                        url: 'downloadDataDump',
                        success : function(data){
                            swal("Backup Successful!", "", "success");
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            console.log(thrownError);
                            swal("Ooops!", "Something Went Wrong! ("+thrownError+")", "error");
                        }
                    });
        }*/
    </script>
@endsection