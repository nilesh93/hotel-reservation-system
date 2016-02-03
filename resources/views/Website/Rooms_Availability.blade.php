@extends('webmaster')





@section('title')

Available Rooms

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

			<div class="booking-area">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">

							<div class="col-md-3 col-lg-3">
								<h3><label class="label label-info ">Check-In:
										@if(Session::has('check_in'))
											{!! session('check_in') !!}
										@endif

									</label></h3>
							</div>



							<div class="col-md-2 col-lg-2">
								<h3><label class="label label-info ">Rooms:
										@if(Session::has('rooms'))
											{!! session('rooms') !!}
										@endif
								<input type="hidden" name="rooms" id="rooms" value="{!! session('rooms') !!}">
									</label></h3>
							</div>


							<div class="col-md-2 col-lg-2">
								<h3><label class="label label-info ">Adults:
										@if(Session::has('adults'))
											{!! session('adults') !!}
										@endif

									</label></h3>
							</div>


							<div class="col-md-2 col-lg-2">
								<h3><label class="label label-info ">Kids:
										@if(Session::has('kids'))
											{!! session('kids') !!}
										@endif

									</label></h3>
							</div>


							<div class="col-md-3 col-lg-3">
								<h3><label class="label label-info ">Check-Out:
										@if(Session::has('check_out'))
											{!! session('check_out') !!}
										@endif

									</label></h3>
							</div>



						</div><!-- /col-md-12 -->
					</div><!-- /row -->
				</div><!-- /container -->
			</div><!-- /booking-area -->

			<a href="#" class="room-trigger"><i class="fa fa-calendar-o"></i> Check Availability</a>


			<div class="room-form">
				<span class="glyphicon glyphicon-remove"></span>



				<form id= "checkavail" name="checkavail" class="form-horizontal" onsubmit="return roomavailability()" action="{!! url('room_availability') !!}"  method="Post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">


					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12">

							<i class="fa fa-calendar"></i>
							<input type="text"  class="form-control default-cursor" id="datepicker" @if(session('check_in')) value ="{!! session('check_in') !!}" @else value="Check In Date" @endif name="check_in" placeholder="Check In Date"  readonly="readonly"  />

						</div><!-- /col-md-12 -->
					</div><!-- /row -->


					<div class="row">

						<div class="col-sm-12 col-md-12 col-lg-12">
							<i class="fa fa-calendar"></i>
							<input type="text" class="form-control default-cursor" @if(session('check_out')) value="{!! session('check_out') !!}" @else Value="Check Out Date" @endif id="datepicker1"  name="check_out" placeholder="Check Out Date" readonly/>

						</div><!-- /col-md-12 -->
					</div><!-- /row -->

					<br>

					<div class="row">
						<div class="col-sm-6 col-md-6 col-lg-6">
							<select class="form-control "  name="adults" id="adults">

								<option value="Adults">Adults</option>
								@for($i=1;$i<31;$i++)
									<option value={{$i}} @if(session('adults') == $i) selected @endif>{{$i}}</option>
								@endfor
							</select>
						</div><!-- /col-md-6 -->
						<div class="col-sm-6 col-md-6 col-lg-6">
							<select class="form-control"  name="children" id="children">
								<option value="Kids">Kids</option>
								@for($i=0;$i<21;$i++)
									<option value={{ $i}} @if(session('kids') == $i) selected @endif>{{$i}}</option>
								@endfor
							</select>
						</div><!-- /col-md-6 -->
					</div><!-- /row -->

					<br>
					<div class="row">

						<div class="col-sm-12 col-md-12 col-lg-12">
							<select class="form-control "  name="ono_of_rooms" id="ono_of_rooms">
								<option value="No. of Rooms" >No. of Rooms</option>

								@for($i=1;$i< 13;$i++)
									<option value={{ $i}} @if(session('rooms') == $i) selected @endif>{{$i}}</option>
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





		<div class="row">
			<div id="myBooking">

			</div>

	</div>
	<br>



	<div class="row">

		<div class="col-md-12">

			@foreach($room_types as $room_type)


				<?php
					$ratefrom = DB::table('RATES')
								->where('room_type_id','=',$room_type->room_type_id)
								->min('single_rates');


					$image = DB::table('ROOM_IMAGES')
							->where('room_type_id','=',$room_type->room_type_id)
							->value('path')





				?>

			<div class="col-md-6">

						<article class="room-post row">
							<div class="col-sm-6 col-md-6 col-lg-6">
								<img class="img-thumbnail" src="{{URL::asset($image)}}" alt="themesgravity">
							</div><!-- /end three columns -->
							<div class="col-sm-6 col-md-6 col-lg-6">

								<span>Discover our</span>
								<h3 class="room-title"><a onclick="showModal({{$room_type->room_type_id}})">{{ $room_type->type_name }}</a></h3>
								<span>from</span>
								<span class="room-cost"> ${{ $ratefrom }}</span>

								<p>
									<b>Available Rooms : {{ $available_superior }}</b>
								</p>

								<a type="button"  onclick='showModalRoomSelector("{{ $room_type->room_type_id }}select")' class="btn btn-primary">Select</a>


								<div class="room-post-person">
									<span class="serif-font">max </span>
									<span class="glyphicon glyphicon-user"></span>
									<span style="font-size:18px;">x <small>3 per room</small></span>
								</div>

							</div><!-- /end nine columns -->

						</article><!-- /article -->

			</div><!-- /col-md-6 -->


			<?php
					$mealtypeRates = DB::table('RATES')
									->join('MEAL_TYPES','RATES.meal_type_id','=','MEAL_TYPES.meal_type_id')
									->where('RATES.room_type_id','=',$room_type->room_type_id)
									->select('MEAL_TYPES.meal_type_name','RATES.rate_code','RATES.single_rates')
									->get();

					?>


				<modal><!-- room_select_modal -->
					<div class="modal fade" id="{{$room_type->room_type_id}}select">
						<div class="modal-dialog ">
							<div class="modal-content">
								<div class="modal-header" style="background: azure">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h3 class="modal-title" align="center">{{ $room_type->type_name }}</h3>
									<br>
								</div>

								<form id="{{ $room_type->room_type_id }}roomselect" onsubmit="return selectRooms({{ $room_type->room_type_id }})">

									<div class="modal-body">


											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<input type="hidden" name="room_type_id" value="{{ $room_type->room_type_id }}">
											<input type="hidden" name="room_type_name" value="{{ $room_type->type_name }}">

											<div class="row">
												<div class="col-md-6 col-sm-6">
													<label for="no_of_rooms"  style="font-size: large">
														No. of Rooms
													</label>
												</div>

												<div class="col-md-6 col-sm-6">
													<select class="form-control"  name="no_of_rooms" id="no_of_rooms">
														{{--@if ($errors->has('code')) <p class="help-block" style="color:red">{{ $errors->first('code') }}</p> @endif--}}
														<option value=1>1</option>

														@for($i=2;$i<=$available_superior;$i++)
															<option value={{ $i}} @if(old('no_of_rooms')==$i ) selected="selected"@endif>{{$i}}</option>
														@endfor
													</select>


												</div>

											</div><!-- /row -->


											<div class="row">

												<div class="col-md-6 col-sm-6" style="margin-top: 3%">
													<label for="stay_type"  style="font-size: large">
														Meal type
													</label>
												</div>

												<div class="col-md-6 col-sm-6" style="margin-top: 3%">
													<select class="form-control"  name="{{ $room_type->room_type_id }}rate_code" id="{{ $room_type->room_type_id }}rate_code">

														<option value=0>Select Meal Type </option>
														@foreach($mealtypeRates as $mealtypeRate)
															<option value="{{ $mealtypeRate->rate_code }}">{{ $mealtypeRate->meal_type_name }} : ${{ $mealtypeRate->single_rates }}</option>

														@endforeach
													</select>

												</div>
											</div><!-- /row -->



									</div>



									<div class="modal-footer" style="background:azure">

										<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary">Save changes</button>

										<br>
									</div>

								</form>




							</div>
						</div>
					</div>
				</modal>

			@endforeach


		</div> <!-- /div-col-md-12 -->
	</div>	<!-- /row -->







	<br>
	<br>
	<br>
	<br>
	<br>



@endsection




@section('js')

	@if(Session::has('room_types'))
		<script>

			$(document).ready(function(){
				loadMybooking();
			});

		</script>
	@endif


<script>

	function selectRooms(id){



		var divid = id+"roomselect";
		var modalid = id+"select";


		var rate_code_value = document.getElementById(id+'rate_code').value;

		if(rate_code_value != 0)
		{

			$.ajax({
				type: "get",
				url: 'select_room_add',
				data: $('#'+divid).serialize(),


				success:function(data){

					swal('Success','Successfully Added!', 'success');
					$('#'+modalid).modal('hide');
					loadMybooking();



				},


				error: function(xhr, ajaxOptions, thrownError) {
					console.log(thrownError);
				}
			});


		}
		else{
			swal({
				title: "<div class='alert alert-danger'> <strong>Warning! </strong> </div>",
				text: "<span style='color:#ff2222'>Select a Meal Type<span>",
				html: true });


		}








		return false;


	}

	function delroomtype(id)
	{


		swal({
					title: "Remove?",
					text: "",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Remove",
					cancelButtonText: "Cancel",
					closeOnConfirm: false},
				function(isConfirm){   if (isConfirm) {

					$.ajax({
						type:'get',
						url:'delete_selected_room_type',
						data: {
							room_type_id:id
						},


						success:function(data){
							loadMybooking();
							swal("Deleted!", "", "success");

						},


						error: function(xhr, ajaxOptions, thrownError) {
							console.log(thrownError);

							swal("Ooops!", "Something Went Wrong! ("+thrownError+")", "error");
						}




					});




				} });




		return false;

	}







	function loadMybooking(){

		$.ajax({


			type:'get',
			url:'loadBooking',



			success:function(data){


				var body ='';
				var total = 0;



				if(data.room_types.length !=0) {
					for (var i = 0; i < data.room_types.length; i++) {

						body += '<div class="row">' +
								'<div class="col-md-12">' + '' +
								'<div align="center">' +
								'<div class="checkout-info row">' +
								'<div class="col-sm-3 col-md-3 col-lg-3">' +
								'<span class="checkout-title">' + data.room_types[i] + '</span>' +
								'<span class="checkout-value"></span>' +
								'</div><!-- /col-3 -->' +

								'<div class="col-sm-2 col-md-2 col-lg-2">' +
								'<span class="checkout-title">' + data.no_of_rooms[i] + '</span>' +
								'<span class="checkout-value"></span>' +
								'</div><!-- /col-3 -->' +

								'<div class="col-sm-2 col-md-2 col-lg-2">' +
								'<span class="checkout-title">' + data.meals[i] + '</span>' +
								'<span class="checkout-value"></span>' +
								'</div><!-- /col-3 -->' +

								'<div class="col-sm-2 col-md-2 col-lg-2">' +
								'<span class="checkout-title">' + data.rates[i] + '</span>' +
								'<span class="checkout-value"></span>' +
								'</div> <!-- /col-3 -->' +

								'<div class="col-sm-2 col-md-2 col-lg-2">' +
								'<span class="checkout-title">' + data.rates[i] * data.no_of_rooms[i] + '</span>' +
								'<span class="checkout-value"></span>' +
								'</div><!-- /col-2 -->' +

								'<div class="col-sm-1 col-md-1 col-lg-1">' +
								'<span class="checkout-title">' +
								'<button onclick="showModalTypeSelector(' + data.ids[i] + ')" type="button" class="btn-primary btn-xs">' +
								'<i class="glyphicon glyphicon-edit"></i>' +
								'</button>  ' +
								'<button onclick="return delroomtype(' + data.ids[i] + ')" type="button" class="btn-primary btn-xs">' +
								'<i class="glyphicon glyphicon-trash"></i>' +
								'</button></span>' +
								'<span class="checkout-value"></span>' +
								'</div><!-- /col-2 -->' +
								'</div>' +
								'</div>' +
								'</div>' +
								'</div>'

						total += data.rates[i] * data.no_of_rooms[i];


					}

					var begin = '<h1 align="center">My Booking</h1><hr><div align="center"><div class="checkout-info row"><div class="col-sm-3 col-md-3 col-lg-3"><span class="checkout-title">Room Type</span><span class="checkout-value"></span></div><!-- /col-3 --><div class="col-sm-2 col-md-2 col-lg-2"><span class="checkout-title">No. of rooms</span><span class="checkout-value"></span></div><!-- /col-2 --><div class="col-sm-2 col-md-2 col-lg-2"><span class="checkout-title">Meal Type</span><span class="checkout-value"></span></div><!-- /col-3 --><div class="col-sm-2 col-md-2 col-lg-2"><span class="checkout-title">Rates ($)</span><span class="checkout-value"></span></div><!-- /col-3 --><div class="col-sm-2 col-md-2 col-lg-2"><span class="checkout-title">Line Total ($)</span><span class="checkout-value"></span></div><!-- /col-2 --><div class="col-sm-1 col-md-1 col-lg-1"><span class="checkout-title"></span><span class="checkout-value"></span></div><!-- /col-2 --></div></div><hr>';


					var end = '<div class="col-md-12"><hr><div class="col-md-3"><button style="width: 60%;" type="button" class="btn-link btn-lg">Cancel</button></div><div class="col-md-6"><h2 align="center"><b>Total($) : ' + total + '</b><h2></div><div class="col-md-3" align="right"><button type="button" class="btn-link btn-lg">Make Payments</button></div><hr></div>'


					document.getElementById("myBooking").innerHTML = begin + body + end;

				}
				else{
					document.getElementById("myBooking").innerHTML = '';


				}


			},


			error: function(xhr, ajaxOptions, thrownError) {
				console.log(thrownError);
			}



		});

	}



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

		if(checkin_date == "Check In Date" || checkout_date == "Check Out Date" || checkout_date == "" || adults == "Adults") {
			if (checkin_date == "Check In Date") {
				swal({
					title: "<div class='alert alert-danger'> <strong>Warning! </strong> </div>",
					text: "<span style='color:#ff2222'> Select a Check-In date <span>",
					html: true
				});

			}
			else if (checkout_date == "Check Out Date" || checkout_date == "") {
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
		minDate:0,
		changeMonth: true,
		changeYear: true,
		defaultDate:new Date(),


		//on change of the date
		onSelect:function(){



			var arrival =$(this).datepicker( 'getDate' );
			var departure = $("#datepicker1" ).datepicker( "getDate" );

			var _MS_PER_DAY = 1000 * 60 * 60 * 24;
			var utc1 = Date.UTC(arrival.getFullYear(), arrival.getMonth(), arrival.getDate());
			var utc2 = Date.UTC(departure.getFullYear(), departure.getMonth(), departure.getDate());


			var difference = Math.abs(Math.floor((utc2 - utc1) / _MS_PER_DAY));

			$("#nights").val(difference);


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
		minDate:0,


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
		}
		else{
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








	function showModalRoomSelector(id){


		var temp = '#'+id;

		$(temp).modal('show');


	}


	function showModalTypeSelector(id){


		var temp = '#'+id+'select';

		$(temp).modal('show');


	}



</script>


@endsection