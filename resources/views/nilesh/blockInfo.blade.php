<div class="row">




    <input type="hidden" id="typeCount" value="{{count($roomTypes)}}">
    <div class="col-lg-12">

        <table class="table table-hover">

            <?php $c = 0; ?>
            <tr class="">
                <td> Room Information</td>
                @foreach($roomTypes as $r)
                <input type="hidden" id="rt{{$c}}" value="{{$r->type_name}}">
                <input type="hidden" id="rtc{{$c}}" value="{{$r->count}}">
                <td class="success">{{$r->type_name}}</td>
                <td  class="success">x{{$r->count}}</td>

                <?php $c++; ?>
                @endforeach
            </tr>


        </table>    


    </div>

</div>
<div class="row">

    @foreach($arr as $r)
    <div class="col-md-4">


        <table class="table table-hover">
            @foreach($r as $a)
            <tr id="{{$a->room_id}}">

                <td>{{$a->room_num}}</td>
                <td>{{$a->type_name}}</td>
                <td><button onclick="addBlock('{{$a->type_name}}','{{$a->room_id}}',this)" class="btn btn-sm btn-block btn-success">Select</button></td>

            </tr>
            @endforeach

        </table>    


    </div>

    @endforeach
</div>