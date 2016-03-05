<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHallImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HALL_IMAGES', function (Blueprint $table) {
            $table->increments('hall_image_id');
            $table->binary('content');  //change to medium blob in the DB
            $table->integer('hall_id')->unsigned();

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
        Schema::drop('HALL_IMAGES');
    }
}
