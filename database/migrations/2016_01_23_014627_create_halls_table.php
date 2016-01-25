<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HALLS', function (Blueprint $table) {
            $table->char('hall_id', 5);
            $table->double('hall_size');
            $table->longText('remarks');
            $table->integer('capacity_from');
            $table->integer('capacity_to');

            $table->primary('hall_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('HALLS');
    }
}
