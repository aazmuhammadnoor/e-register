<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaftarIzin extends Migration
{
    public function up()
    {
        Schema::create('daftar_izin', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('kategori');
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
        Schema::dropIfExists('daftar_izin');
    }
}
