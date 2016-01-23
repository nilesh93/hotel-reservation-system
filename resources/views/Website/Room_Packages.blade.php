@extends('webmaster')





@section('title')

Room Packages

@endsection




@section('css')


@endsection






@section('content')
	<div class="row">
		<div class="col-md-12">

			<img src="{{URL::asset('FrontEnd/img/accomadation/accomdation-pg-bg.jpg')}}" alt="" width="100%">
			<a href="#" class="room-trigger"><i class="fa fa-calendar-o"></i> Check Availability</a>
			<div class="room-form">
				<span class="glyphicon glyphicon-remove"></span>
				<form action="#" method="Post">
					<div class="row">
						<div class="col-sm-8 col-md-12 col-lg-8">
							<select class="selectpicker" style="display: none;">
								<option>Accomodation Type</option>
								<option>Standard</option>
								<option>Delux</option>
								<option>Villa</option>
								<option>Presidential</option>
							</select>
						</div><!-- /col-md-8 -->

					</div><!-- /row -->

					<br>

					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12">
							<input type="text" class="datepicker picker__input" value="Check In Date" data-date-format="mm/dd/yy" readonly="" id="P1796116474" aria-haspopup="true" aria-expanded="false" aria-readonly="false" aria-owns="P1796116474_root"><div class="picker" id="P1796116474_root" aria-hidden="true"><div class="picker__holder"><div class="picker__frame"><div class="picker__wrap"><div class="picker__box"><div class="picker__header"><div class="picker__month">January</div><div class="picker__year">2016</div><div class="picker__nav--prev" data-nav="-1" role="button" aria-controls="P1796116474_table" title="Previous month"> </div><div class="picker__nav--next" data-nav="1" role="button" aria-controls="P1796116474_table" title="Next month"> </div></div><table class="picker__table" id="P1796116474_table" role="grid" aria-controls="P1796116474" aria-readonly="true"><thead><tr><th class="picker__weekday" scope="col" title="Sunday">Sun</th><th class="picker__weekday" scope="col" title="Monday">Mon</th><th class="picker__weekday" scope="col" title="Tuesday">Tue</th><th class="picker__weekday" scope="col" title="Wednesday">Wed</th><th class="picker__weekday" scope="col" title="Thursday">Thu</th><th class="picker__weekday" scope="col" title="Friday">Fri</th><th class="picker__weekday" scope="col" title="Saturday">Sat</th></tr></thead><tbody><tr><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1451154600000" role="gridcell">27</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1451241000000" role="gridcell">28</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1451327400000" role="gridcell">29</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1451413800000" role="gridcell">30</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1451500200000" role="gridcell">31</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1451586600000" role="gridcell">1</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1451673000000" role="gridcell">2</div></td></tr><tr><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1451759400000" role="gridcell">3</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1451845800000" role="gridcell">4</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1451932200000" role="gridcell">5</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1452018600000" role="gridcell">6</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1452105000000" role="gridcell">7</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1452191400000" role="gridcell">8</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1452277800000" role="gridcell">9</div></td></tr><tr><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1452364200000" role="gridcell">10</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1452450600000" role="gridcell">11</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1452537000000" role="gridcell">12</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1452623400000" role="gridcell">13</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1452709800000" role="gridcell">14</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1452796200000" role="gridcell">15</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1452882600000" role="gridcell">16</div></td></tr><tr><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1452969000000" role="gridcell">17</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1453055400000" role="gridcell">18</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1453141800000" role="gridcell">19</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1453228200000" role="gridcell">20</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1453314600000" role="gridcell">21</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1453401000000" role="gridcell">22</div></td><td role="presentation"><div class="picker__day picker__day--infocus picker__day--today picker__day--selected picker__day--highlighted" data-pick="1453487400000" role="gridcell" aria-activedescendant="true">23</div></td></tr><tr><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1453573800000" role="gridcell">24</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1453660200000" role="gridcell">25</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1453746600000" role="gridcell">26</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1453833000000" role="gridcell">27</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1453919400000" role="gridcell">28</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1454005800000" role="gridcell">29</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1454092200000" role="gridcell">30</div></td></tr><tr><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1454178600000" role="gridcell">31</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1454265000000" role="gridcell">1</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1454351400000" role="gridcell">2</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1454437800000" role="gridcell">3</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1454524200000" role="gridcell">4</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1454610600000" role="gridcell">5</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1454697000000" role="gridcell">6</div></td></tr></tbody></table><div class="picker__footer"><button class="picker__button--today" type="button" data-pick="1453487400000" disabled="" aria-controls="P1796116474">Today</button><button class="picker__button--clear" type="button" data-clear="1" disabled="" aria-controls="P1796116474">Clear</button></div></div></div></div></div></div>
						</div><!-- /col-md-12 -->
					</div><!-- /row -->

					<br>

					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12">
							<input type="text" class="datepicker picker__input" value="Check Out Date" data-date-format="mm/dd/yy" readonly="" id="P435932880" aria-haspopup="true" aria-expanded="false" aria-readonly="false" aria-owns="P435932880_root"><div class="picker" id="P435932880_root" aria-hidden="true"><div class="picker__holder"><div class="picker__frame"><div class="picker__wrap"><div class="picker__box"><div class="picker__header"><div class="picker__month">January</div><div class="picker__year">2016</div><div class="picker__nav--prev" data-nav="-1" role="button" aria-controls="P435932880_table" title="Previous month"> </div><div class="picker__nav--next" data-nav="1" role="button" aria-controls="P435932880_table" title="Next month"> </div></div><table class="picker__table" id="P435932880_table" role="grid" aria-controls="P435932880" aria-readonly="true"><thead><tr><th class="picker__weekday" scope="col" title="Sunday">Sun</th><th class="picker__weekday" scope="col" title="Monday">Mon</th><th class="picker__weekday" scope="col" title="Tuesday">Tue</th><th class="picker__weekday" scope="col" title="Wednesday">Wed</th><th class="picker__weekday" scope="col" title="Thursday">Thu</th><th class="picker__weekday" scope="col" title="Friday">Fri</th><th class="picker__weekday" scope="col" title="Saturday">Sat</th></tr></thead><tbody><tr><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1451154600000" role="gridcell">27</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1451241000000" role="gridcell">28</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1451327400000" role="gridcell">29</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1451413800000" role="gridcell">30</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1451500200000" role="gridcell">31</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1451586600000" role="gridcell">1</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1451673000000" role="gridcell">2</div></td></tr><tr><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1451759400000" role="gridcell">3</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1451845800000" role="gridcell">4</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1451932200000" role="gridcell">5</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1452018600000" role="gridcell">6</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1452105000000" role="gridcell">7</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1452191400000" role="gridcell">8</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1452277800000" role="gridcell">9</div></td></tr><tr><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1452364200000" role="gridcell">10</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1452450600000" role="gridcell">11</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1452537000000" role="gridcell">12</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1452623400000" role="gridcell">13</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1452709800000" role="gridcell">14</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1452796200000" role="gridcell">15</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1452882600000" role="gridcell">16</div></td></tr><tr><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1452969000000" role="gridcell">17</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1453055400000" role="gridcell">18</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1453141800000" role="gridcell">19</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1453228200000" role="gridcell">20</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1453314600000" role="gridcell">21</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1453401000000" role="gridcell">22</div></td><td role="presentation"><div class="picker__day picker__day--infocus picker__day--today picker__day--selected picker__day--highlighted" data-pick="1453487400000" role="gridcell" aria-activedescendant="true">23</div></td></tr><tr><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1453573800000" role="gridcell">24</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1453660200000" role="gridcell">25</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1453746600000" role="gridcell">26</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1453833000000" role="gridcell">27</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1453919400000" role="gridcell">28</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1454005800000" role="gridcell">29</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1454092200000" role="gridcell">30</div></td></tr><tr><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1454178600000" role="gridcell">31</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1454265000000" role="gridcell">1</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1454351400000" role="gridcell">2</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1454437800000" role="gridcell">3</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1454524200000" role="gridcell">4</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1454610600000" role="gridcell">5</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1454697000000" role="gridcell">6</div></td></tr></tbody></table><div class="picker__footer"><button class="picker__button--today" type="button" data-pick="1453487400000" disabled="" aria-controls="P435932880">Today</button><button class="picker__button--clear" type="button" data-clear="1" disabled="" aria-controls="P435932880">Clear</button></div></div></div></div></div></div>
						</div><!-- /col-md-12 -->
					</div><!-- /row -->

					<br>

					<div class="row">
						<div class="col-sm-6 col-md-6 col-lg-6">
							<select class="selectpicker" style="display: none;">
								<option>Adults</option>
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
							</select>
						</div><!-- /col-md-6 -->
						<div class="col-sm-6 col-md-6 col-lg-6">
							<select class="selectpicker" style="display: none;">
								<option>Kids</option>
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
							</select>
						</div><!-- /col-md-6 -->
					</div><!-- /row -->

					<br>

					<div class="row">

					</div><!-- /row -->
					<br>
					<button type="submit" class="btn btn-primary">Check Availability</button>
				</form>
			</div>
		</div>
	</div> <!-- /row -->
	<br>
	<br>
	<br>
	<br>

	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-sm-3 col-md-3 col-lg-3">
					<div class="roombox">
						<div class="room-image">
							<img src="FrontEnd/img/superior_rooms/superior2.png" alt="themesgravity">
							<h4><a href="#">superior single</a></h4>
						</div><!-- /room-image -->
						<div class="room-content">
							<p class="room-price"><small>From 169$ per nights</small></p>
							<hr>
							<p>Enjoy downtown San Francisco in a charming hotel that is surrounded by shoopping and restaurants.</p>
						</div><!-- /room-content -->
					</div><!-- /roombox -->
				</div><!-- /col-sm-3 -->
				<div class="col-sm-3 col-md-3 col-lg-3">
					<div class="roombox">
						<div class="room-image">
							<img src="FrontEnd/img/luxury_rooms/luxury1.png" alt="themesgravity">
							<h4><a href="#">luxury double</a></h4>
						</div><!-- /room-image -->
						<div class="room-content">
							<p class="room-price"><small>From 179$ per nights</small></p>
							<hr>
							<p>Enjoy downtown San Francisco in a charming hotel that is surrounded by shoopping and restaurants.</p>
						</div><!-- /room-content -->
					</div><!-- /roombox -->
				</div><!-- /col-sm-3 -->
				<div class="col-sm-3 col-md-3 col-lg-3">
					<div class="roombox">
						<div class="room-image">
							<img src="FrontEnd/img/superior_rooms/superior3.png" alt="themesgravity">
							<h4><a href="#">guest rooms</a></h4>
						</div><!-- /room-image -->
						<div class="room-content">
							<p class="room-price"><small>From 279$ per nights</small></p>
							<hr>
							<p>Enjoy downtown San Francisco in a charming hotel that is surrounded by shoopping and restaurants.</p>
						</div><!-- /room-content -->
					</div><!-- /roombox -->
				</div><!-- /col-sm-3 -->
				<div class="col-sm-3 col-md-3 col-lg-3">
					<div class="roombox">
						<div class="room-image">
							<img src="FrontEnd/img/deluxe_rooms/deluxe1.png" alt="themesgravity">
							<h4><a href="#">Deluxe rooms</a></h4>
						</div><!-- /room-image -->
						<div class="room-content">
							<p class="room-price"><small>From 279$ per nights</small></p>
							<hr>
							<p>Enjoy downtown San Francisco in a charming hotel that is surrounded by shoopping and restaurants.</p>
						</div><!-- /room-content -->
					</div><!-- /roombox -->
				</div><!-- /col-sm-3 -->

			</div>
		</div>

	</div>

	<br>
	<br>
	<br>
	<br>
	<br>
@endsection




@section('js')

<script>

function hello(){
    
   alert("Refer the coding to see where javascript should be written you fucktard!"); 
    
    
}


</script>


@endsection