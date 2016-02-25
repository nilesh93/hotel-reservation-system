<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ADMIN';


    /**
     * The primary key of the selected table
     *
     * @var string
     */
    protected $primaryKey = 'emp_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['last_login_ts', 'email'];

    /**
     * Sets auto inserted timestamps off
     *
     * @var bool
     */
    public $timestamps = false;
}
