`<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ROOM_TYPES', function (Blueprint $table) {
            $table->increments('room_type_id');
            $table->string('type_name', 100);
            $table->longText('description')->nullable();
            $table->integer('count')->nullable();
            $table->string('services_provided');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ROOM_TYPES');
    }
}
