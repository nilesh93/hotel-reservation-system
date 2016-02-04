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
						<img src="{{URL::asset('FrontEnd/img/paypal_integration.png')}}" >
					</div><!-- /col7 -->
					<div class="col-sm-5 col-md-5 col-lg-5">
						<div class="price">
							<br>
							<form style="margin-top:7px;" action="#" method="Post">
								<select class="selectpicker">
									<option>Card Type</option>
									<option>Mastercard</option>
									<option>Visa</option>
									<option>American Express</option>
								</select>
								<br>
								<br>
								<input class="form-control input-lg" type="text" placeholder="Cardholder's Name">
								<br>
								<input class="form-control input-lg" type="text" placeholder="Card Number" required >
								<br>
								<input class="form-control input-lg" type="text" placeholder="Card CVC" required >
								<br>
								<div class="row">
									<div class="col-sm-6 col-md-6 col-lg-6">
										<input type="text" class="datepicker" value="Valid Month" data-date-format="mm/dd/yy">
									</div><!-- /col-md-6 -->
									<div class="col-sm-6 col-md-6 col-lg-6">
										<input type="text" class="datepicker" value="Valid Year" data-date-format="mm/dd/yy">
									</div><!-- /col-md-6 -->
								</div><!-- /row -->
								<br>
								<button type="submit" class="btn btn-primary">Confirm Payment</button>
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




<script>



	$(document).ready(function(){
		loadMybooking();
	});


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


					var end = '<div class="col-md-12"><hr><div class="col-md-3"></div><div class="col-md-6"><h2 align="center"><b>Total($) : ' + total + '</b><h2></div><div class="col-md-3" align="right"></div><hr></div>'


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


</script>


@endsection