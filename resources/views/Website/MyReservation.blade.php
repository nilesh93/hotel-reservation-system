@extends('webmaster')





@section('title')

	My Reservations

@endsection


@section('links')



	<link href="{{URL::asset('BackEnd/assets/css/core.css')}}" rel="stylesheet" type="text/css" />


	<link href="{{URL::asset('BackEnd/assets/css/icons.css')}}" rel="stylesheet" type="text/css" />


	<link href="{{URL::asset('BackEnd/assets/plugins/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />



	<!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>


	<![endif]-->

	@yield('css')
	<script src="{{URL::asset('BackEnd/assets/js/modernizr.min.js')}}"></script>


@endsection

@section('css')


	<style>
		input[readonly].default-cursor {
			cursor: default;
		}
	</style>
@endsection

@section('hall_links')

@endsection




@section('content')
	<div class="row">
		<div class="col-md-12">
			<section class="head-v1 left-sidebar">






			</section>
		</div> <!-- /col-md-12 -->




	</div><!-- row -->


	<div class="row">
		<div class="col-md-12">


			<div class="container left-sidebar">


							<div class="col-md-2 col-lg-2">

								<!--- Divider -->
								<div id="sidebar-menu">

										<ul>



											<li class="has_sub">
												<a href="#" class="waves-effect" id="management"><i class="ti-home"></i> <span> My Reservations </span> </a>
												<ul class="list-unstyled">

													<li class="has_sub">
														<a href="#" class="waves-effect" ><i class="fa fa-caret-right"></i> <span>Room Reservation </span> </a>
														<ul class="list-unstyled">

																<li id=""><a href="" onclick="return LoadFutureRoomRese()">Future Room Reservation</a></li>
																<li id="PRR"><a href="" onclick="return LoadPastRoomRese()">Past Room Reservation</a></li>
														</ul>

													<li class="has_sub">
														<a href="#" class="waves-effect" ><i class="fa fa-caret-right"></i> <span>Hall Reservation </span> </a>
														<ul class="list-unstyled">

															<li id=""><a href="" onclick="return LoadFutureHallRese()">Future Hall Reservation</a></li>
															<li id="PRR"><a href="" onclick="return LoadPastHallRese()">Past Hall Reservation</a></li>
														</ul>
												</ul>

											</li>


										</ul>

									<div class="clearfix"></div>

								</div>
								<div class="clearfix"></div>
							</div>


							<div class="col-md-10 col-lg-10" >


								<div class="row">
									<div  align="center">
										<heading id="head">

										</heading>
									</div>
								</div>

								<div class="row">
									<section id="content">





									</section><!-- content -->
								</div>
							</div>


			</div>
		</div>
	</div>
	<br>
	<br>
	<br>
	<br>
	<br>


@endsection


<?php
	$customer_email = Auth::user()->email;

	$customer_id = DB::table('CUSTOMER')
					->where('email',$customer_email)
					->value('cus_id');
?>



@section('js')



	<script>

		@if(Session::has('reserv_status'))


		swal("Success" ,"Your reservation has been successfully made!", "success");
		@if(session('reserv_status') == 'Room_Reservation')



		@endif


		@endif

		@if(Session::has('hreserv_status'))

		swal("Success" ,"Your reservation has been successfully made!", "success");


		@endif

		var resizefunc = [];

		var customer_id = {!! $customer_id !!}


		function LoadFutureRoomRese(){

			document.getElementById('head').innerHTML = "<b><h2>My Future Room Reservations</h2></b>"

			loadRoomTable();

			var oTable = $('#FRR').DataTable();
			oTable.destroy();



			$('#FRR').DataTable( {

				"bLengthChange": false,
				"fnPreDrawCallback": function( oSettings ) {
					oTable = $("#FRR").dataTable();
					oSettings._iDisplayLength = 4;

				},
				"ajax": {
					"url" : "my_future_room_reservations",
					"data" : {
						"customer_id":customer_id

					}

				},
				"columns": [
					{ "data": "created_at" },
					{ "data": "room_reservation_id" },
					{ "data": "check_in"},
					{ "data": "check_out"},
					{ "data": "adults"},
					{ "data": "children"},
					{ "data": "num_of_rooms"},
					{ "data": "total_amount"}
				]
			} );

			return false;

		}


		function LoadPastRoomRese(){

			document.getElementById('head').innerHTML = "<b><h2>My Past Room Reservations</h2></b>"

			loadRoomTable();

			var oTable = $('#FRR').DataTable();
			oTable.destroy();

			$('#FRR').DataTable({

				"bLengthChange": false,
				"fnPreDrawCallback": function( oSettings ) {
					oTable = $("#FRR").dataTable();
					oSettings._iDisplayLength = 4;

				},

				"ajax": {
					"url": "my_past_room_reservations",
					"data": {
						"customer_id": customer_id

					}

				},
				"columns":[
					{ "data" : "created_at"},
					{ "data": "room_reservation_id" },
					{ "data": "check_in"},
					{ "data": "check_out"},
					{ "data": "adults"},
					{ "data": "children"},
					{ "data": "num_of_rooms"},
					{ "data": "total_amount"}

				]





			});

			return false;

		}


		function LoadFutureHallRese(){

			document.getElementById('head').innerHTML = "<b><h2>My Future Hall Reservations</h2></b>"

			loadHallTable();

			var oTable = $('#FRR').DataTable();
			oTable.destroy();

			$('#FRR').DataTable({
				"bLengthChange": false,
				"fnPreDrawCallback": function( oSettings ) {
					oTable = $("#FRR").dataTable();
					oSettings._iDisplayLength = 4;

				},

				"ajax": {
					"url": "my_future_hall_reservations",
					"data": {
						"customer_id": customer_id

					}

				},
				"columns":[
					{ "data" : "created_at"},
					{ "data": "hall_reservation_id" },
					{ "data": "reserve_date"},
					{ "data": "title"},
					{ "data": "total_amount"}

				]

			});

			return false;


		}


		function LoadPastHallRese(){

			document.getElementById('head').innerHTML = "<b><h2>My Past Hall Reservations</h2></b>"

			loadHallTable();

			var oTable = $('#FRR').DataTable();
			oTable.destroy();

			$('#FRR').DataTable({
				"bLengthChange": false,
				"fnPreDrawCallback": function( oSettings ) {
					oTable = $("#FRR").dataTable();
					oSettings._iDisplayLength = 4;

				},

				"ajax": {
					"url": "my_past_hall_reservations",
					"data": {
						"customer_id": customer_id

					}

				},
				"columns":[
					{ "data" : "created_at"},
					{ "data": "hall_reservation_id" },
					{ "data": "reserve_date"},
					{ "data": "title"},
					{ "data": "total_amount"}

				]

			});

			return false;

		}


		function loadRoomTable()
		{
			var body = 	'<div class="col-md-12">'+
					'<table class="table table-striped table-bordered table-hover dataTables-example" id="FRR" plugin="datatable" >'+
					'<thead>'+
					'<tr>'+

					'<th>Date</th>'+
					'<th>ID</th>'+
					'<th>Check-In</th>'+
					'<th>Check-Out</th>'+
					'<th>Adults</th>'+
					'<th>Kids</th>'+
					'<th>No of Rooms</th>'+
					'<th>Amount($)</th>'+


					'</tr>'+
					'</thead>'+
					'<tbody>'+


					'</tbody>'+

					'</table>'+

					'</div>';

			document.getElementById('content').innerHTML = body;

		}



		function loadHallTable(){

			var body = 	'<div class="col-md-12">'+
					'<table class="table table-striped table-bordered table-hover dataTables-example" id="FRR" plugin="datatable" >'+
					'<thead>'+
					'<tr>'+

					'<th>Date</th>'+
					'<th>ID</th>'+
					'<th>Event Date</th>'+
					'<th>Hall</th>'+
					'<th>Amount($)</th>'+


					'</tr>'+
					'</thead>'+
					'<tbody>'+


					'</tbody>'+

					'</table>'+

					'</div>';

			document.getElementById('content').innerHTML = body;

		}
	</script>

	<!-- jQuery  -->





	<script src="{{URL::asset('BackEnd/assets/js/waves.js')}}"></script>

	<script src="{{URL::asset('BackEnd/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
	<script src="{{URL::asset('BackEnd/assets/plugins/datatables/dataTables.bootstrap.js')}}"></script>
	<script src="{{URL::asset('BackEnd/assets/js/fastclick.js')}}"></script>
	<script src="{{URL::asset('BackEnd/assets/js/wow.min.js')}}"></script>

	<script src="{{URL::asset('BackEnd/assets/js/jquery.core.js')}}"></script>
	<script src="{{URL::asset('BackEnd/assets/js/jquery.app.js')}}"></script>

	<!-- Sweet-Alert  -->
	<script src="{{URL::asset('BackEnd/assets/plugins/sweetalert/dist/sweetalert.min.js')}}"></script>
	<script src="{{URL::asset('BackEnd/assets/pages/jquery.sweet-alert.init.js')}}"></script>

	<script src="{{URL::asset('BackEnd/assets/js/moment.min.js')}}"></script>
	<script src="{{URL::asset('BackEnd/assets/js/collapse.js')}}"></script>
	<script src="{{URL::asset('BackEnd/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

	<script src="{{URL::asset('BackEnd/assets/plugins/moment/moment.js')}}"></script>


@endsection