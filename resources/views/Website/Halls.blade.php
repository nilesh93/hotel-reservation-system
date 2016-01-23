@extends('webmaster')





@section('title')

Function Halls

@endsection


@section('links')

		<!--Links for dropdowns-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>



<!-- These links the date picker-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>



@endsection

@section('css')


@endsection






@section('content')
	<div class="row">
		<div class="col-md-12">
			<section class="head-v1 left-sidebar">
				<img src="{{URL::asset('FrontEnd/img/Hall_images/function_halls.jpg')}}" width="100%">

				<section class="head-title">
					<h2>Function Halls </h2>
					<p><small>Modern, clean design and neutral tones slow the pace when you’re ready to unwind.</small></p>
				</section><!-- /head-title -->



				<a href="#" class="room-trigger"><i class="fa fa-calendar-o"></i> Check Availability</a>
				<div class="room-form">
					<span class="glyphicon glyphicon-remove"></span>
					<form class="form-group" action="#" method="Post">
						<div class="row">
							<div class="col-sm-8 col-md-12 col-lg-8">
								<select class="selectpicker" style="display: none;">
									<option>Hall Type</option>
									<option>Pool Side Ball Room</option>
									<option>Silver Ball Room</option>
									<option>Samro Reception</option>
									<option>Grand Ball Room</option>
								</select>
							</div><!-- /col-md-8 -->

						</div><!-- /row -->

						<br>

						<div class="row">

							<div class="col-sm-12 col-md-12 col-lg-12">

								<input type="date" class="form-control" id="datepicker" placeholder="Select the date" name="arrival" value="@if(session('arrival_date')){{ session('arrival_date') }} @else {{ old('arrival')}} @endif"/>
							</div><!-- /col-md-12 -->

						</div><!-- /row -->

						<br>


						<br>


						<br>

						<div class="row">

						</div><!-- /row -->
						<br>
						<button type="submit" class="btn btn-primary">Check Availability</button>
					</form> <!-- /room-form -->
				</div>
			</section>
		</div> <!-- /col-md-12 -->
	</div><!-- row -->

	<div class="row">
		<div class="col-md-12">
			<div class="container left-sidebar">

				<aside id="sidebar">
					<div class="widget widget-latest-posts">
						<h5>Latest Posts</h5>
						<ul>
							<li><a href="#">We’re Hiring: Digital Designer (Mobile/UX)</a></li>
							<li><a href="#">Attitude: Third WordPress Theme</a></li>
							<li><a href="#">Gravity giving away 5 iPhone</a></li>
							<li><a href="#">Get behind the scene of new WordPress</a></li>
						</ul>
					</div><!-- /widget-latest-posts -->
				</aside><section id="content">

					<h1>Function Halls</h1>

					<p>The projects consists of a vast suite of classic mid format celluloid film portraits of tribes people in the Omo Valley in southwest Ethiopia, near the Sudanese border, a grim and unforgiving, unaccessible roadless area which Claes Btritton has also visited, on a river expedition back in 1988.</p>

					<hr>

					<div class="row">

						<div class="col-sm-6 col-md-6 col-lg-6">
							<div class="roombox">
								<div class="room-image">
									<img src="{{URL::asset('FrontEnd/img/Hall_images/hall1.jpg')}}"  alt="themesgravity">
									<h4><a href="#">Pool Side Ball Room</a></h4>
								</div><!-- /room-image -->
								<div class="room-content">
									{{--<p class="room-price"><small>From 209$ per night</small></p>--}}
									<hr>
									<p>150 - 300 Seating Capacity</p>
								</div><!-- /room-content -->
							</div><!-- /roombox -->
						</div><!-- /col-sm-8 -->

						<div class="col-sm-6 col-md-6 col-lg-6">
							<div class="roombox">
								<div class="room-image">
									<img src="{{URL::asset('FrontEnd/img/Hall_images/hall2.jpg')}}"  alt="themesgravity">
									<h4><a href="#">Silver Ball Room</a></h4>
								</div><!-- /room-image -->
								<div class="room-content">
									{{--<p class="room-price"><small>From 209$ per night</small></p>--}}
									<hr>
									<p>150 - 300 Seating Capacity</p>
								</div><!-- /room-content -->
							</div><!-- /roombox -->
						</div><!-- /col-sm-8 -->

					</div><!-- /row -->


					<br><br>

					<div class="row">

						<div class="col-sm-6 col-md-6 col-lg-6">
							<div class="roombox">
								<div class="room-image">
									<img src="{{URL::asset('FrontEnd/img/Hall_images/hall3.jpg')}}"  alt="themesgravity">
									<h4><a href="#">Samro Reception</a></h4>
								</div><!-- /room-image -->
								<div class="room-content">
									{{--<p class="room-price"><small>From 209$ per night</small></p>--}}
									<hr>
									<p>150 - 300 Seating Capacity</p>
								</div><!-- /room-content -->
							</div><!-- /roombox -->
						</div><!-- /col-sm-8 -->

						<div class="col-sm-6 col-md-6 col-lg-6">
							<div class="roombox">
								<div class="room-image">
									<img src="{{URL::asset('FrontEnd/img/Hall_images/hall4.jpg')}}"  alt="themesgravity">
									<h4><a href="#">Grand Ball Room</a></h4>
								</div><!-- /room-image -->
								<div class="room-content">
									{{--<p class="room-price"><small>From 209$ per night</small></p>--}}
									<hr>
									<p>200 - 400 Seating Capacity</p>
								</div><!-- /room-content -->
							</div><!-- /roombox -->
						</div><!-- /col-sm-8 -->

					</div><!-- /row -->


				</section><!-- content -->
			</div>
		</div>
	</div>
	<br>
	<br>
	<br>
	<br>
	<br>
@endsection




@section('js')

<script>
	$("#datepicker").datepicker({
		dateFormat:'yy-mm-dd',
		minDate:0,
		changeMonth: true,
		changeYear: true,
		defaultDate:new Date(),


	});




	function hello(){
    
   alert("Refer the coding to see where javascript should be written you fucktard!"); 
    
    
}


</script>


@endsection