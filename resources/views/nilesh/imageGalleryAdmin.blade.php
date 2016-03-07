@extends('adminmaster')


@section('css')

<script src="{{ URL::asset('BackEnd/assets/plugins/upload/jquery-pack.js') }}"></script>
<script src="{{ URL::asset('BackEnd/assets/plugins/upload/jquery.imgareaselect.min.js') }}"></script>

<link rel="stylesheet" href="{{ URL::asset('BackEnd/assets/css/crop/animate.min.css')}}">
<link rel="stylesheet" href="{{ URL::asset('BackEnd/assets/css/crop/custom.css')}}">
<link rel="stylesheet" href="{{ URL::asset('BackEnd/assets/css/crop/icheck/flat/green.css')}}">

@endsection



@section('title')

Image Gallery Upload
@endsection


@section('page_title')
Image Gallery Management



@endsection

@section('page_buttons')

<!-- Image Upload Modal -->
<div class="profile_img">

    <!-- end of image cropping -->
    <div id="crop-avatar">


        <div class="col-md-4 col-md-offset-8">
            <button type="button" class="btn btn-success waves-effect btn-block waves-light pull-right avatar-view1"  >
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
                                        <button class="btn btn-primary btn-block avatar-save" type="submit" >Done</button>
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


@endsection

@section('breadcrumbs')

<li>
    <a href="#">Management</a>
</li>
<li  class="active">
    <a href="#">Image Gallery Management</a>
</li>

@endsection



@section('content') 


<div class="col-lg-12"> 

    <div class="portlet">

        <div class="portlet-body">

            <legend> Uploaded Images</legend>
            <div class="row">
                @foreach($images as $i)
                <div class="col-sm-4" style="margin-bottom:2%">
                    <img src="{{URL::asset($i->path)}}" alt="image" class="img-responsive">
                    <br>
                    <button type="button" onclick="del({{$i->id}})" class=" col-md-offset-8 col-md-4 btn btn-danger">Remove</button>
                </div>

                @endforeach

            </div>

        </div>

    </div>



</div>




@endsection



@section('js')


<script src="{{ URL::asset('BackEnd/assets/plugins/cropping/cropper.min.js') }}"></script>
<script src="{{ URL::asset('BackEnd/assets/plugins/cropping/main.js') }}"></script>



<script>

    var _validFileExtensions = [".jpg", ".jpeg", ".png"];

    $('document').ready(function(){

        document.getElementById('management').click();
        document.getElementById('IG').setAttribute('class','active');

        $('#avatarInput').change(function(){

            if (!hasExtension('avatarInput',_validFileExtensions)) {

                swal("Invalid File Type!","Please choose a jpg, jpeg or a png Image.","error");
                $('#avatarInput').val('');
                return false;
            }



        }); 


    });
    function hasExtension(inputID, exts) {
        var fileName = document.getElementById(inputID).value;
        return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
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
        //console.log(new FormData(form));
        var url= "admin_gallery_upload";
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

                    console.log(data.status);
                    swal("Upload Failed", "Something went wrong (code: "+data.status+")", "error");

                } else {
                    console.log(data.status);

                    $('#avatar-modal').modal('hide');
                    swal({   
                        title: "Uploaded Successfully!",   
                        text: "Page will reload upon pressing ok.",   
                        type: "success",  
                        showCancelButton: false,   
                        confirmButtonText: "Ok",  
                        closeOnConfirm: true },
                         function(){  


                        location.reload();

                    });

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

                url:"admin_webImage_del",
                type:"get",
                data:{id:id},
                success:function(data){

                    $('#imageModal').modal('hide');


                    swal({   
                        title: "deleted Successfully!",   
                        text: "Page will reload upon pressing ok.",   
                        type: "success",  
                        showCancelButton: false,   
                        confirmButtonText: "Ok",  
                        closeOnConfirm: true },
                         function(){  


                        location.reload();

                    });
                },
                error:function(err){

                    swal("Something went wrong","code("+err+")","error");
                }

            });


        } });


    }

</script>

@endsection