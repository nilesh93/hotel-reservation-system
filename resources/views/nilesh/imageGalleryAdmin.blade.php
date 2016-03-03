@extends('adminmaster')


@section('css')

<script src="{{ URL::asset('BackEnd/assets/plugins/upload/jquery-pack.js') }}"></script>
<script src="{{ URL::asset('BackEnd/assets/plugins/upload/jquery.imgareaselect.min.js') }}"></script>

<link rel="stylesheet" href="{{ URL::asset('BackEnd/assets/css/crop/animate.min.css')}}">
<link rel="stylesheet" href="{{ URL::asset('BackEnd/assets/css/crop/custom.css')}}">
<link rel="stylesheet" href="{{ URL::asset('BackEnd/assets/css/crop/icheck/flat/green.css')}}">

@endsection



@section('title')

Images
@endsection


@section('page_title')
Image Gallery Management



@endsection

@section('page_buttons')


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
                    <form class="avatar-form"    enctype="multipart/form-data" action="{{URL::asset('admin_gallery_upload')}}" method="post" id="formID" name="formID">
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
                                    <input class="avatar-input btn btn-success"  id="avatarInput" name="avatarInput" type="file">
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
                                        <!--
<div class="btn-group">
<button class="btn btn-primary" data-method="rotate" data-option="-90" type="button" title="Rotate -90 degrees">Rotate Left</button>
<button class="btn btn-primary" data-method="rotate" data-option="-15" type="button">-15deg</button>
<button class="btn btn-primary" data-method="rotate" data-option="-30" type="button">-30deg</button>
<button class="btn btn-primary" data-method="rotate" data-option="-45" type="button">-45deg</button>
</div>

<div class="btn-group">
<button class="btn btn-primary" data-method="rotate" data-option="90" type="button" title="Rotate 90 degrees">Rotate Right</button>
<button class="btn btn-primary" data-method="rotate" data-option="15" type="button">15deg</button>
<button class="btn btn-primary" data-method="rotate" data-option="30" type="button">30deg</button>
<button class="btn btn-primary" data-method="rotate" data-option="45" type="button">45deg</button>
</div>
-->
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-primary btn-block avatar-save" type="button" onclick="abc()">Done</button>
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
                <button  class=" col-md-offset-8 col-md-4 btn btn-danger">Remove</button>
                
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
    $('document').ready(function(){

        document.getElementById('management').click();
        document.getElementById('IG').setAttribute('class','active');

        //dataLoad();


    });



    function abc(){

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

                    name_error.html(data.responseJSON.name);
                    link_error.html(data.responseJSON.link);
                    image_error.html(data.responseJSON.image);

                } else {

                    alert('success');
                    alert(data.status);
                }
            }
        });        


    }


    /*  $('form').submit(function(e) { // capture submit
        e.preventDefault();
        var fd = new FormData(this); // XXX: Neex AJAX2

        // You could show a loading image for example...

        $.ajax({
          url:  'admin_gallery_upload',
          xhr: function() { // custom xhr (is the best)

               var xhr = new XMLHttpRequest();
               var total = 0;

               // Get the total size of files
               $.each(document.getElementById('avatarInput').files, function(i, file) {
                      total += file.size;
               });

               // Called when upload progress changes. xhr2
               xhr.upload.addEventListener("progress", function(evt) {
                      // show progress like example
                      var loaded = (evt.loaded / total).toFixed(2)*100; // percent

                     console.log('Uploading... ' + loaded + '%' );
               }, false);

               return xhr;
          },
          type: 'get',
          processData: false,
          contentType: false,
          data: fd,
          success: function(data) {
               // do something...
               alert('uploaded');
          }
        });
    }); */
</script>

@endsection