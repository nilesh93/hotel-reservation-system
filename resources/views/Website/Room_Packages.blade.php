@extends('webmaster')


@section('title')

Room Packages

@endsection


@section('css')



@endsection






@section('content')
	<div class="row">
		<div class="col-md-12">

			<img src="{{URL::asset('FrontEnd/img/accomadation/accomdation-pg-bg.jpg')}}" alt="" width="100%">
			<a href="#" class="room-trigger"><i class="fa fa-calendar-o"></i> Check Availability</a>
			<div class="room-form">
				<span class="glyphicon glyphicon-remove"></span>



						<form class="form-horizontal" action="{!! url('/room_packages/room_availability') !!}" method="Post">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">

					<br>

					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12">

							<i class="fa fa-calendar"></i>
								<input type="date" class="form-control" id="datepicker" value="Check In Date" name="check_in"/>

						</div><!-- /col-md-12 -->
					</div><!-- /row -->

					<br>

					<div class="row">

						<div class="col-sm-12 col-md-12 col-lg-12">
							<i class="fa fa-calendar"></i>
							<input type="date" class="form-control" Value="Check Out Date" id="datepicker1"  name="check_out"/>

						</div><!-- /col-md-12 -->
					</div><!-- /row -->

					<br>

							<div class="row">
								<div class="col-sm-6 col-md-6 col-lg-6">
									<select class="selectpicker">
										<option>Adults</option>
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
									</select>
								</div><!-- /col-md-6 -->
								<div class="col-sm-6 col-md-6 col-lg-6">
									<select class="selectpicker">
										<option>Kids</option>
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
									</select>
								</div><!-- /col-md-6 -->
							</div><!-- /row -->

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
	<br>
	<br>

	<div class="row">
		<div class="col-md-12">

			@foreach($room_types as $room_type)
				<div class="col-sm-3 col-md-3 col-lg-3">
					<div class="roombox">
						<div class="room-image">
							<img src="FrontEnd/img/superior_rooms/superior2.png" alt="themesgravity">
							<h4><a style="text-decoration: none" onclick="showModal({{$room_type->room_type_id}})" href="#">{{ $room_type->type_name }}</a></h4>
						</div><!-- /room-image -->
						<div class="room-content">
							<p class="room-price"><small>From 169$ per nights</small></p>
							<hr>
							<p>{{ $room_type->description }}</p>
						</div><!-- /room-content -->
					</div><!-- /roombox -->
				</div><!-- /col-sm-3 -->


				<div class="modal fade" id="{{$room_type->room_type_id}}">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&close;</button>
								<h4 class="modal-title">Modal title</h4>
							</div>
							<div class="modal-body">
								<p>One fine body…</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<button type="button" class="btn btn-primary">Save changes</button>
							</div>
						</div>
					</div>
				</div>



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

<script>

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
function showModal(id){


	var temp = '#'+id;

	$(temp).modal('show');


}


</script>


@endsection