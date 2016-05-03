
@if(!empty($result))
<div class="row">
<div class="col-md-2"><b>Check In </b></div>
<div class="col-md-1">{{$result[0]->check_in}}</div>
 
<div class="col-md-2"><b>Check Out </b></div>
<div class="col-md-1">{{$result[0]->check_out}}</div>
 
 
<div class="col-md-2"><b>Customer Name </b></div>
<div class="col-md-4">{{$result[0]->name}}</div>
</div>


<div class="row" style="padding-top:8%">
<div class="col-md-2"><b>Adults </b></div>
<div class="col-md-1">{{$result[0]->adults}}</div>
 
<div class="col-md-2"><b>Kids </b></div>
<div class="col-md-1">{{$result[0]->children}}</div>
 
 
<div class="col-md-2"><b> NIC</b></div>
<div class="col-md-1">{{$result[0]->NIC_passport_num}}</div>
 
 
<div class="col-md-1"><b>Phone</b></div>
<div class="col-md-2">{{$result[0]->telephone_num}}</div>
</div>
@else


<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>No Reservations Today!</strong>
</div>


@endif