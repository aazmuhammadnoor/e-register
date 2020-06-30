<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIzinSyarat extends Migration
{
    public function up()
    {
        Schema::create('daftar_izin_syarat', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('daftar_izin_id');
            $table->unsignedInteger('syarat_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daftar_izin_syarat');
    }
}
