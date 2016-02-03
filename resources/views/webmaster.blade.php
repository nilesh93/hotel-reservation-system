
<!DOCTYPE html>
<html lang="en">

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

		<!-- CUSTOM JavaScript so you can use jQuery or $ before it has been loaded in the footer. -->
	<!--	 <script>(function(w,d,u){w.readyQ=[];w.bindReadyQ=[];function p(x,y){if(x=="ready"){w.bindReadyQ.push(y);}else{w.readyQ.push(x);}};var a={ready:p,bind:p};w.$=w.jQuery=function(f){if(f===d||f===u){return a}else{p(f)}}})(window,document)</script> -->
	</head>

	<body>
		<section id="wrapper">
			<header class="main-header header-v1">
				<div class="container">
					<div class="row">
						<div class="col-sm-3 col-md-2 col-lg-2">

							<img align="center" src="{{URL::asset('FrontEnd/img/amalya-logo.png')}}" alt="" style=" background-size: 227px;"><!-- /logo -->

						</div><!-- /4 columns -->
						<div class="col-lg-10 col-md-10">
							<a class="nav-toggle pull-right"><i class="icon-menu"></i></a>

							<nav class="col-sm-12 clear" id="mobile-nav"></nav>

							<!-- weather widget -->
							<div class="col-sm-12 col-md-12 col-lg-12">

								<div class="elements pull-right">

									<!-- <div class="language element">
<p>thank you lord</p>
</div>-->

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

							<div class="col-sm-12   col-md-12 col-lg-12">
								<nav id="main-nav">
									<ul>
										@if(Auth::check())
										<li><a href="{{URL::to('auth/logout')}}">Log out</a></li>
										@else
										<li><a href="{{URL::to('auth/register')}}">Sign up</a></li>
										<li><a href="{{URL::to('auth/login')}}">Login</a>
											@endif
											{{--<ul>
											<li><a href="#">Blog Listing</a></li>
											<li><a href="#">Blog Post Left Sidebar</a></li>
											<!-- <li><a href="#">Blog Post Right Sidebar</a></li> -->
											</ul>--}}
										</li>

										<li><a href="{!! url('/contact') !!}">Contact Us</a></li>

										<li><a href="#">Pages</a>
											<ul>
												<li><a href="#">Typography</a></li>
												<li><a href="#">Gallery</a></li>
												<li><a href="#">Full Width Page</a></li>
												<li><a  href="#">Right Sidebar Page</a></li>
												<li><a href="#">left Sidebar Page</a></li>
												<li><a href="#">About</a></li>
											</ul>
										</li>
										<li><a href="#">Hotel</a></li>

										<li><a href="{!! url('/halls') !!}">Halls</a>
											<ul>

												@foreach($halls as $hall)
												<li><a onclick="showModal('{{$hall->hall_id}}hall')">{{ $hall->title }}</a></li>
												@endforeach
											</ul>
										</li>
										<li><a href="{!! url('/room_packages') !!}">Rooms</a>

											<ul>

												@foreach($roomtypes as $roomtype)
												<li><a onclick="showModal({{$roomtype->room_type_id}})">{{ $roomtype->type_name}}</a></li>
												@endforeach
											</ul>
										</li>

										<li><a href="{!! url('/') !!}">Home</a>
											<ul>
												<li><a href="#">Home Version 1</a></li>
												<li><a href="#">Home Version 2</a></li>
												<li><a href="#">Home Version 3</a></li>
											</ul> 
										</li>
									</ul>
								</nav>
							</div><!-- /8 columns -->


						</div>				</div><!-- /row -->
				</div><!-- /container -->
			</header><!-- /main-header -->



					<div class="container-fluid">
					@yield('content')


						<!-- room_type_modals_to _load_in_any_page-->
						@foreach($roomtypes as $room_type)

						<?php

							$image1 = DB::table('ROOM_IMAGES')
									->where('room_type_id','=',$room_type->room_type_id)
									->value('path');

							$images = DB::table('ROOM_IMAGES')
									->where('room_type_id','=',$room_type->room_type_id)
									->where('path','!=',$image1)
									->select('path')
									->get();


							$mealtypeRates = DB::table('RATES')
									->join('MEAL_TYPES','RATES.meal_type_id','=','MEAL_TYPES.meal_type_id')
									->where('RATES.room_type_id','=',$room_type->room_type_id)
									->select('MEAL_TYPES.meal_type_name','RATES.rate_code','RATES.single_rates')
									->get();




							?>

							<modal><!-- room -->
								<div class="modal fade" id="{{$room_type->room_type_id}}">
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="modal-header" style="background: cornsilk">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												<h3 class="modal-title" align="center">{{ $room_type->type_name }}</h3>
												<br>
											</div>
											<div class="modal-body">

												<slides>

													<div class="row">

														<div class="col-md-3">

															<h4 align="center">Furnishing and Fixtures</h4>

															<ul>
																<?php

																$token = strtok($room_type->services_provided, ";")

																?>
																<?php
																while($token != false)
																{
																	echo "<li >$token<br></li>";
																	$token = strtok(";");

																}
																?>
															</ul>
														</div>

														<div class="col-md-6">

															<br>
															<br>
															<br>
															<br>
															<br>
															<div class="carousel slide" id="carousel-{{$room_type->room_type_id}}">
																<div class="carousel-inner">

																	<div class="item active">
																		<img class="img-thumbnail" src="{{URL::asset($image1)}}" width="100%">

																	</div>

																	@foreach($images as $image)
																		<div class="item">
																			<img class="img-thumbnail"  src="{{URL::asset($image->path)}}" width="100%">
																			<div class="carousel-caption">
																				<h4>

																				</h4>
																				<p>

																				</p>
																			</div>
																		</div>
																	@endforeach

																</div>

																<a class="left carousel-control" href="#carousel-{{$room_type->room_type_id}}" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#carousel-{{$room_type->room_type_id}}" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
															</div>

														</div>

														<div class="col-md-3">

															<h4 align="center">Services</h4>

															<ul>
																<?php
																while($token != false)
																{
																	echo "<li >$token<br></li>";
																	$token = strtok(";");

																}
																?>
															</ul>
														</div>




													</div><!--/row -->
												</slides>
												<br>
												<services>

													<div class="row">
														<div class="col-md-4">


														</div>

														<div class="col-md-4">
														</div>

														<div class="col-md-4">
														</div>

													</div>
												</services>

											</div>



											<div class="modal-footer" style="background:cornsilk">

												<div class="row">

													<div class="col-md-4">

														<div align="center">
															<h4>Area</h4>

														</div>
													</div>

													<div class="col-md-4">

														<div align="center">
															<h4>Bed</h4>

														</div>
													</div>

													<div class="col-md-4">
														<div align="center">

															<h4>Rate</h4>

															@foreach($mealtypeRates as $mealtype)
																{{ $mealtype->meal_type_name }} from ${{ $mealtype->single_rates }}<br>

															@endforeach

														</div>
													</div>

												</div>
												<br>
												<div class="row">

													<div class="col-md-4">
														<div align="center">
															<h4>Extra Bed</h4>

														</div>

													</div>

													<div class="col-md-4">
														<div align="center">
															<h4>Chenk In</h4>
															14:00
														</div>
													</div>

													<div class="col-md-4">
														<div align="center">
															<h4 >Check Out</h4>
															12:00
														</div>
													</div>

												</div>
												<br>
												<br>
											</div>





										</div>
									</div>
								</div>
							</modal>
						@endforeach
				<!-- /room_type_modals-->


				<!-- halls modal -->
							@foreach($halls as $hall)


								<?php
									$himage1 = DB::table('HALL_IMAGES')
											->where('hall_id','=',$hall->hall_id)
											->value('path');

									$himages = DB::table('HALL_IMAGES')
											->where('hall_id','=',$hall->hall_id)
											->where('path','!=',$himage1)
											->select('path')
											->get();



								?>


								<modal><!-- room -->
									<div class="modal fade" id="{{$hall->hall_id}}hall">
										<div class="modal-dialog modal-lg">
											<div class="modal-content">
												<div class="modal-header" style="background: cornsilk">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h3 class="modal-title" align="center">{{ $hall->title }}</h3>
													<br>
												</div>
												<div class="modal-body">

													<slides>

														<div class="row">

															<div class="col-md-3">

																<h4 align="center">Furnishing and Fixtures</h4>

																<ul>
															<!--	<?php
																		/*
																	$token = strtok($room_type->services_provided, ";")

																	?>
																	<?php
																	while($token != false)
																	{
																		echo "<li >$token<br></li>";
																		$token = strtok(";");

																	} */
																	?> -->
																</ul>
															</div>

															<div class="col-md-6">

																<br>
																<br>
																<br>
																<br>
																<br>
																<div class="carousel slide" id="carousel-{{$hall->hall_id}}hall">
																	<div class="carousel-inner">
																		<div class="item active">
																			<img class="img-thumbnail"alt="Carousel Bootstrap First" src="{{URL::asset($himage1)}}" width="100%">
																			<!--	<div class="carousel-caption">
                                                                                    <h4>


                                                                                    </h4>
                                                                                    <p>

                                                                                    </p>
                                                                                </div> -->
																		</div>

																		@foreach($himages as $himage)
																			<div class="item">
																				<img class="img-thumbnail" alt="Carousel Bootstrap Second" src="{{URL::asset($himage->path)}}" width="100%">
																				<div class="carousel-caption">
																					<h4>

																					</h4>
																					<p>

																					</p>
																				</div>
																			</div>
																		@endforeach
																	</div>

																	<a class="left carousel-control" href="#carousel-{{$hall->hall_id}}hall" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#carousel-{{$hall->hall_id}}hall" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>

																</div>

															</div>

															<div class="col-md-3">

																<h4 align="center">Services</h4>

															<!--	<ul>
																	<?php
																		/*
																	while($token != false)
																	{
																		echo "<li >$token<br></li>";
																		$token = strtok(";");

																	}*/
																	?>
																</ul> -->
															</div>




														</div><!--/row -->
													</slides>
													<br>
													<services>

														<div class="row">
															<div class="col-md-4">


															</div>

															<div class="col-md-4">
															</div>

															<div class="col-md-4">
															</div>

														</div>
													</services>

												</div>



												<div class="modal-footer" style="background:cornsilk">

													<div class="row">

														<div class="col-md-4">

															<div align="center">
																<h4>Area</h4>

															</div>
														</div>

														<div class="col-md-4">

															<div align="center">
																<h4>Capacity</h4>
																{{ $hall->capacity_from }} - {{ $hall->capacity_to }}
															</div>
														</div>

														<div class="col-md-4">
															<div align="center">

																<h4>Rate</h4>


															</div>
														</div>

													</div>


												</div>





											</div>
										</div>
									</div>
								</modal>
							@endforeach


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

									@if($init == 0)

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
							<p>Amalya Reach resort situated in homagama on morgahahena road away from 26km from Colombo this hotel can be accommodate up to 750 guests on a function.</p>
							<p>Well trained staff to give you the best services to experience the difference with us</p>
						</div><!-- /col-md-3 -->
						<div class="col-sm-3 col-md-3 col-lg-3">
							<div class="widget widget-latest-posts">
								<h5>Latest Posts</h5>
								<ul>
									<li><a href="#">We’re Hiring: Digital Designer (Mobile/UX)</a></li>
									<li><a href="#">Attitude: Third WordPress Theme</a></li>
									<li><a href="#">Gravity giving away 5 iPhone</a></li>
									<li><a href="#">Get behind the scene of new WordPress</a></li>
								</ul>
							</div><!-- /widget-latest-posts -->
						</div><!-- /col-md-3 -->
						<div class="col-sm-3 col-md-3 col-lg-3">
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

								<!-- <div class="time">
<i class="fa fa-clock-o"></i>
<p>08-16 hours<br>Monday - Friday</p>
</div> -->

								<div class="email">
									<i class="fa fa-envelope-o"></i>
									<p>amalyareach@yahoo.com

									</p>
								</div><!-- /email -->

							</div><!-- /widget-contact -->
						</div><!-- /col-md-3 -->
						<div class="col-sm-3 col-md-3 col-lg-3">
							<div class="widget widget-newsletter">
								<h5>Newsletter</h5>

								<form method="get" action="#">
									<input type="text" name="name" placeholder="Your Name?">
									<input type="email" name="email" placeholder="Email Address">
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


<!-- <script src="{{URL::asset('FrontEnd/js/vendor/maplace.min.js')}}"></script>
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
		<script src=''></script>

		<!-- Newsletter Shortcode DEPENDANCY JS -->

		<script src="{{URL::asset('FrontEnd/js/vendor/classie.js')}}"></script>
		<script src="{{URL::asset('FrontEnd/js/vendor/modernizr.custom.js')}}"></script>

		<!-- Newsletter Shortcode main JS -->

		<script src="{{URL::asset('FrontEnd/js/vendor/newsletter.js')}}"></script>

		<!-- Owl Carousel Main Js File -->

		<script src="{{URL::asset('FrontEnd/js/vendor/owl.carousel.js')}}"></script>

		<!-- Sweet Alert -->
		<script src="{{URL::asset('FrontEnd/sweetalert/sweetalert.min.js')}}"></script>


		<script>
			function showModal(id){


				var temp = '#'+id;

				$(temp).modal('show');


			}
		</script>

		<script src="{{URL::asset('FrontEnd/js/jquery.simpleWeather.js')}}"></script>

		<script src="{{URL::asset('FrontEnd/js/sugar.js')}}"></script>

		<script src="{{URL::asset('FrontEnd/js/weather.js')}}"></script>

		<script>

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
		</script>


		@yield('js')




	</body>
</html>


