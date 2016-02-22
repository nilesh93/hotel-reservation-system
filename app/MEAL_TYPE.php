<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MEAL_TYPE extends Model
{
    //


    protected $table = 'MEAL_TYPES';
    protected $primaryKey = 'meal_type_id';

    public $timestamps  = false;
}
