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
			<a href="#" class="room-trigger"><i class="fa fa-calendar-o"></i> Check Availability</a>
			<div class="room-form">
				<span class="glyphicon glyphicon-remove"></span>



				<form class="form-horizontal" action="{!! url('room_availability') !!}" method="Post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">

					<br>

					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12">

							<i class="fa fa-calendar"></i>
							<input type="text"  class="form-control default-cursor" id="datepicker" value="Check In Date" name="check_in" placeholder="Check In Date"  readonly="readonly"  />

						</div><!-- /col-md-12 -->
					</div><!-- /row -->

					<br>

					<div class="row">

						<div class="col-sm-12 col-md-12 col-lg-12">
							<i class="fa fa-calendar"></i>
							<input type="text" class="form-control default-cursor" Value="Check Out Date" id="datepicker1"  name="check_out" placeholder="Check Out Date" readonly/>

						</div><!-- /col-md-12 -->
					</div><!-- /row -->

					<br>

					<div class="row">
						<div class="col-sm-6 col-md-6 col-lg-6">
							<select class="form-control "  name="adults" id="adults">

								<option>Adults</option>
								@for($i=1;$i<31;$i++)
									<option value={{ $i}}>{{$i}}</option>
								@endfor
							</select>
						</div><!-- /col-md-6 -->
						<div class="col-sm-6 col-md-6 col-lg-6">
							<select class="form-control"  name="children" id="children">
								<option>Kids</option>
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

								@for($i=1;$i< 13;$i++)
									<option value={{ $i}}>{{$i}}</option>
								@endfor
							</select>
						</div>
					</div>	<!-- /row -->

					<br>



					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12">
							<input class="form-control input-lg" type="text" placeholder="Enter Promo Code">
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


		<div id="myBooking" class="col-md-12">

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


				?>

			<div class="col-md-6">

						<article class="room-post row">
							<div class="col-sm-6 col-md-6 col-lg-6">
								<img class="img-thumbnail" src="{{URL::asset('FrontEnd/img/superior_rooms/superior1.png')}}" alt="themesgravity">
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
													<select class="form-control"  name="rate_code" id="rate_code">

														<option value="Select Meal Type">Select Meal Type </option>
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

<script>

	function selectRooms(id){



		var divid = id+"roomselect";
		var modalid = id+"select"



		$.ajax({
			type: "get",
			url: 'select_room_add',
			data: $('#'+divid).serialize(),


			success:function(data){

				swal('Success','Successfully Added!', 'success');
				$('#'+modalid).modal('hide');

				document.getElementById("myBooking").innerHTML = '<h1 align="center">My Booking<h1><hr><div align="center"><div class="checkout-info row"><div class="col-sm-3 col-md-3 col-lg-3"><span class="checkout-title">Room: '+data.room_type_name+'</span><span class="checkout-value"></span></div><!-- /col-3 --><div class="col-sm-3 col-md-3 col-lg-3"><span class="checkout-title">No. of rooms: '+data.no_of_rooms+'</span><span class="checkout-value"></span></div><!-- /col-3 --><div class="col-sm-3 col-md-3 col-lg-3"><span class="checkout-title">Check in:</span><span class="checkout-value">02-07-2014</span></div><!-- /col-3 --><div class="col-sm-3 col-md-3 col-lg-3"><span class="checkout-title">Check out:</span><span class="checkout-value">08-07-2014</span></div><!-- /col-3 --></div></div><hr>';

			},


			error: function(xhr, ajaxOptions, thrownError) {
				console.log(thrownError);
			}
		});



		return false;


	}


	//datepicker
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



	function showModalRoomSelector(id){


		var temp = '#'+id;

		$(temp).modal('show');


	}



</script>


@endsection