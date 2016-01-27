<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ROOM_RESERVATION extends Model
{
    //

    protected $table = 'ROOM_RESERVATION';

    protected $primaryKey = 'room_reservation_id';

    public $timestamps  = false;

    public function CUSTOMER()
    {
        return $this->belongsTo('App\CUSTOMER', 'room_reservation_id');
    }

}
