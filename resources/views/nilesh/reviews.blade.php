@extends('adminmaster')


@section('css')

@endsection



@section('title')


Rates

@endsection


@section('page_title')

REVIEWS MANAGEMENT



@endsection

@section('page_buttons')

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

    <div class="portlet">

        <div class="portlet-body">
            <table class="table table-striped table-bordered table-hover dataTables-example" id="dd" plugin="datatable" >
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User Name</th>
                        <th>Review</th>
                        <th>Status</th>
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


@endsection



@section('js')



<script>

    //onload function
    $('document').ready(function(){

        document.getElementById('siteAdmin').click();
        document.getElementById('RE').setAttribute('class','active');

        dataLoad();
    });

    //datalaod
    function dataLoad(){

        var oTable = $('#dd').DataTable();
        oTable.destroy();

        $('#dd').DataTable( {
            "ajax": "admin_get_reviews",
            "columns": [
                { "data": "id" },
                { "data": "name" },
                { "data": "review" },

                {"data" : null,
                 "mRender": function(data, type, full) {

                     if(data.status == 'PENDING'){

                         return "<span class='label label-warning'> PENDING </span>";

                     }else  if(data.status == 'REJECTED'){


                         return "<span class='label label-danger'> REJECTED </span>";

                     }else{

                         return "<span class='label label-success'> PUBLISHED </span>";



                     }

                 }
                },
                {"data" : null,
                 "mRender": function(data, type, full) {
                     if(data.status == 'PENDING'  || data.status == "REJECTED"){
                         return '<button class="btn btn-primary  btn-animate btn-animate-side   btn-sm" onclick="publish('+data.id+')"> Publish </button>' ;
                     }else{

                         return '<button class="btn btn-primary  btn-animate btn-animate-side   btn-sm"   disabled> Publish </button>' ;   

                     }
                 }
                },
                {"data" : null,
                 "mRender": function(data, type, full) {
                     if(data.status == 'PENDING' || data.status == "PUBLISHED"){
                         return '<button class="btn btn-danger  btn-animate btn-animate-side   btn-sm" onclick="reject('+data.id+')"> REJECT </button>' ;
                     }else{
                         
                             return '<button class="btn btn-danger  btn-animate btn-animate-side   btn-sm" disabled> REJECT </button>' ; 
                         
                     }
                 }
                }
            ]
        } );


    }


    
    
    function publish(id){
        
         swal({   
            title: "Publish?",   
            text: "",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Publish",   
            cancelButtonText: "Cancel",   
            closeOnConfirm: false}, 
             function(isConfirm){   if (isConfirm) {



            $.ajax({
                type: "get",
                url: 'admin_publish_review',
                data: {
                    id:id
                },

                success : function(data){


                    swal("Published!", "", "success");
                    dataLoad();    

                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(thrownError);

                    swal("Ooops!", "Something Went Wrong! ("+thrownError+")", "error");   
                }	 
            });


        } });
        
        
    }
    function reject(id){
        
        
        
        
             swal({   
            title: "Reject?",   
            text: "",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Reject",   
            cancelButtonText: "Cancel",   
            closeOnConfirm: false}, 
             function(isConfirm){   if (isConfirm) {



            $.ajax({
                type: "get",
                url: 'admin_reject_review',
                data: {
                    id:id
                },

                success : function(data){


                    swal("Rejected!", "", "success");
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