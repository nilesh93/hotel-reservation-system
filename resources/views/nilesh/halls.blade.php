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


<div class="modal inmodal fade" id="addHall" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog ">
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




@endsection



@section('js')


<script src="{{ URL::asset('BackEnd/assets/plugins/cropping/cropper.min.js') }}"></script>
<script src="{{ URL::asset('CustomJs/hallImg.js') }}"></script>

<script>
    
        var _validFileExtensions = [".jpg", ".jpeg", ".png"];
    
    function hasExtension(inputID, exts) {
        var fileName = document.getElementById(inputID).value;
        return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
    }
    $('document').ready(function(){

        document.getElementById('management').click();
        document.getElementById('HM').setAttribute('class','active');

        dataLoad();




    });

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

    function insertH(){


        $.ajax({
            type: "get",
            url: 'admin_hall_add',
            data: $('#addH').serialize(),

            success : function(data){
                // $('#addHall').modal('hide');
                swal('Success','Successfully Added!', 'success');
                dataLoad();

            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError);
            }	 
        });



        return false; 


    }

    function addimg(id){

        $('#imgLoad').click();
        document.getElementById("imgid").value = id;



    }

    
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

    function delCancel(id){

        swal('Cannot delete!', 'Room type cannot be deleted because there are rooms associated with this room type. Please delete them or change them first!', 'error');


    }

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