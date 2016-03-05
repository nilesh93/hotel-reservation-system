<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RoomTypeFurnish extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        
        
        
        Schema::create('ROOM_TYPE_FURNISH', function (Blueprint $table) {
            
            $table->integer('room_type_id');
            $table->integer('furnish_id');

            $table->timestamps();
            $table->softDeletes();
            $table->primary(array('room_type_id', 'furnish_id'));

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
        Schema::drop('ROOM_TYPE_FURNISH');
    }
}
