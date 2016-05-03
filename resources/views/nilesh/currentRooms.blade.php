@extends('adminmaster')


@section('css')

@endsection



@section('title')


DEMO PAGE

@endsection


@section('page_title')
CURRENT ROOM STATUS
@endsection



@section('breadcrumbs')

<li>
    <a href="#">Reservatio</a>
</li>
<li  class="active">
    <a href="#">Demo</a>
</li>

@endsection



@section('content')




<div class="col-lg-12"> 

    <div class="portlet">

        <div class="portlet-body">

            <table class="table table-striped table-bordered table-hover dataTables-example" id="hh" plugin="datatable" >
                <thead>
                    <tr>
                        <th>Room Number</th>
                        <th>Room Type</th>
                        <th>Size</th>
                        <th>Remarks</th>
                        <th>Status</th>
                        <th class="col-md-1"></th>

                    </tr>
                </thead>
                <tbody>


                </tbody>

            </table>



        </div>

    </div>





</div>


<div class="modal inmodal fade" id="rView" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Room Information</h4>

            </div>
                  <div class="modal-body">

                      <div id="reserve_info"></div>
                      
                      
                      
 

                </div>

                <div class="modal-footer">
                     
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                  
                </div>
                </div>

             
    </div>
</div>


@endsection



@section('js')



<script>

    $('document').ready(function(){

        dataLoad();

    });

    function dataLoad(){

        var oTable = $('#hh').DataTable();
        oTable.destroy();

        $('#hh').DataTable( {
            "ajax": "admin_getcurrent_rooms",
            "columns": [
                { "data": "room_num" },
                { "data": "type_name" },
                { "data": "room_size" },
                { "data": "room_remarks" },
                {"data" : null,
                 "mRender": function(data, type, full) {



                     if(data.st == "AVAILABLE"){

                         return data.st1;
                     }else{

                         return data.st;

                     }



                 }
                },
                {"data" : null,
                 "mRender": function(data, type, full) {

                     if(data.st != "AVAILABLE"){

                         return '<button class="btn btn-success btn-animate btn-animate-side btn-block btn-sm" onclick="viewReservation('+data.room_id +')"> Reservation Info </button>' ;
                     }else{


                        // return '<button class="btn btn-success btn-animate btn-animate-side btn-block btn-sm" onclick="viewReservation('+data.room_id +')"> Reservation Info </button>' ;
                          return '<button class="btn btn-success btn-animate btn-animate-side btn-block btn-sm" disabled> Reservation Info </button>' ;

                     }
                 }
                } 
            ]
        } );



    }

    function viewReservation(data){

        $.ajax({

            url:"admin_get_room_current",
            type:"get",
            data :{rid:data},
            success:function(data){

                
                
                $('#rView').modal('show');
                document.getElementById("reserve_info").innerHTML = data;
            },
            error : function(err){
                console.log(err);
            }


        });

    }

</script>

@endsection