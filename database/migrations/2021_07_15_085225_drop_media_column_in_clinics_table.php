<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropMediaColumnInClinicsTable extends Migration
{
    
    public function up()
    {
        Schema::table('clinics', function (Blueprint $table) {
            $table->dropColumn('media');
        });
    }

   
    public function down()
    {
        Schema::table('clinics', function (Blueprint $table) {
            $table->string('media');
        });
    }
}
