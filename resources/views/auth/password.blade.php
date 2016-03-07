@extends('webmaster')

@section('title')
    Password Reset
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

            <p class="text-info text-justify">If you have forgotten your password, just enter the email you used to sign in below and you are good to go.</p>

            <form role="form" method="POST" action="{{URL::to('/password/email')}}">
                {!! csrf_field() !!}

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul class="list-group list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li class="list-group-item-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('status'))
                    <div class="alert alert-success ">
                        <ul class="list-group list-unstyled">
                            <li class="list-group-item-success">{{ session('status') }}</li>
                        </ul>
                    </div>
                @endif

                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Your email" required>
                </div>

                <div>
                    <button class="btn btn-success" type="submit">Send Link</button>
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