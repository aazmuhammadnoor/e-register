<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJenisReklame extends Migration
{
    public function up()
    {
        //
         Schema::create('jenis_reklame', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reklame');
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
        Schema::dropIfExists('tb_jenis_reklame');
    }

}
