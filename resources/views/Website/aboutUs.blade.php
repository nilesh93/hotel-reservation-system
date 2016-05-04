@extends('webmaster')

@section('title')
    About Us
@endsection

@section('css')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <section class="head-v1 left-layout">
                <img src="{{URL::asset('FrontEnd/img/about_us/about_us2.jpg')}}" width="100%">
                <section class="head-title">
                    <h2>About Us</h2>
                    <p><small>Experience the difference with us.</small></p>
                </section>
            </section>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2">

        </div>
        <div class="col-lg-8">
            <h2 class="text-center">
                <br>
                About Us
            </h2>
            <p class="text-justify text-info">
                {{$description}}
                {{--Lorem ipsum dolor sit amet, consectetur adipiscing elit. In elementum, arcu quis suscipit posuere, felis nisi blandit augue, nec ornare justo turpis cursus lectus. Donec neque ipsum, volutpat sit amet dictum ac, consectetur sit amet arcu. Aliquam luctus aliquam libero quis sollicitudin. Aliquam quis lobortis ipsum. Nam fermentum, justo eget vulputate ultricies, turpis leo condimentum enim, sed vulputate dolor tortor id odio. Duis vel arcu nisi. Nulla rhoncus dignissim tellus eu condimentum.
                Donec finibus vehicula dui et pharetra. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.--}}
            </p>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <br>
        </div>
    </div>
@endsection