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
                                                            <form class="avatar-form" onsubmit="return upload()" enctype="multipart/form-data" method="post" id="formID" name="formID">
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
                                                                                <div class="avatar-preview preview-lg"></div>
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
                                                                                <button class="btn btn-primary btn-block avatar-save" type="submit">Done</button>
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
    
       

    
    
    </div>
    
    </div>



         
 
</div>

 

   <div class="modal fade" id="imgUpload" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <form class="avatar-form"   enctype="multipart/form-data" method="post" id="formID" name="formID">
                                                                <div class="modal-header">
                                                                    <button class="close" data-dismiss="modal" type="button">&times;</button>
                                                                    <h4 class="modal-title" id="avatar-modal-label">Profile Image</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="avatar-body">
<input type="hidden" name="_token" value="{{csrf_token()}}">
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
                                                                                <div class="avatar-preview preview-lg"></div>
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
                                                                                <button class="btn btn-primary btn-block avatar-save" type="submit">Done</button>
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
    
 
 
    $('form').submit(function(e) { // capture submit
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
    });
    </script>

    @endsection