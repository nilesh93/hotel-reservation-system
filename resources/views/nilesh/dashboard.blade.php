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


Dashboard

@endsection


@section('page_title')
DASHBOARD
@endsection



@section('breadcrumbs')


<li  class="">
	<a href="#">Admin</a>
</li>
<li  class="active">
	<a href="#">Dashboard</a>
</li>

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