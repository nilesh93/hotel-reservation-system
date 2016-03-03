@extends('webmaster')

@section('title')
    Change Password
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
            <form role="form" id="password_reset" method="POST" action="{{URL::to('change_password')}}">
                {!! csrf_field() !!}
                @if (count($errors) > 0)
                    <ul class="list-group">
                        @foreach ($errors->all() as $error)
                            <li class="list-group-item text-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" class="form-control" name="password" required pattern="^.{6,}$" title="6 Characters minimum" placeholder="Password should be minimum 6 characters long">
                </div>

                <div class="form-group">
                    <label for="email">Confirm Password</label>
                    <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" required pattern="^.{6,}$" title="6 Characters minimum">
                </div>

                <div>
                    <button type="submit" class="btn btn-success">Change Password</button>
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

@section('js')
    <script>
        $('#password_reset').submit(function(evt) {
            if ($('#password').val() != $('#password_confirmation').val()) {
                var msg = "<div class='alert alert-danger'><ul class='list-group list-unstyled text-center'><li class='list-group-item-danger'>Passwords did not match.</li></ul></div>"
                $("#password_reset").before(msg);
                evt.preventDefault();
            }
        })
    </script>
@endsection