<!DOCTYPE html>
<html lang="en">
<?php date_default_timezone_set("Asia/Colombo");  ?>
<head>

	<title>@yield('title')</title>

	<!-- SEO -->
	<meta charset="utf-8">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<meta name="author" content="">

	<?php

	$roomtypes = DB::table('ROOM_TYPES')->get();
	$halls = DB::table('HALLS')->get();

	?>
			<!-- initializing looks -->
	<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Animate Styles -->
	<link rel="stylesheet" href="{{URL::asset('FrontEnd/css/vendor/animate.css')}}">

	<!-- Sweet  Alert -->
	<link rel="stylesheet" href="{{URL::asset('FrontEnd/sweetalert/sweetalert.css')}}">

	<!-- Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Playfair+Display|Sintony:400,700' rel='stylesheet' type='text/css'>

	<!-- Stylesheet -->
	<link rel="stylesheet" href="{{URL::asset('FrontEnd/css/styles.css')}}">
	<link rel="stylesheet" href="{{URL::asset('FrontEnd/css/font-awesome/css/font-awesome.min.css')}}">

	<link rel="stylesheet" href="{{URL::asset('FrontEnd/dp/jquery-ui.css')}}">

	@yield('links')
	@yield('css')
			<!-- Custom Stylesheet == Make sure u put all ur css changes in this file == -->

	<!-- HTML5 shim, for IE6-8 support of HTML elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

</head>

<body>
<section id="wrapper">
	<header class="main-header header-v1">
		<div class="container">
			<div class="row">

				<div class="col-sm-2 col-md-2 col-lg-2">
					<img align="center" src="{{URL::asset('FrontEnd/img/amalya-logo.png')}}" alt="" style=" background-size: 227px;"><!-- /logo -->
				</div><!-- /4 columns -->

				<div class="col-lg-10 col-md-10">
					<a class="nav-toggle pull-right"><i class="icon-menu"></i></a>

					<nav class="col-sm-12 clear" id="mobile-nav"></nav>

					<!-- weather widget -->
					<div class="col-sm-12 col-md-12 col-lg-12">
						<div class="elements pull-right">

							<div class="weather element">
								<p id="deg"><strong> {{strtoupper(date('l'))}}</strong>, {{strtoupper(date('F'))}}  {{date('d')}} <i id="weatherid" class=""></i> </p>
							</div><!-- /weather -->

							<div class="header-info element">
								<div class="info">
									<p data-id="1"><strong>CALL US:</strong> +94 114404040 / +94 114368291</p>
									<p data-id="2"><strong>ADDRESS:</strong>No.556,
										Moragahahena Road, Pitipana North,
										Homagama.</p>
									<p data-id="3"><strong>EMAIL:</strong> amalyareach@yahoo.com</p>
								</div><!-- /info -->
								<div class="triggers">
									<i data-id="1" class="icon-tablet-2"></i>
									<i data-id="2" class="icon-location"></i>
									<i data-id="3" class="icon-globe-3"></i>
								</div><!-- /triggers -->
							</div><!-- /header-info -->

						</div><!-- /elements -->
					</div><!-- /col-sm-8 -->
				</div>
			</div><!-- /row -->

			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12" style="margin-left: -50px">

					<nav id="main-nav">
						<ul>

							@if(Auth::check())
								<li><a href="#">My Account</a>
									<ul>
										<li><a href="{{ URL::to('profile') }}">My Details</a></li>
										<li><a href="{{ URL::to('change_password') }}">Change Password</a></li>
										<li><a href="{{ URL::to('auth/logout') }}">Log out</a></li>
									</ul>
								</li>
							@else
								<li><a href="{{URL::to('auth/register')}}">Register</a></li>
								<li><a href="{{URL::to('auth/login')}}">Login</a></li>
							@endif

							@if(Auth::check())
								<li><a href="{!! url('/myreserv') !!}">My Reservations</a></li>
							@endif


							<li><a href="{!! url('/contact') !!}">Contact Us</a></li>
							<li><a href="gallery">Gallery</a></li><li><a href="menu">Menus</a></li>

							<li><a href="{!! url('/halls') !!}">Halls</a>
								<ul>

									@foreach($halls as $hall)
										<li><a onclick="viewHall('{{$hall->hall_id}}','{{ $hall->title }}','{{$hall->capacity_from}}','{{ $hall->capacity_to }}')">{{ $hall->title }}</a></li>
									@endforeach

								</ul>
							</li>

							<li><a href="{!! url('/room_packages') !!}">Rooms</a>
								<ul>
									@foreach($roomtypes as $roomtype)
										<li><a onclick="viewRoomType('{{$roomtype->room_type_id}}','{{$roomtype->type_name}}')">{{ $roomtype->type_name}}</a></li>
									@endforeach
								</ul>
							</li>

							<li><a href="{!! url('/') !!}">Home</a></li>

						</ul>
					</nav>

				</div><!-- /8 columns -->
			</div>

		</div><!-- /container -->
	</header><!-- /main-header -->

	{{--This flash message is displayed if a customer tries to access admin area--}}
	<br>
	<div class="row">
		<div class="col-md-3">  </div>
		<div class="col-md-6">
			@if(session('noAccess'))
				<ul class="list-group text-center">
					<li class="list-group-item list-group-item-warning"><strong>{{ session('noAccess') }}</strong></li>
				</ul>
			@endif

			{{--This flash message is displayed when a fb login registration has been completed--}}
			@if(session('success'))
				<ul class="list-group text-center">
					<li class="list-group-item list-group-item-success">{{session('success')}}</li>
				</ul>
			@endif
		</div>
		<div class="col-md-3">  </div>
	</div>

	<div class="container-fluid">
		@yield('content')

		{{--This flash message is displayed if a customer tries to access admin area--}}
	{{--	@if(session('noAccess'))
			<ul class="list-group text-center">
				<li class="list-group-item list-group-item-warning"><strong>{{ session('noAccess') }}</strong></li>
			</ul>
		@endif
		--}}{{--This flash message is displayed when a fb login registration has been completed--}}{{--
		@if(session('success'))
			<ul class="list-group text-center">
				<li class="list-group-item list-group-item-success">{{session('success')}}</li>
			</ul>
			@endif
--}}


					<!-- room_type_modals_to _load_in_any_page-->
			<modal><!-- room -->
				<div class="modal fade" id="room_modal">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">

							<div class="modal-header" style="background: cornsilk">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h3 class="modal-title" align="center"><div id="room_title"></div></h3>
								<br>
							</div>

							<div class="modal-body">

								<slides>
									<div class="row">

										<div class="col-md-3">
											<h4 align="center">Furnishing and Fixtures</h4>
											<ul>
												<div id="room_furnishes">
												</div>
											</ul>
										</div>

										<div class="col-md-6">
											<br><br><br><br><br>

											<div class="carousel slide" id="carousel-room_modal">


											</div>

										</div>

										<div class="col-md-3">
											<h4 align="center">Services</h4>
											<ul>
												<div id="room_services">

												</div>
											</ul>
										</div>

									</div><!--/row -->
								</slides>
								<br>

								<div class="row">
									<div align="center">
										<b>$</b> - Additional Charges Apply
									</div>
								</div>

							</div>

							<div class="modal-footer" style="background:cornsilk">

								<div class="row">

									<div class="col-md-4">
										<div align="center">
											<h4>Check In</h4>
											14:00
										</div>
									</div>

									<div class="col-md-4">
										<div align="center">
											<h4 >Check Out</h4>
											12:00
										</div>
									</div>

									<div class="col-md-4">
										<div align="center">
											<h4>Rate</h4>
											<ul>
												<div id="room_rates">

												</div>
											</ul>
										</div>

									</div>

								</div>

							</div>

						</div>
					</div>
				</div>
			</modal><!-- /room_type_modals-->

			<!-- halls modal -->

			<modal><!-- halls -->
				<div class="modal fade" id="hall_modal">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">

							<div class="modal-header" style="background: cornsilk">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h3 class="modal-title" align="center"><div id="hall_title"> </div></h3>
								<br>
							</div>

							<div class="modal-body">
								<div class="row">

									<div class="col-md-3">
										<h4 align="center">Services<br>(Free of Charge) </h4>
										<div id="hall_services">
											<!--ajax call-->
										</div>
									</div>

									<slides>
										<div class="col-md-6">
											<br><br><br>

											<div class="carousel slide" id="carousel-hall_modal">

											</div>
										</div>
									</slides>

									<div class="col-md-3">
										<h4 align="center">Services<br>(Additional Charges) </h4>
										<ul>
											<div id="aservices">
											</div>
										</ul>
									</div>

								</div><!--/row -->
								<br>
							</div>

							<div class="modal-footer" style="background:cornsilk">

								<div class="row">
									<div class="col-md-6">
										<div align="center">
											<h4>Rates</h4>
											<div id="hall_rates">

											</div>
										</div>
									</div>

									<div class="col-md-6">
										<div align="center">
											<h4>Capacity</h4>
											<div id="hall_capacity">  </div>
										</div>
									</div>

								</div>

							</div>
						</div>
					</div>
				</div>
			</modal>

	</div>




	<div class="footerbox" style="margin-top:1%">
		<div class="container">
			<div class="row">

				<div class="col-sm-2 col-md-2 col-lg-2">
					<div class="footerbox">
						<h3 style="margin-top:7%" class="date">PROMOTIONS</h3>
					</div><!-- /footerbox-social -->
				</div><!-- /col-md-3 -->
				<div class="col-sm-10 col-md-10 col-lg-10">
					<div class="footercarousel carousel slide" id="footercarousel" data-ride="carousel">
						<div class="carousel-inner">

							<?php $promotions = DB::table('PROMOTIONS')
									->where('date_from','<',date('Y-m-d'))
									->where('date_to','>',date('Y-m-d'))
									->get();



							$init = 0;
							?>


							@foreach($promotions as $p)

								@if($init == 0 )

									<div class="item active">

										<div class="col-md-6">
											<i class="fa fa-calendar-o"></i><small class="date">AUGUST 26th</small>
											<h4 class=" ">


												{{$p->promotion_name}}
											</h4>
										</div>
										<div class="col-md-6" style="border-left:#517693 1px solid">
											{{$p->promotion_description}}
										</div>
									</div>
								@else
									<div class="item  ">

										<div class="col-md-6">
											<i class="fa fa-calendar-o"></i><small class="date">AUGUST 26th</small>
											<h4 class=" ">


												{{$p->promotion_name}}
											</h4>
										</div>
										<div class="col-md-6" style="border-left:#517693 1px solid">
											{{$p->promotion_description}}
										</div>
									</div>

								@endif



								<?php $init++; ?>
							@endforeach

							@if(empty($promotions))

								<div class="item active">



									<h3 class=" date">

										Sorry No Promotions Avaialable at the moment. Please visit again later to see new promotions.

									</h3>

								</div>

							@endif


						</div><!-- /carousel-inner -->
						<a class="footercarousel-controls top" href="#">
							<i class="fa fa-bars"></i>
						</a>
						<a class="footercarousel-controls" href="#footercarousel" data-slide="prev">
							<i class="fa fa-chevron-down"></i>
						</a>
					</div><!-- /footercarousel -->
				</div><!-- /col-md-6 -->
			</div><!-- /row -->
		</div><!-- /container -->
	</div><!-- /footerbox -->

	<footer id="footer">
		<div class="container">
			<div class="row">
				<div class="col-sm-3 col-md-3 col-lg-3">
					<img src="{{URL::asset('FrontEnd/img/amalya-logo.png')}}" alt="">
					<br>
					<br>
					<p style="word-wrap: break-word;">Amalya Reach resort situated in homagama on morgahahena road away from 26km from Colombo this hotel can be accommodate up to 750 guests on a function.</p>
					<p style="word-wrap: break-word;">Well trained staff to give you the best services to experience the difference with us</p>
				</div><!-- /col-md-3 -->
				<!-- /col-md-3 -->
				<div class="col-sm-4 col-md-4 col-lg-4">
					<div class="widget widget-contact">
						<h5>Contact</h5>

						<div class="address">
							<i class="fa fa-home"></i>
							<p>No.556, Moragahahena Road, Pitipana North, Homagama.

							</p>
						</div><!-- /address -->

						<div class="phone">
							<i class="fa fa-phone"></i>
							<p>+94 114404040 <br> +94 114368291

							</p>
						</div><!-- /phone -->



						<div class="email">
							<i class="fa fa-envelope-o"></i>
							<p>amalyareach@yahoo.com

							</p>
						</div><!-- /email -->

					</div><!-- /widget-contact -->
				</div><!-- /col-md-3 -->
				<div class="col-sm-5 col-md-5 col-lg-5">
					<div class="widget widget-newsletter">
						<h5>Write a review</h5>

						<form method="get" action="#">
							<input type="text" name="rname" placeholder="Your Name?">
							<textarea class="form-control" name="rtext" placeholder="What do you have to say?"></textarea>
							<a type="button" class="btn btn-primary">Submit</a>
						</form>

					</div><!-- /widget-newsletter -->

				</div><!-- /col-md-3 -->
			</div><!-- /row -->
		</div><!-- /container -->
	</footer><!-- /main-footer -->

	<div class="copyright-section">
		<div class="container">
			<div class="row">
				<div class="col-sm-3 col-md-3 col-lg-3">
					<div class="footer-social">
						<a href="#"><i class="fa fa-facebook"></i></a>
						<a href="#"><i class="fa fa-twitter"></i></a>
						<a href="#"><i class="fa fa-pinterest"></i></a>
						<a href="#"><i class="fa fa-google-plus"></i></a>
						<a href="#"><i class="fa fa-github"></i></a>
						<a href="#"><i class="fa fa-youtube"></i></a>
						<a href="#"><i class="fa fa-linkedin"></i></a>
					</div><!-- /footer-social -->
				</div><!-- /col-md-3 -->
				<div class="col-sm-5 col-md-5 col-lg-5">
					<nav class="footer-nav">
						<ul>
							<li><a href="#">Home</a></li>
							<li><a href="#">About Us</a></li>
							<li><a href="#">Careers</a></li>
							<li><a href="#">FAQ</a></li>
							<li><a href="#">Widgets</a></li>
							<li><a href="#">Contact Us</a></li>
						</ul>
					</nav>
				</div><!-- /col-md-5 -->
				<div class="col-sm-4 col-md-4 col-lg-4">
					<p class="copyright">&copy;{{date('Y')}} Amalya Reach </p>
				</div><!-- /col-md-4 -->
			</div><!-- /row -->
		</div><!-- /container -->
	</div><!-- /copyright-section -->


</section><!-- /wrapper -->




<!-- jQuery -->
<script src="{{URL::asset('FrontEnd/js/vendor/jquery-1.11.0.min.js')}}"></script>
<script src="{{URL::asset('FrontEnd/dp/jquery-ui.js')}}"></script>

<!-- CUSTOM JavaScript so you can use jQuery or $ before it has been loaded in the footer. -->

<!-- Google Maps Plugin -->
<!--	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=geometry"></script>

<!-- Bootstrap JavaScript -->
<script src="{{URL::asset('FrontEnd/bootstrap/js/bootstrap.min.js')}}"></script>

<!-- Custom Bootstrap Select Dropdown Javascript -->
<script src="{{URL::asset('FrontEnd/js/vendor/bootstrap-select.min.js')}}"></script>

<!-- Custom Bootstrap Datepicker Javascript -->
<script src="{{URL::asset('FrontEnd/js/vendor/picker.js')}}"></script>
<script src="{{URL::asset('FrontEnd/js/vendor/picker.date.js')}}"></script>

<!-- Main JavaScript File for the theme -->
<script src="{{URL::asset('FrontEnd/js/scripts.js')}}"></script>

<!-- Shortcodes JavaScript File for the theme -->
<script src="{{URL::asset('FrontEnd/js/shortcodes.js')}}"></script>

<!-- widgets/footer-widgets JavaScript File for the theme -->
<script src="{{URL::asset('FrontEnd/js/widgets.js')}}"></script>

<!-- Newsletter Shortcode DEPENDANCY JS -->
<script src="{{URL::asset('FrontEnd/js/vendor/classie.js')}}"></script>
<script src="{{URL::asset('FrontEnd/js/vendor/modernizr.custom.js')}}"></script>

<!-- Newsletter Shortcode main JS -->
<script src="{{URL::asset('FrontEnd/js/vendor/newsletter.js')}}"></script>

<!-- Owl Carousel Main Js File -->
<script src="{{URL::asset('FrontEnd/js/vendor/owl.carousel.js')}}"></script>

<!-- Sweet Alert -->
<script src="{{URL::asset('FrontEnd/sweetalert/sweetalert.min.js')}}"></script>

<script src="{{URL::asset('FrontEnd/js/jquery.simpleWeather.js')}}"></script>
<script src="{{URL::asset('FrontEnd/js/sugar.js')}}"></script>
<script src="{{URL::asset('FrontEnd/js/weather.js')}}"></script>

<script>

	function showModal(id){
		var temp = '#'+id;
		$(temp).modal('show');
	}


	$('document').ready(function(){

		var myLatLng = {lat:6.840172, lng: 80.020895};

		Weather.getCurrent("colombo", function(current) {
			console.log(current.data.list[0].weather[0].main );

			if(current.data.list[0].weather[0].main == "Rain"){
				document.getElementById("weatherid").removeAttribute("class","");
				document.getElementById("weatherid").setAttribute("class","icon-rain-1");

			}else if(current.data.list[0].weather[0].main == "Clouds"){

				document.getElementById("weatherid").removeAttribute("class","");
				document.getElementById("weatherid").setAttribute("class","icon-cloud-1");
			}
			else{

				document.getElementById("weatherid").removeAttribute("class","");
				document.getElementById("weatherid").setAttribute("class","icon-sun-1");
			}
		});

		Weather.getForecast("colombo", function(forecast) {
			console.log("Forecast High in Kelvin: " + forecast.high());
			console.log("Forecast High in Fahrenheit" + Weather.kelvinToFahrenheit(forecast.high()));
			console.log("Forecast High in Celsius" + Weather.kelvinToCelsius( forecast.high() ));

			var F = Math.ceil(Weather.kelvinToFahrenheit(forecast.high()));
			var C = Math.ceil(Weather.kelvinToCelsius(forecast.high()));
			document.getElementById("deg").innerHTML += C+"&deg;C/"+F+"&deg;F";
		});
	});


	<!---hall modal view using ajax-->
	function viewHall(id,title,capa_from,capa_to)
	{
		$.ajax({
			type:"get",
			url :"hall_view",
			data:{
				'hall_id':id
			},
			success:function(data){

				var services = "";

				for (var i = 0; i < data.services.length; i++) {
					services +='<li>'+data.services[i].name +'</li>';
				}

				document.getElementById('hall_services').innerHTML = services;

				var image_active ='<div id="hall_slide" class="carousel-inner">' +
						'<div class="item active"><img class="img-thumbnail" alt="Carousel Bootstrap First" src="'+data.himage1+'" width="100%"></div>';

				var hall_images = "";

				for (var i = 0; i < data.himages.length; i++) {
					hall_images +=  '<div class="item">'+
							'<img class="img-thumbnail" alt="Carousel Bootstrap Second" src="'+data.himages[i].path+'" width="100%">'+
							'<div class="carousel-caption">'+
							'</div>'+
							'</div>';
				}

				var end = '<a class="left carousel-control" href="#carousel-hall_modal" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#carousel-hall_modal" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>'

				document.getElementById('carousel-hall_modal').innerHTML = image_active+hall_images+'</div>'+end;

				var aservices = "";

				for (var i = 0; i < data.aservices.length; i++) {

					aservices +='<li>'+data.aservices[i].name +'-Rs.'+formatNumber(data.aservices[i].rate)+'</li>';
				}

				document.getElementById('aservices').innerHTML = aservices;

				var hall_rates = 'Advance Payment : Rs.'+formatNumber(data.advance)+'<br>'+
						' Refundable : Rs.'+formatNumber(data.refundable);

				document.getElementById('hall_rates').innerHTML = hall_rates;

				document.getElementById('hall_title').innerHTML = title;

				document.getElementById('hall_capacity').innerHTML = capa_from +' - '+capa_to;



				$('#hall_modal').modal('show');

			},
			error: function(xhr, ajaxOptions, thrownError) {

				console.log(thrownError);
				swal("Ooops!", "Something Went Wrong! ("+thrownError+")", "error");
			}
		});
	}

	function viewRoomType(id,name)
	{
		$.ajax({
			type:"get",
			url :"room_view",
			data:{
				'room_id':id
			},
			success:function(data){


				document.getElementById('room_title').innerHTML = name;

				var room_furnishes = "";

				for (var i = 0; i < data.room_furnishes.length; i++) {

					room_furnishes +='<li>'+data.room_furnishes[i].name +'</li>';
				}

				document.getElementById('room_furnishes').innerHTML = room_furnishes;


				var room_services = "";

				for (var i = 0; i < data.room_services.length; i++) {

					room_services +='<li>'+data.room_services[i].name +'</li>';
				}

				document.getElementById('room_services').innerHTML = room_services;



				var image_active ='<div id="room_slide" class="carousel-inner">' +
						'<div class="item active" id="room_image_active"><img class="img-thumbnail" alt="Carousel Bootstrap First" src="'+data.rimage1+'" width="100%"></div>';

				var room_images = "";

				for (var i = 0; i < data.rimages.length; i++) {
					room_images +=  '<div class="item">'+
							'<img class="img-thumbnail" alt="Carousel Bootstrap Second" src="'+data.rimages[i].path+'" width="100%">'+
							'<div class="carousel-caption">'+
							'</div>'+
							'</div>';
				}


				var end = '<a class="left carousel-control" href="carousel-room_modal" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#carousel-room_modal" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>'

				document.getElementById('carousel-room_modal').innerHTML = image_active+room_images+'</div>'+end;

				var room_rates = "";

				for (var i = 0; i < data.room_rates.length; i++) {

					room_rates += data.room_rates[i].meal_type_name+'- Rs.'+formatNumber(data.room_rates[i].single_rates)+'<br>';
				}

				document.getElementById('room_rates').innerHTML = room_rates;



				$('#room_modal').modal('show');

			},
			error: function(xhr, ajaxOptions, thrownError) {

				console.log(thrownError);
				swal("Ooops!", "Something Went Wrong! ("+thrownError+")", "error");
			}
		});

	}

	//function to format currency
	function formatNumber(number)
	{
		number = number.toFixed(2) + '';
		x = number.split('.');
		x1 = x[0];
		x2 = x.length > 1 ? '.' + x[1] : '';
		var rgx = /(\d+)(\d{3})/;
		while (rgx.test(x1)) {
			x1 = x1.replace(rgx, '$1' + ',' + '$2');
		}
		return x1 + x2;
	}
</script>

@yield('js')

</body>
</html>