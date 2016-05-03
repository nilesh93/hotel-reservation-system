@if(!empty($room))

<div class="row">
<div class="col-md-6">
<h5>Reservation Information</h5>

    
     <div class="row" style="padding-top:2%">
    <div class="col-md-4"><b>Check In </b></div>
    <div class="col-md-8">{{$room[0]->check_in}}</div>
    </div>
    
     <div class="row" style="padding-top:2%">
    <div class="col-md-4"><b>Check Out </b></div>
    <div class="col-md-8">{{$room[0]->check_in}}</div>
    </div>
    
     <div class="row" style="padding-top:2%">
    <div class="col-md-4"><b>Adults </b></div>
    <div class="col-md-8">{{$room[0]->adults}}</div>
    </div>
    
    
     <div class="row" style="padding-top:2%">
    <div class="col-md-4"><b>Kids </b></div>
    <div class="col-md-8">{{$room[0]->children}}</div>
    </div>
    
   <div class="row" style="padding-top:2%">
    <div class="col-md-4"><b>No Of nights </b></div>
    <div class="col-md-8">{{$room[0]->num_of_nights}}</div>
    </div>
 
     <div class="row" style="padding-top:2%">
    <div class="col-md-4"><b>Promo Code</b></div>
    <div class="col-md-8">{{$room[0]->promo_code}}</div>
    </div>
    
 


</div>



<div class="col-md-6">
<h5>Customer Information</h5>

<div class="row" style="padding-top:2%">
    <div class="col-md-4"><b>Customer Name </b></div>
    <div class="col-md-8">{{$room[0]->name}}</div>
    </div>
    
    <div class="row" style="padding-top:2%">
    <div class="col-md-4"><b>NIC </b></div>
    <div class="col-md-8">{{$room[0]->NIC_passport_num}}</div>
    </div>
    
    <div class="row" style="padding-top:2%">
    <div class="col-md-4"><b>Email </b></div>
    <div class="col-md-8">{{$room[0]->email}}</div>
    </div>
    
    
    <div class="row" style="padding-top:2%">
    <div class="col-md-4"><b>Phone </b></div>
    <div class="col-md-8">{{$room[0]->telephone_num}}</div>
    </div>
</div>
    </div>
@else

<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>This room is not reserved!</strong>.
</div>


@endif