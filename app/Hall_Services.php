<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hall_Services extends Model
{
    protected $table = 'HALL_SERVICES';

    protected $primaryKey = 'hs_id';

    protected $fillable = [
        'name',
        'rate'
    ];
}
