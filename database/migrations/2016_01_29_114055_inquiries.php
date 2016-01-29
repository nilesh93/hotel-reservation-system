<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Inquiries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('INQUIRIES', function (Blueprint $table) {
            $table->increments('inq_id');
            $table->longText('name');
            $table->longText('company');
            $table->longText('email'); 
            $table->longText('message');  
            $table->longText('status')->nullable(); 
            $table->longText('follow_user_id')->nullable(); 
            $table->longText('follow_reply')->nullable(); 
            $table->longText('remarks')->nullable(); 
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
         Schema::drop('INQUIRIES');
    }
}
