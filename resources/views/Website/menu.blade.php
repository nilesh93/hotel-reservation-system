@extends('webmaster')





@section('title')

Menus
@endsection




@section('css')


@endsection






@section('content')

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
	<section id="content" style="padding-top:1%">
		<h1>Menus &amp; Menu Details Overview</h1>
		<hr>
		@foreach($menus as $m)
<div class="col-md-4">
 <div class="head-v5-sliderbox">
				<img src="FrontEnd/img/preview-images/sliderbox_03.png" alt="themesgravity">
				<br>
				<br>
				<h4>{{$m->category}}</h4>
				<p>{{$m->description}}</p>
	 <!--<h5>Rs. {{$m->rate}} Onwards</h5> -->
				<a href="#">Download Menu</a><span> or </span><a href="#">Read More</a>
			</div>

</div>
@endforeach
	</section><!-- content -->
</div><!-- /container -->




@endsection




@section('js')

<script src="https://maps.googleapis.com/maps/api/js?callback=initMap" async defer></script>
<script>



	function initMap(){

		var myLatLng = {lat:6.840172, lng: 80.020895};

		var mapDiv = document.getElementById('gmap');
		var map = new google.maps.Map(mapDiv, {
			center:myLatLng,
			zoom: 14
		});
		var marker = new google.maps.Marker({
			position: myLatLng,
			map: map,
			title: 'Amalya Reach Holiday Resort'
		});

	}


	function save(){

		document.getElementById("msg").innerHTML = "";
		
		$.ajax({
			
			url: "saveinquiry",
			type: "get",
			data : $('#inquiry').serialize(),
			success:function(data){
				
				document.getElementById("msg").innerHTML = 	 '<div class="alert alert-success"> <strong>Thank You!</strong> Your inquiry was saved successfully. We will get back to you as soon as we can. </div> ';
				$('#res').click();
			},
			error:function(err){
				
			
				document.getElementById("msg").innerHTML = 	 '<div class="alert alert-danger"> <strong>Oops!</strong> Something went wrong (code: '+err+') Please try again in a moment. </div> ';
					
				
			}
			
			
			
		});


		return false;

	}
</script>

@endsection