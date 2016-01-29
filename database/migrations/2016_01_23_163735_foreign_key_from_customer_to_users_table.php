<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForeignKeyFromCustomerToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('CUSTOMER', function (Blueprint $table) {
            $table->foreign('email')->references('email')->on('users');
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
             $table->dropForeign('CUSTOMER_email_foreign');
            
        });
    }
}
