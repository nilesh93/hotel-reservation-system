<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHallRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HALL_RATES', function (Blueprint $table) {
            $table->increments('hall_rate_code');
            $table->integer('hall_id')->unsigned();
            $table->double('advance_payment')->nullable();
            $table->double('refundable_amount')->nullable();
            $table->longText('remarks');
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
        Schema::drop('HALL_RATES');
    }
}
