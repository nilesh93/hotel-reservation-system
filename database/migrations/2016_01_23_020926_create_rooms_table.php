<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ROOMS', function (Blueprint $table) {
            $table->increments('room_id');
            $table->char('room_num', 15);
            $table->integer('sequence_num')->unsigned();
            $table->double('room_size');
            $table->integer('room_type_id')->unsigned();
            $table->string('remarks');
            $table->char('status', 50);
            $table->timestamps();
            $table->softDeletes();

            //$table->primary('room_num');
            //$table->foreign('room_type_id')->references('room_type_id')->on('ROOM_TYPES');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ROOMS');
    }
}
