<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CUSTOMER', function (Blueprint $table) {
            $table->increments('cus_id');
            $table->char('NIC/passport_num', 10);
            $table->string('email')->unique;
            $table->string('password');
            $table->string('pwd_reset_qtn');
            $table->string('pwd_reset_ans');
            $table->string('telephone_num', 15);
            $table->boolean('block_status');
            $table->string('address_line_1');
            $table->string('address_line_2');
            $table->string('city');
            $table->string('provicnce/state');
            $table->string('zip_code');
            $table->string('country');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('CUSTOMER');
    }
}
