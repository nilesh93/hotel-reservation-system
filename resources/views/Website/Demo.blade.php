@extends('webmaster')





@section('title')

DEMO PAGE

@endsection




@section('css')


@endsection



@section('section_content')
 

<h1> Hello I am inside the section defined in the theme</h1>

 
@endsection



@section('outside_content')


<h1> I can be Outside the section too should i want to be! Yay!</h1>
<button type="button" class="btn btn-info" onclick="hello()">Lets try JavaScript</button>
   
    
 

@endsection




@section('js')

<script>

function hello(){
    
   alert("Refer the coding to see where javascript should be written you fucktard!"); 
    
    
}


</script>


@endsection