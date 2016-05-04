<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BACKUP_LOG extends Model
{
    protected $table = 'BACKUP_SERIAL_NUM';

    protected $primaryKey = 'serial_num';

    public $timestamps = false;
}
