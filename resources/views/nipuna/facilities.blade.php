@extends('adminmaster')


@section('css')

@endsection



@section('title')


Facilities and Features - Admin Panel

@endsection


@section('page_title')
Facilities and Feature
@endsection



@section('breadcrumbs')

<li>
	<a href="#">Admin</a>
</li>
<li  class="active">
	<a href="#">Facilities and Features</a>
</li>

@endsection



@section('content')


    
        
<div class="col-lg-12" style="margin:0px; padding:0px" >

    <form class="form-horizontal" >

        <div class="form-group" >
            <!--
            <div class="col-lg-2" style="padding-left:0px; margin-left:0px">
                <input class="form-control" id="search" oninput="navigate()"  placeholder="Enter Item Code" type="text">
            </div>-->
            <div class="col-lg-1" style="padding-left:0cm;">
                <button type="button" class="btn btn-primary btn-success" onclick="add_facilities_modal()"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add new Facility</button>
            </div>
</div>
    </form>
    <br>
</div>
    
   
    <div class="row" id="temptable">
        <table class="table table-striped table-bordered table-hover dataTables-example" id="dd" plugin="datatable" >
                    <thead>
                        <tr>
                            
                            
                            <th>Facility ID</th>
                            <th>Category</th>
                            <th>Facility Description</th>
                            <th>Price</th>
                            <th class="col-md-1"></th>
                            <th class="col-md-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>

                </table>
    </div>
      
        
    <!--Add Promotions Modal-->
    <div  class="modal fade" id="add_facilities_modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add A New Facility</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" enctype="multipart/form-data" onsubmit="" method="post">

                    <div class="row">
                        <div class="form-group">
                            <label for="quantity" class="col-lg-5 control-label">Facility Category</label>
                            <div class="col-lg-6">
                                <input class="form-control" id="facility_cat" placeholder="Facility Category" type="text">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="item" class="col-lg-5 control-label">Facility Description</label>
                            <div class="col-lg-6">
                                <input class="form-control" id="facility_desc" placeholder="Description" type="text">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="item" class="col-lg-5 control-label">Price</label>
                            <div class="col-lg-6">
                                <input class="form-control" id="facility_price" placeholder="Price" type="text">
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
                    <button type="button" onclick="add_facility()" class="btn btn-primary" name="submit" >Add Facility</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-------------------------------------END OF ADD PROMOTIONS MODAL-------------------------------->

<div  class="modal fade" id="update_facilities_modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Update Facility</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" enctype="multipart/form-data" onsubmit="" method="post">

                    <div class="row">
                        <div class="form-group">
                            <label for="quantity" class="col-lg-5 control-label">Facility Category</label>
                            <div class="col-lg-6">
                                <input class="form-control" id="facility_cat_edit" placeholder="Facility Category" type="text">
                                <input type="text" id="rownumber" hidden>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="item" class="col-lg-5 control-label">Facility Description</label>
                            <div class="col-lg-6">
                                <input class="form-control" id="facility_desc_edit" placeholder="Description" type="text">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="item" class="col-lg-5 control-label">Price</label>
                            <div class="col-lg-6">
                                <input class="form-control" id="facility_price_edit" placeholder="Price" type="text">
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
                    <button type="button" onclick="update_facility()" class="btn btn-primary" name="submit" >Update Facility</button>
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
        document.getElementById("FS").setAttribute("class","active");
        dataLoad();
});

 function add_facilities_modal(){

        $("#add_facilities_modal").modal("show");
         document.getElementById("facility_cat").value = "";
         document.getElementById("facility_desc").value = "";
         document.getElementById("facility_price").value = "";
    }



function update_facility(){

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
                var facility_category=$('#facility_cat_edit').val();
                var facility_description=$('#facility_desc_edit').val();
                var facility_price=$('#facility_price_edit').val();

                if(facility_category == "" || facility_desc == "" || facility_price == ""){
                    sweetAlert("Oops...", "One or more field(s) are empty!", "error");
                }
                else{
                var data="row="+row+"&category="+facility_category+"&description="+facility_description+"&price="+facility_price;
                
                $.ajax({
                    type:"get",
                    url:"admin_facilities/updatefacility",
                    data:data,
                    success:function(ss){
                        swal("Updated!", "Your record was updated with new data.", "success");
                        dataLoad();
                    }
                });
         }
        });

  }


function add_facility(){

    var facility_category=$('#facility_cat').val();
    var facility_description=$('#facility_desc').val();
    var facility_price=$('#facility_price').val();
  

    if(facility_category == "" || facility_description == "" || facility_price == ""){
        sweetAlert("Oops...", "One or more field(s) are empty!", "error");

    }
    else{
    var data="category="+facility_category+"&description="+facility_description+"&price="+facility_price;
    
    $.ajax({
        type:"get",
        url:"admin_facilities/addfacility",
        data:data,
        success:function(ss){
            dataLoad();
            swal("Added!", "Record Added Successfully.", "success");
        }
    });
  }
}

function edit(a){
   // console.log(a);
    $("#update_facilities_modal").modal("show");
    console.log(a);

    var data="row="+a;
    $.ajax({
    type:"get",
    url:"admin_facilities/retrievedetails",
    data:data,
    success:function(data){
      //  console.log(data[0].promotion_name);
document.getElementById("facility_cat_edit").value = data[0].category;
document.getElementById("facility_desc_edit").value = data[0].description;
document.getElementById("facility_price_edit").value = data[0].price;
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

function delete_menu(a){
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
    url:"admin_facilities/deleterow",
    data:data,
    success:function(data){
            swal("Deleted!", "Your imaginary file has been deleted.", "success"); 
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
            "ajax": "admin_facilities/facilities",
            "columns": [
                { "data": "facility_id" },
                { "data": "category"},
                { "data": "description"},
                { "data": "price" },
                {"data" : null,
                 "mRender": function(data, type, full) {
                     return '<button class="btn btn-info  btn-animate btn-animate-side btn-block btn-sm" onclick="edit('+data.facility_id+')"> View </button>' ;
                 }
                },
                {"data" : null,
                 "mRender": function(data, type, full) {
                     return '<button class="btn btn-danger  btn-animate btn-animate-side btn-block btn-sm" onclick="delete_menu('+data.facility_id+')"> Delete </button>' ;
                 }
                }
            ]
        } );


    }

</script>

@endsection