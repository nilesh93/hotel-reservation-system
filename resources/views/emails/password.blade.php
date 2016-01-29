@extends('webmaster')

@section('title')
    Create New Password
@endsection

@section('css')
@endsection

@section('content')
    <div class="row">
        <br>
        <div class="col-lg-6">
            <img src="{{URL::asset('FrontEnd/img/Amalayareach-pool.jpg')}}">
        </div>
        <div class="col-lg-6">
            <p class="text-info">Click below to reset your password:</p> <a href="{{ url('password/reset/'.$token) }}" class="btn btn-success">Reset Password</a>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <br>
            </div>
        </div>
    </div>
@endsection