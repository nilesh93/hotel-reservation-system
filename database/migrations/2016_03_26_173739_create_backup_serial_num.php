<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBackupSerialNum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('BACKUP_SERIAL_NUM', function (Blueprint $table) {
            $table->integer('serial_num');
        });

        DB::table('BACKUP_SERIAL_NUM')->insert(['serial_num' => 0]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('BACKUP_SERIAL_NUM');
    }
}
