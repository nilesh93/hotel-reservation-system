@extends('adminmaster')


@section('css')

<link href="{{URL::asset('bower_components/fullcalendar/dist/fullcalendar.css')}}" rel="stylesheet" type="text/css" />

<style>

.fc-day:hover{
    background:lightblue;
}
</style>
@endsection



@section('title')


Calander

@endsection


@section('page_title')
CALENDAR
@endsection



@section('breadcrumbs')


<li  class="">
	<a href="#">Admin</a>
</li>
<li  class="active">
	<a href="#">Calendar</a>
</li>

@endsection


@section('page_buttons')
<div class="col-md-4 col-md-offset-4">
    <button type="button" class="btn btn-success waves-effect btn-block waves-light pull-right" data-toggle="modal" data-target="#addRoom">
        <span class="btn-label pull-left"><i class="fa fa-plus"></i>
        </span> HALL RESERVE</button>
</div>
<div class="col-md-4">
    <button type="button" class="btn btn-primary waves-effect btn-block waves-light pull-right" data-toggle="modal" data-target="#addRoomT">
        <span class="btn-label pull-left"><i class="fa fa-plus"></i>
        </span>ROOM RESERVE</button></div>
@endsection


@section('content')
<div ng-app="dashboard" ng-controller ="DashboardController">

	<div class="col-lg-12">

		<div class="panel">

			<div class="panel-body">


				<div ui-calendar="uiConfig.calendar" ng-model="eventSources">

				</div>
			</div>



		</div>

	</div>







	@endsection



	@section('js')



	<script src="{{URL::asset('angular/dashboard/dashboard.module.js')}}"></script>


	@endsection