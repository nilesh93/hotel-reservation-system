<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{

    
    use SoftDeletes;
    
    protected $table = 'ROOMS';
    public $timestamps = false;
    protected  $primaryKey = 'room_id';
    
}
