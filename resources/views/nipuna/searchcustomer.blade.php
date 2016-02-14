@extends('adminmaster')


@section('css')

@endsection



@section('title')


Search Customer - Admin Panel

@endsection


@section('page_title')
Search Customer
@endsection



@section('breadcrumbs')

<li>
	<a href="#">Admin</a>
</li>
<li  class="active">
	<a href="#">Search Customer</a>
</li>

@endsection



@section('content')
<div class="portlet"> 

<div class="portlet-body">

    <div class="row" id="temptable">
        <table class="table table-striped table-bordered table-hover dataTables-example" id="dd" plugin="datatable" >
                    <thead>
                        <tr>
                            
                            
                            <th>Customer ID</th>
                            <th>NIC / Passport</th>
                            <th>Email</th>
                            <th>Telephone</th>
                            <th>Block Status</th>
                            <th>Address Line 1</th>
                            <th>Address Line 2</th>
                            <th>City</th>
                            <th>Postal Code</th>
                            <th>Country</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>

                </table>
    </div>
      
</div></div>

        @endsection



@section('js')
<script>
	$('document').ready(function(){

        
        document.getElementById("management").click();
        document.getElementById("CS").setAttribute("class","active");
        dataLoad();
});

function dataLoad(){

        var oTable = $('#dd').DataTable();
        oTable.destroy();

        $('#dd').DataTable( {
            "ajax": "admin_search/customers",
            "columns": [
                { "data": "cus_id" },
                { "data": "NIC_passport_num"},
                { "data": "email" },
                { "data": "telephone_num" },
                { "data": "block_status"},
                { "data": "address_line_1"},
                { "data": "address_line_2"},
                { "data": "city"},
                { "data": "zip_code"},
                { "data": "country"}

            ]
        } );


    }

</script>

@endsection