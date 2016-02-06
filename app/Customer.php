<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //

    protected $table = 'CUSTOMER';

    protected $primaryKey = 'cus_id';
 
    public $timestamps  = false;

    protected $fillable = [
        'name',
        'NIC_passport_num',
        'email',
        'telephone_num',
        'block_status',
        'address_line_1',
        'address_line_2',
        'city',
        'province_state',
        'zip_code',
        'country'
    ];

    public function ROOM_RESERVATION()
    {
        return $this->hasMany('App\ROOM_RESERVATION','room_reservation_id');
  }
}
