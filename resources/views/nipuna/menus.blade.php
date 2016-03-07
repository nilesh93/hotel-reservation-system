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
                        <th>Menu Name</th>
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
        </div>
    </div>
        
<!--Add Menus Modal-->
    <div  class="modal fade" id="add_menus_modal">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" onclick="addModalClose()" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add A New Menu</h4>
                </div>

                <div class="modal-body">
                    <form class="form-horizontal" enctype="multipart/form-data" onsubmit="" action="menuImageUpload" class="form single-dropzone" id="my-dropzone" method="post">
                        <div class="row">
                            <div class="form-group">
                                <label for="quantity" class="col-lg-5 control-label">Menu Name</label>
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
                                    <input class="form-control number-only" id="menu_rate" placeholder="Rate" type="text">
                                    <input id="menu_number" type="text" hidden>
                                    <input id="imagepath" type="text" hidden>


                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="portlet">
                                    <div class="portlet-body">
                                        <div class="row" id="temptable">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" id="menuitems" plugin="datatable" >
                                                <thead>
                                                <tr>

                                                    <th>ID</th>
                                                    <th>Menu ID</th>
                                                    <th>Item Name</th>
                                                    <th>Price</th>
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
                            </div>
                        </div>

                        <div id="uploaderDiv">
                            <div id="img-thumb-preview">
                                <img id="img-thumb" class="user size-lg img-thumbnail">
                            </div>
                            <button id="upload-submit" class="btn btn-default margin-t-5"><i class="fa fa-upload"></i> Upload Picture</button>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="text" hidden="true" name="fname" id="fname" disabled="true">
                            <button type="button" id="delete" disabled="true" onclick="deleteImage()" class="btn btn-default margin-t-5">Delete Image</button>
                            <p style="color:red;">*Supporetd file types: jpg,jpeg,png,bmp</p>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="add_menu()" class="btn btn-primary" name="submit" >Add Menu</button>
                    <button type="button" id="btnAddMenuItem" class="btn btn-primary btn-success" disabled="true" onclick="add_menu_item()"><span class="glyphicon glyphicon-plus"></span>Add new item</button>

                    <button type="button" class="btn btn-default" onclick="addModalClose()">Close</button>
                </div>

            </div>
        </div>
    </div>

<!-------------------------------------Update Menus MODAL-------------------------------->

    <div  class="modal fade" id="update_menus_modal">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" onclick="updateModalClose()" aria-hidden="true">×</button>
                    <h4 class="modal-title">Update Menu</h4>
                </div>

                <div class="modal-body">
                    <form class="form-horizontal" enctype="multipart/form-data" action="menuImageUpload" class="form single-dropzone" id="my-dropzone" method="post">
                        <div class="row">
                            <div class="form-group">
                                <label for="quantity" class="col-lg-5 control-label">Menu Name</label>
                                <div class="col-lg-6">
                                    <input class="form-control" id="menu_cat_edit" onclick="enable_update()" placeholder="Menu Category" type="text">
                                    <input type="text" id="menu_number" hidden>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <label for="item" class="col-lg-5 control-label">Menu Description</label>
                                <div class="col-lg-6">
                                    <input class="form-control" id="menu_desc_edit" onclick="enable_update()" placeholder="Description" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <label for="item" class="col-lg-5 control-label">Rate</label>
                                <div class="col-lg-6">
                                    <input class="form-control number-only" id="menu_rate_edit" onclick="enable_update()" placeholder="Rate" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="portlet">
                                    <div class="portlet-body">
                                        <div class="row" id="temptable">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" id="dm" plugin="datatable" >
                                                <thead>
                                                <tr>
                                                    <th>Item ID</th>
                                                    <th>Item Name</th>
                                                    <th>Price</th>
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
                            </div>
                        </div>
                        <img id="menuimage" src="" class="user size-lg img-thumbnail">

                </div>
                <div class="alert alert-dismissible alert-success" id="addedsuccessfully" hidden="true">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong> Added Successfully!</strong>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="add_menu_item()" class="btn btn-primary"  >Add Item</button>
                    <button type="button" onclick="update_menu()" disabled="true" class="btn btn-primary" id="btnUpdate" name="submit" >Update Menu</button>
                    <button type="button" class="btn btn-default" onclick="updateModalClose()">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- END OF UPDATE MENUS MODAL -->
        @endsection



@section('js')
    <script>
        /**
         * When the user clicks on an input element on the update modal, Update button will be unlocked.
         */
        function enable_update(){
            document.getElementById("btnUpdate").removeAttribute("disabled",false);
        }


        /**
         * On document.ready event, the sidebar classes will change.
         * A Dropzone.js instance will be created and initialized for the file upload.
         * Upon file selection, the file will be uploaded to the server.
         */
        $('document').ready(function(){
            document.getElementById("management").click();
            document.getElementById("MM").setAttribute("class","active");
            dataLoad();

            //Dropzone.js Options - Upload an image via AJAX.
            Dropzone.options.myDropzone = {
                uploadMultiple: false,
                // previewTemplate: '',
                addRemoveLinks: false,
                // maxFiles: 1,
                dictDefaultMessage: '',
                init: function() {
                    this.on("addedfile", function(file) {
                        // console.log('addedfile...');
                    });
                    this.on("thumbnail", function(file, dataUrl) {
                        // console.log('thumbnail...');
                        $('.dz-image-preview').hide();
                        $('.dz-file-preview').hide();
                    });
                    this.on("success", function(file, res) {
                        console.log('upload success...');

                        var filename = $('#fname').val();
                        var data = "imagepath="+res.path+"&fname="+filename;

                        if(res == 0){
                            console.log('res='+res);
                            sweetAlert("Oops...", "Invalid filetype!", "error");

                        }
                        else {
                            $.ajax({
                                type:"get",
                                url:"admin_menus/addimagepath",
                                data:data,
                                success:function(ss){

                                }
                            });
                            swal("Uploaded!", "Image was uploaded successfully.", "success");
                            document.getElementById("delete").removeAttribute("disabled",false);

                        }


                        $('#img-thumb').attr('src', res.path);
                        $('input[name="pic_url"]').val(res.path);
                        $('.dz-success-mark.dz-error-mark').hide();

                    });
                }
            };
            var myDropzone = new Dropzone("#my-dropzone");

            $('#upload-submit').on('click', function(e) {
                e.preventDefault();
                //trigger file upload select
                $("#my-dropzone").trigger('click');
            });

        });
        //we want to manually init the dropzone.
        Dropzone.autoDiscover = false;

        /**
         * The button action of the dropzone delete button in the Add menu modal. When clicked the uploaded image will
         * be deleted and the Delete Image button will be disabled until a new Image is uploaded.
         */
        function deleteImage(){
            var rowno = $('#menu_number').val();
            var data = "rowno="+rowno;
            $.ajax({
                type:"get",
                url:"deleteImage",
                data:data,
                success:function(ss){
                    console.log(ss);
                    $('#img-thumb').attr('src', null);
                    $('input[name="pic_url"]').val(null);
                    $('.dz-preview.dz-processing.dz-image-preview.dz-success.dz-complete').hide();

                    $('#menuimage').hide();
                    document.getElementById("delete").setAttribute("disabled","true");
                    swal("Deleted!", "The menu was deleted successfully.", "success");
                    document.getElementById("delete").setAttribute("disabled","true");


                }
            });
        }

        /**
         * This method will be invoked when the Add New Menu button is clicked.
         * Here the input fields of the modal will be set to blank and the dataTable inside the modal will reset.
         * The validation script for Rates input will be executed.
         */
        function add_menu_modal(){
            $("#add_menus_modal").modal("show");
            $('#menu_number').val(-1);

            $('#uploaderDiv').css('visibility', 'hidden');

            //Rate validation
            var ele = document.getElementById('menu_rate');
            ele.onkeypress = function(e) {
                if(isNaN(this.value+""+String.fromCharCode(e.charCode)))
                    return false;
            }
            ele.onpaste = function(e){
                e.preventDefault();
            }

            document.getElementById("menu_cat").value = "";
            document.getElementById("menu_desc").value = "";
            document.getElementById("menu_rate").value = "";
            document.getElementById("btnAddMenuItem").setAttribute("disabled","true");

            $('#menuitems').dataTable().fnClearTable();
        }

        /**
         * This function will be invoked then the user closes the Add new Menu modal.
         * This will check all the input fields are filled and if there are any menu items by the id of the menu.
         * If there are no menu items for that menu, the menu will be dismissed.
         */
        function addModalClose(){
            var row = $('#menu_number').val();
            if (row == -1){
                $('#add_menus_modal').modal('hide');
            }
            else{
                var menuid = "menu_id="+row;
                $.ajax({
                    type:"get",
                    url:"admin_menus/menuitemcount",
                    data:menuid,
                    success:function(ss){
                        itemCount = ss;
                        console.log(itemCount);
                        if(itemCount == 0){
                            swal({
                                        title: "No items in the menu",
                                        text: "You have not assigned any items for this menu. The menu added will be dismissed.",
                                        type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",
                                        confirmButtonText: "Okay, delete it!",
                                        closeOnConfirm: false
                                    },
                                    function(){
                                        var data="row="+row;
                                        $.ajax({
                                            type:"get",
                                            url:"admin_menus/deleterow",
                                            data:data,
                                            success:function(data){
                                                deleteImage();
                                                swal("Deleted!", "The menu was deleted successfully.", "success");
                                                $('#update_menus_modal').modal('hide');
                                                $('#add_menus_modal').modal('hide');


                                                dataLoad();
                                                menuitemdataLoad();
                                                location.reload();


                                            },
                                            complete: function (data) {
                                            },
                                            error: function(xhr, ajaxOptions, thrownError) {
                                            }
                                        });
                                    });
                        }
                        if(itemCount != 0) {

                            $('#add_menus_modal').modal('hide');
                            location.reload();

                        }
                    }
                });
            }
        }

        function updateModalClose(){
            $('#update_menus_modal').modal('hide');
            location.reload();
        }

        /**
         * Changes done to existing menus are sent to the controller via this function.
         */
        function update_menu(){

            var row = $('#menu_number').val();
            var menu_category=$('#menu_cat_edit').val();
            var menu_description=$('#menu_desc_edit').val();
            var menu_rate=$('#menu_rate_edit').val();

            if(menu_category == "" || menu_description == "" || menu_rate == ""){
                sweetAlert("Please fill all the fields", "One or more fields are empty. Please fill all the fields.", "error");
            }
            else {
                swal({
                            title: "Are you sure?",
                            text: "Are you sure you want to update?",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Update!",
                            closeOnConfirm: false },
                        function(){

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
        }

        /**
         * Add a new menu.
         */
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
                        $('#menu_number').val(ss);
                        $('#fname').val(ss);
                        var rowno = $('#menu_number').val();
                        console.log(rowno);
                        $('#uploaderDiv').css('visibility', 'visible');

                        document.getElementById("menu_cat").setAttribute("disabled","true");
                        document.getElementById("menu_desc").setAttribute("disabled","true");
                        document.getElementById("menu_rate").setAttribute("disabled","true");


                        document.getElementById("btnAddMenuItem").removeAttribute("disabled",false);
                        swal("Added!", "Record Added Successfully. Now you may add menu items.", "success");
                    }
                });
            }
        }

        /**
         * Edit menu details.
         * @param a
         */
        function edit(a){

            $("#update_menus_modal").modal("show");

            var ele = document.getElementById('menu_rate_edit');
            ele.onkeypress = function(e) {
                if(isNaN(this.value+""+String.fromCharCode(e.charCode)))
                    return false;
            }
            ele.onpaste = function(e){
                e.preventDefault();
            }

            console.log(a);
            var data="row="+a;


            $.ajax({
                type:"get",
                url:"admin_menus/retrievedetails",
                data:data,
                success:function(data){
                    var dir = "/HOTEL_RESERVATION/public/"+data[0].imagepath;
                    $('#menuimage').attr('src', dir);
                    //  console.log(data[0].promotion_name);
                    document.getElementById("menu_cat_edit").value = data[0].category;
                    document.getElementById("menu_desc_edit").value = data[0].description;
                    document.getElementById("menu_rate_edit").value = data[0].rate;
                    document.getElementById("menu_number").value = a;
                    detailedMenu(a);

                },
                complete: function (data) {
                },
                error: function(xhr, ajaxOptions, thrownError) {
                }
            });
        }

        /**
         * Delete a menu.
         * @param a
         */
        function delete_menu(a){

            swal({
                        title: "Are you sure?",
                        text: "Are you sure you want to permanently delete the menu "+ a +" and all its content?",
                        type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    },
                    function(){
                        var data="row="+a;
                        $.ajax({
                            type:"get",
                            url:"admin_menus/deleterow",
                            data:data,
                            success:function(data){
                                swal("Deleted!", "The menu was deleted successfully.", "success");
                                var imgname = "rowno="+a;
                                $.ajax({
                                    type:"get",
                                    url:"deleteImage",
                                    data:imgname,
                                    success:function(ss){
                                        console.log(ss);
                                        $('#img-thumb').attr('src', null);
                                        $('input[name="pic_url"]').val(null);
                                        $('.dz-preview.dz-processing.dz-image-preview.dz-success.dz-complete').hide();

                                    }
                                });
                                dataLoad();
                            },
                            complete: function (data) {
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                            }
                        });
                    });
        }

        /**
         * This function Loads the data into the jQuery DataTable using Ajax.
         */
        function dataLoad(){

            var oTable = $('#dd').DataTable();
            oTable.destroy();

            $('#dd').DataTable({
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
            });
        }


        /**
         * Loads the details of the items of menu to DataTable.
         */
        function menuitemdataLoad(){

            var oTable = $('#menuitems').DataTable();
            oTable.destroy();
            var rowno = $('#menu_number').val() ;

            $.ajax({
                url : 'admin_menus/menuitemdataload?rowno='+rowno,
                type : 'GET',
                dataType : 'json',
                success : function(data) {
                    assignToEventsColumns(data);
                }
            });

            function assignToEventsColumns(data) {
                console.log(data);
                var table = $('#menuitems').dataTable({
                    "bAutoWidth" : false,
                    "aaData" : data,
                    "aoColumns" : [
                        { "data" : "id" },
                        { "data" : "menu_id" },
                        { "data" : "item_name" },
                        { "data" : "price" },
                        {"data" : null,
                            "mRender": function(data, type, full) {
                                return '<button type="button" class="btn btn-info  btn-animate btn-animate-side btn-block btn-sm" onclick="edit_items('+data.id+','+data.menu_id+')"> Edit </input>' ;
                            }
                        },
                        {"data" : null,
                            "mRender": function(data, type, full) {
                                return '<button type="button" class="btn btn-danger  btn-animate btn-animate-side btn-block btn-sm" onclick="delete_item('+data.id+','+data.menu_id+')"> Delete </button>' ;
                            }
                        }
                    ]
                });
            }
        }

        function add_menu_item(){
            var rowno = $('#menu_number').val() ;

            swal({   title: "Insert Item",
                        text: "Enter item details",
                        type: "input",
                        showCancelButton: true,
                        closeOnConfirm: false},

                    function(inputValue)
                    {
                        SweetAlertMultiInputReset(); // make sure you call this

                        if (inputValue!=false)
                        {
                            swal({   title: "Added Successfully!",
                                text: "Item was added successfully.",
                                type:"success",
                                closeOnConfirm: true,
                            },function(){SweetAlertMultiInputFix()}); // fix used if you want to display another box immediately
                            if (inputValue!=false)
                            {
                                var checkResults = JSON.parse(inputValue);

                                if(checkResults[0] == "" || checkResults[1] == null){
                                    sweetAlert("Oops...", "One or more field(s) are empty!", "error");
                                }
                                else {
                                    var data = "menu_number=" + rowno + "&item_name=" + checkResults[0] + "&item_price=" + checkResults[1];
                                    $.ajax({
                                        type: "get",
                                        url: "admin_menus/checkavailability",
                                        data: data,
                                        success: function (ss) {

                                            if(ss == 1){
                                                sweetAlert("Oops...", "There is already an item by that name", "error");

                                            }
                                            else{
                                                $.ajax({
                                                    type: "get",
                                                    url: "admin_menus/addmenuitem",
                                                    data: data,
                                                    success: function (ss) {
                                                        var rowno = $('#menu_number').val();
                                                        menuitemdataLoad();
                                                        detailedMenu(rowno);
                                                    }
                                                });
                                            }

                                        }
                                    });

                                }
                            }
                        }
                    }
            );

            //set up the fields: labels
            var tooltipsArray = ["Item Name","Price"];
            //set up the fields: defaults
            var defaultsArray = ["",""];
            //we use an extra field here, only takes "float" or "string"
            var typesArray = ["string","float"];
            SweetAlertMultiInput(tooltipsArray,defaultsArray,typesArray);
        }

        function detailedMenu(a){
            $('#menu_number').val(a);
            var oTable = $('#dm').DataTable();
            oTable.destroy();

            $('#dm').DataTable({
                "ajax": "admin_menus/detailedmenus?row="+a,
                "columns": [
                    { "data": "id" },
                    { "data": "item_name"},
                    { "data": "price"},
                    {"data" : null,
                        "mRender": function(data, type, full) {
                            return '<button type="button" class="btn btn-info  btn-animate btn-animate-side btn-block btn-sm" onclick="edit_items('+data.id+','+data.menu_id+')"> Edit </input>' ;
                        }
                    },
                    {"data" : null,
                        "mRender": function(data, type, full) {
                            return '<button type="button" class="btn btn-danger  btn-animate btn-animate-side btn-block btn-sm" onclick="delete_item('+data.id+','+data.menu_id+')"> Delete </button>' ;
                        }
                    }
                ]
            });
        }

        function edit_items(a,b) {
            console.log(a);


            var data="row="+a;

            $.ajax({
                type:"get",
                url:"admin_menus/retrieveitemdetails",
                data:data,
                success:function(data){
                    console.log(data);

                    swal({   title: "Update Item",
                                text: "Enter item details",
                                type: "input",
                                showCancelButton: true,
                                closeOnConfirm: false},

                            function(inputValue)
                            {
                                SweetAlertMultiInputReset(); // make sure you call this

                                if (inputValue!=false)
                                {
                                    swal({   title: "Update Successful",
                                        text: "Item was updated successfully.",
                                        type:"success",
                                        closeOnConfirm: true,
                                    },function(){SweetAlertMultiInputFix()}); // fix used if you want to display another box immediately
                                    if (inputValue!=false)
                                    {
                                        var checkResults = JSON.parse(inputValue);
                                        var id = a;
                                        var item_name = checkResults[0];
                                        var price = checkResults[1];
                                        console.log(checkResults[1]);
                                        if(checkResults[0] == "" || checkResults[1] == null){
                                            sweetAlert("Oops...", "One or more field(s) are empty!", "error");

                                        }
                                        else {
                                            data = "id=" + id + "&item_name=" + item_name + "&price=" + price;

                                            $.ajax({
                                                type: "get",
                                                url: "admin_menus/updateitem",
                                                data: data,
                                                success: function (ss) {
                                                    swal("Updated!", "Your record was updated with new data.", "success");
                                                    detailedMenu(b);
                                                    menuitemdataLoad();
                                                }
                                            });
                                        }

                                        //do stuff
                                    }
                                }
                            }
                    );

                    //set up the fields: labels
                    var tooltipsArray = ["Item Name","Price"];
                    //set up the fields: defaults
                    var defaultsArray = [data[0].item_name,data[0].price];
                    //we use an extra field here, only takes "float" or "string"
                    var typesArray = ["string","float"];
                    SweetAlertMultiInput(tooltipsArray,defaultsArray,typesArray);
                },
                complete: function (data) {
                },
                error: function(xhr, ajaxOptions, thrownError) {
                }
            });
        }

        function delete_item(a,b){

            swal({
                        title: "Are you sure?",
                        text: "Are you sure you want to delete the item number "+a+"?",
                        type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    },
                    function(){

                        var data="row="+a;
                        $.ajax({
                            type:"get",
                            url:"admin_menus/deleteitem",
                            data:data,
                            success:function(data){
                                swal("Deleted!", "The item was deleted successfully.", "success");
                                detailedMenu(b);
                                menuitemdataLoad();

                                var itemCount;
                                var menuid = "menu_id="+b;
                                $.ajax({
                                    type:"get",
                                    url:"admin_menus/menuitemcount",
                                    data:menuid,
                                    success:function(ss){
                                        itemCount = ss;
                                        console.log(itemCount);
                                        if(itemCount == 0){
                                            swal({
                                                        title: "No items in the menu",
                                                        text: "Deleting item leaves this menu with no items. Do you want to delete this menu?",
                                                        type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",
                                                        confirmButtonText: "Yes, delete it!",
                                                        closeOnConfirm: false
                                                    },
                                                    function(){
                                                        var data="row="+b;
                                                        $.ajax({
                                                            type:"get",
                                                            url:"admin_menus/deleterow",
                                                            data:data,
                                                            success:function(data){
                                                                swal("Deleted!", "The menu was deleted successfully.", "success");
                                                                $('#update_menus_modal').modal('hide');
                                                                $('#add_menus_modal').modal('hide');

                                                                dataLoad();
                                                                menuitemdataLoad();

                                                            },
                                                            complete: function (data) {
                                                            },
                                                            error: function(xhr, ajaxOptions, thrownError) {
                                                            }
                                                        });
                                                    });
                                        }
                                    }
                                });
                            },
                            complete: function (data) {
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                            }
                        });
                    });
        }

    </script>

@endsection