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
<section id="content" style="padding-top:1%">
	
	<h3> Image Gallery</h3>
	<hr>
	<div class="gallery">
	  
		<div class="row">

			<?php $count = 1; ?>
			@foreach($images as $i)
			<div class="col-sm-4 col-md-4 col-lg-4 img-small" data-id="{{$count}}">
				<img  src="{{URL::asset($i->path)}}"  >
			</div><!-- /col-lg-3 -->

			@if(($count%3) == 0)

			<?php $newcount = $count - 3; ?> 

			@for($x=0; $x<3; $x++)

		<div class="col-sm-12    col-md-12   col-lg-12">
			<div class="img-large" data-id="{{$newcount + 1 }}">
				<img  src="{{URL::asset($images[$newcount]->path)}}" align="middle" >
				<a class="cross"><i class="icon-cancel-1"></i></a>
				<a class="plus"><i class="icon-plus-1"></i></a>
				<a class="prev"><i class="icon-left-small"></i></a>
				<a class="next"><i class="icon-right-small"></i></a>
				<p class="caption"></p>
			</div><!-- /img-large -->
		</div><!-- /col-lg-9 -->

		<?php $newcount++; ?>
		@endfor
		@endif

		<?php $count++; ?>
		@endforeach


	</div><!-- /row -->
</div><!-- /gallery -->

	</section>


</div>




@endsection




@section('js')


@endsection