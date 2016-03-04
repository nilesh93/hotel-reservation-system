<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('RATES', function (Blueprint $table) {
            $table->increments('rate_code');
            $table->integer('room_type_id')->unsigned();
            $table->integer('meal_type_id')->unsigned();
            $table->double('double_rates')->nullable();
            $table->double('single_rates')->nullable();
            $table->double('triple_rates')->nullable();
            $table->longText('remarks');
            $table->timestamps();
            $table->softDeletes();

           // $table->foreign('room_type_id')->references('room_type_id')->on('ROOM_TYPES');
           // $table->foreign('meal_type_id')->references('meal_type_id')->on('MEAL_TYPES');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('RATES');
    }
}
