<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSertifikat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_sertifikat', function (Blueprint $t) {
            $t->increments('id');
            $t->smallInteger('permohonan');
            $t->smallInteger('pemohon');
            $t->string('jenis', 100)->nullable();
            $t->string('nomor', 100)->nullable();
            $t->smallInteger('kecamatan')->nullable();
            $t->smallInteger('kelurahan')->nullable();
            $t->smallInteger('desa')->nullable();
            $t->string('surat_ukur',100);
            $t->string('no_surat_ukur',40);
            $t->date('tgl_surat_ukur');
            $t->string('persil');
            $t->string('kelas');
            $t->string('luas');
            $t->smallInteger('keadaan_tanah');
            $t->string('atas_nama');
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
        Schema::dropIfExists('master_sertifikat');
    }
}
