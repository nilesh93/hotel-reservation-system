<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomReservationBlockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ROOM_RESERVATION_BLOCK', function (Blueprint $table) {
            $table->char('room_num', 5);
            $table->integer('room_reservation_id')->unsigned();
            $table->integer('adults');
            $table->integer('children');
            $table->integer('rate_code')->unsigned();
            $table->primary(['room_num', 'room_reservation_id']);

            $table->foreign('room_num')->references('room_num')->on('ROOMS');
            $table->foreign('room_reservation_id')->references('room_reservation_id')->on('ROOM_RESERVATION');
            $table->foreign('rate_code')->references('rate_code')->on('RATES');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ROOM_RESERVATION_BLOCK');
    }
}
