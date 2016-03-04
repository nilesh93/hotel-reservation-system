@extends('adminmaster')


@section('css')

@endsection



@section('title')
    Search Booking - Admin Panel
@endsection


@section('page_title')
    Search Booking
@endsection



@section('breadcrumbs')
    <li>
        <a href="#">Admin</a>
    </li>
    <li  class="active">
        <a href="#">Search Booking</a>
    </li>
@endsection



@section('content')
    <div class="portlet">
        <div class="portlet-body">
            <div class="row" id="temptable">
                <table class="table table-striped table-bordered table-hover dataTables-example" id="dd" plugin="datatable" >
                    <thead>
                    <tr>
                        <th>Reservation ID</th>
                        <th>Remarks</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Adults</th>
                        <th>Children</th>
                        <th>Rooms</th>
                        <th>Nights</th>
                        <th>Total Amount</th>
                        <th>Type</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection



@section('js')
    <script>

        $('document').ready(function(){
            document.getElementById("management").click();
            document.getElementById("BS").setAttribute("class","active");
            dataLoad();
        });

        function dataLoad(){
            var oTable = $('#dd').DataTable();
            oTable.destroy();
            $('#dd').DataTable({
                "ajax": "admin_search/bookings",
                "columns": [
                    { "data": "room_reservation_id" },
                    { "data": "remarks"},
                    { "data": "check_in" },
                    { "data": "check_out" },
                    { "data": "adults"},
                    { "data": "children"},
                    { "data": "num_of_rooms" },
                    { "data": "num_of_nights"},
                    { "data": "total_amount"},
                    { "data": "type" }
                ]
            });
        }

    </script>

@endsection