<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class MakeDefaultAdminInUserAndAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            // This migration does not do any database changes.
            // It just adds a default admin like MySQL's root user,
            //which can be removed once actual admins have been created.

            // create User
            DB::table('users')->insert(
                ['email' => 'admin@admin.com', 'password' => bcrypt(123456), 'role' => 'admin']
            );

            // create Admin entry for the above User
            DB::table('ADMIN')->insert(
                ['email' => 'admin@admin.com','last_login_ts' => '']
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
