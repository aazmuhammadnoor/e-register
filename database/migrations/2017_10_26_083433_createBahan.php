<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBahan extends Migration
{
    public function up()
    {
        Schema::create('bahan', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('konstruksi');
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
        Schema::dropIfExists('bahan');
    }
}
