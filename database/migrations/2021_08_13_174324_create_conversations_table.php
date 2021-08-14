<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            
            $table->bigInteger('admin_id')->unsigned();
            $table->bigInteger('to_admin_id')->unsigned();
            
            $table->string('channel_name');
            
            $table->unique(['admin_id', 'to_admin_id']);
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('to_admin_id')->references('id')->on('admins')->onDelete('cascade');

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
        Schema::dropIfExists('conversations');
    }
}
