<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seances', function (Blueprint $table) {
            $table->id();
            $table->string('jour');
            $table->time('temps');
            $table->unsignedBigInteger('id_module');
            $table->unsignedBigInteger('id_semestre');
            $table->string('salle');
            $table->foreign('id_module')->references('id')->on('modules')
                ->onUpdate('cascade');
            $table->foreign('id_semestre')->references('id')->on('semestres')
                ->onUpdate('cascade');
            $table->rememberToken();
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
        Schema::dropIfExists('seances');
    }
}
