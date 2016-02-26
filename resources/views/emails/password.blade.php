<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Playfair+Display|Sintony:400,700' rel='stylesheet' type='text/css'>

    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{URL::asset('FrontEnd/css/styles.css')}}">
    {{--<link rel="stylesheet" href="{{URL::asset('FrontEnd/css/font-awesome/css/font-awesome.min.css')}}">--}}

    <link rel="stylesheet" href="{{URL::asset('FrontEnd/dp/jquery-ui.css')}}">
</head>

<body style="background-color: #ffffff; background: none">
    <div class="row">
        <div class="col-md-2">
            <img src="<?php echo $message->embed('FrontEnd/img/amalya-logo.png'); ?>"><br><br><br>
        </div>
        <div class="col-md-10">
            <h1 style="display: inline" class="text-info">Amalya Reach Holiday Resorts</h1>
            <p class="text-muted">
                No:556, Moragahahena, Pitipana North, Homagama, Sri Lanka <br>

                +94 11 2748913 | info@amalyareach.com | http://amalyareachlk.com
            </p>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <p class="text-info">
                Hello, <br>
                We have received a request to reset the password associated with this email address. If you made this request,
                please follow the instructions below.<br>
                Click this link to reset your password. This will redirect you to a page where you can enter a new password.
                <br>This link will expire in one hour.<br><br>
                <a href="{{ url('password/reset/'.$token) }}">{{ url('password/reset/'.$token) }}</a><br><br>

                If you did not request to have your password reset, you may ignore this request. <br><br>

                Have a nice day!<br><br>

                -Amalya Reach Holiday Resort-

            </p>
        </div>
    </div>
</body>