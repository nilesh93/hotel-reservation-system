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
        <img src="{{URL::asset('FrontEnd/img/amalya-logo.png')}}"><br><br><br>
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
        <br>
        <p class="text-info">

           <b> <h2><?php echo $promo_name; ?></h2></b>
            <h4><?php echo $promo_desc; ?></h4>
            <h4>Promotion will be available from <?php echo $date_from; ?> to <?php echo $date_to; ?>. </h4>

            <h5><b>Have a nice day!</b></h5><br><br>

           <h5><b> -Amalya Reach Holiday Resort- </b></h5>

        </p>
    </div>
</div>
</body>