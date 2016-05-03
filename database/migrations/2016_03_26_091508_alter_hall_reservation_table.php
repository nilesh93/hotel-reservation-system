<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterHallReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('HALL_RESERVATION', function (Blueprint $table) {
            $table->string('time_slot')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('HALL_RESERVATION', function (Blueprint $table) {
            $table->dropColumn('time_slot');
        });
    }
}
