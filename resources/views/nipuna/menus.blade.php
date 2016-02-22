@extends('adminmaster')


@section('css')

@endsection



@section('title')


Menus - Admin Panel

@endsection


@section('page_title')
Menus
@endsection

@section('breadcrumbs')

<li>
	<a href="#">Admin</a>
</li>
<li  class="active">
	<a href="#">Menus</a>
</li>

@endsection
@section('page_buttons')
<div class="col-md-4 col-md-offset-9">
                <button type="button" class="btn btn-primary btn-success" onclick="add_menu_modal()"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add new Menu</button>

       
</div>

@endsection


@section('content')


    
<div class="portlet"> 

<div class="portlet-body">

    
   
    <div class="row" id="temptable">
        <table class="table table-striped table-bordered table-hover dataTables-example" id="dd" plugin="datatable" >
                    <thead>
                        <tr>
                            
                            
                            <th>Menu ID</th>
                            <th>Category</th>
                            <th>Menu Description</th>
                            <th>Rate</th>
                            <th class="col-md-1"></th>
                            <th class="col-md-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>

                </table>
    </div>
      </div></div>
        
    <!--Add Promotions Modal-->
    <div  class="modal fade" id="add_menus_modal">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add A New Menu</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" enctype="multipart/form-data" onsubmit="" method="post">

                    <div class="row">
                        <div class="form-group">
                            <label for="quantity" class="col-lg-5 control-label">Menu Category</label>
                            <div class="col-lg-6">
                                <input class="form-control" id="menu_cat" placeholder="Menu Category" type="text">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="item" class="col-lg-5 control-label">Menu Description</label>
                            <div class="col-lg-6">
                                <input class="form-control" id="menu_desc" placeholder="Description" type="text">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="item" class="col-lg-5 control-label">Rate</label>
                            <div class="col-lg-6">
                                <input class="form-control" id="menu_rate" placeholder="Rate" type="text">
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
                    <button type="button" onclick="add_menu()" class="btn btn-primary" name="submit" >Add Menu</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-------------------------------------END OF ADD PROMOTIONS MODAL-------------------------------->

<div  class="modal fade" id="update_menus_modal">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Update Menu</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" enctype="multipart/form-data" onsubmit="" method="post">

                    <div class="row">
                        <div class="form-group">
                            <label for="quantity" class="col-lg-5 control-label">Menu Category</label>
                            <div class="col-lg-6">
                                <input class="form-control" id="menu_cat_edit" placeholder="Menu Category" type="text">
                                <input type="text" id="rownumber" hidden>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="item" class="col-lg-5 control-label">Menu Description</label>
                            <div class="col-lg-6">
                                <input class="form-control" id="menu_desc_edit" placeholder="Description" type="text">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="item" class="col-lg-5 control-label">Rate</label>
                            <div class="col-lg-6">
                                <input class="form-control" id="menu_rate_edit" placeholder="Rate" type="text">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="item" class="col-lg-5 control-label">Image</label>
                            <div class="col-lg-6">
                                <img height="400" width="300" src={{URL::asset('BackEnd\assets\images\RoyalVictoriaMenu.jpg')}}></img>
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
                    <button type="button" onclick="update_menu()" class="btn btn-primary" name="submit" >Update Promotion</button>
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
        document.getElementById("MM").setAttribute("class","active");
        dataLoad();
});

 function add_menu_modal(){

        $("#add_menus_modal").modal("show");
         document.getElementById("menu_cat").value = "";
         document.getElementById("menu_desc").value = "";
         document.getElementById("menu_rate").value = "";
    }



function update_menu(){

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
                var menu_category=$('#menu_cat_edit').val();
                var menu_description=$('#menu_desc_edit').val();
                var menu_rate=$('#menu_rate_edit').val();

                if(menu_category == "" || menu_description == "" || menu_rate == ""){
                    sweetAlert("Oops...", "One or more field(s) are empty!", "error");
                }
                else{
                var data="row="+row+"&category="+menu_category+"&description="+menu_description+"&rate="+menu_rate;
                
                $.ajax({
                    type:"get",
                    url:"admin_menus/updatemenu",
                    data:data,
                    success:function(ss){
                        swal("Updated!", "Your record was updated with new data.", "success");
                        dataLoad();
                    }
                });
         }
        });

  }


function add_menu(){

    var menu_category=$('#menu_cat').val();
    var menu_description=$('#menu_desc').val();
    var menu_rate=$('#menu_rate').val();
  

    if(menu_category == "" || menu_description == "" || menu_rate == ""){
        sweetAlert("Oops...", "One or more field(s) are empty!", "error");

    }
    else{
    var data="category="+menu_category+"&description="+menu_description+"&rate="+menu_rate;
    
    $.ajax({
        type:"get",
        url:"admin_menus/addmenu",
        data:data,
        success:function(ss){
            dataLoad();
            swal("Added!", "Record Added Successfully.", "success");
        }
    });
  }
}

function edit(a){
    console.log(a);
    $("#update_menus_modal").modal("show");
    console.log(a);

    var data="row="+a;
    $.ajax({
    type:"get",
    url:"admin_menus/retrievedetails",
    data:data,
    success:function(data){
      //  console.log(data[0].promotion_name);
document.getElementById("menu_cat_edit").value = data[0].category;
document.getElementById("menu_desc_edit").value = data[0].description;
document.getElementById("menu_rate_edit").value = data[0].rate;
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
    url:"admin_menus/deleterow",
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
            "ajax": "admin_menus/menus",
            "columns": [
                { "data": "menu_id" },
                { "data": "category"},
                { "data": "description"},
                { "data": "rate" },
                {"data" : null,
                 "mRender": function(data, type, full) {
                     return '<button class="btn btn-info  btn-animate btn-animate-side btn-block btn-sm" onclick="edit('+data.menu_id+')"> View </button>' ;
                 }
                },
                {"data" : null,
                 "mRender": function(data, type, full) {
                     return '<button class="btn btn-danger  btn-animate btn-animate-side btn-block btn-sm" onclick="delete_menu('+data.menu_id+')"> Delete </button>' ;
                 }
                }
            ]
        } );


    }

</script>

@endsection