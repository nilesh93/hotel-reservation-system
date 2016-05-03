@extends('webmaster')

@section('title')
	Available Rooms
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

	<div class="row">

		<div class="col-md-12">

			<img src="{{URL::asset('FrontEnd/img/accomadation/accomdation-pg-bg.jpg')}}" alt="" width="100%">

			<div class="booking-area">

				<div class="container">

					<div class="row">

						<div class="col-lg-12">

							<div class="col-md-3 col-lg-3">
								<h3>
									<label class="label label-info ">Check-In:
										@if(Session::has('check_in'))
											{!! session('check_in') !!}
										@endif

									</label>
								</h3>
							</div>

							<div class="col-md-2 col-lg-2">
								<h3>
									<label class="label label-info ">Rooms:
										@if(Session::has('rooms'))
											{!! session('rooms') !!}
										@endif
										<input type="hidden" name="rooms" id="rooms" value="{!! session('rooms') !!}">
									</label>
								</h3>
							</div>

							<div class="col-md-2 col-lg-2">
								<h3>
									<label class="label label-info ">Adults:
										@if(Session::has('adults'))
											{!! session('adults') !!}
										@endif
									</label>
								</h3>
							</div>

							<div class="col-md-2 col-lg-2">
								<h3>
									<label class="label label-info ">Kids:
										@if(Session::has('kids'))
											{!! session('kids') !!}
										@endif
									</label>
								</h3>
							</div>

							<div class="col-md-3 col-lg-3">
								<h3>
									<label class="label label-info ">Check-Out:
										@if(Session::has('check_out'))
											{!! session('check_out') !!}
										@endif
									</label>
								</h3>
							</div>

						</div><!-- /col-md-12 -->

					</div><!-- /row -->

				</div><!-- /container -->

			</div><!-- /booking-area -->

			<a href="#" class="room-trigger"><i class="fa fa-calendar-o"></i> Check Availability</a>

			<div class="room-form">

				<span class="glyphicon glyphicon-remove"></span>

				<!--this is the form to check room availability-->
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
								@for($i=1;$i<=$adults_can;$i++)
									<option value={{$i}} @if(session('adults') == $i) selected @endif>{{$i}}</option>
								@endfor
							</select>
						</div><!-- /col-md-6 -->

						<div class="col-sm-6 col-md-6 col-lg-6">
							<select class="form-control"  name="children" id="children">
								<option value="Kids">Kids</option>
								@for($i=0;$i<=$kids_can;$i++)
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
								@for($i=1;$i<=$total_rooms;$i++)
									<option value={{ $i}} @if(session('rooms') == $i) selected @endif>{{$i}}</option>
								@endfor
							</select>
						</div>

					</div>	<!-- /row -->
					<br>

					@if(session('promo_code'))

					<div class="checkbox" align="center">
						<label>
							Promotion Code
						</label>
					</div>

					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12">
							<input class="form-control input-lg" type="text" id="promotxt" name="promotxt" placeholder="Enter Promo Code" @if(session('promo_code')) value="{{ session('promo_code') }}"@endif readonly>
						</div><!-- /col-md-12 -->
					</div><!-- /row -->
					<br>
					@endif
					<button type="submit" class="btn btn-primary">Check Availability</button>

				</form>

			</div>

		</div>

	</div> <!-- /row -->
	<br>
	<br>

	<div class="row">
		<!--this div is used by ajax call-->
		<div id="myBooking">

		</div>

	</div>
	<br>

	<div class="row">
		<div class="col-md-12">

			@foreach($room_types as $room_type)

				<?php

				//retrieve the rates and an image os the rooom type
				$ratefrom = DB::table('RATES')
						->where('room_type_id','=',$room_type->room_type_id)
						->min('single_rates');

				$image    = DB::table('ROOM_IMAGES')
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
							<h3 class="room-title"><a onclick="viewRoomType('{{$room_type->room_type_id}}','{{$room_type->type_name}}')">{{ $room_type->type_name }}</a></h3>
							<span>from</span>
							<span class="room-cost finance"> Rs.{{ number_format($ratefrom,2) }}</span>

							<p>
								<b>Available Rooms : {{ $room_type_available[$room_type->room_type_id]}}</b>
							</p>

							<button  id="select_button{{$room_type->room_type_id }}" onclick='showModalRoomSelector("{{ $room_type->room_type_id }}select")' class="btn btn-primary" >Select</button>

							@if($room_type_available[$room_type->room_type_id]  == 0)
								<script>
									document.getElementById("select_button{{$room_type->room_type_id }}").disabled = true;
								</script>
							@endif

							<div class="room-post-person">
								<span class="serif-font">max </span>
								<span class="glyphicon glyphicon-user"></span>
								<span style="font-size:18px;">x <small>3 per room</small></span>
							</div>

						</div><!-- /end nine columns -->

					</article><!-- /article -->

				</div><!-- /col-md-6 -->

				<?php

				//get the meal types
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

								<!--- room selection form-->
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
													<option value=1>1</option>
													@for($i=2;$i<=$room_type_available[$room_type->room_type_id];$i++)
														<option value={{ $i}} @if(session('no_of_rooms'.$room_type->room_type_id) == $i) selected @endif>{{$i}}</option>
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
														<option value="{{ $mealtypeRate->rate_code }}" @if(session('meal_type'.$room_type->room_type_id) == $mealtypeRate->rate_code) selected @endif>{{ $mealtypeRate->meal_type_name }} :<span class="room-cost finance"> Rs.{{ number_format($mealtypeRate->single_rates,2) }}</span></option>
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

	<!--this is used to trigger whether the back button is clicked or not and refresh the page according to that-->
	<input type="hidden" id="refresh" value="no">

	<br>
	<br>
	<br>
	<br>
	<br>
@endsection

@section('js')

	<script>

		//if room types are selected load the content
		@if(Session::has('room_types'))
            $(document).ready(function(){
					loadMybooking();
				});
		@endif

        //this is to trigger when back button is clicked
		$(document).ready(function(e) {

			var $input = $('#refresh');
			$input.val() == 'yes' ? location.reload(true) : $input.val('yes');
		});

		//this function is used to select rooms and add to the session
		function selectRooms(id)
		{
			var divid = id+"roomselect";
			var modalid = id+"select";
			var rate_code_value = document.getElementById(id+'rate_code').value;

			if(rate_code_value != 0) {

				$.ajax({
					type: "get",
					url: 'select_room_add',
					data: $('#'+divid).serialize(),

					success:function(data){

						swal('Success','Successfully Added!', 'success');
						$('#'+modalid).modal('hide');
						loadMybooking();
						$('html,body').animate({scrollTop:$("#myBooking").offset().top}, 'slow');
					},
					error: function(xhr, ajaxOptions, thrownError) {
						console.log(thrownError);
					}
				});
			}
			else {
				swal({
					title: "<div class='alert alert-danger'> <strong>Warning! </strong> </div>",
					text: "<span style='color:#ff2222'>Select a Meal Type<span>",
					html: true });
			}

			return false;
		}

		//this function is to delete a selected roon type details from the session and dipaly new list
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
					}
					}
			);

			return false;
		}

		//this function is to load the selected room content
		function loadMybooking(){

			$.ajax({
				type:'get',
				url:'loadBooking',
				success:function(data){

					var body ='';
					var total = 0;
					var total_rooms = 0;

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
									'<span class="checkout-title finance">Rs.' + formatNumber(data.rates[i]) + '</span>' +
									'<span class="checkout-value"></span>' +
									'</div> <!-- /col-3 -->' +

									'<div class="col-sm-2 col-md-2 col-lg-2">' +
									'<span class="checkout-title finance">Rs.' + formatNumber(data.rates[i] * data.no_of_rooms[i]) + '</span>' +
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
									'</div>';

							total += data.rates[i] * data.no_of_rooms[i];
							total_rooms += parseInt(data.no_of_rooms[i]);
						}

						var begin = '<h1 align="center">My Booking</h1><hr>' +
								'<div align="center">' +
								'<div class="checkout-info row">' +

								'<div class="col-sm-3 col-md-3 col-lg-3">' +
								'<span class="checkout-title">Room Type</span>' +
								'<span class="checkout-value"></span>' +
								'</div><!-- /col-3 -->' +

								'<div class="col-sm-2 col-md-2 col-lg-2">' +
								'<span class="checkout-title">No. of rooms</span>' +
								'<span class="checkout-value"></span>' +
								'</div><!-- /col-2 -->' +

								'<div class="col-sm-2 col-md-2 col-lg-2">' +
								'<span class="checkout-title">Meal Type</span>' +
								'<span class="checkout-value"></span>' +
								'</div><!-- /col-3 -->' +

								'<div class="col-sm-2 col-md-2 col-lg-2">' +
								'<span class="checkout-title">Rates</span>' +
								'<span class="checkout-value"></span>' +
								'</div><!-- /col-3 -->' +

								'<div class="col-sm-2 col-md-2 col-lg-2">' +
								'<span class="checkout-title">Line Total</span>' +
								'<span class="checkout-value"></span>' +
								'</div><!-- /col-2 -->' +

								'<div class="col-sm-1 col-md-1 col-lg-1">' +
								'<span class="checkout-title"></span>' +
								'<span class="checkout-value"></span>' +
								'</div><!-- /col-2 -->' +
								'</div>' +
								'</div>' +
								'<hr>';

						var promo = "";
						var promo_value = 0;

						@if(session('promo_code'))

								promo_value = "{{ session('promo_rate') }}";

						promo = '<br><br><h3 align="center">Promotion Discount : <span class="finance"> Rs.' + formatNumber(total*promo_value) + '</span>  </h3>';

						@endif

						var end = 	'<input type="hidden" name="total_payable" id="total_payable" value='+total+'>' +
								'<input type="hidden" name="total_rooms_selected" id="total_rooms_selected" value='+total_rooms+'>' +
								'<div class="col-md-12"><hr><div class="col-md-3">' +
								'<a  href="{!! url('cancel_reserv') !!}"  style="width: 60%;" type="button" class="btn-link btn-lg">Cancel</a>' +
								'</div>' +
								'<div class="col-md-6"><h2 align="center"><b>Total :<span class="finance"> Rs.' + formatNumber(total*(1-promo_value)) + '</span></b><h2>' +
								'</div>' +

								'<div class="col-md-3" align="right">' +
								'<form method="get" onsubmit="return makepaymentchk()"action="{{ url('payment') }}"><input type="hidden" name="_token" value="{{ csrf_token() }}"><input type="hidden" name="CanPay" value="Can"><button type="submit" class="btn btn-primary" >Make Payments</button></form>' +
								'</div><hr>' +
								'</div>';

						document.getElementById("myBooking").innerHTML = begin + body + promo + end;
					}
					else {
						document.getElementById("myBooking").innerHTML = '';
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					console.log(thrownError);

					swal("Ooops!", "Something Went Wrong! ("+thrownError+")", "error");
				}
			});
		}

		//to enable and disable the promotion text box field
		function enableDisable(benable,id)
		{
			if(benable) {
				document.getElementById(id).removeAttribute('disabled');
			}
			else {
				document.getElementById(id).setAttribute('disabled','disabled');
			}
		}

		//validate form submission before send to the server side
		function roomavailability()
		{
			var checkin_date = document.getElementById('datepicker').value;
			var checkout_date = document.getElementById('datepicker1').value;
			var adults =  document.getElementById('adults').value;
			var no_of_rooms =  document.getElementById('ono_of_rooms').value;

			if(checkin_date == "Check In Date" || checkout_date == "Check Out Date" || checkout_date == "" || adults == "Adults" || no_of_rooms == "No. of Rooms") {
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
				} else if (no_of_rooms == "No. of Rooms") {
					swal({
						title: "<div class='alert alert-danger'> <strong>Warning! </strong> </div>",
						text: "<span style='color:#ff2222'> Select No. of Rooms <span>",
						html: true
					});
				}
				return false;
			}
			else {
				return true;
			}
		}

		//check the room_count when make payments button is clicked
		function makepaymentchk()
		{
			var requested_rooms = "{!! session('rooms') !!}";
			var req_rooms = parseInt(requested_rooms);
			var total_rooms_selected = document.getElementById('total_rooms_selected').value;

			if(req_rooms > total_rooms_selected) {
				swal({
					title: "<div class='alert alert-danger'> <strong>Warning! </strong> </div>",
					text: "<span style='color:#ff2222'> Your selected no of rooms are less than requested no of rooms. Please select "+ (req_rooms - total_rooms_selected) +" more room(s)<span>",
					html: true
				});
				return false;
			}
			else if(req_rooms < total_rooms_selected) {
				swal({
					title: "<div class='alert alert-danger'> <strong>Warning! </strong> </div>",
					text: "<span style='color:#ff2222'> You have selected "+ (total_rooms_selected - req_rooms ) +" more than requested no of room(s). Please select "+ req_rooms +" room(s) only <span>",
					html: true
				});
				return false;
			}
			else {
				//this is put to the session in order to access the payment page
				{{  Session::put('CanPay','yes') }}
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

				var _MS_PER_DAY = 1000 * 60 * 60 * 24;
				var utc1 = Date.UTC(arrival.getFullYear(), arrival.getMonth(), arrival.getDate());
				var utc2 = Date.UTC(departure.getFullYear(), departure.getMonth(), departure.getDate());

				var difference = Math.abs(Math.floor((utc2 - utc1) / _MS_PER_DAY));

				$("#nights").val(difference);

				$.datepicker._clearDate('#datepicker1');
				$("#nights").val(0);
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
				else {
					if(difference > 14) {
						$('#nightsmodalpopup').modal('show');
					}
				}
			}
		});

		$('#ono_of_rooms').on('change',function(e){

			console.log(e);
			var rooms=parseInt(e.target.value);
			var adult=document.getElementById('adults').value;
			var children = document.getElementById('children').value;
			var possibleoccupants = parseInt(rooms)*3;
			var totaloccupants = parseInt(adult) + parseInt(children);

			if( totaloccupants > possibleoccupants ) {

				swal({
					title: "<div class='alert alert-danger'> <strong>Warning! </strong> </div>",
					text: "<span style='color:#ff2222'> Occupancy is exceeded for room type. Additional Rooms need to be booked for requested number of occupants.  <span>",
					html: true });

				var setrooms = totaloccupants/3;
				var remainder = totaloccupants%3;

				if(remainder == 0) {
					document.getElementById('ono_of_rooms').value = setrooms;
				}
				else {
					document.getElementById('ono_of_rooms').value = parseInt(setrooms) + 1;
				}
			}

			if(rooms > totaloccupants) {
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
			var rooms=document.getElementById('ono_of_rooms').value;
			var children = document.getElementById('children').value;
			var possibleoccupants = parseInt(rooms)*3;
			var totaloccupants = parseInt(adult) + parseInt(children);
			var setrooms = totaloccupants/3;
			var remainder = totaloccupants%3;

			if(setrooms < '{{ $total_rooms }}') {
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
			else {

				$('#exceedmodalpopup').modal('show');
				document.getElementById('ono_of_rooms').value = 1;
				document.getElementById('adults').value = 1;
				document.getElementById('children').value =0;
			}
		});

		$('#children').on('change',function(e){

			console.log(e);
			var children=parseInt(e.target.value);
			var rooms=document.getElementById('ono_of_rooms').value;
			var adult = document.getElementById('adults').value;
			var totaloccupants = parseInt(adult) + children;var possibleoccupants = parseInt(rooms)*3;
			var setrooms = totaloccupants/3;
			var remainder = totaloccupants%3;




			if(setrooms < '{{ $total_rooms }}') {
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

		//to dhoe the modals in the master page
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