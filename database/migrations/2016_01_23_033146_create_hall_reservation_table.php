<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHallReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HALL_RESERVATION', function (Blueprint $table) {
            $table->increments('hall_reservation_id');
            $table->dateTime('reserve_date');
            $table->longText('remarks');
            $table->double('total_amount');
            $table->integer('cus_id')->unsigned();
            $table->integer('hall_id')->unsigned();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();

           // $table->foreign('cus_id')->references('cus_id')->on('CUSTOMER');
           // $table->foreign('hall_id')->references('hall_id')->on('HALLS');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('HALL_RESERVATION');
    }
}
