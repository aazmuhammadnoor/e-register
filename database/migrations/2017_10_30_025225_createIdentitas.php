<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdentitas extends Migration
{
    public function up()
    {
        Schema::create('identitas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('instansi');
            $table->string('singkatan_instansi');
            $table->string('footer');
            $table->string('logo_public');
            $table->string('logo_backend');
            $table->string('logo_login');
            $table->string('kepala_dinas');
            $table->string('nip_kepala_dinas');
            $table->string('bupati');
            $table->string('kabid_pelayanan');
            $table->string('nip_kabid_pelayanan');
            $table->string('kabid_penanaman_modal');
            $table->string('nip_kabid_penanaman_modal');
            $table->string('kasek_tinjau_lapangan');
            $table->string('nip_kasek_tinjau_lapangan');
            $table->string('sekda');
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
        Schema::dropIfExists('identitas');
    }
}
