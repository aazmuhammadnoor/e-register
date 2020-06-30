<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKondisiTanah extends Migration
{
    public function up()
    {
        //
        Schema::create('kondisi_tanah', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kondisi');
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
        Schema::dropIfExists('tb_kondisi_tanah');
    }

}
