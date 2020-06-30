<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVerifikasi extends Migration
{
    public function up()
    {
        //
         Schema::create('verifikasi', function (Blueprint $t) {
            $t->increments('id');
            $t->integer('permohonan');
            $t->smallInteger('syarat');
            $t->string('file');
            $t->smallInteger('lengkap_tidak')->default(0);
            $t->smallInteger('ada_tidak')->default(0);
            $t->text('keterangan');
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
        Schema::dropIfExists('verifikasi');
    }
}
