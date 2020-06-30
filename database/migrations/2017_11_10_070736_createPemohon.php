<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePemohon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_pemohon', function (Blueprint $t) {
            $t->increments('id');
            $t->string('nama_pemohon', 100)->nullable();
            $t->string('nik',40)->unique();
            $t->string('no_telepon',14)->unique();
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_pemohon');
    }
}
