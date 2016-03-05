<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
    
    
    protected $table = 'MENUS';
    protected $primaryKey = 'menu_id';

    public $timestamps  = false;
}
