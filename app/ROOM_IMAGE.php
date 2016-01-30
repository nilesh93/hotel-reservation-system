<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ROOM_IMAGE extends Model
{
    //
    protected $primaryKey = 'room_image_id';
    protected $table = 'ROOM_IMAGES';

    public $timestamps  = false;
}
