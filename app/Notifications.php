<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'NOTIFICATIONS';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['notification', 'readStatus', 'body'];
}
