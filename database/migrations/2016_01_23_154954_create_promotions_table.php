<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PROMOTIONS', function (Blueprint $table) {
            $table->increments('promotion_code');
            $table->longText('promotion_name');
            $table->longText('promotion_description');
            $table->longText('date_from'); 
            $table->longText('date_to');           
            $table->double('rate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('PROMOTIONS');
    }
}
