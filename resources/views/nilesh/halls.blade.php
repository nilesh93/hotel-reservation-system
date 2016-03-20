@extends('adminmaster')


@section('css') 

<script src="{{ URL::asset('BackEnd/assets/plugins/upload/jquery-pack.js') }}"></script>
<script src="{{ URL::asset('BackEnd/assets/plugins/upload/jquery.imgareaselect.min.js') }}"></script>

<link rel="stylesheet" href="{{ URL::asset('BackEnd/assets/css/crop/animate.min.css')}}">
<link rel="stylesheet" href="{{ URL::asset('BackEnd/assets/css/crop/custom.css')}}">
<link rel="stylesheet" href="{{ URL::asset('BackEnd/assets/css/crop/icheck/flat/green.css')}}">
@endsection



@section('title')

Halls

@endsection


@section('page_title')
HALL MANAGEMENT



@endsection

@section('page_buttons')
<div class="col-md-4 col-md-offset-8">
    <button type="button" class="btn btn-success waves-effect btn-block waves-light pull-right" data-toggle="modal" data-target="#addHall">
        <span class="btn-label pull-left"><i class="fa fa-plus"></i>
        </span>HALLS</button>
</div>

@endsection

@section('breadcrumbs')

<li>
    <a href="#">Management</a>
</li>
<li  class="active">
    <a href="#">Hall Management</a>
</li>

@endsection



@section('content')

<div class="col-lg-12"> 

    <div class="portlet">

        <div class="portlet-body">

            <table class="table table-striped table-bordered table-hover dataTables-example" id="hh" plugin="datatable" >
                <thead>
                    <tr>
                        <th>Hall Number</th>
                        <th>Title</th>

                        <th>Size</th>
                        <th>Remarks</th>
                        <th>Capacity</th>
                        <th class="col-md-1"></th>
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


<div class="profile_img">

    <!-- end of image cropping -->
    <div id="crop-avatar">


        <div class="col-md-4 col-md-offset-8" hidden="true">
            <button type="button" class="btn btn-success waves-effect btn-block waves-light pull-right avatar-view1"  id="imgLoad" >
                <span class="btn-label pull-left"><i class="fa fa-plus"></i>
                </span>ADD IMAGE</button>
        </div>


        <!-- Cropping modal -->
        <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form class="avatar-form"    enctype="multipart/form-data"  onsubmit="return upload()" method="post" id="formID" name="formID">
                        <div class="modal-header">
                            <button class="close" data-dismiss="modal" type="button">&times;</button>
                            <h4 class="modal-title" id="avatar-modal-label">Upload Image</h4>
                        </div>
                        <div class="modal-body">
                            <div class="avatar-body">

                                <!-- Upload image and data -->
                                <div class="avatar-upload">
                                    <input class="avatar-src"  name="avatar_src"   id="avatar_src" type="hidden">
                                    <input class="avatar-data" name="avatar_data"  id="avatar_data"  type="hidden">
                                    <input type="hidden" id="imgid">
                                    <label for="avatarInput">Upload</label>
                                    <input class="avatar-input btn btn-success"  id="avatarInput" name="avatarInput" type="file" required>
                                </div>

                                <!-- Crop and preview -->
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="avatar-wrapper"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="avatar-preview preview-lg" id="lg1"></div>
                                        <div class="avatar-preview preview-md"></div>
                                        <div class="avatar-preview preview-sm"></div>
                                    </div>
                                </div>
                                <div class="row avatar-btns">
                                    <div class="col-md-9">

                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-primary btn-block avatar-save" type="submit"  >Done</button>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <!-- <div class="modal-footer">
<button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
</div> -->
                    </form>
                </div>
            </div>
        </div>
        <!-- /.modal -->

        <!-- Loading state -->
        <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
    </div>
    <!-- end of image cropping -->

</div> 

<!-- add Hall -->
<div class="modal inmodal fade" id="addHall" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Add A Hall</h4>

            </div>
            <form class="form-horizontal" id="addH" onsubmit="return insertH()">
                <div class="modal-body">


                    <div class="form-group">

                        <label class="col-lg-3 control-label">Hall No</label>

                        <div class="col-lg-9"><input placeholder="Enter Hall Number" class="form-control" type="text" required id="hnum" name="hnum" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Hall Title</label>

                        <div class="col-lg-9"> <input placeholder="Enter Hall Name" class="form-control"  type="text" id="htitle" name="htitle" required>

                        </div>
                    </div>

                    
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Hall Rate</label>

                        <div class="col-lg-9"> <input placeholder="Enter Hall Rate (Rs)" class="form-control"  type="text" id="hrate" name="hrate" pattern="[-+]?[0-9]*\.?[0-9]+" title="Float value needed" required>

                        </div>
                    </div>

                    
                          <div class="form-group">
                        <label class="col-lg-3 control-label">Min Advance</label>
                        <div class="col-lg-9">

                            <div class="col-lg-4"> 
                                <input type="text"  placeholder="Min Advance (Rs)" class="form-control" id="advance" name="advance" pattern="[-+]?[0-9]*\.?[0-9]+" title="Float value needed" required>               

                            </div>
                             <label class="col-lg-3 control-label">Max Refund</label>

                            <div class="col-lg-4"> 
                                <input type="text" placeholder="Max Refund (Rs)" class="form-control" id="refund" name="refund" pattern="[-+]?[0-9]*\.?[0-9]+" title="Float value needed" required>               

                            </div>
                        </div>
                    </div>
                    <div class="form-group">

                        <label class="col-lg-3 control-label">Size (SqFt)</label>

                        <div class="col-lg-9"><input type="text" placeholder="Enter Hall Size" class="form-control" type="text" required id="hsize" name="hsize" pattern="[-+]?[0-9]*\.?[0-9]+" title="Float value needed" >

                        </div>               
                    </div>

                    <input type="text"  id="max" name="max" hidden="true">

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Capacity</label>
                        <div class="col-lg-9">

                            <div class="col-lg-6"> 
                                <input type="number"  placeholder="From" class="form-control" id="hfrom" name="hfrom" required>               

                            </div>

                            <div class="col-lg-6"> 
                                <input type="number" placeholder="To" class="form-control" id="hto" name="hto" required>               

                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Services</label>
                        <div class="col-lg-9">

                            <div class="">
                                <?php $rscount = 0; ?>

                                @if(count($hs) == 0)
                                <label class="  control-label">  <i>Not available</i> </label>

                                @endif

                                @foreach($hs as $h)


                                <div class="checkbox checkbox-primary">
                                    <input id="service{{$rscount}}" name="service{{$rscount}}" value="{{$h->hs_id}}" type="checkbox">
                                    <label for="service{{$rscount}}">
                                        {{ $h->name}}   
                                    </label>
                                </div>

                                <?php $rscount++; ?>

                                @endforeach

                                <input type="text" name="hscount" value="{{$rscount}}" hidden="true">

                            </div>



                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Remarks</label>

                        <div class="col-lg-9"><textarea placeholder="Any special Comments?" class="form-control" type="text" required id="hremarks" name="hremarks"> </textarea>
                        </div>
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

<!-- edit hall -->
<div class="modal inmodal fade" id="editHall" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
         <form class="form-horizontal" id="editH" onsubmit="return updateH()">
           
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Edit A Hall</h4>

            </div>
                <div class="modal-body">


                    <ul class="nav nav-tabs tabs" style="width: 100%;">
                        <li class="active tab" style="width: 25%;">
                            <a href="#hallGI" data-toggle="tab" aria-expanded="true" id="giInfo" > 
                                <span class="visible-xs"><i class="fa fa-home"></i></span> 
                                <span class="hidden-xs">General Info</span> 
                            </a> 
                        </li> 
                        <li class="tab" style="width: 25%;"> 
                            <a href="#hallImg" data-toggle="tab" aria-expanded="false"> 
                                <span class="visible-xs"><i class="fa fa-user"></i></span> 
                                <span class="hidden-xs">Images</span> 
                            </a> 
                        </li> 

                    </ul> 

                    <div class="tab-content"> 
                        
                        <div class="tab-pane active " id="hallGI"> 
                            
                            <div class="form-group">

                                <label class="col-lg-3 control-label">Hall No</label>

                                <div class="col-lg-9">
                                    <input placeholder="Enter Hall Number" class="form-control" type="text" required id="hnum1" name="hnum" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">Hall Title</label>

                                <div class="col-lg-9"> <input placeholder="Enter Hall Name" class="form-control"  type="text" id="htitle1" name="htitle" required>

                                </div>
                            </div>

                            
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Hall Rate</label>

                        <div class="col-lg-9"> <input placeholder="Enter Hall Rate (Rs)" class="form-control"  type="text" id="hrate1" name="hrate" pattern="[-+]?[0-9]*\.?[0-9]+" title="Float value needed" required>

                        </div>
                    </div>

                    
                          <div class="form-group">
                        <label class="col-lg-3 control-label">Min Advance</label>
                        <div class="col-lg-9">

                            <div class="col-lg-4"> 
                                <input type="text"  placeholder="Min Advance (Rs)" class="form-control" id="advance1" name="advance" pattern="[-+]?[0-9]*\.?[0-9]+" title="Float value needed" required>               

                            </div>
                             <label class="col-lg-3 control-label">Max Refund</label>

                            <div class="col-lg-4"> 
                                <input type="text" placeholder="Max Refund (Rs)" class="form-control" id="refund1" name="refund" pattern="[-+]?[0-9]*\.?[0-9]+" title="Float value needed" required>               

                            </div>
                        </div>
                    </div>

                            <div class="form-group">

                                <label class="col-lg-3 control-label">Size (SqFt)</label>

                                <div class="col-lg-9"><input type="text" placeholder="Enter Hall Size" class="form-control" type="text" required id="hsize1" name="hsize" pattern="[-+]?[0-9]*\.?[0-9]+" title="Float value needed" >

                                </div>               
                            </div>

                            <input type="text"  id="max1" name="max" hidden="true">

                            <div class="form-group">
                                <label class="col-lg-3 control-label">Capacity</label>
                                <div class="col-lg-9">

                                    <div class="col-lg-6"> 
                                        <input type="number"  placeholder="From" class="form-control" id="hfrom1" name="hfrom" required>               

                                    </div>

                                    <div class="col-lg-6"> 
                                        <input type="number" placeholder="To" class="form-control" id="hto1" name="hto" required>               

                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">Services</label>
                                <div class="col-lg-9">

                                    <div class="">
                                        <?php $rscount = 100; ?>

                                        @if(count($hs) == 0)
                                        <label class="  control-label">  <i>Not available</i> </label>

                                        @endif

                                        @foreach($hs as $h)


                                        <div class="checkbox checkbox-primary">
                                            <input class="service" id="service{{$rscount}}" name="service{{$rscount}}" value="{{$h->hs_id}}" type="checkbox">
                                            <label for="service{{$rscount}}">
                                                {{ $h->name}}   
                                            </label>
                                        </div>

                                        <?php $rscount++; ?>

                                        @endforeach

                                        <input type="text" id="hscount1" name="hscount" value="{{$rscount}}" hidden="true">

                                    </div>



                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">Remarks</label>

                                <div class="col-lg-9"><textarea placeholder="Any special Comments?" class="form-control" type="text" required id="hremarks1" name="hremarks"> </textarea>
                                </div>
                            </div>
                            
                            <input type="hidden" name="id" id="hall_idedit">

                        </div>

                        <div class="tab-pane  " id="hallImg"> 


                            <div id="hallImgDiv" class="row"> </div>
                        </div>
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



@endsection



@section('js')


<script src="{{ URL::asset('BackEnd/assets/plugins/cropping/cropper.min.js') }}"></script>
<script src="{{ URL::asset('CustomJs/hallImg.js') }}"></script>

<script>

    //image validation extensions
    var _validFileExtensions = [".jpg", ".jpeg", ".png"];

    //image validate
    function hasExtension(inputID, exts) {
        var fileName = document.getElementById(inputID).value;
        return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
    }
    
    //onload function
    $('document').ready(function(){

        document.getElementById('management').click();
        document.getElementById('HM').setAttribute('class','active');

        dataLoad();




    });

    //dataload
    function dataLoad(){

        var oTable = $('#hh').DataTable();
        oTable.destroy();

        $('#hh').DataTable( {
            "ajax": "admin_get_halls",
            "columns": [
                { "data": "hall_num" },
                { "data": "title" },
                { "data": "hall_size" },
                { "data": "remarks" },
                {"data" : null,
                 "mRender": function(data, type, full) {



                     return "  "+data.capacity_from+" - "+data.capacity_to+" ";



                 }
                },
                {"data" : null,
                 "mRender": function(data, type, full) {
                     return '<button class="btn btn-success btn-animate btn-animate-side btn-block btn-sm" onclick="addimg('+data.hall_id+')"> Images </button>' ;
                 }
                },
                {"data" : null,
                 "mRender": function(data, type, full) {
                     return '<button class="btn btn-primary  btn-animate btn-animate-side btn-block btn-sm" onclick="edit('+data.hall_id+')"> View </button>' ;
                 }
                },
                {"data" : null,
                 "mRender": function(data, type, full) {
                     return '<button class="btn btn-danger  btn-animate btn-animate-side btn-block btn-sm" onclick="del('+data.hall_id+')"> Delete </button>' ;
                 }
                }
            ]
        } );



    }

    //add hall
    function insertH(){


        $.ajax({
            type: "get",
            url: 'admin_hall_add',
            data: $('#addH').serialize(),

            success : function(data){
                $('#addHall').modal('hide');
                swal('Success','Successfully Added!', 'success');
                dataLoad();
                

            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError);
            }	 
        });



        return false; 


    }

    //add image to hall
    function addimg(id){

        $('#imgLoad').click();
        document.getElementById("imgid").value = id;



    }

    //upload image via AJAX
    function upload(){


        if (!hasExtension('avatarInput',_validFileExtensions)) {

            swal("Invalid File Type!","Please choose a jpg, jpeg or a png Image.","error");
            return false;
        }

        swal({

            title: "Uploading...Please wait!",   
            text: "",   
            type: "info",  
            showCancelButton: false,   
            showConfirmButton: false


        });

        console.log(document.getElementById("avatar_data").value);

        var f =   new FormData();
        f.append('img',document.getElementById("avatarInput").files[0]);
        f.append('img_data',document.getElementById("avatar_data").value);
        f.append('imgid',document.getElementById("imgid").value);

        var url= "admin_hall_upload";
        $.ajax({
            url: url,
            type:"post",
            data: f,
            dataType:"JSON",
            processData: false,
            contentType: false,
            success: function (data, status)
            {
                console.log(data);
            },
            error: function (data)
            {

                if (data.status === 422) {

                    name_error.html(data.responseJSON.name);
                    link_error.html(data.responseJSON.link);
                    image_error.html(data.responseJSON.image);

                } else {
                    $('#avatar-modal').modal('hide');
                    swal("success","Image Successfully Uploaded","success");
                    console.log(data.status);
                    $('.avatar-wrapper img').removeAttr('src');
                    //$('.avatar-preview').html("");
                    $('#avatarInput').val("");

                    ('#avatarInput').fireEvent("onchange");
                }
            }
        });  

        return false;



    }
    
    //edit hall details get info
    function edit(id){

        $.ajax({
            type: "get",
            url: 'admin_edit_hall',
            data: {
                id:id
            },

            success : function(data){

                console.log(data);
                $('#hall_idedit').val(data.hall.hall_id);
                $('#hnum1').val(data.hall.hall_num);
                $('#htitle1').val(data.hall.title);
                $('#hsize1').val(data.hall.hall_size);
                $('#hfrom1').val(data.hall.capacity_from);
                $('#hto1').val(data.hall.capacity_to);
                $('#hremarks1').val(data.hall.remarks);
                
                if(data.hr != null){
                $('#hrate1').val(data.hr.rate);
                $('#advance1').val(data.hr.advance_payment);
                $('#refund1').val(data.hr.refundable_amount);
                }else{
                    
                    $('#hrate1').val("");
                $('#advance1').val("");
                $('#refund1').val("");
                    
                }

                for(var i = 0; i<data.hs.length; i++){

                    $('input:checkbox[class="service"][value="' + data.hs[i].service_id + '"]')
                        .attr('checked', 'checked');

                }


                var body = "";

                for(var t=0; t< data.images.length ; t++){


                    body+= '    <div class="col-sm-4" style="margin-bottom:2%">'+
                        '<img src="'+data.images[t].path+'" alt="image" class="img-responsive">'+
                        '<br>'+
                        '<button type="button" onclick="delImage('+data.images[t].hall_image_id+','+data.images[t].hall_id+')" class=" col-md-offset-8 col-md-4 btn btn-danger">Remove</button>'+

                        ' </div>';
                }
                if(data.images.length == 0){

                    body = '<div class="alert alert-danger alert-dismissable">  Sorry No Images Avaialble. </div>';

                }
                
                document.getElementById("hallImgDiv").innerHTML = body;

                $('#editHall').modal('show');

            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError);

                swal("Ooops!", "Something Went Wrong! ("+thrownError+")", "error");   
            }	 
        });




    }

    //delete image
    function delImage(id,originalid){

        $.ajax({

            url:"admin_hall_image_del",
            type:"get",
            data:{
                id:id,
                type_id:originalid
            },
            success:function(data){

                var body = "";

                for(var t=0; t< data.images.length ; t++){


                    body+= '<div class="col-sm-4" style="margin-bottom:2%">'+
                        '<img src="'+data.images[t].path+'" alt="image" class="img-responsive">'+
                        '<br>'+
                        '<button type="button" onclick="delImage('+data.images[t].hall_image_id+','+data.images[t].hall_id+')" class=" col-md-offset-8 col-md-4 btn btn-danger">Remove</button>'+

                        ' </div>';
                }
                if(data.images.length == 0){

                    body = '<div class="alert alert-danger alert-dismissable">  Sorry No Images Avaialble. </div>';

                }
                console.log(body);
                document.getElementById("hallImgDiv").innerHTML = body;
                console.log(data);
            },
            error: function (err){


                swal("Something went wrong","code("+err+")","error");
            }



        });




    }
    
    //update hall edit save
    function updateH(){
        
            $.ajax({
                type: "get",
                url: 'admin_update_hall',
                data:  $('#editH').serialize(),

                success : function(data){


                    swal("Updated!", "", "success"); 
                    
                    dataLoad();    
                     $('#editHall').modal('hide');

                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(thrownError);

                    swal("Ooops!", "Something Went Wrong! ("+thrownError+")", "error");   
                }	 
            });
        
        
        return false;
    }

    //delete hall
    function del(id){


        swal({   
            title: "Delete?",   
            text: "",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Delete",   
            cancelButtonText: "Cancel",   
            closeOnConfirm: false}, 
             function(isConfirm){   if (isConfirm) {



            $.ajax({
                type: "get",
                url: 'admin_delete_hall',
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


        } });


    }

    //cancel alert on delete
    function delCancel(id){

        swal('Cannot delete!', 'Room type cannot be deleted because there are rooms associated with this room type. Please delete them or change them first!', 'error');


    }

    
    //depcrecated function
    function getRoomNum(id){

        if(id == 0){

            document.getElementById('rnum').value = "";
            document.getElementById('max').value = "";
            return false;


        }

        $.ajax({
            type: "get",
            url: 'admin_getRoomNum',
            data: {
                id:id
            },

            success : function(data){

                document.getElementById('rnum').value = data.code;
                document.getElementById('max').value = data.max;


            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError);

                swal("Ooops!", "Cannot generate room number! ("+thrownError+")", "error");   
            }	 
        });



    }

</script>

@endsection