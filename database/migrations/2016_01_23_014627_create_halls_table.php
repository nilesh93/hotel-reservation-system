<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HALLS', function (Blueprint $table) {
            $table->increments('hall_id');
            $table->char('hall_num', 15);
            $table->string('title');
            $table->double('hall_size');
            $table->longText('remarks');
            $table->integer('capacity_from');
            $table->integer('capacity_to');
            $table->timestamps();
            $table->softDeletes();

           // $table->primary('hall_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('HALLS');
    }
}
