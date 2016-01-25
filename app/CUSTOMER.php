<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'CUSTOMER';

    protected $primaryKey = 'cus_id';

    protected $fillable = [
        'name',
        'NIC/passport_num',
        'email',
        'telephone_num',
        'block_status',
        'address_line_1',
        'address_line_2',
        'city',
        'provicnce/state',
        'zip_code',
        'country'
    ];

    public $timestamps = false;
}
