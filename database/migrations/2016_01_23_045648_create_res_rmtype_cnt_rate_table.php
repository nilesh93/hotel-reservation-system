<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResRmtypeCntRateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('RES_RMTYPE_CNT_RATE', function (Blueprint $table) { //RESERVATION_ROOMTYPE_COUNT_RATE
            $table->integer('room_reservation_id')->unsigned();
            $table->integer('room_type_id')->unsigned();
            $table->integer('rate_code')->unsigned()    ;
            $table->integer('count');
            $table->primary(['room_reservation_id', 'room_type_id']);

            $table->foreign('room_reservation_id')->references('room_reservation_id')->on('ROOM_RESERVATION');
            $table->foreign('room_type_id')->references('room_type_id')->on('ROOM_TYPES');
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
        Schema::drop('RES_RMTYPE_CNT_RATE');
    }
}
