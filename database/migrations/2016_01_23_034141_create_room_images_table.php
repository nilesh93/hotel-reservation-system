<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ROOM_IMAGES', function (Blueprint $table) {
            $table->increments('room_image_id');
            $table->binary('content');  //change to medium blob in the DB
            $table->char('room_num', 5);
            $table->integer('room_type_id')->unsigned();

            $table->foreign('room_num')->references('room_num')->on('ROOMS');
            $table->foreign('room_type_id')->references('room_type_id')->on('ROOM_TYPES');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ROOM_IMAGES');
    }
}
