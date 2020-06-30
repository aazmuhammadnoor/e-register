<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkflowTask extends Migration
{
    public function up()
    {
        Schema::create('workflow_task', function (Blueprint $table) {
            $table->increments('id');
            $table->string('event');
            $table->double('sub_task');
            $table->double('executor');
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
        Schema::dropIfExists('workflow_task');
    }
}
