<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermohonan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('permohonan', function (Blueprint $t) {
            $t->increments('id');
            $t->integer('workflow');
            $t->integer('izin');
            $t->date('tgl_pendaftaran');
            $t->smallInteger('daftar_online');
            $t->string('no_pendaftaran_sementara');
            $t->string('no_pendaftaran');
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
        //
        Schema::dropIfExists('permohonan');
    }
}
