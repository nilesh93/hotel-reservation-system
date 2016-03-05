<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RATE extends Model
{
    //
    protected $table = 'RATES';
    protected $primaryKey = 'rate_code';

    public $timestamps  = false;
}
