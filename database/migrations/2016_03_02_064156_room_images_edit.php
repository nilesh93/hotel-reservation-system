<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RoomImagesEdit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //


        Schema::table('ROOM_IMAGES', function ($table) {

            //$table->increments('room_image_id');
            //$table->binary('content');  //change to medium blob in the DB
            //$table->integer('room_id')->unsigned();
            //$table->integer('room_type_id')->unsigned();

            $table->dropColumn('content');
            $table->dropColumn('room_id');    

        });



        Schema::table('ROOM_TYPES', function ($table) {

            $table->dropColumn('services_provided');


        });



        Schema::table('RATES', function ($table) {



            $table->dropColumn('remarks');


        });


        Schema::table('HALL_IMAGES', function ($table) {



            $table->dropColumn('content');


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

        /*
            Schema::table('ROOM_IMAGES', function ($table) {

            //$table->increments('room_image_id');
            //$table->binary('content');  //change to medium blob in the DB
            //$table->integer('room_id')->unsigned();
            //$table->integer('room_type_id')->unsigned();

            $table->dropColumn('content');
            $table->dropColumn('room_id');    

        }); */
    }
}
