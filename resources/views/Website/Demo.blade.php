@extends('webmaster')





@section('title')
Home
@endsection




@section('css')

<style>
 #owl-demo .item{
    background: #42bdc2;
    padding: 30px 0px;
    margin: 5px;
    color: #FFF;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    text-align: center;
}

</style>
@endsection






@section('content')


 <div class="big-slider">
          <div id="big-slider-carousel" class="carousel slide" data-ride="carousel">
          <a class="left carousel-nav" href="#big-slider-carousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
              <a class="right carousel-nav" href="#big-slider-carousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#big-slider-carousel" data-slide-to="0" class="active"></li>
            <li data-target="#big-slider-carousel" data-slide-to="1"></li>
            <li data-target="#big-slider-carousel" data-slide-to="2"></li>
          </ol>

          <!-- Wrapper for slides -->
          <div class="carousel-inner">
			  <?php  $class = "active"; ?>
			  @foreach($images as $i)
			  
			  	
			      <div class="item  {{$class}}">
                <img src="{{$i->path}}" />
              
              <div class="container">
              <div class="carousel-text">
              <a href="#">
                  <h2>Ocean View Welcomes You</h2>
                  <br>
                  <h2>to Indulge Your Senses</h2>
              </a>
              </div><!-- /carousel-text -->
              </div><!-- /container -->
            </div>
			  
			  
			  @if($class == "active")
			  <?php $class = ""; ?>
			  @endif
			  @endforeach
			  
        <!-- /item -->
          </div><!-- /carousel-inner -->
        </div><!-- /big-slider-carousel -->
        
        </div><!-- /big-slider -->


	 <div class="container left-sidebar">
	<aside id="sidebar">
		<div class="widget widget-contact">
			<h5>Contact</h5>

			<div class="address">
				<i class="fa fa-home"></i>
				<p>No.556,<br> Moragahahena Road,
					Pitipana North,<br>
					Homagama.</p>
			</div><!-- /address -->

			<div class="phone">
				<i class="fa fa-phone"></i>
				<p>+94 114404040<br>
					+94 114368291<br>
					+94 777743612</p>
			</div><!-- /phone -->

			<div class="time">
				<i class="fa fa-clock-o"></i>
				<p>08-16 hours<br>Monday - Friday</p>
			</div><!-- /time -->

			<div class="email">
				<i class="fa fa-envelope-o"></i>
				<p>amalyareach@<br>yahoo.com</p>
			</div><!-- /email -->

		</div><!-- /widget-contact -->

	</aside>
	<section id="content">
<h3>Services</h3>
										<hr>
		<div class="row">
			
			<div  >
  <div class="item" style="margin-bottom:2%">
                            <div class="col-sm-4 col-md-4 col-lg-4" style="margin-bottom:2%">
                                <div class="servicebox">
                                    <div class="servicebox-content">
                                        <h3><a href="#">Wellness &amp; Spa Weekend Getaway</a></h3>
                                        <p>In addition to our Web Development services, we offer Mobile Applications In addition to our Web Development services </p>
                                    </div><!-- /servicebox-content --> 
                                </div><!-- /servicebox -->
                            </div><!-- /col-sm-3 --></div>
  <div class="item" style="margin-bottom:2%"> <div class="col-sm-4 col-md-4 col-lg-4" style="margin-bottom:2%">
                                <div class="servicebox">
                                    <div class="servicebox-content">
                                        <h3><a href="#">World Cuisine for all your Tastes</a></h3>
                                        <p>In addition to our Web Development services, we offer Mobile Applications In addition to our Web Development services </p>
                                    </div><!-- /servicebox-content --> 
                                </div><!-- /servicebox -->
                            </div></div>
  <div class="item" style="margin-bottom:2%">  <!-- /col-sm-3 -->
                            <div class="col-sm-4 col-md-4 col-lg-4" style="margin-bottom:2%">
                                <div class="servicebox">
                                    <div class="servicebox-content">
                                        <h3><a href="#">Business and VIP Exclussive Studios</a></h3>
                                        <p>In addition to our Web Development services, we offer Mobile Applications In addition to our Web Development services </p>
                                    </div><!-- /servicebox-content --> 
                                </div><!-- /servicebox -->
                            </div><!-- /col-sm-3 --></div>
  <div class="item" style="margin-bottom:2%"><div class="col-sm-4 col-md-4 col-lg-4" style="margin-bottom:2%">
                                <div class="servicebox">
                                    <div class="servicebox-content">
                                        <h3><a href="#">Let us Guide you through the Island</a></h3>
                                        <p>In addition to our Web Development services, we offer Mobile Applications In addition to our Web Development services </p>
                                    </div><!-- /servicebox-content --> 
                                </div><!-- /servicebox -->
                            </div><!-- /col-sm-3 --></div>
   
</div>
			
                         
                            
                        </div>
		

	<br>
										<br>
										<h3>Customer Reviews</h3>
										<hr>
		
		
			 <div class="img-carousel">
				 <div class="infobox" style="background:#d3ebef;">
						<div id="img-carousel" class="carousel slide" data-ride="carousel">

						  <!-- Wrapper for slides -->
						  <div class="carousel-inner" id="testimonial"> 
							 
						  </div><!-- /carousel-inner -->

						  <!-- Controls -->
						  <a class="left carousel-nav" href="#img-carousel" data-slide="prev">
						    <span class="glyphicon glyphicon-chevron-left"></span>
						  </a>
						  <a class="right carousel-nav" href="#img-carousel" data-slide="next">
						    <span class="glyphicon glyphicon-chevron-right"></span>
						  </a>
						</div>
					</div>
		</div>
										 
		 </section>
</div>

@endsection




@section('js')

 

<script type="text/javascript">
	
$(document).ready(function() {
  
 
	
	$.ajax({
		type: "get",
		url:"https://maps.googleapis.com/maps/api/place/details/json?placeid=ChIJ7261PD1S4joRJq4Cw7ZDgX8&key=AIzaSyAxCbXVxRICVSNWa_zbEr_XrmMW0cQQz9w",
		data:{},
		success:function(data){
			
			console.log(data.result.reviews);
			var body = "";
			var a = 0;
			for(var i = 0; i<data.result.reviews.length ; i++){
				
				if(data.result.reviews[i].text != ""){
			 	
					if(a == 0){
						
						var cls = "active";
					}else{
						
						var cls = "";
					}
					
					body+= '   <div class="item '+cls+'">'+
							     '   '+
							     '  <div class="img-info">'+
								    '   <h3>'+data.result.reviews[i].author_name+'</h3>'+
								    '   <p>'+data.result.reviews[i].text+' </p>'+
								    '  '+
							      ' </div> '+
							   '  </div>';
					a++;
				}
				
			}
			
			document.getElementById("testimonial").innerHTML = body;
			
		},
		error: function(err){
			
			console.log(err);
		}
	});
 
	

});
</script>
	

@endsection