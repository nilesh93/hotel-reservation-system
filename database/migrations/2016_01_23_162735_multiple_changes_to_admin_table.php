<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MultipleChangesToAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ADMIN', function (Blueprint $table) {
            $table->string('email')->unique;
            $table->dropColumn('username');
            $table->dropColumn('password, 60');
            $table->dropColumn('admin_level');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ADMIN', function (Blueprint $table) {
            //
        });
    }
}
