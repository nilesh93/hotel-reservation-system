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
		</div>


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
			</aside>
			<section id="content">

				<h1>Place Your Reservation</h1>

				<div class="row">
					<div id="myBooking">

					</div>

				</div>

				<hr>

				<br>

				<div class="row">
					<div class="col-sm-7 col-md-7 col-lg-7">
						<p class="big-text">We have the right to cancel your booking if you're credit card is not valid. Your credit card will be charged after we review your booking request.</p>
						<br>

					</div><!-- /col7 -->
					<div class="col-sm-5 col-md-5 col-lg-5">
						<div class="price">
							<br>

							<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
								<input type="hidden" name="cmd" value="_xclick">
								<input type="hidden" name="business" value="rishanthakumar@gmail.com">
								<input type="hidden" name="item_name" value="Room Total">
								<input type="hidden" name="no_item_price" value="0">
								<input type="hidden" name="no_item_number" value="0">
								<input type="hidden" name="amount" value="{{ session('total_payable') }}">

								<input type="hidden" name="no_shipping" value="0">
								<input type="hidden" name="no_note" value="1">
								<input type="hidden" name="currency_code" value="USD">

								<input type="hidden" name="lc" value="AU">
								<input type="hidden" name="bn" value="PP-BuyNowBF">
								<input type="image" src="https://www.paypalobjects.com/webstatic/en_US/btn/btn_paynow_107x26.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
								<input type="image" src="https://www.paypalobjects.com/webstatic/mktg/logo/AM_mc_vs_dc_ae.jpg" border="0"  alt="PayPal - The safer, easier way to pay online!">
								<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
							</form>

						</div><!-- /price -->
					</div><!-- /col7 -->
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



@endsection


@section('js')


	@if(Session::has('hall_selected'))
		<script>


			$(document).ready(function(){

				loadHallMyBooking()
			});

		</script>


	@endif





	<script>


@if(Session::has('room_types'))
	$(document).ready(function(){
		loadMybooking();
	});
@endif

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
								'</div><!-- /col-2 -->' +
								'</div>' +
								'</div>' +
								'</div>' +
								'</div>'

						total += data.rates[i] * data.no_of_rooms[i];


					}

					var begin = '<hr><div align="center"><div class="checkout-info row"><div class="col-sm-3 col-md-3 col-lg-3"><span class="checkout-title">Room Type</span><span class="checkout-value"></span></div><!-- /col-3 --><div class="col-sm-2 col-md-2 col-lg-2"><span class="checkout-title">No. of rooms</span><span class="checkout-value"></span></div><!-- /col-2 --><div class="col-sm-2 col-md-2 col-lg-2"><span class="checkout-title">Meal Type</span><span class="checkout-value"></span></div><!-- /col-3 --><div class="col-sm-2 col-md-2 col-lg-2"><span class="checkout-title">Rates ($)</span><span class="checkout-value"></span></div><!-- /col-3 --><div class="col-sm-2 col-md-2 col-lg-2"><span class="checkout-title">Line Total ($)</span><span class="checkout-value"></span></div><!-- /col-2 --><div class="col-sm-1 col-md-1 col-lg-1"><span class="checkout-title"></span><span class="checkout-value"></span></div><!-- /col-2 --></div></div><hr>';


/*
					var end = '<div class="col-md-12"><hr><div class="col-md-3"></div><div class="col-md-6"><h2 align="center"><b>Total($) : ' + total + '</b><h2></div><div class="col-md-3" align="right"></div><hr></div>'
*/
					var end = '<div class="col-md-12"><hr><div class="col-md-3"><a  href="{!! url('cancel_reserv') !!}"  style="width: 60%;" type="button" class="btn-link btn-lg">Cancel</a></div><div class="col-md-6"><h2 align="center"><b>Total($) : ' + total + '</b><h2></div><div class="col-md-3" align="right"><a   onclick="return makepaymentchk()" href="{!! url('room_reservation') !!}" type="button" class="btn-link btn-lg">Make Payments</a></div><hr></div>'

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


				var begin = '<div align="center"><div class="checkout-info row"><div class="col-sm-4 col-md-4 col-lg-4"><span class="checkout-title">Hall</span><span class="checkout-value"></span></div><!-- /col-4---><div class="col-sm-4 col-md-4 col-lg-4"><span class="checkout-title">Advance Payment ($)</span><span class="checkout-value"></span></div><!-- /col-4---><div class="col-sm-4 col-md-4 col-lg-4"><span class="checkout-title">Refundable Amount ($)</span><span class="checkout-value"></span></div><!-- /col-4 --></div></div><hr>';

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

				var end = '<div class="col-md-12"><hr><div class="col-md-3"><a href="{!! url('cancel_hall_reserv') !!}"  style="width: 60%;" type="button" class="btn-link btn-lg">Cancel</a></div><div class="col-md-6"><h2 align="center"><b>Total($) : ' + data.hall_detail[0].advance_payment + '</b><h2></div><div class="col-md-3" align="right"><a   onclick="return makepaymentchk()" href="{!! url('hall_reserve_final') !!}" type="button" class="btn-link btn-lg">Make Payments</a></div><hr></div>'

				document.getElementById('myBooking').innerHTML = begin + body +end;


			},


			error: function(xhr, ajaxOptions, thrownError) {
				console.log(thrownError);
			}
		});






	}



</script>


@endsection