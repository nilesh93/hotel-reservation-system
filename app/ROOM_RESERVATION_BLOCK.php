<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ROOM_RESERVATION_BLOCK extends Model
{
    //

    protected $table = 'ROOM_RESERVATION_BLOCK';
    protected $primaryKey = ['room_num', 'room_reservation_id'];

    public $timestamps  = false;

}
