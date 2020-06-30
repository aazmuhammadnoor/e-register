<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGunaBangunan extends Migration
{
    public function up()
    {
        Schema::create('guna_bangunan', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('fungsi_bangunan');
            $table->string('name');
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
        Schema::dropIfExists('guna_bangunan');
    }
}
