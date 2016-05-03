@extends('adminmaster')


@section('css')

@endsection



@section('title')
Search Booking - Admin Panel
@endsection


@section('page_title')
Search Reservation
@endsection



@section('breadcrumbs')
<li>
    <a href="#">Admin</a>
</li>
<li  class="active">
    <a href="#">Search Booking</a>
</li>
@endsection


@section('page_buttons')


@endsection

@section('content')


<div class="panel panel-border panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Search</h3>
    </div>
    <div class="panel-body">

        <div class="col-md-2">
            <b>Reservation ID</b>
            <input type="text" id="resid" class="form-control">

        </div>
        <div class="col-md-4">
            <b>Name</b>
            <input type="text" id="cus_name" class="form-control">

        </div>

        <div class="col-md-2">
            <b>NIC</b>
            <input type="text" id="cus_id" class="form-control">

        </div>

        <div class="col-md-2">
            <b>Check In</b>
            <input type="text" id="checkin" class="form-control">

        </div>
        <div class="col-md-2 ">
            <br>
            <button   onclick="dataLoad()" type="button" class="btn btn-primary   waves-effect btn-block waves-light pull-right">

                SEARCH</button>
        </div>

    </div>
</div>

<div class="portlet">
    <div class="portlet-body">
        <div class="row" id="temptable">
            <table class="table table-striped table-bordered table-hover dataTables-example" id="dd" plugin="datatable" >
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Contact</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Rooms</th>
                        <th>Nights</th>
                        <th>Status</th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>





<div class="modal inmodal fade" id="reserve_info" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">View Reservation</h4>

            </div>
          
                <div class="modal-body">

                    <div id="resInfo"></div>
 


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
        document.getElementById("management").click();
        document.getElementById("BS").setAttribute("class","active");
        dataLoad();
        
        
           
        $('#checkin').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format:'yyyy-mm-dd'
        });
    });
    

    function dataLoad(){

        var id = $("#resid").val();
        var nic = $("#cus_id").val();
        var name = $("#cus_name").val();
        var check = $("#checkin").val();

        console.log("admin_search_bookings?resid="+id+"&nic="+nic+"&name="+name+"&checkin="+check);

        var oTable = $('#dd').DataTable();
        oTable.destroy();
        $('#dd').DataTable({
            "ajax": "admin_search_bookings?resid="+id+"&nic="+nic+"&name="+name+"&checkin="+check,
            "columns": [
                { "data": "res" },
                { "data": "name"},
                { "data": "telephone_num"},
                { "data": "check_in" },
                { "data": "check_out" },
                { "data": "num_of_rooms"},
                { "data": "num_of_nights"},
                { "data": "status" },
                {"data" : null,
                 "mRender": function(data, type, full) {
                   
                     
                     return '<button class="btn btn-success btn-animate btn-animate-side btn-block btn-sm" onclick="ViewModal('+data.res+')"> View </button>' ;
                 }
                }
            ]
        });
    }

    
    
    function ViewModal(id){
     
    
        $.ajax({
        
            url:"admin_search_bookings_get",
            type:"get",
            data:{id:id},
            success:function(data){
            
                $('#reserve_info').modal('show');
                //console.log(data);
               document.getElementById("resInfo").innerHTML = data;
                
            },
            error:function(err){
            
            console.log(err);
            }
        
        });
    
    
    }
</script>

@endsection