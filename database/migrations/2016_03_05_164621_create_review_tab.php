<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewTab extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        
            Schema::create('REVIEWS', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('name');
            $table->longText('review')->nullable();
            $table->string('status')->default('PENDING');
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
        //
        
        Schema::drop('REVIEWS');
    }
}
