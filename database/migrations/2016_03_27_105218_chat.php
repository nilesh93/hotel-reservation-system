<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Chat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        
        Schema::create('CHATS', function (Blueprint $table) {
            $table->increments('chat_id');
            $table->integer('sender_id')->unsigned();
            $table->string('reciever_id')->nullable();
            $table->string('session_key')->nullable();
            $table->string('message')->nullable();
            $table->string('sender_name')->nullable();
            $table->string('chat_key')->nullable();
            
            
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
         Schema::drop('CHATS');
        
    }
}
