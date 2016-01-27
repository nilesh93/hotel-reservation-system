<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ROOM_TYPE extends Model
{
    //

    protected $table = 'ROOM_TYPES';
    protected $primaryKey = 'room_type_id';

    public $timestamps  = false;
}
