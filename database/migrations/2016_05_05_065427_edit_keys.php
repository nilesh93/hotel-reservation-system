<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::table('ROOMS', function ($table) {
            $table->string('room_num')->unique()->change(); 

            $table->integer('room_type_id')->unsigned()->change();
            $table->foreign('room_type_id')->references('room_type_id')->on('ROOM_TYPES');
        });

        Schema::table('ROOM_TYPES', function ($table) {
            $table->string('type_code')->unique()->change(); 
        });

        Schema::table('ROOM_FURNISHING', function ($table) {
            $table->string('name')->unique()->change(); 
        });
        Schema::table('ROOM_SERVICES', function ($table) {
            $table->string('name')->unique()->change(); 
        });
        Schema::table('MEAL_TYPES', function ($table) {
            $table->string('meal_type_name')->unique()->change(); 
        });

        Schema::table('HALL_RESERVATION', function ($table) {

            $table->integer('hall_id')->unsigned()->change();
            $table->foreign('hall_id')->references('hall_id')->on('HALLS');
        });

        Schema::table('RES_RMTYPE_CNT_RATE', function ($table) {
            $table->integer('room_type_id')->unsigned()->change();

            $table->foreign('room_type_id')->references('room_type_id')->on('ROOM_TYPES');
        });

        Schema::table('RATES', function ($table) {
            $table->integer('room_type_id')->unsigned()->change();
            $table->integer('meal_type_id')->unsigned()->change();

            $table->foreign('room_type_id')->references('room_type_id')->on('ROOM_TYPES')->onDelete('cascade');
            $table->foreign('meal_type_id')->references('meal_type_id')->on('MEAL_TYPES');
        });



        Schema::table('HALL_SERVICES_JOIN', function ($table) {
            $table->integer('hall_id')->unsigned()->change();
            $table->integer('service_id')->unsigned()->change();

            $table->foreign('hall_id')->references('hall_id')->on('HALLS')->onDelete('cascade');
            $table->foreign('service_id')->references('hs_id')->on('HALL_SERVICES')->onDelete('cascade');
        });


        Schema::table('ROOM_RESERVATION_BLOCK', function ($table) {
            $table->integer('room_id')->unsigned()->change();

            //$table->foreign('room_id')->references('room_id')->on('ROOMS');
        });

        Schema::table('ROOM_TYPE_FURNISH', function ($table) {
            $table->integer('room_type_id')->unsigned()->change();
            $table->integer('furnish_id')->unsigned()->change();

            $table->foreign('room_type_id')->references('room_type_id')->on('ROOM_TYPES')->onDelete('cascade');
            $table->foreign('furnish_id')->references('rf_id')->on('ROOM_FURNISHING')->onDelete('cascade');
        });

        Schema::table('ROOM_TYPE_SERVICE', function ($table) {
            $table->integer('room_type_id')->unsigned()->change();
            $table->integer('service_id')->unsigned()->change();

            $table->foreign('room_type_id')->references('room_type_id')->on('ROOM_TYPES')->onDelete('cascade');
            $table->foreign('service_id')->references('rs_id')->on('ROOM_SERVICES')->onDelete('cascade');
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
        Schema::table('ROOMS', function ($table) {

            $table->dropUnique('rooms_room_num_unique');
            $table->dropForeign('rooms_room_type_id_foreign');
        });


        Schema::table('ROOM_TYPES', function ($table) {

            $table->dropUnique('room_types_type_code_unique');
        });

        Schema::table('ROOM_FURNISHING', function ($table) {

            $table->dropUnique('room_furnishing_name_unique');
        });
        Schema::table('ROOM_SERVICES', function ($table) {

            $table->dropUnique('room_services_name_unique');
        });
        
        Schema::table('MEAL_TYPES', function ($table) {

            $table->dropUnique('meal_types_meal_type_name_unique');
        });


        Schema::table('HALL_RESERVATION', function ($table) {

            $table->dropForeign('hall_reservation_hall_id_foreign');

        });

        Schema::table('RES_RMTYPE_CNT_RATE', function ($table) {

            $table->dropForeign('res_rmtype_cnt_rate_room_type_id_foreign');

        });

        Schema::table('RATES', function ($table) { 
            $table->dropForeign('rates_meal_type_id_foreign');
            $table->dropForeign('rates_room_type_id_foreign');
        });

        Schema::table('HALL_SERVICES_JOIN', function ($table) {
            $table->dropForeign('hall_services_join_service_id_foreign');
            $table->dropForeign('hall_services_join_hall_id_foreign');
        });


        Schema::table('ROOM_RESERVATION_BLOCK', function ($table) {


        });

        Schema::table('ROOM_TYPE_FURNISH', function ($table) {

            $table->dropForeign('room_type_furnish_furnish_id_foreign');
            $table->dropForeign('room_type_furnish_room_type_id_foreign');
        });

        Schema::table('ROOM_TYPE_SERVICE', function ($table) {

            $table->dropForeign('room_type_service_service_id_foreign');
            $table->dropForeign('room_type_service_room_type_id_foreign');
        });
    }
}
