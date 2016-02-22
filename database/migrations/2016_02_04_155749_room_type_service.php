<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RoomTypeService extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //



        Schema::create('ROOM_TYPE_SERVICE', function (Blueprint $table) {
            $table->integer('room_type_id');
            $table->integer('service_id');

            $table->timestamps();
            $table->softDeletes();



            $table->primary(array('room_type_id', 'service_id'));

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

        Schema::drop('ROOM_TYPE_SERVICE');
    }
}
