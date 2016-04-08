@extends('webmaster')





@section('title')
Home
@endsection




@section('css')

<style>
	#owl-demo .item{
		background: #42bdc2;
		padding: 30px 0px;
		margin: 5px;
		color: #FFF;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
		border-radius: 3px;
		text-align: center;
	}

</style>
@endsection






@section('content')


<div class="big-slider">
	<div id="big-slider-carousel" class="carousel slide" data-ride="carousel">

		<!-- Indicators -->


		<!-- Wrapper for slides -->
		<div class="carousel-inner">
			<?php  $class = "active"; ?>
			@foreach($images as $i)


			<div class="item  {{$class}}">
				<img src="{{URL::asset($i->path)}}" />

				<div class="container">
					<div class="carousel-text" style="margin-left:4%;margin-top:10%">
						<a href="#">
							<h2>{{ $i->caption }}</h2>
							<br>

							<h2>{{ $i->caption_desc }}</h2>

						</a>
					</div><!-- /carousel-text -->
				</div><!-- /container -->
			</div>


			@if($class == "active")
			<?php $class = ""; ?>
			@endif
			@endforeach

			<!-- /item -->
		</div><!-- /carousel-inner -->


		<a class="left carousel-nav" href="#big-slider-carousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
		<a class="right carousel-nav" href="#big-slider-carousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>

	</div><!-- /big-slider-carousel -->

</div><!-- /big-slider -->


<div class="container left-sidebar">
	<aside id="sidebar">
		<div class="widget widget-contact">
			<h5>Contact</h5>

			<div class="address">
				<i class="fa fa-home"></i>
				<p>No.556,<br> Moragahahena Road,
					Pitipana North,<br>
					Homagama.</p>
			</div><!-- /address -->

			<div class="phone">
				<i class="fa fa-phone"></i>
				<p>+94 114404040<br>
					+94 114368291<br>
					+94 777743612</p>
			</div><!-- /phone -->

			<div class="time">
				<i class="fa fa-clock-o"></i>
				<p>08-16 hours<br>Monday - Friday</p>
			</div><!-- /time -->

			<div class="email">
				<i class="fa fa-envelope-o"></i>
				<p>amalyareach@<br>yahoo.com</p>
			</div><!-- /email -->

		</div><!-- /widget-contact -->

	</aside>
	<section id="content">
		<h3>Our   Services & Facilities</h3>
		<hr>


		<div class="row">


			<div class="recent-posts">
				<div id="recent-posts-1" class="owl-carousel">


					@foreach($facilities as $f)
					<div class="post-item">
						<div class="post-img">
							<img src="{{URL::asset('FrontEnd/img/preview-images/recent_posts_01.jpg')}}" alt="themesgravity">
							<div class="img-overlay"><i class="fa fa-bars"></i></div><!-- /img-overlay -->
						</div><!-- /post-img -->

						<div class="post-content" >
							<span class="post-category">{{$f->category}}</span>
							<hr>
							<h4><a href="#" > <c class="finance">Rs&nbsp;  {{ number_format($f->price,2,".","")}} </c> Per Hour</a></h4>
							<p> {{$f->description}}</p>
						</div><!-- /post-content -->
					</div><!-- /post-item -->

					@endforeach

					<!-- /post-item -->
				</div><!-- /owl-carousel -->
				<div class="recent-posts-controls">
					<div class="owl-menu-hover"><i class="fa fa-bars"></i></div><!-- /owl-menu -->
					<div class="owl-next-hover"><i class="fa fa-arrow-circle-o-right"></i></div>
					<div class="owl-prev-hover"><i class="fa fa-arrow-circle-o-left"></i></div>
					<span class="hover-text"><small>Hover</small></span>
					<span class="hover-prev"><small>Previous item</small></span>
					<span class="hover-index"><small>Blog index</small></span>
					<span class="hover-next"><small>Next Item</small></span>
					<hr>
				</div><!-- /recent-posts-controls -->
			</div><!-- /recent-posts -->

		</div>


		<br>
		<br>
		<h3>Customer Reviews</h3>
		<hr>


		<div class="img-carousel">
			<div class="infobox" style="background:#d3ebef;">
				<div id="img-carousel" class="carousel slide" data-ride="carousel">

					<!-- Wrapper for slides -->
					<div class="carousel-inner" id="testimonial"> 

					</div><!-- /carousel-inner -->

					<!-- Controls -->
					<a class="left carousel-nav" href="#img-carousel" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left"></span>
					</a>
					<a class="right carousel-nav" href="#img-carousel" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right"></span>
					</a>
				</div>
			</div>
		</div>

	</section>
</div>

@endsection




@section('js')



<script type="text/javascript">

	$(document).ready(function() {



		$.ajax({
			type: "get",
			url:"https://maps.googleapis.com/maps/api/place/details/json?placeid=ChIJ7261PD1S4joRJq4Cw7ZDgX8&key=AIzaSyAxCbXVxRICVSNWa_zbEr_XrmMW0cQQz9w",
			 
			success:function(data){

				console.log(data.result.reviews);
				var body = "";
				var a = 0;
				for(var i = 0; i<data.result.reviews.length ; i++){

					if(data.result.reviews[i].text != ""){

						if(a == 0){

							var cls = "active";
						}else{

							var cls = "";
						}

						body+= '   <div class="item '+cls+'">'+
							'   '+
							'  <div class="img-info">'+
							'   <h3>'+data.result.reviews[i].author_name+'</h3>'+
							'   <p>'+data.result.reviews[i].text+' </p>'+
							'  '+
							' </div> '+
							'  </div>';
						a++;
					}

				}

				document.getElementById("testimonial").innerHTML = body;

			},
			error: function(err){

				console.log(err);
			}
		});


		$("#recent-posts-1").owlCarousel({
			responsive: false,
			items: 4,
			navigation: false,
			scrollPerPage: false,
			autoPlay: true,
		});
		// ADDING NEXT AND PREVIOUS BUTTONS
		var owl = $("#recent-posts-1").data('owlCarousel');
		$('.owl-next-hover').on('click',function(){owl.next();});
		$('.owl-prev-hover').on('click',function(){owl.prev();});


	});
</script>


@endsection