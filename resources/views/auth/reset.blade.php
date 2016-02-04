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
            <form role="form" method="POST" action="{{URL::to('/password/reset')}}">
                {!! csrf_field() !!}
                <input type="hidden" name="token" value="{{ $token }}">

                @if (count($errors) > 0)
                    <ul class="list-group">
                        @foreach ($errors->all() as $error)
                            <li class="list-group-item text-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Your email">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" class="form-control" name="password" required placeholder="Password should be minimum 6 characters long">
                </div>

                <div class="form-group">
                    <label for="email">Confirm Password</label>
                    <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" required>
                </div>

                <div>
                    <button type="submit" class="btn btn-success">Reset Password</button>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <br>
            </div>
        </div>
    </div>
@endsection