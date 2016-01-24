<!DOCTYPE html>
<html lang="en">

	<head>

		<title>@yield('title')</title>


		<!-- SEO -->
		<meta charset="utf-8">
		<meta name="keywords" content="">
		<meta name="description" content="">
		<meta name="author" content="">



		@yield('links')
		<!-- initializing looks -->
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Animate Styles -->
        <link rel="stylesheet" href="{{URL::asset('FrontEnd/css/vendor/animate.css')}}">

		<!-- Fonts -->
		<link href='http://fonts.googleapis.com/css?family=Playfair+Display|Sintony:400,700' rel='stylesheet' type='text/css'>

		<!-- Stylesheet -->
		 <link rel="stylesheet" href="{{URL::asset('FrontEnd/css/styles.css')}}">
		 <link rel="stylesheet" href="{{URL::asset('FrontEnd/css/font-awesome/css/font-awesome.min.css')}}">


		@yield('css')
		<!-- Custom Stylesheet == Make sure u put all ur css changes in this file == -->

		<!-- HTML5 shim, for IE6-8 support of HTML elements -->
		<!--[if lt IE 9]>
		  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- CUSTOM JavaScript so you can use jQuery or $ before it has been loaded in the footer. -->
		<script>(function(w,d,u){w.readyQ=[];w.bindReadyQ=[];function p(x,y){if(x=="ready"){w.bindReadyQ.push(y);}else{w.readyQ.push(x);}};var a={ready:p,bind:p};w.$=w.jQuery=function(f){if(f===d||f===u){return a}else{p(f)}}})(window,document)</script>

	</head>

	<body>
		<section id="wrapper">
			<header class="main-header header-v1">
				<div class="container">
					<div class="row">
						<div class="col-sm-4 col-md-4 col-lg-4">

							<a class="logo" href="" ><!-- check css to update logo --></a><img src="{{URL::asset('FrontEnd/img/amalya-logo.png')}}" alt=""><!-- /logo -->

						</div><!-- /4 columns -->

						<a class="nav-toggle pull-right"><i class="icon-menu"></i></a>

						<nav class="col-sm-12 clear" id="mobile-nav"></nav>
					
							<!-- weather widget -->
						<div class="col-sm-12 col-md-8 col-lg-8">

							<div class="elements">

								<!-- <div class="language element">
									<p>thank you lord</p>
								</div>-->

								<div class="weather element">
									<p><strong>SUNDAY</strong>, FEBRUARY 27 <i class="icon-sun-1"></i> 31&deg;C/88&deg;F</p>
								</div><!-- /weather -->

								<div class="header-info element">
									<div class="info">
										<p data-id="1"><strong>CALL US:</strong> 1-800-643-4300</p>
										<p data-id="2"><strong>ADDRESS:</strong> 176, Pivot Lane</p>
										<p data-id="3"><strong>EMAIL:</strong> support@themesgravity.com</p>
									</div><!-- /info -->
									<div class="triggers">
										<i data-id="1" class="icon-tablet-2"></i>
										<i data-id="2" class="icon-location"></i>
										<i data-id="3" class="icon-globe-3"></i>
									</div><!-- /triggers -->
								</div><!-- /header-info -->
							</div><!-- /elements -->

						</div><!-- /col-sm-8 -->

						<div class="col-sm-8 col-lg-offset-4 col-md-12 col-lg-8">
  <nav id="main-nav">
    <ul>
        <li><a href="#">Contact</a></li>
        <li><a href="#" >Blog</a>
          <ul>
            <li><a href="#">Blog Listing</a></li>
            <li><a href="#">Blog Post Left Sidebar</a></li>
            <!-- <li><a href="#">Blog Post Right Sidebar</a></li> -->
          </ul>
        </li>
        <li><a href="#">Shortcodes</a></li>
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
		<li><a href="{!! url('/halls') !!}">Halls</a></li>
        <li><a href="{!! url('/room_packages') !!}">Rooms</a>

        </li>

        <li><a href="#">Home</a>
          <ul>
            <li><a href="#">Home Version 1</a></li>
            <li><a href="#">Home Version 2</a></li>
            <li><a href="#">Home Version 3</a></li>
          </ul> 
        </li>
    </ul>
  </nav>
</div><!-- /8 columns -->

						</div><!-- /row -->
				</div><!-- /container -->
			</header><!-- /main-header -->

				
				

					<div class="container-fluid">
					@yield('content')
					</div>
				 
			<div class="footerbox" style="margin-top:1%">
				<div class="container">
					<div class="row">
						<div class="col-sm-3 col-md-3 col-lg-3">
							<form class="footerbox-subscribe">
								<input type="email" name="footerbox-subscribe" placeholder="Email Address" />
								<button type="submit"><i class="fa fa-chevron-right"></i></button>
							</form>
						</div><!-- /col-md-3 -->
						<div class="col-sm-3 col-md-3 col-lg-3">
							<div class="footerbox-social">
								<a href="#"><i class="fa fa-facebook"></i></a>
								<a href="#"><i class="fa fa-twitter"></i></a>
								<a href="#"><i class="fa fa-pinterest"></i></a>
								<a href="#"><i class="fa fa-google-plus"></i></a>
								<a href="#"><i class="fa fa-github"></i></a>
								<a href="#"><i class="fa fa-youtube"></i></a>
								<a href="#"><i class="fa fa-linkedin"></i></a>
							</div><!-- /footerbox-social -->
						</div><!-- /col-md-3 -->
						<div class="col-sm-6 col-md-6 col-lg-6">
							<div class="footercarousel carousel slide" id="footercarousel" data-ride="carousel">
								<div class="carousel-inner">

									<div class="item active">
										<i class="fa fa-calendar-o"></i><small class="date">AUGUST 26th</small>
										<h3>Experience Amalya Reach World of Hospitality</h3>
									</div><!-- /item -->

									<div class="item">
										<i class="fa fa-calendar-o"></i><small class="date">AUGUST 26th</small>
										<h3>Experience Amalya Reach World of Hospitality</h3>
									</div><!-- /item -->

									<div class="item">
										<i class="fa fa-calendar-o"></i><small class="date">AUGUST 26th</small>
										<h3>Experience Amalya Reach World of Hospitality</h3>
									</div><!-- /item -->

									<div class="item">
										<i class="fa fa-calendar-o"></i><small class="date">AUGUST 26th</small>
										<h3>Experience Amalya Reach World of Hospitality</h3>
									</div><!-- /item -->

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
							<p>Vivamus lacus libero, ultrices and well non ullamcorper as, tempus sit amer enim. Suspendisse at supermarket and semper ispum Suspeat all web design</p>
							<p>Vivamus lacus libero, ultrices and well non ullamcorper as, tempus sit amer enim.</p>
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
		<p>Bouler Street 19 New Jersersssey, USA 81000</p>
	</div><!-- /address -->

	<div class="phone">
		<i class="fa fa-phone"></i>
		<p>+382 20 389 268<br>+382 69 655 333</p>
	</div><!-- /phone -->

	<!-- <div class="time">
		<i class="fa fa-clock-o"></i>
		<p>08-16 hours<br>Monday - Friday</p>
	</div> -->

	<div class="email">
		<i class="fa fa-envelope-o"></i>
		<p>info@domain.com<br>sup@domain.com</p>
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
							<p class="copyright">&copy;2016 Amalya Reach - ThemesGravity. All Rights Reserved</p>
						</div><!-- /col-md-4 -->
					</div><!-- /row -->
				</div><!-- /container -->
			</div><!-- /copyright-section -->


		</section><!-- /wrapper -->

		<!-- jQuery -->
		<!-- <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script> -->
{{--

		<script src="{{URL::asset('FrontEnd/js/vendor/jquery-1.11.0.min.js')}}"></script>
--}}

		<!-- CUSTOM JavaScript so you can use jQuery or $ before it has been loaded in the footer. -->
{{--
		<script>(function($,d){$.each(readyQ,function(i,f){$(f)});$.each(bindReadyQ,function(i,f){$(d).bind("ready",f)})})(jQuery,document)</script>
--}}

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


		@yield('js')

	</body>
</html>

		
