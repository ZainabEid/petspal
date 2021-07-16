<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinics', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('clinics_categrory_id')->unsigned();
            $table->string('name');
            $table->string('description');
            $table->string('address');
            $table->string('social');
            $table->double('rate')->default(0);
            $table->string('media');

            $table->foreign('clinics_categrory_id')->references('id')->on('clinics_categories')->onDelete('cascade');

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
        Schema::dropIfExists('clinic');
    }
}
