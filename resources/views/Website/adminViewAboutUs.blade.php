@extends('adminmaster')

@section('css')
@endsection


@section('title')
    Edit About Us Page
@endsection


@section('page_title')
    Edit About Us Page
@endsection


@section('page_buttons')
@endsection


@section('breadcrumbs')

    <li>
        <a href="#">Site Administration</a>
    </li>
    <li  class="active">
        <a href="#">Edit About Us</a>
    </li>
@endsection


@section('content')

    <div class="col-lg-12">
        <div class="portlet">
            <div class="portlet-body">

                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h1>
                            Edit About Us Page
                        </h1>

                        <p class="text-center text-info">
                            Here you can view how the current About Us page looks like and edit it as you like.
                            <br><br><br>
                            <button class="btn btn-success" data-toggle="modal" data-target="#editAboutUs">Edit About Us Page</button>
                        </p>

                        @if(session('status'))
                            <ul class="list-group text-center">
                                <li class="list-group-item list-group-item-success"><strong>{{ session('status') }}</strong></li>
                            </ul>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="text-center">
                        <iframe id="about" src="{{URL::to('about_us')}}" width="150%" height="1000px" style="margin-left:-25%; margin-top: -20%; display:block;-webkit-transform:scale(0.4);-moz-transform-scale(0.4);"></iframe>
                    </div>
                </div>



            </div>
        </div>
    </div>

    <div class="modal inmodal fade" id="editAboutUs" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Edit About Us Page</h4>

                </div>
                <form class="form-horizontal" id="edit" method="post" action="{{URL::to('admin_about_us_edit')}}" enctype="multipart/form-data">

                    <div class="modal-body">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label class="col-lg-3 control-label">
                                About Us Paragraph
                            </label>

                            <div class="col-lg-9">
                                <textarea rows="20" form="edit" placeholder="Main paragraph comes here" class="form-control" type="text" name="paragraph">{{old('paragraph')}}</textarea>
                                @if ($errors->has('paragraph')) <p class="text-danger">{{ $errors->first('paragraph') }}</p>@endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">
                                Banner Image
                            </label>

                            <div class="col-lg-9">
                                <input type="file" id="file" class="form-control" name="bannerImg" accept=".jpg, .jpeg, .png, image/*">
                                @if ($errors->has('bannerImg')) <p class="text-danger">{{ $errors->first('bannerImg') }}</p>@endif
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('js')

    <script>
        $('document').ready(function() {

            document.getElementById('siteAdmin').click();
            document.getElementById('AU').setAttribute('class','active');
        });
    </script>

    <script>
            @if(count($errors)>0){
            $('#editAboutUs').modal('show');
        }
        @endif
    </script>

    {{--Reloads the IFrame every 30 seconds--}}
    <script>
        window.setInterval("reloadIFrame();", 30000);
        function reloadIFrame() {
            document.frames["about"].location.reload();
        }
    </script>

    <script>
        var _URL = window.URL || window.webkitURL;

        $("#file").change(function(e) {
            var image, file;

            if ((file = this.files[0])) {
                image = new Image();
                image.onload = function() {
                    /*alert("The image width is " +this.width + " and image height is " + this.height);*/
                    if ((this.width>=795 && this.width <=805) ||(this.height>=195 && this.height <=205)) {
                        swal("This image is qualified", "", "success");
                    }
                    else {
                        swal("This file is not qualified.", "The dimensions of the image should be 795 x 200 ± 5 pixels", "error");
                    }
                };
                image.src = _URL.createObjectURL(file);
            }
        });
    </script>
@endsection