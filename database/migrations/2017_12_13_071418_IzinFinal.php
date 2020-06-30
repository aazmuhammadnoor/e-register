<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IzinFinal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('izin_final', function (Blueprint $table) {
            $table->increments('id');
            $table->string('permohonan');
            $table->date('tgl_penetpan');
            $table->date('berlaku_hingga');
            $table->string('no_perizinan');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
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
        Schema::drop('izin_final');
    }
}
