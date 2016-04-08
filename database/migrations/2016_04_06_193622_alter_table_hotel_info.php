<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableHotelInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('HOTEL_INFO', function (Blueprint $table) {
            $table->integer('no_of_adults')->nullable();
            $table->integer('no_of_kids')->nullable();
            $table->integer('selectable_no_of_rooms')->nullable();
            $table->time('hall_time_slot_1_from')->nullable();
            $table->time('hall_time_slot_1_to')->nullable();
            $table->time('hall_time_slot_2_from')->nullable();
            $table->time('hall_time_slot_2_to')->nullable();
            $table->string('block')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('HOTEL_INFO', function (Blueprint $table) {

            $table->dropColumn('no_of_adults');
            $table->dropColumn('no_of_kids');
            $table->dropColumn('selectable_no_of_rooms');
            $table->dropColumn('hall_time_slot_1_from');
            $table->dropColumn('hall_time_slot_1_to');
            $table->dropColumn('hall_time_slot_2_from');
            $table->dropColumn('hall_time_slot_2_to');
            $table->dropColumn('block');
        });
    }
}
