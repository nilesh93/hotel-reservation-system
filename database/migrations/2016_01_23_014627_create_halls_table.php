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
            
            
            $table->increments('hall_id');
            $table->double('hall_size');
            $table->longText('remarks');
            $table->integer('capacity');
            $table->string('title');
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
