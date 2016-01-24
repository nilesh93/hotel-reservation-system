@extends('webmaster')





@section('title')

Available Rooms

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
							<input type="date" class="form-control" id="datepicker" value="Check In Date" name="check_in"/>

						</div><!-- /col-md-12 -->
					</div><!-- /row -->

					<br>

					<div class="row">

						<div class="col-sm-12 col-md-12 col-lg-12">
							<input type="date" class="form-control" Value="Check Out Date" id="datepicker1"  name="check_out"/>

						</div><!-- /col-md-12 -->
					</div><!-- /row -->

					<br>



					<br>

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

			<div class="col-md-6">

						<article class="room-post row">
							<div class="col-sm-6 col-md-6 col-lg-6">
								<img src="{{URL::asset('FrontEnd/img/superior_rooms/superior1.png')}}" alt="themesgravity">
							</div><!-- /end three columns -->
							<div class="col-sm-6 col-md-6 col-lg-6">

								<span>Discover our</span>
								<h3 class="room-title"><a href="#">Superior Single</a></h3>
								<span>from</span>
								<span class="room-cost"> $198</span>

								<p>
									<b>Available Rooms : {{ $available_superior }}</b>
								</p>

								<a type="button" class="btn btn-primary">Select</a>

								<div class="room-post-person">
									<span class="serif-font">max </span>
									<span class="glyphicon glyphicon-user"></span>
									<span style="font-size:18px;">x <small>2 per room</small></span>
								</div><!-- /room-post-person -->

							</div><!-- /end nine columns -->

						</article><!-- /article -->

			</div><!-- /col-md-6 -->


			<div class="col-md-6">
					<article class="room-post row">
						<div class="col-sm-6 col-md-6 col-lg-6">
							<img src="{{URL::asset('FrontEnd/img/deluxe_rooms/deluxe1.png')}}" alt="themesgravity">
						</div><!-- /end three columns -->
						<div class="col-sm-6 col-md-6 col-lg-6">

							<span>Discover our</span>
							<h3 class="room-title"><a href="#">Deluxe Rooms</a></h3>
							<span>from</span>
							<span class="room-cost"> $200</span>

							<p>
								<b>Available Rooms : {{ $available_deluxe }}</b>
							</p>

							<a type="button" class="btn btn-primary">Select</a>

							<div class="room-post-person">
								<span class="serif-font">max </span>
								<span class="glyphicon glyphicon-user"></span>
								<span style="font-size:18px;">x <small>3 per room</small></span>
							</div><!-- /room-post-person -->

						</div><!-- /end nine columns -->

					</article><!-- /article -->
				</div><!-- /col-md-6 -->

		</div> <!-- /div-col-md-12 -->
	</div>	<!-- /row -->



	<div class="row">

		<div class="col-md-12">

			<div class="col-md-6">

				<article class="room-post row">
					<div class="col-sm-6 col-md-6 col-lg-6">
						<img src="{{URL::asset('FrontEnd/img/luxury_rooms/luxury1.png')}}"alt="themesgravity">
					</div><!-- /end three columns -->
					<div class="col-sm-6 col-md-6 col-lg-6">

						<span>Discover our</span>
						<h3 class="room-title"><a href="#">Luxury Rooms</a></h3>
						<span>from</span>
						<span class="room-cost"> $220</span>

						<p>
							<b>Available Rooms : {{ $available_luxury }}</b>
						</p>

						<a type="button" class="btn btn-primary">Select</a>

						<div class="room-post-person">
							<span class="serif-font">max </span>
							<span class="glyphicon glyphicon-user"></span>
							<span style="font-size:18px;">x <small>3 per room</small></span>
						</div><!-- /room-post-person -->

					</div><!-- /end nine columns -->

				</article><!-- /article -->

			</div><!-- /col-md-6 -->


			<div class="col-md-6">
				<article class="room-post row">
					<div class="col-sm-6 col-md-6 col-lg-6">
						<img src="{{URL::asset('FrontEnd/img/superior_rooms/superior3.png')}}" alt="themesgravity">
					</div><!-- /end three columns -->
					<div class="col-sm-6 col-md-6 col-lg-6">

						<span>Discover our</span>
						<h3 class="room-title"><a href="#">Guest Rooms</a></h3>
						<span>from</span>
						<span class="room-cost"> $150</span>

						<p>
							<b>Available Rooms : {{ $available_guest }}</b>
						</p>

						<a type="button" class="btn btn-primary">Select</a>

						<div class="room-post-person">
							<span class="serif-font">max </span>
							<span class="glyphicon glyphicon-user"></span>
							<span style="font-size:18px;">x <small>1 per room</small></span>
						</div><!-- /room-post-person -->

					</div><!-- /end nine columns -->

				</article><!-- /article -->
			</div><!-- /col-md-6 -->

		</div> <!-- /div-col-md-12 -->
	</div>	<!-- /row -->



	<br>
	<br>
	<br>
	<br>
	<br>


	<script src="{{URL::asset('FrontEnd/js/vendor/jquery-1.11.0.min.js')}}"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

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
function hello(){
    
   alert("Refer the coding to see where javascript should be written you fucktard!"); 
    
    
}


</script>


@endsection