@extends('adminmaster')


@section('css')

@endsection



@section('title')


DEMO PAGE

@endsection


@section('page_title')
ADMIN DEMO
@endsection



@section('breadcrumbs')

<li>
	<a href="#">Admin</a>
</li>
<li  class="active">
	<a href="#">Demo</a>
</li>

@endsection



@section('content')


    
        
<div class="col-lg-12" style="margin:0px; padding:0px" >

    <form class="form-horizontal" >

        <div class="form-group" >
            <!--
            <div class="col-lg-2" style="padding-left:0px; margin-left:0px">
                <input class="form-control" id="search" oninput="navigate()"  placeholder="Enter Item Code" type="text">
            </div>-->
            <div class="col-lg-1" style="padding-left:0cm;">
                <button type="button" class="btn btn-primary btn-default" onclick="add_promotions_modal()">Add Promotions</button>
            </div>
</div>
    </form>
    <br>
</div>
    
   
    <div class="row" id="temptable">
        <table class="table table-striped table-bordered table-hover dataTables-example" id="dd" plugin="datatable" >
                    <thead>
                        <tr>
                            
                            
                            <th>Promotion Code</th>
                            <th>Promotion Name</th>
                            <th>Promotion Description</th>
                            <th>Date From</th>
                            <th>Date To</th>
                            <th>rate</th>
                            <th class="col-md-1"></th>
                            <th class="col-md-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>

                </table>
    </div>
      
        
    <!--Add Promotions Modal-->
    <div  class="modal fade" id="add_promotions_modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add Promotions</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" enctype="multipart/form-data" onsubmit="" method="post">

                    <div class="row">
                        <div class="form-group">
                            <label for="quantity" class="col-lg-5 control-label">Promotion Name</label>
                            <div class="col-lg-6">
                                <input class="form-control" id="prom_name" placeholder="Promotion Name" type="text">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="item" class="col-lg-5 control-label">Promotion Descrition</label>
                            <div class="col-lg-6">
                                <input class="form-control" id="prom_description" placeholder="Promotion Descrition" type="text">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                            <div class="form-group">
                                <label for="description" class="col-lg-5 control-label">Start Date</label>
                                <div class='input-group date' id='datetimepicker1'>
                                    <input type='text' class="form-control" id='start_date'/>
                                    <span class="input-group-addon">
                                     <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                    </div>

                        <div class="row">
                            <div class="form-group">
                                <label for="description" class="col-lg-5 control-label">Start Date</label>
                                <div class='input-group date' id='datetimepicker2'>
                                    <input type='text' class="form-control" id='end_date'/>
                                    <span class="input-group-addon">
                                     <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <label for="discount" class="col-lg-5 control-label">Rate</label>
                                <div class="col-lg-6">
                                    <input class="form-control" id="prom_rate" placeholder="Rate" type="number">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="alert alert-dismissible alert-success" id="addedsuccessfully" hidden="true">                   
                    <button type="button" class="close" data-dismiss="alert">×</button>
                <strong> Added Successfully!</strong>  
                </div>
                <div class="alert alert-dismissible alert-success" id="adderror" hidden="true">                   
                    <button type="button" class="close" data-dismiss="alert">×</button>
                <strong> Adding Fail!</strong>  
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="add_promotion()" class="btn btn-primary" name="submit" >Add Promotion</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-------------------------------------END OF MANUAL ITEM ENTRY-------------------------------->
        @endsection



@section('js')
<script>
	$('document').ready(function(){

        
        document.getElementById("management").click();
        document.getElementById("MM").setAttribute("class","active");
        dataLoad();
});

</script>

@endsection