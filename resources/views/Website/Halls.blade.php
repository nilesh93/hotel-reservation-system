@extends('webmaster')





@section('title')

Function Halls

@endsection


@section('links')




@endsection

@section('css')


	<style>
		input[readonly].default-cursor {
			cursor: default;
		}
	</style>
@endsection

@section('hall_links')

	<ul>

		@foreach($halls as $hall)
			<li><a href="#">{{ $hall->title }}</a></li>
		@endforeach
	</ul>
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



				<a href="#" id="hall-form" class="room-trigger"><i class="fa fa-calendar-o"></i> Check Availability</a>
				<div class="room-form">
					<span class="glyphicon glyphicon-remove"></span>
					<form class="form-group"id="chk_hall"  name="chk_hall" onsubmit="return chk_hall_availability()" method="get">
						<input  type="hidden" name="_token" value="{{ csrf_token() }}">

						<br>

						<div class="row">

							<div class="col-sm-12 col-md-12 col-lg-12" align="center">
								<label><h3> Event Date </h3></label>
								<input type="text" class="form-control default-cursor" id="event_date" name="event_date" placeholder="Select the date"  readonly required/>
							</div><!-- /col-md-12 -->

						</div><!-- /row -->


						<br>


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

					<div class="row">
						<div class="col-md-3"></div>

						<div class="col-md-9">

							<div id="edate" align="center" class="col-md-9 col-lg-9 ">

							</div>

						</div><!-- /col-md-12 -->
					</div>


					<h1>Function Halls</h1>

					<p>The projects consists of a vast suite of classic mid format celluloid film portraits of tribes people in the Omo Valley in southwest Ethiopia, near the Sudanese border, a grim and unforgiving, unaccessible roadless area which Claes Btritton has also visited, on a river expedition back in 1988.</p>

					<hr>
					<div id="hall_my_booking">


					</div>



					<div id="hall" class="row">

						@foreach($halls as $hall)

						<?php
							$himage = DB::table('HALL_IMAGES')
							->where('hall_id','=',$hall->hall_id)
							->value('path');

						?>

							<div class="col-sm-6 col-md-6 col-lg-6">
								<div class="roombox">



									<div class="room-image">

										<img src="{{URL::asset($himage)}}"  alt="themesgravity" width="100%">
										<h4><a style="text-decoration: none" onclick="showModal('{{$hall->hall_id}}hall')"href="#">{{ $hall->title }}</a></h4>

									</div><!-- /room-image -->

									<div class="room-content">
										<hr>
										<p>{{ $hall->capacity_from }} - {{ $hall->capacity_to }} Seating Capacity</p>
									</div><!-- /room-content -->
								</div><!-- /roombox -->
								<div class="col-md-12 label-default" id="{{ $hall->hall_id }}avail"></div>
							</div><!-- /col-sm-6 -->


						@endforeach

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


	@if(Session::has('hreserv_status'))
		<script>

			swal("Success" ,"Your reservation has been successfully made!", "success");

		</script>

	@endif


	@if(Session::has('event_date'))
		<script>

			$(document).ready(function(){
				var end = "";
				$.ajax({
					type:'get',
					url: 'hall_availability',
					data :{
						'event_date':"{{ session('event_date') }}"
					},


					success:function(data){



						for (var i = 0; i < data.hall_ids.length; i++) {


							if(data.hall_status[data.hall_ids[i].hall_id] == "Available") {
								end = '<a type="button"  onclick="book_halls('+data.hall_ids[i].hall_id +')" class="btn btn-primary "style="width: 100%">Book</a>'

								document.getElementById(data.hall_ids[i].hall_id + 'avail').innerHTML = "<h4 align='center'><b><br>Status :" + data.hall_status[data.hall_ids[i].hall_id] +"   </b>" +end+ "</h4>"
							}
							else{
								document.getElementById(data.hall_ids[i].hall_id + 'avail').innerHTML = "<h4 align='center'><b><br>Status :" + data.hall_status[data.hall_ids[i].hall_id]   +"  </b></h4>"

							}
						}


						document.getElementById('edate').innerHTML = '<h2><label class="label label-info ">Your Requested Date :'+ data.edate+'</label></h2>'



					}




				});




			});




		</script>
	@endif


	@if(Session::has('hall_selected'))
		<script>


			$(document).ready(function(){
				var hall_id = "{{ session('hall_selected') }}";
				$.ajax({
					type: 'get',
					url: 'book_hall_add',
					data: {
						'hall_id':hall_id

					},


					success:function(data){


						loadHallMyBooking(data);
						$('html,body').animate({scrollTop:$("#hall_my_booking").offset().top}, 'slow');


					},


					error: function(xhr, ajaxOptions, thrownError) {
						console.log(thrownError);
					}
				});


			});

		</script>


	@endif



	<script>
	$("#event_date").datepicker({
		dateFormat:'yy-mm-dd',
		minDate:1,
		changeMonth: true,
		changeYear: true,
		defaultDate:new Date(),


	});



	function chk_hall_availability()
	{
		var event_date = document.getElementById('event_date').value;

		if(event_date == "")
		{

			swal({
				title: "<div class='alert alert-danger'> <strong>Warning! </strong> </div>",
				text: "<span style='color:#ff2222'> Select a event date <span>",
				html: true
			});

			return false;


		}else{

			var end = "";
			$.ajax({
				type:'get',
				url: 'hall_availability',
				data : $('#chk_hall').serialize(),


				success:function(data){



					for (var i = 0; i < data.hall_ids.length; i++) {


						if(data.hall_status[data.hall_ids[i].hall_id] == "Available") {
							end = '<a type="button"  onclick="book_halls('+data.hall_ids[i].hall_id +')" class="btn btn-primary "style="width: 100%">Book</a>'

							document.getElementById(data.hall_ids[i].hall_id + 'avail').innerHTML = "<h4 align='center'><b><br>Status :" + data.hall_status[data.hall_ids[i].hall_id] +"   </b>" +end+ "</h4>"
						}
						else{
							document.getElementById(data.hall_ids[i].hall_id + 'avail').innerHTML = "<h4 align='center'><b><br>Status :" + data.hall_status[data.hall_ids[i].hall_id]   +"  </b></h4>"

						}



						$('html,body').animate({scrollTop:$("#hall").offset().top}, 'slow');
					}


					document.getElementById('edate').innerHTML = '<h2><label class="label label-info ">Your Requested Date :'+ data.edate+'</label></h2>'
					document.getElementById('hall_my_booking').innerHTML = '';

				}




			});


			return false;



		}


	}


	function book_halls(id){


		var hall_id = id;

		$.ajax({
			type: 'get',
			url: 'book_hall_add',
			data: {
				'hall_id':id

			},


			success:function(data){

				swal('Success','Successfully Added!', 'success');

				loadHallMyBooking(data);
				$('html,body').animate({scrollTop:$("#hall_my_booking").offset().top}, 'slow');



			},


			error: function(xhr, ajaxOptions, thrownError) {
				console.log(thrownError);
			}
		});


	}



		function loadHallMyBooking(data)
		{

			var begin = '<h1 align="center">My Booking</h1><hr><div align="center"><div class="checkout-info row"><div class="col-sm-4 col-md-4 col-lg-4"><span class="checkout-title">Hall</span><span class="checkout-value"></span></div><!-- /col-4---><div class="col-sm-4 col-md-4 col-lg-4"><span class="checkout-title">Advance Payment ($)</span><span class="checkout-value"></span></div><!-- /col-4---><div class="col-sm-4 col-md-4 col-lg-4"><span class="checkout-title">Refundable Amount ($)</span><span class="checkout-value"></span></div><!-- /col-4 --></div></div><hr>';

			var body = 	'<div class="row">' +
					'<div class="col-md-12">' + '' +
					'<div align="center">' +
					'<div class="checkout-info row">' +

					'<div class="col-sm-4 col-md-4 col-lg-4">' +
					'<span class="checkout-title">' + data.hall_detail[0].title + '</span>' +
					'<span class="checkout-value"></span>' +
					'</div><!-- /col-4 -->' +

					'<div class="col-sm-4 col-md-4 col-lg-4">' +
					'<span class="checkout-title">' + data.hall_detail[0].advance_payment  + '</span>' +
					'<span class="checkout-value"></span>' +
					'</div><!-- /col-4 -->' +

					'<div class="col-sm-4 col-md-4 col-lg-4">' +
					'<span class="checkout-title">' + data.hall_detail[0].refundable_amount + '</span>' +
					'<span class="checkout-value"></span>' +
					'</div><!-- /col-4 -->' +

					'</div><!--/checkout -->'+
					'</div><!--/center-->'+
					'</div><!--/col-md-12'+
					'</div><!-- row --><br><br>'

			var end = '<div class="col-md-12"><hr><div class="col-md-3"><a href="{!! url('cancel_hall_reserv') !!}"  style="width: 60%;" type="button" class="btn-link btn-lg">Cancel</a></div><div class="col-md-6"><h2 align="center"><b>Total($) : ' + data.hall_detail[0].advance_payment + '</b><h2></div><div class="col-md-3" align="right"><a   onclick="return makepaymentchk()" href="{!! url('payment') !!}" type="button" class="btn-link btn-lg">Make Payments</a></div><hr></div>'

			document.getElementById('hall_my_booking').innerHTML = begin + body +end;

		}





</script>


@endsection