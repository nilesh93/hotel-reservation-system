@extends('webmaster')

@section('title')
    Login
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
            <form role="form" method="post" action="{{URL::to('auth/login')}}">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="email">Email address:</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                    @if ($errors->has('email')) <p class="text-danger">{{ $errors->first('email') }}</p>@endif
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                    @if ($errors->has('email')) <p class="text-danger">{{ $errors->first('password') }}</p>@endif
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="remember"> Remember me</label>
                </div>
                <button type="submit" class="btn btn-success">Login</button>
                <p style="display: inline" class="text-info"> Or </p>
                <a href="{{URL::to('/login/fb')}}" class="text-info"><img src="{{URL::asset('FrontEnd/img/btn_facebook_login.png')}}" alt="Login with Facebook" height="37%" width="37%"></a>
                <a href="{{URL::to('password/email')}}" class="text-info">Forgot your password?</a>
            </form>



        </div>
        <div class="row">
            <div class="col-lg-12">
                <br>
            </div>
        </div>
    </div>
@endsection