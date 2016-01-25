@extends('webmaster')





@section('title')

DEMO PAGE

@endsection

@section('links')

		<!--Links for dropdowns-->
<script src="{{URL::asset('FrontEnd/js/vendor/jquery-1.11.0.min.js')}}"></script>



<!-- These links the date picker-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>





@endsection


@section('css')


@endsection






@section('content')

	<input type="date" id="datepicker" placeholder="Select the date" name="arrival" value="@if(session('arrival_date')){{ session('arrival_date') }} @else {{ old('arrival')}} @endif"/>

	<div class="row">

<div class="col-md-4" id="">
								<div class="widget widget-search-form">
	<h5>Search Form</h5>

	<form role="search" method="get">
	    <input type="text" name="s" placeholder="Search..">
	    <button type="submit"><span class="glyphicon glyphicon-search"></span></button>
	</form>

</div><!-- /widget-search-form -->

								<div class="widget widget-advertisement">
	<h5>Advertisement</h5>
		<a href="#" class="ad-img"><img src="FrontEnd/img/preview-images/ad_campari.jpg" alt="themesgravity"></a>
		<a href="#" class="ad-link"><small>Advertise with us!</small></a>
</div><!-- /widget-advertisement -->
								<div class="widget widget-projects">

	<h5>Hotel Projects</h5>

	<div id="web-design" class="carousel slide carousel-active" data-ride="carousel">

	  <!-- Wrapper for slides -->
	  <div class="carousel-inner">

	    <div class="item active">
	      <img src="FrontEnd/img/preview-images/widgets_03.jpg" alt="themesgravity">
	      <h4>Web Design</h4>
	      <!-- <p class="project-category">Web Design</p> -->
	    </div><!-- /item -->

	    <div class="item">
	      <img src="FrontEnd/img/preview-images/widgets_04.jpg" alt="themesgravity">
	      <h4>Web Design</h4>
	      <!-- <p class="project-category">Web Design</p> -->
	    </div><!-- /item -->

	    <div class="item">
	      <img src="FrontEnd/img/preview-images/widgets_05.jpg" alt="themesgravity">
	      <h4>Web Design</h4>
	      <!-- <p class="project-category">Web Design</p> -->
	    </div><!-- /item -->

	  </div><!-- /carousel-inner -->

	  <!-- Controls -->
	  <div class="controls">
		  <a class="control" href="#web-design" data-slide="prev">
	      	<span class="glyphicon glyphicon-chevron-left"></span>
	  	  </a>
	  	  <a class="center control" href="#">
	      	<i class="fa fa-bars"></i>
	  	  </a>
		  <a class="right control" href="#web-design" data-slide="next">
		    <span class="glyphicon glyphicon-chevron-right"></span>
		  </a>
	  </div><!-- /controls -->

	</div><!-- /carousel -->

	<div id="uiux" class="carousel slide" data-ride="carousel">

	  <!-- Wrapper for slides -->
	  <div class="carousel-inner">

	    <div class="item active">
	      <img src="FrontEnd/img/preview-images/widgets_06.jpg" alt="themesgravity">
	      <h4>UI/UX</h4>
	      <!-- <p class="project-category">UI/UX</p> -->
	    </div><!-- /item -->

	    <div class="item">
	      <img src="FrontEnd/img/preview-images/widgets_09.jpg" alt="themesgravity">
	      <h4>UI/UX</h4>
	      <!-- <p class="project-category">UI/UX</p> -->
	    </div><!-- /item -->

	    <div class="item">
	      <img src="FrontEnd/img/preview-images/widgets_10.jpg" alt="themesgravity">
	      <h4>UI/UX</h4>
	      <!-- <p class="project-category">UI/UX</p> -->
	    </div><!-- /item -->

	  </div><!-- /carousel-inner -->

	  <!-- Controls -->
	  <div class="controls">
		  <a class="control" href="#uiux" data-slide="prev">
	      	<span class="glyphicon glyphicon-chevron-left"></span>
	  	  </a>
	  	  <a class="center control" href="#">
	      	<i class="fa fa-bars"></i>
	  	  </a>
		  <a class="right control" href="#uiux" data-slide="next">
		    <span class="glyphicon glyphicon-chevron-right"></span>
		  </a>
	  </div><!-- /controls -->

	</div><!-- /carousel -->

	<div id="illustrations-production" class="carousel slide" data-ride="carousel">

	  <!-- Wrapper for slides -->
	  <div class="carousel-inner">

	    <div class="item">
	      <img src="FrontEnd/img/preview-images/widgets_05.jpg" alt="themesgravity">
	      <h4>Illustrations</h4>
	      <!-- <p class="project-category">Illustrations Production</p> -->
	    </div><!-- /item -->

	    <div class="item">
	      <img src="FrontEnd/img/preview-images/widgets_06.jpg" alt="themesgravity">
	      <h4>Illustrations</h4>
	      <!-- <p class="project-category">Illustrations Production</p> -->
	    </div><!-- /item -->

	    <div class="item active">
	      <img src="FrontEnd/img/preview-images/widgets_10.jpg" alt="themesgravity">
	      <h4>Illustrations</h4>
	      <!-- <p class="project-category">Illustrations Production</p> -->
	    </div><!-- /item -->

	  </div><!-- /carousel-inner -->

	  <!-- Controls -->
	  <div class="controls">
		  <a class="control" href="#illustrations-production" data-slide="prev">
	      	<span class="glyphicon glyphicon-chevron-left"></span>
	  	  </a>
	  	  <a class="center control" href="#">
	      	<i class="fa fa-bars"></i>
	  	  </a>
		  <a class="right control" href="#illustrations-production" data-slide="next">
		    <span class="glyphicon glyphicon-chevron-right"></span>
		  </a>
	  </div><!-- /controls -->

	</div><!-- /carousel -->

	<div id="editorial-design" class="carousel slide" data-ride="carousel">

	  <!-- Wrapper for slides -->
	  <div class="carousel-inner">

	    <div class="item">
	      <img src="FrontEnd/img/preview-images/widgets_09.jpg" alt="themesgravity">
	      <h4>Editorial Design</h4>
	      <!-- <p class="project-category">Editorial Design</p> -->
	    </div><!-- /item -->

	    <div class="item">
	      <img src="FrontEnd/img/preview-images/widgets_04.jpg" alt="themesgravity">
	      <h4>Editorial Design</h4>
	      <!-- <p class="project-category">Editorial Design</p> -->
	    </div><!-- /item -->

	    <div class="item active">
	      <img src="FrontEnd/img/preview-images/widgets_03.jpg" alt="themesgravity">
	      <h4>Editorial Design</h4>
	      <!-- <p class="project-category">Editorial Design</p> -->
	    </div><!-- /item -->

	  </div><!-- /carousel-inner -->

	  <!-- Controls -->
	  <div class="controls">
		  <a class="control" href="#editorial-design" data-slide="prev">
	      	<span class="glyphicon glyphicon-chevron-left"></span>
	  	  </a>
	  	  <a class="center control" href="#">
	      	<i class="fa fa-bars"></i>
	  	  </a>
		  <a class="right control" href="#editorial-design" data-slide="next">
		    <span class="glyphicon glyphicon-chevron-right"></span>
		  </a>
	  </div><!-- /controls -->

	</div><!-- /carousel -->

	<div id="studio" class="carousel slide" data-ride="carousel">

	  <!-- Wrapper for slides -->
	  <div class="carousel-inner">

	    <div class="item">
	      <img src="FrontEnd/img/preview-images/widgets_06.jpg" alt="themesgravity">
	      <h4>Studio</h4>
	      <!-- <p class="project-category">Studio Photography</p> -->
	    </div><!-- /item -->

	    <div class="item">
	      <img src="FrontEnd/img/preview-images/widgets_03.jpg" alt="themesgravity">
	      <h4>Studio</h4>
	      <!-- <p class="project-category">Studio Photography</p> -->
	    </div><!-- /item -->

	    <div class="item active">
	      <img src="FrontEnd/img/preview-images/widgets_04.jpg" alt="themesgravity">
	      <h4>Studio</h4>
	      <!-- <p class="project-category">Studio Photography</p> -->
	    </div><!-- /item -->

	  </div><!-- /carousel-inner -->

	  <!-- Controls -->
	  <div class="controls">
		  <a class="control" href="#studio" data-slide="prev">
	      	<span class="glyphicon glyphicon-chevron-left"></span>
	  	  </a>
	  	  <a class="center control" href="#">
	      	<i class="fa fa-bars"></i>
	  	  </a>
		  <a class="right control" href="#studio" data-slide="next">
		    <span class="glyphicon glyphicon-chevron-right"></span>
		  </a>
	  </div><!-- /controls -->

	</div><!-- /carousel -->

	<div id="develop" class="carousel slide" data-ride="carousel">

	  <!-- Wrapper for slides -->
	  <div class="carousel-inner">

	    <div class="item">
	      <img src="FrontEnd/img/preview-images/widgets_10.jpg" alt="themesgravity">
	      <h4>Develop</h4>
	      <!-- <p class="project-category">Develop</p> -->
	    </div><!-- /item -->

	    <div class="item">
	      <img src="FrontEnd/img/preview-images/widgets_09.jpg" alt="themesgravity">
	      <h4>Develop</h4>
		<!-- <p class="project-category">Develop</p> -->
	    </div><!-- /item -->

	    <div class="item active">
	      <img src="FrontEnd/img/preview-images/widgets_04.jpg" alt="themesgravity">
	      <h4>Develop</h4>
	      <!-- <p class="project-category">Develop</p> -->
	    </div><!-- /item -->

	  </div><!-- /carousel-inner -->

	  <!-- Controls -->
	  <div class="controls">
		  <a class="control" href="#develop" data-slide="prev">
	      	<span class="glyphicon glyphicon-chevron-left"></span>
	  	  </a>
	  	  <a class="center control" href="#">
	      	<i class="fa fa-bars"></i>
	  	  </a>
		  <a class="right control" href="#develop" data-slide="next">
		    <span class="glyphicon glyphicon-chevron-right"></span>
		  </a>
	  </div><!-- /controls -->

	</div><!-- /carousel -->

	<div class="projects-menu">
		<ul>
			<li><a href="#" data-id="web-design">Web Design</a></li>
			<li><a href="#" data-id="uiux">UI/UX</a></li>
			<li><a href="#" data-id="illustrations-production">Illustrations</a></li>
			<li><a href="#" data-id="editorial-design">Editorial Design</a></li>
			<li><a href="#" data-id="studio">Studio</a></li>
			<li><a href="#" data-id="develop">Develop</a></li>

		</ul>
	</div><!-- /projects-menu -->

	<hr>

</div><!-- /widget-projects -->
							</div>
<div class="col-md-8" id="">

								<h1>Hotel Rooms Listing: Search or Listing Results</h1>

								<p>The projects consists of a vast suite of classic mid format celluloid film portraits of tribes people in the Omo Valley in southwest Ethiopia, near the Sudanese border, a grim and unforgiving, unaccessible roadless area which Claes Btritton has also visited, on a river expedition back in 1988.</p>

								<hr>

								<article class="room-post row">
									<div class="col-sm-7 col-md-7 col-lg-7">
										<img src="FrontEnd/img/preview-images/rooms_01.jpg" alt="themesgravity">
									</div><!-- /end three columns -->
									<div class="col-sm-5 col-md-5 col-lg-5">

									<span>Discover our</span>
									<h3 class="room-title"><a href="#">Standard Suite</a></h3>
									<span>from</span>
									<span class="room-cost"> $198</span>

									<p>The projects consists of a vast suite of classic mid format celluloid film which Claes Britton has also visited, on a river expedition 1988.</p>

									<a type="button" class="btn btn-primary">Book Now</a>

									<div class="room-post-person">
										<span class="serif-font">max </span>
										<span class="glyphicon glyphicon-user"></span>
										<span style="font-size:18px;">x 1</span>
									</div><!-- /room-post-person -->

									</div><!-- /end nine columns -->

								</article><!-- /article -->

								<hr>

								<article class="room-post row">
									<div class="col-sm-7 col-md-7 col-lg-7">
										<img src="FrontEnd/img/preview-images/rooms_02.jpg" alt="themesgravity">
									</div><!-- /end three columns -->
									<div class="col-sm-5 col-md-5 col-lg-5">

									<span>Discover our</span>
									<h3 class="room-title"><a href="#">Large Suite</a></h3>
									<span>from</span>
									<span class="room-cost"> $198</span>

									<p>The projects consists of a vast suite of classic mid format celluloid film which Claes Britton has also visited, on a river expedition 1988.</p>

									<a type="button" class="btn btn-primary">Book Now</a>

									<div class="room-post-person">
										<span class="serif-font">max </span>
										<span class="glyphicon glyphicon-user"></span>
										<span style="font-size:18px;">x 2</span>
									</div><!-- /room-post-person -->

									</div><!-- /end nine columns -->

								</article><!-- /article -->

								<hr>

								<article class="room-post row">
									<div class="col-sm-7 col-md-7 col-lg-7">
										<img src="FrontEnd/img/preview-images/rooms_03.jpg" alt="themesgravity">
									</div><!-- /end three columns -->
									<div class="col-sm-5 col-md-5 col-lg-5">

									<span>Discover our</span>
									<h3 class="room-title"><a href="#">Delux Suite</a></h3>
									<span>from</span>
									<span class="room-cost"> $198</span>

									<p>The projects consists of a vast suite of classic mid format celluloid film which Claes Britton has also visited, on a river expedition 1988.</p>

									<a type="button" class="btn btn-primary">Book Now</a>

									<div class="room-post-person">
										<span class="serif-font">max </span>
										<span class="glyphicon glyphicon-user"></span>
										<span style="font-size:18px;">x 3</span>
									</div><!-- /room-post-person -->

									</div><!-- /end nine columns -->

								</article><!-- /article -->

								<hr>

								<article class="room-post row">
									<div class="col-sm-7 col-md-7 col-lg-7">
										<img src="FrontEnd/img/preview-images/rooms_04.jpg" alt="themesgravity">
									</div><!-- /end three columns -->
									<div class="col-sm-5 col-md-5 col-lg-5">

									<span>Discover our</span>
									<h3 class="room-title"><a href="#">President Suite</a></h3>
									<span>from</span>
									<span class="room-cost"> $198</span>

									<p>The projects consists of a vast suite of classic mid format celluloid film which Claes Britton has also visited, on a river expedition 1988.</p>

									<a type="button" class="btn btn-primary">Book Now</a>

									<div class="room-post-person">
										<span class="serif-font">max </span>
										<span class="glyphicon glyphicon-user"></span>
										<span style="font-size:18px;">x 4</span>
									</div><!-- /room-post-person -->

									</div><!-- /end nine columns -->

								</article><!-- /article -->

								<hr>

								<div class="pagination">
									<a class="active">1</a>
									<a href="#">2</a>
									<a href="#">3</a>
									<a href="#">4</a>
									<a href="#"><i class="icon-right-open"></i></a>

								</div><!-- /pagination -->

							</div>

</div>


@endsection




@section('js')

<script>


	//datepicker
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