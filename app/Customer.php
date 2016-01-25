<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CUSTOMER extends Model
{
    //

    protected $table = 'CUSTOMER';

    protected $primaryKey = 'cus_id';

    public $timestamps  = false;


    public function ROOM_RESERVATION()
    {
        return $this->hasMany('App\ROOM_RESERVATION','room_reservation_id');
    }

}
