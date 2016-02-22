@extends('webmaster')


@section('title')

Room Packages

@endsection


@section('css')

	<style>
	input[readonly].default-cursor {
		cursor: default;
	}
	</style>

@endsection




@section('content')
	<div class="row">
		<div class="col-md-12">

			<img src="{{URL::asset('FrontEnd/img/accomadation/accomdation-pg-bg.jpg')}}" alt="" width="100%">
			<a href="#" class="room-trigger"><i class="fa fa-calendar-o"></i> Check Availability</a>
			<div class="room-form">
				<span class="glyphicon glyphicon-remove"></span>



						<form id= "checkavail" name="checkavail" class="form-horizontal" onsubmit="return roomavailability()" action="{!! url('room_availability') !!}"  method="Post">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">


					<div class="row">
						<div class=" col-sm-12 col-md-12 col-lg-12">

							<i class="fa fa-calendar"></i>
								<input type="text"  class="form-control default-cursor" id="datepicker"  name="check_in" placeholder="Check In Date"  readonly="readonly"  required/>
						</div><!-- /col-md-12 -->
					</div><!-- /row -->


					<div class="row">

						<div class="col-sm-12 col-md-12 col-lg-12">
							<i class="fa fa-calendar"></i>
							<input type="text" class="form-control default-cursor"  id="datepicker1"  name="check_out" placeholder="Check Out Date" readonly required/>

						</div><!-- /col-md-12 -->
					</div><!-- /row -->

					<br>

							<div class="row">
								<div class="col-sm-6 col-md-6 col-lg-6">
									<select class="form-control "  name="adults" id="adults">

										<option value="Adults">Adults</option>
										@for($i=1;$i<31;$i++)
											<option value={{ $i}}>{{$i}}</option>
										@endfor
									</select>
								</div><!-- /col-md-6 -->
								<div class="col-sm-6 col-md-6 col-lg-6">
									<select class="form-control"  name="children" id="children">
										<option value="Kids">Kids</option>
										@for($i=0;$i<21;$i++)
											<option value={{ $i}}>{{$i}}</option>
										@endfor
									</select>
								</div><!-- /col-md-6 -->
							</div><!-- /row -->

					<br>
							<div class="row">

								<div class="col-sm-12 col-md-12 col-lg-12">
									<select class="form-control "  name="ono_of_rooms" id="ono_of_rooms">
										<option value="No. of Rooms">No. of Rooms</option>

										@for($i=1;$i< 20;$i++)
											<option value={{ $i}}>{{$i}}</option>
										@endfor
									</select>
								</div>
							</div>	<!-- /row -->

					<br>



								<div class="checkbox">
									<label>
										<input type="checkbox" id="promochk" onclick="enableDisable(this.checked,'promotxt')"><span style="color: darkslategray"> I have promotion code</span>
									</label>
								</div>



							<div class="row">
								<div class="col-sm-12 col-md-12 col-lg-12">
									<input class="form-control input-lg" type="text" id="promotxt" name="promotxt" placeholder="Enter Promo Code" disabled>
								</div><!-- /col-md-12 -->
							</div><!-- /row -->

					<div class="row">

					</div><!-- /row -->
					<br>
					<button type="submit" class="btn btn-primary">Check Availability</button>
				</form>
			</div>
		</div>
	</div> <!-- /row -->
	<br>
	<br>
	<br>
	<br>

	<div class="row">
		<div class="col-md-12">

			@foreach($room_types as $room_type)
				<?php

					$image = DB::table('ROOM_IMAGES')
								->where('room_type_id','=',$room_type->room_type_id)
								->value('path');

					$ratefrom = DB::table('RATES')
							->where('room_type_id','=',$room_type->room_type_id)
							->min('single_rates');

				?>



				<div class="col-sm-3 col-md-3 col-lg-3">
					<div class="roombox">
						<div class="room-image">
							<img src="{{ $image }}" alt="themesgravity">
							<h4><a style="text-decoration: none" onclick="showModal({{$room_type->room_type_id}})" href="#">{{ $room_type->type_name }}</a></h4>
						</div><!-- /room-image -->
						<div class="room-content">
							<p class="room-price"><small>From ${{ $ratefrom }} per nights</small></p>
							<hr>
							<p>{{ $room_type->description }}</p>
						</div><!-- /room-content -->
					</div><!-- /roombox -->
				</div><!-- /col-sm-3 -->






			@endforeach
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
	@if(Session::has('reserv_status'))
		<script>

		swal("Success" ,"Your reservation has been successfully made!", "success");

		</script>
	@endif




	@if(Session::has('rooms_not_available'))

		<script>

			swal({
			title: "<div class='alert alert-danger'> <strong>Warning! </strong> </div>",
			text: "<span style='color:#ff2222'> {!! session("rooms_not_available") !!}<span>",
				html: true
			});

		</script>

	@endif

<script>


	//to enable and disable the promotion text box field
	function enableDisable(benable,id)
	{

		if(benable)
		{
			document.getElementById(id).removeAttribute('disabled');
		}
		else{

			document.getElementById(id).setAttribute('disabled','disabled');
		}
	}


	//validate form submission before send to the server side

	function roomavailability(){

		var checkin_date = document.getElementById('datepicker').value;
		var checkout_date = document.getElementById('datepicker1').value;
		var adults =  document.getElementById('adults').value;

		if(checkin_date == "" || checkout_date == "" || checkout_date == "" || adults == "Adults") {
			if (checkin_date == "") {
				swal({
					title: "<div class='alert alert-danger'> <strong>Warning! </strong> </div>",
					text: "<span style='color:#ff2222'> Select a Check-In date <span>",
					html: true
				});

			}
			else if (checkout_date == "") {
				swal({
					title: "<div class='alert alert-danger'> <strong>Warning! </strong> </div>",
					text: "<span style='color:#ff2222'> Select a Check-Out date <span>",
					html: true
				});


			}
			else if (adults == "Adults") {
				swal({
					title: "<div class='alert alert-danger'> <strong>Warning! </strong> </div>",
					text: "<span style='color:#ff2222'> Select Adults <span>",
					html: true
				});

			}

			return false;
		}
		else {


			return true;


		}
	}

	// script code for date picker 1
	$("#datepicker").datepicker({
		dateFormat:'yy-mm-dd',
		minDate:1,
		changeMonth: true,
		changeYear: true,
		defaultDate:new Date(),


		//on change of the date
		onSelect:function(){



			var arrival =$(this).datepicker( 'getDate' );
			var departure = $("#datepicker1" ).datepicker( "getDate" );

			/*var _MS_PER_DAY = 1000 * 60 * 60 * 24;
			var utc1 = Date.UTC(arrival.getFullYear(), arrival.getMonth(), arrival.getDate());
			var utc2 = Date.UTC(departure.getFullYear(), departure.getMonth(), departure.getDate());


			var difference = Math.abs(Math.floor((utc2 - utc1) / _MS_PER_DAY));

			$("#nights").val(difference);*/


			/*if(arrival > departure){
			 */

			$.datepicker._clearDate('#datepicker1');
			$("#nights").val(0);
			/*}
			 */
		},
		//onclose set the min date of the departure
		onClose: function(selectedDate) {

			// Set the minDate of 'to' as the selectedDate of 'from'
			var dt=new Date(selectedDate);


			dt.setDate(dt.getDate() + 1);


			$("#datepicker1").datepicker("option", "minDate", dt);
		}



	});


	$('#datepicker1').datepicker({
		dateFormat:'yy-mm-dd',
		changeMonth: true,
		changeYear: true,
		minDate:2,


		onClose:function(){
			var departure =$(this).datepicker( 'getDate' );
			var arrival = $("#datepicker" ).datepicker( "getDate" );


			var _MS_PER_DAY = 1000 * 60 * 60 * 24;
			var utc1 = Date.UTC(arrival.getFullYear(), arrival.getMonth(), arrival.getDate());
			var utc2 = Date.UTC(departure.getFullYear(), departure.getMonth(), departure.getDate());


			var difference = Math.abs(Math.floor((utc2 - utc1) / _MS_PER_DAY));

			$("#nights").val(difference);

			if(difference > 200)
			{


				$('#nightsmodalpopup200').modal('show');
				$.datepicker._clearDate('#datepicker1');


			}
			else{
				if(difference > 14)
				{
					$('#nightsmodalpopup').modal('show');

				}
			}


			document.getElementById('ono_of_rooms').value = 1;
			document.getElementById('adults').value = 1;
			document.getElementById('children').value =0;




		}
	});


	$('#ono_of_rooms').on('change',function(e){
		console.log(e);

		var rooms=parseInt(e.target.value);


		//console.log(po);


		var adult=document.getElementById('adults').value;

		var children = document.getElementById('children').value;


		var possibleoccupants = parseInt(rooms)*3;

		var totaloccupants = parseInt(adult) + parseInt(children);



		if( totaloccupants > possibleoccupants )
		{

			swal({
				title: "<div class='alert alert-danger'> <strong>Warning! </strong> </div>",
				text: "<span style='color:#ff2222'> Occupancy is exceeded for room type. Additional Rooms need to be booked for requested number of occupants.  <span>",
				html: true });


			var setrooms = totaloccupants/3;
			var remainder = totaloccupants%3;

			if(remainder == 0)
			{
				document.getElementById('ono_of_rooms').value = setrooms;

			}
			else{
				document.getElementById('ono_of_rooms').value = parseInt(setrooms) + 1;


			}
		}


		if(rooms > totaloccupants)
		{
			swal({
				title: "<div class='alert alert-danger'> <strong>Warning! </strong> </div>",
				text: "<span style='color:#ff2222'> The specified number of room(s)  must not exceed the specified number of Occupants. <span>",
				html: true });
			document.getElementById('ono_of_rooms').value = parseInt(adult);
		}

	});




	$('#adults').on('change',function(e){
		console.log(e);

		var adult=parseInt(e.target.value);
		//console.log(po);


		var rooms=document.getElementById('ono_of_rooms').value;
		var children = document.getElementById('children').value;


		var possibleoccupants = parseInt(rooms)*3;

		var totaloccupants = parseInt(adult) + parseInt(children);

		var setrooms = totaloccupants/3;
		var remainder = totaloccupants%3;

		if(setrooms < 13) {
			if (totaloccupants > possibleoccupants) {
				$('#adultmodalpopup').modal('show');
				if (remainder == 0) {
					document.getElementById('ono_of_rooms').value = setrooms;
				}
				else {
					document.getElementById('ono_of_rooms').value = parseInt(setrooms) + 1;
				}
			}

			if (rooms > totaloccupants) {
				$('#roommodalpopup').modal('show');

				if (remainder == 0) {
					document.getElementById('ono_of_rooms').value = setrooms;
				}
				else {
					document.getElementById('ono_of_rooms').value = parseInt(setrooms) + 1;
				}
			}
		}else{

			$('#exceedmodalpopup').modal('show');
			document.getElementById('ono_of_rooms').value = 1;
			document.getElementById('adults').value = 1;
			document.getElementById('children').value =0;

		}

	});


	$('#children').on('change',function(e){
		console.log(e);

		var children=parseInt(e.target.value);
		//console.log(po);


		var rooms=document.getElementById('ono_of_rooms').value;
		var adult = document.getElementById('adults').value;

		var totaloccupants = parseInt(adult) + children;
		var possibleoccupants = parseInt(rooms)*3;
		var setrooms = totaloccupants/3;
		var remainder = totaloccupants%3;




		if(setrooms < 13) {
			if (totaloccupants > possibleoccupants) {
				$('#adultmodalpopup').modal('show');

				if (remainder == 0) {
					document.getElementById('ono_of_rooms').value = setrooms;
				}
				else {
					document.getElementById('ono_of_rooms').value = parseInt(setrooms) + 1;
				}
			}


			if (rooms > totaloccupants) {
				$('#roommodalpopup').modal('show');

				if (remainder == 0) {
					document.getElementById('ono_of_rooms').value = setrooms;
				}
				else {
					document.getElementById('ono_of_rooms').value = parseInt(setrooms) + 1;
				}
			}

		}
		else{

			$('#exceedmodalpopup').modal('show');
			document.getElementById('ono_of_rooms').value = 1;
			document.getElementById('adults').value = 1;
			document.getElementById('children').value =0;

		}



	});








</script>


@endsection