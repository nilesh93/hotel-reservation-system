<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'AboutUs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['description'];

    /**
     * Sets auto inserted timestamps off
     *
     * @var bool
     */
    public $timestamps = false;
}
