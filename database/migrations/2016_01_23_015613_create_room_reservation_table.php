<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ROOM_RESERVATION', function (Blueprint $table) {
            $table->increments('room_reservation_id');
            $table->dateTime('date_created');
            $table->longText('remarks');
            $table->dateTime('check_in');
            $table->dateTime('check_out');
            $table->integer('adults');
            $table->integer('children');
            $table->integer('num_of_rooms');
            $table->integer('num_of_nights');
            $table->double('total_amount');
            $table->char('type', 50);
            $table->integer('cus_id')->unsigned();

           // $table->foreign('cus_id')->references('cus_id')->on('CUSTOMER');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ROOM_RESERVATION');
    }
}
