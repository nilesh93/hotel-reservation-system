@if(!empty($room))
 
<div class="row">

<input type="hidden" value="{{$room[0]->hall_reservation_id}}" id="hall_reservation_id">
	<div class="card-box widget-inline" style="padding-top:0cm">
		<div class="row">
			<div class="col-lg-6 col-sm-6">
				<div class="widget-inline-box text-center" style="padding-top:0cm">

					<h4 class="text-muted text-uppercase">Reservation Information</h4>
					<br>
					<table class="table table-hover">
					
						<tbody>
						<tr>
						<td class="">Status </td>
						<td><span class="label label-success">{{$room[0]->status}} </span></td>
						</tr>
							
						<tr>
						<td class="">Hall </td>
						<td><span class="label label-success">{{$room[0]->title}} </span></td>
						</tr>
						<tr>
						<td class="">Date </td>
						<td>{{$room[0]->reserve_date}}</td>
						</tr>
					 
						 
						<tr class="success">
						<td class="">Total </td>
						<td> Rs.{{ number_format($room[0]->total_amount,2,'.',',')}}</td>
						</tr>
						</tbody>
					
					
					</table>
					
					 

					 


				</div>
			</div>

			<div class="col-lg-6 col-sm-6  ">
				<div class="widget-inline-box text-center"  style="padding-top:0cm">

					<h4 class="text-muted text-uppercase ">Customer Information</h4>
					<br>
					<table class="table table-hover">
					
					<tbody>
						<tr>
					 
						<td>{{$room[0]->name}}</td>
						</tr>
						
						<tr>
						 
						<td>{{$room[0]->NIC_passport_num}}</td>
						</tr>
						
						<tr>
					 
						<td>{{$room[0]->email}}</td>
						</tr>
						
						<tr>
						 
						<td>{{$room[0]->telephone_num}}</td>
						</tr>
						
						
					 
						</tbody>
					
					
					</table>
					
				</div>
			</div>

		 


		</div>
	</div>

</div>
@else

<div class="alert alert-dismissible alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong>This hall is not reserved!</strong>.
</div>


@endif