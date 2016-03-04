<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeToTimestampAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ADMIN', function (Blueprint $table) {
            $table->dropColumn('last_login');
            $table->timestamp('last_login_ts');
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
            $table->dropColumn('last_login_ts');
        });
    }
}
