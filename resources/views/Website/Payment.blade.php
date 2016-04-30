@extends('webmaster')

@section('title')
	Reservation Payment
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
		</div>

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

				<h1>Place Your Reservation</h1>

				<div class="row">
					<div id="myBooking">
						<!--this div area will be used by ajax call-->
					</div>
				</div>
				<hr>
				<br>

				<div class="row" id="paypal">

					<div class="col-sm-12 col-md-12 col-lg-12">

						<div class="price" align="center">
							<br>

							<!--this form is used to connect to the paypal API-->
							<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" >

								<input type="hidden" name="cmd" value="_xclick">
								<input type="hidden" name="business" value="rishanthakumar@gmail.com">
								<input type="hidden" name="item_name" value="Total Payable">
								<input type="hidden" name="no_item_price" value="0">
								<input type="hidden" name="no_item_number" value="0">
								<input type="hidden" name="amount" value="{{ session('pay_pal_total_payable')}}"><!--here the total payable amount is attached-->
								<input type="hidden" name="no_shipping" value="0">
								<input type="hidden" name="no_note" value="1">
								<input type="hidden" name="currency_code" value="USD">
								<input type="hidden" name="lc" value="AU">
								<input type="hidden" name="bn" value="PP-BuyNowBF">

								<input type="image" onclick="submitFormOkay = true;" src="https://www.paypalobjects.com/webstatic/en_US/btn/btn_paynow_107x26.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!"><br>
								<input type="image" src="https://www.paypalobjects.com/webstatic/mktg/logo/AM_mc_vs_dc_ae.jpg" border="0"  alt="PayPal - The safer, easier way to pay online!">

								<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">

							</form>

						</div><!-- /price -->

					</div><!-- /col12 -->

				</div><!-- /row -->

			</section><!-- content -->

		</div><!-- /container -->

	</div>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<!--this is used to trigger whether the user clicked the back button-->
	<input type="hidden" id="refresh" value="no">

@endsection

@section('js')

	<script>


		//if it is a hall reservation then load hall reservation details
		@if(Session::has('hall_selected'))
            $(document).ready(function(){

					loadHallMyBooking()
				});
		@endif

        //this function used to trigger whether the user clicks the back buttom
		window.onload = function () {

			if (typeof history.pushState === "function") {
				history.pushState("jibberish", null, null);
				window.onpopstate = function () {
					history.pushState('newjibberish', null, null);

					//sweet alert function
					swal({
								title: "Navigate?",
								text: "Do not use back buttons in your reservation process,if you continue you will lose your details",
								type: "warning",
								showCancelButton: true,
								confirmButtonColor: "#DD6B55",
								confirmButtonText: "Continue",
								cancelButtonText: "Cancel",
								closeOnConfirm: false},

							function(isConfirm){   if (isConfirm) {

								window.location.href = "{{ url('/') }}";
							}

							});

					// Handle the back (or forward) buttons here
					// Will NOT handle refresh, use onbeforeunload for this.
				};
			}
			else {
				var ignoreHashChange = true;
				window.onhashchange = function () {
					if (!ignoreHashChange) {
						ignoreHashChange = true;
						window.location.hash = Math.random();
						// Detect and redirect change here
						// Works in older FF and IE9
						// * it does mess with your hash symbol (anchor?) pound sign
						// delimiter on the end of the URL
					}
					else {
						ignoreHashChange = false;
					}
				};
			}
		};

		//this function is used to refresh the page when user comes to the pagw using back button
		$(document).ready(function(e) {

			var $input = $('#refresh');
			$input.val() == 'yes' ? location.reload(true) : $input.val('yes');
		});

		//this function is used to trigger when user try to navigate to any links
		$(document).on("click", "a", function() {

			swal({
						title: "Navigate?",
						text: "You will lose your details",
						type: "warning",
						showCancelButton: true,
						confirmButtonColor: "#DD6B55",
						confirmButtonText: "Continue",
						cancelButtonText: "Cancel",
						closeOnConfirm: false
					},
					function (isConfirm) {
						if (isConfirm) {
							window.location.href = "{{ url('/') }}";
							return false;
						}
					});

			return false;
		});

		//if it is a room reservation then load the room reservation details
		@if(Session::has('room_types'))
            $(document).ready(function(){
					loadMybooking();
				});
		@endif

        //this function is to load the content of room reservation
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
									'<span class="checkout-title finance">Rs.' + formatNumber(data.rates[i]) + '</span>' +
									'<span class="checkout-value"></span>' +
									'</div> <!-- /col-3 -->' +

									'<div class="col-sm-2 col-md-2 col-lg-2">' +
									'<span class="checkout-title finance">Rs.' + formatNumber(data.rates[i] * data.no_of_rooms[i]) + '</span>' +
									'<span class="checkout-value"></span>' +
									'</div><!-- /col-2 -->' +

									'<div class="col-sm-1 col-md-1 col-lg-1">' +
									'<span class="checkout-title">' +
									'</div><!-- /col-2 -->' +
									'</div>' +
									'</div>' +
									'</div>' +
									'</div>';

							//increment it order to get the total amount payable
							total += data.rates[i] * data.no_of_rooms[i];
						}

						var begin = '<hr>' +
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


						var end ='<div class="col-md-12"><hr>' +

								'<div class="col-md-3">' +
								'</div>' +

								'<div class="col-md-6">' +
								'<h2 align="center"><b>Total : <span class="finance">Rs.' + formatNumber(total) + '</span></b><h2>' +
								'</div>' +

								'<div class="col-md-3" align="right">' +

								'<form id="payForm" name="payForm" method="get" action="{{ url('room_reservation') }}" >' +
								'<input type="hidden" name="_token" value="{{ csrf_token() }}">' +
								'<input type="hidden" name="CanPay" value="Can">' +
								'<button type="submit" class="btn btn-primary" onclick="confirmPayment()">Make Payments</button>' +
								'</form>' +

								'</div>' +
								'<hr>' +

								'</div>';

						document.getElementById("myBooking").innerHTML = begin + body + end;
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

		//this function is to load the hall content
		function loadHallMyBooking()
		{
			var hall_id = "{{ session('hall_selected') }}";

			$.ajax({
				type: 'get',
				url: 'book_hall_add',
				data: {
					'hall_id':hall_id
				},

				success:function(data){

					var begin = '<div align="center">' +
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
							'<span class="checkout-value"></span>' +
							'</div><!-- /col-4 -->' +

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

					var end = '<div class="col-md-12"><hr>' +
							'<div class="col-md-3"></div>' +

							'<div class="col-md-6">' +
							'<h2 align="center"><b>Total : <span class="finance">Rs.' + formatNumber(data.hall_detail[0].advance_payment) + '</span></b><h2>' +
							'</div>' +

							'<div class="col-md-3" align="right">' +
							'<form id="payForm" method="get" action="{!! url('hall_reserve_final') !!}">' +
							'<input type="hidden" name="_token" value="{{ csrf_token() }}">' +
							'<input type="hidden" name="CanPay" value="Can">' +
							'<button type="submit" class="btn btn-primary" onclick="confirmPayment()">Make Payments</button>' +
							'</form>' +
							'</div>' +

							'<hr>' +
							'</div>';

					document.getElementById('myBooking').innerHTML = begin + body +end;
				},
				error: function(xhr, ajaxOptions, thrownError) {
					console.log(thrownError);

					swal("Ooops!", "Something Went Wrong! ("+thrownError+")", "error");
				}
			});
		}

		function confirmPayment()
		{

			swal({

						title: "Are you sure?",
						text: "Reservation will be confirmed",
						type: "info",
						showCancelButton: true,
						confirmButtonText: "OK",
						cancelButtonText: "Cancel",
						closeOnConfirm: false,
						closeOnCancel: true,
						showLoaderOnConfirm: true

					},
					function(isConfirm){
						if (isConfirm) {

							document.getElementById('payForm').submit()

						}

					});

			document.getElementById('payForm').onsubmit = function() {
				return false;
			}
		}




	</script>

@endsection