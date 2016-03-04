<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateDefaultAdminInUserAndAdminTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //The login function will not allow an empty password.
            //Hence a dummy password consisting of numbers 123456 is implemented.
            // update User password
            DB::table('users')
                ->where('email', 'admin@admin.com')
                ->update(
                    ['password' => bcrypt(123456)]
            );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
