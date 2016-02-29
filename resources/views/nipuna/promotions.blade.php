@extends('adminmaster')


@section('css')

@endsection



@section('title')
    Promotions - Admin Panel
@endsection


@section('page_title')
    Promotions
@endsection



@section('breadcrumbs')
    <li>
        <a href="#">Admin</a>
    </li>
    <li  class="active">
        <a href="#">Promotions</a>
    </li>
@endsection


@section('page_buttons')
    <div class="col-md-4 col-md-offset-8">
        <button type="button" class="btn btn-primary btn-success pull-right" onclick="add_promotions_modal()"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Promotions</button>
    </div>
@endsection

@section('content')
    <div class="portlet">

        <div class="portlet-body">


            <div class="" id="temptable">
                <table class="table table-striped table-bordered table-hover dataTables-example" id="dd" plugin="datatable" >
                    <thead>
                    <tr>
                        <th>Promotion Code</th>
                        <th>Promotion Name</th>
                        <th>Promotion Description</th>
                        <th>Date From</th>
                        <th>Date To</th>
                        <th>rate</th>
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
        
    <!--Add Promotions Modal-->
 <div  class="modal fade" id="add_promotions_modal">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                 <h4 class="modal-title">Add Promotions</h4>
             </div>
             <div class="modal-body">
                 <form class="form-horizontal" enctype="multipart/form-data" onsubmit="" method="post">

                     <div class="row">
                         <div class="form-group">
                             <label for="quantity" class="col-lg-5 control-label">Promotion Name</label>
                             <div class="col-lg-6">
                                 <input class="form-control" id="prom_name" placeholder="Promotion Name" type="text">
                             </div>
                         </div>
                     </div>

                     <div class="row">
                         <div class="form-group">
                             <label for="item" class="col-lg-5 control-label">Promotion Descrition</label>
                             <div class="col-lg-6">
                                 <input class="form-control" id="prom_description" placeholder="Promotion Descrition" type="text">
                             </div>
                         </div>
                     </div>

                     <div class="row">
                         <div class="form-group">
                             <label for="description" class="col-lg-5 control-label">Start Date</label>
                             <div class='input-group date' id='datetimepicker1'>
                                 <input disabled type='text' onchange="start_date_validate()" placeholder="MM/DD/YYYY" class="form-control" id='start_date'/>
                                    <span class="input-group-addon">
                                     <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                             </div>
                         </div>
                     </div>

                     <div class="row">
                         <div class="form-group">
                             <label for="description" class="col-lg-5 control-label">End Date</label>
                             <div class='input-group date' id='datetimepicker2'>
                                 <input disabled type='text' onchange="end_date_validate()" placeholder="MM/DD/YYYY" class="form-control" id='end_date'/>
                                    <span class="input-group-addon">
                                     <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                             </div>
                         </div>
                     </div>

                     <div class="row">
                         <div class="form-group">
                             <label for="discount" class="col-lg-5 control-label">Rate</label>
                             <div class="col-lg-6">
                                 <input class="form-control" id="prom_rate" placeholder="Rate" type="number">
                             </div>
                         </div>
                     </div>
             </div>
             <div class="alert alert-dismissible alert-success" id="addedsuccessfully" hidden="true">
                 <button type="button" class="close" data-dismiss="alert">×</button>
                 <strong> Added Successfully!</strong>
             </div>
             <div class="alert alert-dismissible alert-success" id="adderror" hidden="true">
                 <button type="button" class="close" data-dismiss="alert">×</button>
                 <strong> Adding Fail!</strong>
             </div>
             <div class="modal-footer">
                 <button type="button" onclick="add_promotion()" class="btn btn-primary" name="submit" >Add Promotion</button>
                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 </form>
             </div>
         </div>
     </div>
 </div>
<!-------------------------------------END OF ADD PROMOTIONS MODAL-------------------------------->

 <div  class="modal fade" id="update_promotions_modal">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                 <h4 class="modal-title">Add Promotions</h4>
             </div>
             <div class="modal-body">
                 <form class="form-horizontal" enctype="multipart/form-data" onsubmit="" method="post">

                     <div class="row">
                         <div class="form-group">
                             <label for="quantity" class="col-lg-5 control-label">Promotion Name</label>
                             <div class="col-lg-6">
                                 <input class="form-control" id="prom_name_edit" placeholder="Promotion Name" type="text">
                                 <input type="text" id="rownumber" hidden>
                             </div>
                         </div>
                     </div>

                     <div class="row">
                         <div class="form-group">
                             <label for="item" class="col-lg-5 control-label">Promotion Descrition</label>
                             <div class="col-lg-6">
                                 <input class="form-control" id="prom_description_edit" placeholder="Promotion Descrition" type="text">
                             </div>
                         </div>
                     </div>

                     <div class="row">
                         <div class="form-group">
                             <label for="description" class="col-lg-5 control-label">Start Date</label>
                             <div class='input-group date' id='datetimepicker1_edit'>
                                 <input disabled type='text' onchange="start_date_validate_edit()" placeholder="MM/DD/YYYY" class="form-control" id='start_date_edit'/>
                                    <span class="input-group-addon">
                                     <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                             </div>
                         </div>
                     </div>

                     <div class="row">
                         <div class="form-group">
                             <label for="description" class="col-lg-5 control-label">End Date</label>
                             <div class='input-group date' id='datetimepicker2_edit'>
                                 <input disabled type='text' onchange="end_date_validate_edit()" placeholder="MM/DD/YYYY" class="form-control" id='end_date_edit'/>
                                    <span class="input-group-addon">
                                     <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                             </div>
                         </div>
                     </div>

                     <div class="row">
                         <div class="form-group">
                             <label for="discount" class="col-lg-5 control-label">Rate</label>
                             <div class="col-lg-6">
                                 <input class="form-control" id="prom_rate_edit" placeholder="Rate" type="number">
                             </div>
                         </div>
                     </div>
             </div>
             <div class="alert alert-dismissible alert-success" id="addedsuccessfully" hidden="true">
                 <button type="button" class="close" data-dismiss="alert">×</button>
                 <strong> Added Successfully!</strong>
             </div>
             <div class="alert alert-dismissible alert-success" id="adderror" hidden="true">
                 <button type="button" class="close" data-dismiss="alert">×</button>
                 <strong> Adding Fail!</strong>
             </div>
             <div class="modal-footer">
                 <button type="button" onclick="update_promotion()" class="btn btn-primary" name="submit" >Update Promotion</button>
                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 </form>
             </div>
         </div>
     </div>
 </div>
@endsection



@section('js')
<script>
    $('document').ready(function(){


        document.getElementById("management").click();
        document.getElementById("PR").setAttribute("class","active");
        dataLoad();
    });

    function add_promotions_modal(){
        $("#add_promotions_modal").modal("show");

        document.getElementById("prom_name").value = "";
        document.getElementById("prom_description").value = "";
        document.getElementById("start_date").value = "";
        document.getElementById("end_date").value = "";
        document.getElementById("prom_rate").value = "";
    }

    $(function () {
        $('#datetimepicker1').datepicker({ dateFormat: 'dd-mm-yy' });

    });

    $(function () {
        $('#datetimepicker2').datepicker();
    });

    $(function () {
        $('#datetimepicker1_edit').datepicker({ dateFormat: 'dd-mm-yy' });

    });

    $(function () {
        $('#datetimepicker2_edit').datepicker();
    });

    function start_date_validate(){
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();

        Date.prototype.yyyymmdd = function() {
            var yyyy = this.getFullYear().toString();
            var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
            var dd  = this.getDate().toString();
            //return yyyy + "-" + (mm[1]?mm:"0"+mm[0]) + "-" + (dd[1]?dd:"0"+dd[0]); // padding
            return (mm[1]?mm:"0"+mm[0]) + "/" + (dd[1]?dd:"0"+dd[0])  + "/" + yyyy;
        };

        d = new Date();
        console.log( d.yyyymmdd() ); // Assuming you have an open console
        console.log(start_date);

        if ( d.yyyymmdd() > start_date ) {
            sweetAlert("Oops...", "Start date cannot be lesser than current date!", "error");
            console.log("todays lower");
            document.getElementById("start_date").value = "";
        };

        if(end_date != ""){
            if ( start_date > end_date || end_date != "") {
                sweetAlert("Oops...", "End date cannot be lesser than start date!", "error");
                //console.log("todays lower");
                document.getElementById("end_date").value = "";
            };
        }
    }

    function end_date_validate(){
        var end_date = $('#end_date').val();
        var start_date = $('#start_date').val();

        Date.prototype.yyyymmdd = function() {
            var yyyy = this.getFullYear().toString();
            var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
            var dd  = this.getDate().toString();
            //return yyyy + "-" + (mm[1]?mm:"0"+mm[0]) + "-" + (dd[1]?dd:"0"+dd[0]); // padding
            return (mm[1]?mm:"0"+mm[0]) + "/" + (dd[1]?dd:"0"+dd[0])  + "/" + yyyy;
        };

        d = new Date();
        console.log( d.yyyymmdd() ); // Assuming you have an open console
        console.log(start_date);

        if ( d.yyyymmdd() > end_date ) {
            sweetAlert("Oops...", "End date cannot be lesser than current date!", "error");
            console.log("todays lower");
            document.getElementById("end_date").value = "";
        };

        if ( start_date > end_date ) {
            sweetAlert("Oops...", "End date cannot be lesser than start date!", "error");
            //console.log("todays lower");
            document.getElementById("end_date").value = "";
        };

    }

    function start_date_validate_edit(){
        var start_date = $('#start_date_edit').val();
        var end_date = $('#end_date_edit').val();

        Date.prototype.yyyymmdd = function() {
            var yyyy = this.getFullYear().toString();
            var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
            var dd  = this.getDate().toString();
            //return yyyy + "-" + (mm[1]?mm:"0"+mm[0]) + "-" + (dd[1]?dd:"0"+dd[0]); // padding
            return (mm[1]?mm:"0"+mm[0]) + "/" + (dd[1]?dd:"0"+dd[0])  + "/" + yyyy;
        };

        d = new Date();
        console.log( d.yyyymmdd() ); // Assuming you have an open console
        console.log(start_date);

        if ( d.yyyymmdd() > start_date ) {
            sweetAlert("Oops...", "Start date cannot be lesser than current date!", "error");
            console.log("todays lower");
            document.getElementById("start_date_edit").value = "";
        };

        if ( start_date > end_date || end_date != "") {
            sweetAlert("Oops...", "End date cannot be lesser than start date!", "error");
            //console.log("todays lower");
            document.getElementById("end_date_edit").value = "";
        };

    }

    function end_date_validate_edit(){
        var end_date = $('#end_date_edit').val();
        var start_date = $('#start_date_edit').val();

        Date.prototype.yyyymmdd = function() {
            var yyyy = this.getFullYear().toString();
            var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
            var dd  = this.getDate().toString();
            //return yyyy + "-" + (mm[1]?mm:"0"+mm[0]) + "-" + (dd[1]?dd:"0"+dd[0]); // padding
            return (mm[1]?mm:"0"+mm[0]) + "/" + (dd[1]?dd:"0"+dd[0])  + "/" + yyyy;
        };

        d = new Date();
        console.log( d.yyyymmdd() ); // Assuming you have an open console
        console.log(start_date);

        if ( d.yyyymmdd() > end_date ) {
            sweetAlert("Oops...", "End date cannot be lesser than current date!", "error");
            console.log("todays lower");
            document.getElementById("end_date_edit").value = "";
        };

        if ( start_date > end_date ) {
            sweetAlert("Oops...", "End date cannot be lesser than start date!", "error");
            //console.log("todays lower");
            document.getElementById("end_date_edit").value = "";
        };

    }

    function update_promotion(){

        swal({
                    title: "Are you sure?",
                    text: "Are you sure you want to update?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Update!",
                    closeOnConfirm: false },
                function(){


                    var row = $('#rownumber').val();
                    var promo_name=$('#prom_name_edit').val();
                    var promo_description=$('#prom_description_edit').val();
                    var promo_start=$('#start_date_edit').val();
                    var promo_end=$('#end_date_edit').val();
                    var promo_rate=$('#prom_rate_edit').val();

                    if(promo_name == "" || promo_description == "" || promo_start == "" || promo_end == "" || promo_rate == ""){
                        sweetAlert("Oops...", "One or more field(s) are empty!", "error");

                    }
                    else{
                        var data="row="+row+"&promo_name="+promo_name+"&promo_description="+promo_description+"&promo_start="+promo_start+"&promo_end="+promo_end+"&promo_rate="+promo_rate;

                        $.ajax({
                            type:"get",
                            url:"admin_promotions/updatepromotion",
                            data:data,
                            success:function(ss){
                                swal("Updated!", "Your record was updated with new data.", "success");
                                dataLoad();
                            }
                        });
                    }
                });

    }


    function add_promotion(){

        var promo_name=$('#prom_name').val();
        var promo_description=$('#prom_description').val();
        var promo_start=$('#start_date').val();
        var promo_end=$('#end_date').val();
        var promo_rate=$('#prom_rate').val();

        if(promo_name == "" || promo_description == "" || promo_start == "" || promo_end == "" || promo_rate == ""){
            sweetAlert("Oops...", "One or more field(s) are empty!", "error");

        }
        else{
            var data="promo_name="+promo_name+"&promo_description="+promo_description+"&promo_start="+promo_start+"&promo_end="+promo_end+"&promo_rate="+promo_rate;

            $.ajax({
                type:"get",
                url:"admin_promotions/addpromotion",
                data:data,
                success:function(ss){
                    dataLoad();
                    swal("Added!", "Record Added Successfully.", "success");
                }
            });
        }
    }

    function edit(a){
        $("#update_promotions_modal").modal("show");
        console.log(a);

        var data="row="+a;
        $.ajax({
            type:"get",
            url:"admin_promotions/retrievedetails",
            data:data,
            success:function(data){
                console.log(data[0].promotion_name);
                document.getElementById("prom_name_edit").value = data[0].promotion_name;
                document.getElementById("prom_description_edit").value = data[0].promotion_description;
                document.getElementById("start_date_edit").value = data[0].date_from;
                document.getElementById("end_date_edit").value = data[0].date_to;
                document.getElementById("prom_rate_edit").value = data[0].rate;
                document.getElementById("rownumber").value = a;

                //swal("Deleted!", "Your imaginary file has been deleted.", "success");
                // dataLoad();

            },
            complete: function (data) {
            },
            error: function(xhr, ajaxOptions, thrownError) {
            }
        });
    }

    function delete_promo(a){
        swal({
                    title: "Are you sure?",
                    text: "Are you sure you want to delete the record"+a+"?",
                    type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false },
                function(){

                    var data="row="+a;
                    $.ajax({
                        type:"get",
                        url:"admin_promotions/deleterow",
                        data:data,
                        success:function(data){
                            swal("Deleted!", "Record has been deleted.", "success");
                            dataLoad();

                        },
                        complete: function (data) {
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                        }
                    });
                });
    }


    function dataLoad(){

        var oTable = $('#dd').DataTable();
        oTable.destroy();

        $('#dd').DataTable( {
            "ajax": "admin_promotions/promotions",
            "columns": [
                { "data": "promotion_code" },
                { "data": "promotion_name"},
                { "data": "promotion_description"},
                { "data": "date_from" },
                { "data": "date_to" },
                { "data": "rate" },
                {"data" : null,
                    "mRender": function(data, type, full) {
                        return '<button class="btn btn-info  btn-animate btn-animate-side btn-block btn-sm" onclick="edit('+data.promotion_code+')"> View </button>' ;
                    }
                },
                {"data" : null,
                    "mRender": function(data, type, full) {
                        return '<button class="btn btn-danger  btn-animate btn-animate-side btn-block btn-sm" onclick="delete_promo('+data.promotion_code+')"> Delete </button>' ;
                    }
                }
            ]
        } );


    }

</script>

@endsection