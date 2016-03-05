<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnNamesCUSTOMERTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('CUSTOMER', function (Blueprint $table) {
            $table->renameColumn('`NIC/passport_num`', 'NIC_passport_num');
            $table->renameColumn('`provicnce/state`', 'province_state');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('CUSTOMER', function (Blueprint $table) {
            //
        });
    }
}
