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
        <img src="{{URL::asset('FrontEnd/img/amalya-logo.png')}}"> <br><br><br>
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
    <div class="col-md-3">
        <br>
    </div>
    <div class="col-md-9">
        <h1>You have been temporarily blocked from the site</h1>
        <p class="text-info">

            We are sorry to inform you that have temporarily blocked from the site due to violation of the site user policy.<br>
            To unblock this account, or for further inquiry, please contact us through the site's <a href="{{URL::to('contact')}}">Contact Us</a> page.<br><br>

            -Amalya Reach Holiday Resort-

        </p>
    </div>
</div>
</body>