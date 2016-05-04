<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixRishansObjectError extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        DB::table('HOTEL_INFO')->insert(
            ['check_in' => '', 
             'check_out' => '',
             'no_of_adults'=>'0',
             'no_of_kids'=>'0',
             'selectable_no_of_rooms'=>'0',
             'hall_time_slot_1_from'=>'',
             'hall_time_slot_1_to'=>'',
             'hall_time_slot_2_from'=>'',
             'hall_time_slot_2_to' => '',
             'block'=>'']
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //

        DB::table('HOTEL_INFO')->truncate();
    }
}
