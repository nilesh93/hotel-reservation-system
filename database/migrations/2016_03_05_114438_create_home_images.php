<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('HOME_GALLERY', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('path');
            $table->longText('caption')->nullable();
            $table->longText('caption_desc')->nullable();
            $table->timestamps();
            $table->softDeletes();

        });
        
        

        Schema::table('IMAGE_GALLERY', function ($table) {

            $table->longText('caption')->nullable();


        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('HOME_GALLERY');
    }
}
