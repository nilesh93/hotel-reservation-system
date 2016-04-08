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
    {{--<div class="col-md-4 col-md-offset-8">
        <button type="button" class="btn btn-success waves-effect btn-block waves-light pull-right" onclick="backupNow()">
        <span class="btn-label pull-left"><i class="fa fa-plus"></i>
        </span>Backup Now</button>
    </div>--}}
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



                {{--@if(session('status'))
                    <ul class="list-group text-center">
                        <li class="list-group-item list-group-item-success"><strong>{{ session('status') }}</strong></li>
                    </ul>
                @endif
                @if(session('wrong_pass'))
                    <ul class="list-group text-center">
                        <li class="list-group-item list-group-item-success"><strong>{{ session('wrong_pass') }}</strong></li>
                    </ul>
                @endif--}}

            </div>
        </div>
    </div>
@endsection


@section('js')
@endsection