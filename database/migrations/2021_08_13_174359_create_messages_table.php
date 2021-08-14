<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            
            $table->id();

            $table->bigInteger('sender_id')->unsigned();
            $table->bigInteger('reciever_id')->unsigned();
            $table->bigInteger('conversation_id')->unsigned();
            
            $table->text('message_content');
            $table->string('message_type');

            $table->foreign('sender_id')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('reciever_id')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('conversation_id')->references('id')->on('admins')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
