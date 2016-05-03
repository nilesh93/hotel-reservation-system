@extends('webmaster')

@section('title')
	Function Halls
	@endsection

	@section('links')

	@endsection

	@section('css')
			<!-- This style is disable the warning cursor for disabled fields -->
	<style>
		input[readonly].default-cursor {
			cursor: default;
		}
	</style>
@endsection

@section('content')
	<div class="row"><!-- 1st row start -->

		<div class="col-md-12"><!-- col-md-12 -->

			<section class="head-v1 left-sidebar">

				<img src="{{URL::asset('FrontEnd/img/Hall_images/function_halls.jpg')}}" width="100%">

				<section class="head-title">
					<h2>Function Halls </h2>
					<p><small>Modern, clean design and neutral tones slow the pace when you’re ready to unwind.</small></p>
				</section><!-- /head-title -->

				<a href="#" id="hall-form" class="room-trigger"><i class="fa fa-calendar-o"></i> Check Availability</a>

				<div class="room-form">
					<span class="glyphicon glyphicon-remove"></span>

					<!-- Check hall availability form-->
					<form class="form-group"id="chk_hall"  name="chk_hall" onsubmit="return chkHallAvailability()" method="get">
						<input  type="hidden" name="_token" value="{{ csrf_token() }}">
						<br>
						<div class="row">
							<div class="col-sm-12 col-md-12 col-lg-12" align="center">
								<label><h3> Event Date </h3></label>
								<input type="text" class="form-control default-cursor" id="event_date" name="event_date" placeholder="Select the date"  readonly required/>
							</div><!-- /col-md-12 -->
						</div><!-- /row -->
						<br>
						<div class="row">
							<div class="col-sm-12 col-md-12 col-lg-12" align="center">
								<label><h3> Time Slot </h3></label>
								<select class="form-control "  name="timeSlot" id="timeSlot" required>

									<option value="{{ $time_slot1}}">{{ $time_slot1 }} </option>
									<option value="{{ $time_slot2 }}">{{ $time_slot2 }} </option>

								</select>
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
						<div class="col-md-1"></div>

						<div class="col-md-11">

							<div id="edate" align="center" class="col-md- col-lg-11 ">

							</div>

						</div><!-- /col-md-9 -->
					</div>

					<h1>Function Halls</h1>

					<hr>

					<!-- This div is used by the ajax call-->
					<div id="hall_my_booking">

					</div>

					<div class="row" id="hall">

						@foreach($halls as $hall)

							<?php
							//query a image of a hall to display
							$himage = DB::table('HALL_IMAGES')
									->where('hall_id','=',$hall->hall_id)
									->value('path');
							?>

							<div class="col-sm-6 col-md-6 col-lg-6">

								<div class="roombox">

									<div class="room-image">

										<img src="{{URL::asset($himage)}}"  alt="themesgravity" width="100%">
										<h4><a style="text-decoration: none" onclick="viewHall('{{$hall->hall_id}}','{{ $hall->title }}','{{$hall->capacity_from}}','{{ $hall->capacity_to }}')"href="#">{{ $hall->title }}</a></h4>

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

			</div><!--container -->

		</div><!-- col-md-12-->

	</div><!--/row-->

	<!-- this hidden filed is use to trigger if browsers forward button clicked-->
	<input type="hidden" id="refresh" value="no">

	<br>
	<br>
	<br>
	<br>
	<br>

@endsection

@section('js')

	<script>

		//if hall event date is already selected then load the halls with availability in the view using ajax call

		@if(Session::has('event_date'))

			$(document).ready(function(){
					var end = "";
					$.ajax({
						type:'get',
						url: 'hall_availability',
						data :{
							'event_date':"{{ session('event_date') }}",
							'timeSlot':"{{ session('timeSlot') }}"
						},
						success:function(data){
							document.getElementById('edate').innerHTML = '<h2><label class="label label-info ">Your Requested  Date :' + data.edate + ',   Time Slot : '+data.timeSlot+'</label></h2>';

							if(data.total_halls != 0) {
								for (var i = 0; i < data.hall_ids.length; i++) {

									if (data.hall_status[data.hall_ids[i].hall_id] == "Available") {
										end = '<a type="button"  onclick="book_halls(' + data.hall_ids[i].hall_id + ')" class="btn btn-primary "style="width: 100%">Book</a>'

										document.getElementById(data.hall_ids[i].hall_id + 'avail').innerHTML = "<h4 align='center'><b><br>Status :" + data.hall_status[data.hall_ids[i].hall_id] + "   </b>" + end + "</h4>"
									}
									else {
										end = '<a type="button"  onclick="book_halls(' + data.hall_ids[i].hall_id + ')" class="btn btn-primary "style="width: 100%" disabled>Book</a>'

										document.getElementById(data.hall_ids[i].hall_id + 'avail').innerHTML = "<h4 align='center'><b><br>Status :" + data.hall_status[data.hall_ids[i].hall_id] + "  </b>" + end + "</h4>"
									}
								}
							} else {
								swal({
									title: "<div class='alert alert-danger'> <strong>Sorry! </strong> </div>",
									text: "<span style='color:#ff2222'>No Halls are available on that date<span>",
									html: true
								});
							}
						},
						error: function(xhr, ajaxOptions, thrownError) {
							console.log(thrownError);

							swal("Ooops!", "Something Went Wrong! ("+thrownError+")", "error");
						}

					});

				});
		@endif

		//if hall is selected already load the hall details in the page using ajax, this is done due to refreshing the page
		@if(Session::has('hall_selected'))

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
							$('body,html').animate({scrollTop:$("#hall_my_booking").offset().top},"slow");
						},
						error: function(xhr, ajaxOptions, thrownError) {
							console.log(thrownError);

							swal("Ooops!", "Something Went Wrong! ("+thrownError+")", "error");
						}
					});


				});
		@else
			//else load the div with nothing
		document.getElementById('hall_my_booking').innerHTML = '';
		@endif

				//This function is use to trigger when back button is clicked and because of that refresh the page
		$(document).ready(function(e) {
			var $input = $('#refresh');
			$input.val() == 'yes' ? location.reload(true) : $input.val('yes');
		});

		//date picked used in the event date
		$("#event_date").datepicker({
			dateFormat:'yy-mm-dd',
			minDate:1,
			changeMonth: true,
			changeYear: true,
			defaultDate:new Date(),
		});

		//validate the hall availability checking form and call a ajax call on success
		function chkHallAvailability()
		{
			var event_date = document.getElementById('event_date').value;

			if(event_date == "") {

				swal({
					title: "<div class='alert alert-danger'> <strong>Warning! </strong> </div>",
					text: "<span style='color:#ff2222'> Select a event date <span>",
					html: true
				});

				return false;
			}else {

				var end = "";

				$.ajax({
					type:'get',
					url: 'hall_availability',
					data : $('#chk_hall').serialize(),

					success:function(data){

						document.getElementById('edate').innerHTML = '<h2><label class="label label-info ">Your Requested Date :' + data.edate +',   Time Slot : '+data.timeSlot+ '</label></h2>'

						if(data.total_halls != 0) {
							for (var i = 0; i < data.hall_ids.length; i++) {

								if (data.hall_status[data.hall_ids[i].hall_id] == "Available") {

									end = '<a type="button"  onclick="book_halls(' + data.hall_ids[i].hall_id + ')" class="btn btn-primary "style="width: 100%">Book</a>';
									document.getElementById(data.hall_ids[i].hall_id + 'avail').innerHTML = "<h4 align='center'><b><br>Status :" + data.hall_status[data.hall_ids[i].hall_id] + "   </b>" + end + "</h4>"
								}
								else {
									end = '<a type="button"  onclick="book_halls(' + data.hall_ids[i].hall_id + ')" class="btn btn-primary "style="width: 100%" disabled>Book</a>'
									document.getElementById(data.hall_ids[i].hall_id + 'avail').innerHTML = "<h4 align='center'><b><br>Status :" + data.hall_status[data.hall_ids[i].hall_id] + "  </b>" + end + "</h4>"
								}

								//this is used to scroll page and point to the div which has the id hall
								$('html,body').animate({scrollTop: $("#hall").offset().top}, 'fast');
							}

							document.getElementById('hall_my_booking').innerHTML = '';
						} else{
							swal({
								title: "<div class='alert alert-danger'> <strong>Sorry! </strong> </div>",
								text: "<span style='color:#ff2222'>No Halls are available on that date<span>",
								html: true
							});
						}
					},
					error: function(xhr, ajaxOptions, thrownError) {
						console.log(thrownError);

						swal("Ooops!", "Something Went Wrong! ("+thrownError+")", "error");
					}
				});

				return false;
			}
		}

		//this function is used to add a hall to the current reservation session
		function book_halls(id)
		{
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

					swal("Ooops!", "Something Went Wrong! ("+thrownError+")", "error");
				}
			});
		}

		//this function is used to load the content if the hall booking part
		function loadHallMyBooking(data)
		{
			//put this value ro the session in order to access the payment page
					{{ Session::put('CanPay') }}

                    var begin = '<h1 align="center">My Booking</h1>' +
					'<hr>' +
					'<div align="center">' +
					'<div class="checkout-info row">' +
					'<div class="col-sm-4 col-md-4 col-lg-4">' +
					'<span class="checkout-title">Hall</span>' +
					'<span class="checkout-value"></span>' +
					'</div><!-- /col-4--->' +

					'<div class="col-sm-4 col-md-4 col-lg-4">' +
					'<span class="checkout-title">Advance Payment</span>' +
					'<span class="checkout-value"></span>' +
					'</div><!-- /col-4--->' +

					'<div class="col-sm-4 col-md-4 col-lg-4">' +
					'<span class="checkout-title">Refundable Amount</span>' +
					'<span class="checkout-value"></span></div><!-- /col-4 -->' +
					'</div>' +
					'</div>' +
					'<hr>';

			var body = 	'<div class="row">' +
					'<div class="col-md-12">' + '' +
					'<div align="center">' +
					'<div class="checkout-info row">' +

					'<div class="col-sm-4 col-md-4 col-lg-4">' +
					'<span class="checkout-title">' + data.hall_detail[0].title + '</span>' +
					'<span class="checkout-value"></span>' +
					'</div><!-- /col-4 -->' +

					'<div class="col-sm-4 col-md-4 col-lg-4">' +
					'<span class="checkout-title finance">Rs.' + formatNumber(data.hall_detail[0].advance_payment)  + '</span>' +
					'<span class="checkout-value"></span>' +
					'</div><!-- /col-4 -->' +

					'<div class="col-sm-4 col-md-4 col-lg-4">' +
					'<span class="checkout-title finance">Rs.' + formatNumber(data.hall_detail[0].refundable_amount) + '</span>' +
					'<span class="checkout-value"></span>' +
					'</div><!-- /col-4 -->' +

					'</div><!--/checkout -->'+
					'</div><!--/center-->'+
					'</div><!--/col-md-12'+
					'</div><!-- row --><br><br>'

			var end = '<div class="col-md-12">' +
					'<hr>' +
					'<div class="col-md-3">' +
					'<a href="{!! url('cancel_hall_reserv') !!}" style="width: 60%;" type="button" class="btn-link btn-lg">Cancel</a>' +
					'</div>' +

					'<div class="col-md-6">'+
					'<h2 align="center"><b>Total : <span class="finance">' + formatNumber(data.hall_detail[0].advance_payment)+'</span></b><h2>'+
					'</div>' +

					'<div class="col-md-3" align="right">'+
					'<form method="get" onsubmit="return makepaymentchk()"action="{{ url('payment') }}">' +
					'<input type="hidden" name="_token" value="{{ csrf_token() }}">' +
					'<input type="hidden" name="CanPay" value="Can">' +
					'<button type="submit" class="btn btn-primary" >Make Payments</button>' +
					'</form>' +
					'</div>' +
					'<hr>' +

					'</div>';

			document.getElementById('hall_my_booking').innerHTML = begin + body +end;
		}

	</script>
@endsection