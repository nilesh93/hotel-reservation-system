@if(!empty($room))
 
<div class="row">
<input type="hidden" value="{{$resId}}" id="room_reservation_id">
	<div class="card-box widget-inline" style="padding-top:0cm">
		<div class="row">
			<div class="col-lg-4 col-sm-6">
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
						<td class="">In </td>
						<td>{{$room[0]->check_in}}</td>
						</tr>
						
						<tr>
						<td class="">Out </td>
						<td>{{$room[0]->check_out}}</td>
						</tr>
						
						<tr>
						<td class="">Adults </td>
						<td>{{$room[0]->adults}}</td>
						</tr>
						
						<tr>
						<td class="">Kids </td>
						<td>{{$room[0]->children}}</td>
						</tr>
						
						<tr>
						<td class="">Nights </td>
						<td>{{$room[0]->num_of_nights}}</td>
						</tr>
						
						<tr>
						<td class="">Rooms</td>
						<td>{{$room[0]->num_of_rooms}}</td>
						</tr>
						<tr>
						<td class="">Promo </td>
						<td>{{$room[0]->promo_code}}</td>
						</tr>
						<tr class="success">
						<td class="">Total </td>
						<td> Rs.{{ number_format($room[0]->total_amount,2,'.',',')}}</td>
						</tr>
						</tbody>
					
					
					</table>
					
					 

					 


				</div>
			</div>

			<div class="col-lg-4 col-sm-6  ">
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

			<div class="col-lg-4 col-sm-6 text-primary">
				<div class="widget-inline-box text-center"  style="padding-top:0cm">

					<h4 class="text-muted text-uppercase ">Room Information</h4>
					
					
					
						<br>
					<table class="table table-hover">
					
					<tbody>
						@foreach($roomInfo as $r)
						<tr>
						<td class="text-uppercase">{{$r->type_name}} x {{$r->count}}</td>
						<td><span class="label label-primary">{{$r->meal}}</span> </td>
						</tr>
						@endforeach
						 
					 
						</tbody>
					
					
					</table>
					
					@if(empty($roomInfo))
					
					<div class="alert alert-dismissible alert-warning">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <h4>Room Information Unavailable</h4>
</div>
					@endif
					<h4 class="text-muted text-uppercase ">Room BLocks</h4>
					<br>
					
					
							<br>
					<table class="table table-hover">
					
					<tbody>
						@foreach($roomblocks as $r)
						<tr>
						<td class="text-uppercase">{{$r->room_num}}</td>
						<td><span class="label label-success">{{$r->type_name}}</span> </td>
						</tr>
						@endforeach
						 
					 
						</tbody>
					
					
					</table>
						@if(empty($roomblocks))
					
					<div class="alert alert-dismissible alert-warning">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <h4>Room Blocks Unavailable</h4>
</div>
					@endif
				</div>
			</div>



		</div>
	</div>

</div>
@else

<div class="alert alert-dismissible alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong>This room is not reserved!</strong>.
</div>


@endif