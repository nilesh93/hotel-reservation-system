@extends('webmaster')





@section('title')

Contact Us
@endsection




@section('css')

<link rel="stylesheet" href="{{URL::asset('FrontEnd/FancyBox/source/jquery.fancybox.css')}}">


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
	
	<h3> Image Gallery</h3>
	<hr>
	<div class=" ">
	  
		<div class="row">

			<?php $count = 1; ?>
			@foreach($images as $i)
			<div class="col-sm-4 col-md-4 col-lg-4 img-small" style="padding-top:2%"  >
				
				<a class="fancybox" rel="group" href="{{URL::asset($i->path)}}">
					<img  src="{{URL::asset($i->path)}}"  >
				</a>
				
			</div><!-- /col-lg-3 -->
 

		<?php $count++; ?>
		@endforeach


	</div><!-- /row -->
</div><!-- /gallery --> 
	</section>


</div>




@endsection




@section('js')


<script>


$(document).ready(function() {
		 
	
	$(".fancybox").fancybox({
    	openEffect	: 'elastic',
    	closeEffect	: 'elastic'
    	 
    });
	});
</script>
@endsection