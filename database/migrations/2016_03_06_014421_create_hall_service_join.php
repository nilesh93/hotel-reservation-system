<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHallServiceJoin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        
        
        Schema::create('HALL_SERVICES_JOIN', function (Blueprint $table) {
            
            $table->integer('hall_id');
            $table->integer('service_id');

            $table->timestamps();
            $table->softDeletes();
            $table->primary(array('hall_id', 'service_id'));

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
          Schema::drop('HALL_SERVICES_JOIN');
    }
}
