@extends('webmaster')





@section('title')

Contact Us
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
	<section id="content">


		<div class="row">


			<div id="gmap"></div>
		</div>

		<br>
		<h3 class="col6">Contact Us</h3>
		<p>Tell us what you think. Make an Inquiry. Ask us anything.</p>

		<hr>
		<div class="col-md-10 col-lg-10" id="msg" style="padding-left:0cm;padding-right:0cm">
		
		
		</div>
		<form id="inquiry" onsubmit="return save()">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<div class="row">
						<div class="col-sm-4 col-md-2 col-lg-2">
							<span class="form-label">Full Name</span>
						</div>
						<div class="col-sm-8 col-md-8 col-lg-8">
							<input name="fullname" class="form-control input-lg" type="text" placeholder="Enter Your Name" required>
						</div><!-- /col-md-8 -->
						<!-- /col-md-4 -->
					</div><!-- /row -->
				</div><!-- /col-12 -->
			</div><!-- /row -->
			<br>
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<div class="row">
						<div class="col-sm-4 col-md-2 col-lg-2">
							<span class="form-label">Company</span>
						</div>
						<div class="col-sm-8 col-md-8 col-lg-8">
							<input name="company" class="form-control input-lg" type="text" placeholder="Company"  >
						</div><!-- /col-md-8 -->
						<!-- /col-md-4 -->
					</div><!-- /row -->
				</div><!-- /col-12 -->
			</div><!-- /row -->
			<br>
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<div class="row">
						<div class="col-sm-4 col-md-2 col-lg-2">
							<span class="form-label">Email</span>
						</div>
						<div class="col-sm-8 col-md-8 col-lg-8">
							<input type="email" name="email" class="form-control input-lg" type="text" placeholder="Enter Your Email" required>
						</div><!-- /col-md-8 -->
						<!-- /col-md-4 -->
					</div><!-- /row -->
				</div><!-- /col-12 -->
			</div><!-- /row -->
			<br>
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<div class="row">
						<div class="col-sm-4 col-md-2 col-lg-2">
							<span class="form-label">Message</span>
						</div>
						<div class="col-sm-8 col-md-8 col-lg-8">
							<textarea rows="10" class="form-control input-lg" type="text" placeholder="Your Message" name="message" required></textarea>
						</div><!-- /col-md-8 -->
						<!-- /col-md-4 -->
					</div><!-- /row -->
				</div><!-- /col-12 -->
			</div>
			<br>
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<div class="row">

						<div class="col-sm-8 col-md-2 col-lg-offset-7 col-lg-3">
							<button type="submit" class="btn btn-block btn-icon btn-primary"><i class="fa fa-inbox"></i> Submit</button>
							<button type="reset" id="res" hidden="true"></button>
						</div><!-- /col-md-8 -->
						<!-- /col-md-4 -->
					</div><!-- /row -->
				</div><!-- /col-12 -->
			</div>
			<!-- /row -->
		</form>





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