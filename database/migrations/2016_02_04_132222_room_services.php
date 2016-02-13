<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RoomServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        
         Schema::create('ROOM_SERVICES', function (Blueprint $table) {
            $table->increments('rs_id');
            $table->longText('name');
            $table->double('rate'); 
            $table->timestamps();
            $table->softDeletes();
          
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
          Schema::drop('ROOM_SERVICES');
    }
}
