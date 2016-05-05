
@if(!empty($result))

<div class="alert alert-dismissible alert-warning">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <div class="row">
    <div class="col-md-10"> <strong>This Room is Reserved for Today!</strong> </div> 
    <div class="col-md-2">
      <button onclick="viewInfo({{$result[0]->room_reservation_id}})" class="btn btn-warning  btn-block">View</button> 
    </div>
  </div>
</div>
@else


<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>No Reservations Today!</strong>
</div>


@endif