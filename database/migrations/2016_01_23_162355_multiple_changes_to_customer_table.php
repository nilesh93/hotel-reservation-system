<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MultipleChangesToCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('CUSTOMER', function (Blueprint $table) {
            $table->string('name');
            $table->dropColumn('password');
            $table->dropColumn('pwd_reset_qtn');
            $table->dropColumn('pwd_reset_ans');
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
