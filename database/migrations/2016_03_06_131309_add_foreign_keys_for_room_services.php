<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysForRoomServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        
      /*  
           Schema::table('ROOM_TYPE_FURNISH', function ($table) {

               
            $table->foreign('room_type_id')
                 ->references('room_type_id')->on('ROOM_TYPES')
                 ->onDelete('cascade');   
               
             $table->foreign('furnish_id')
                 ->references('rf_id')->on('ROOM_FURNISHING')
                 ->onDelete('cascade');


        });
        
       
           Schema::table('ROOM_TYPE_SERVICE', function ($table) {

            $table->foreign('room_type_id')
                 ->references('room_type_id')->on('ROOM_TYPES')
                 ->onDelete('cascade');   
               
             $table->foreign('service_id')
                 ->references('rs_id')->on('ROOM_SERVICES')
                 ->onDelete('cascade');


        });
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        ///*
        /*
          Schema::table('ROOM_TYPE_SERVICE', function ($table) {

            $table->dropForeign('ROOM_TYPE_SERVICE_room_type_id_foreign');
        
            $table->dropForeign('ROOM_TYPE_SERVICE_service_id_foreign');
        

        });
        
        
          Schema::table('ROOM_TYPE_FURNISH', function ($table) {

            $table->dropForeign('ROOM_TYPE_FURNISH_room_type_id_foreign');
        
            $table->dropForeign('ROOM_TYPE_FURNISH_furnish_id_foreign');
        

        });
        */
        
    }
}
