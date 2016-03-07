<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MENUS', function (Blueprint $table) {
            $table->increments('menu_id');
            $table->longText('category');
            $table->longText('description');          
            $table->double('rate');
            $table->longText('imagepath');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('MENUS');
    }
}
