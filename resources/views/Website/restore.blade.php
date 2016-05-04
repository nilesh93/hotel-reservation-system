@extends('adminmaster')

@section('css')
@endsection


@section('title')
    Backup & Restore
@endsection


@section('page_title')
    Backup & Restore
@endsection


@section('page_buttons')

@endsection


@section('breadcrumbs')

    <li>
        <a href="#">Site Administration</a>
    </li>
    <li  class="active">
        <a href="#">Backup & Restore</a>
    </li>
@endsection


@section('content')
    <div class="col-lg-12">
        <div class="portlet">
            <div class="portlet-body">
                <div class="row">
                    <h1 class="text-danger text-center">Warning: This action can potentially break the whole application!</h1>
                    <p class="text-danger text-center">Proceed only if you are absolutely sure, otherwise press <b>Cancel</b>.</p>
                    <div class="col-md-2"> </div>
                    <div class="col-md-8">
                        <p class="text-info text-center">Incorrectly restoring the database to an earlier time can cause conflicts in the application. <br>Further it could lead to loss of data and proper functioning of the application.</p>
                    </div>
                    <div class="col-md-2"> </div>
                    <div class="row">
                        <div class="col-md-4"> </div>
                        <div class="col-md-4">
                            <p class="text-center text-warning">
                                Please enter your password to confirm this action :
                            </p>
                            <form role="form" method="post" action="{{URL::to('restore/auth')}}">
                                {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="pwd">Password:</label>
                                    <input type="password" class="form-control" name="password" id="password" required>
                                    <input type="hidden" name="serial_num" value="{{$serial_num}}">
                                </div>
                                <button type="submit" class="btn btn-danger">Proceed</button>
                                <button class="btn btn-warning" onclick='location.href="{{URL::to('get_backup')}}"'>Cancel</button>
                            </form>
                        </div>
                        <div class="col-md-4"> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')

@endsection