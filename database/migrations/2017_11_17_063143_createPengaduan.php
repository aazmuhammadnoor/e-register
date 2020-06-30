<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengaduan extends Migration
{
    public function up()
    {
        //
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('jenis',['pendaftaran','perizinan']);
            $table->string('nama', 45);
            $table->string('nik',45);
            $table->string('alamat',100);
            $table->string('telepon',14);
            $table->string('email',50);
            $table->string('perihal',190);
            $table->smallInteger('user')->nullable();
            $table->text('aduan');
            $table->text('replay')->nullable;
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
        //
        Schema::drop('pengaduan');
    }
}
