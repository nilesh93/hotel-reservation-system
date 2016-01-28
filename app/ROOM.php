<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class Room extends Model
{

    

    
    protected $table = 'ROOMS';
    public $timestamps = false;
    protected  $primaryKey = 'room_id';
    
}
