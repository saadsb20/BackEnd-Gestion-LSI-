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
        Schema::create('Seance', function (Blueprint $table) {
            $table->id();
            $table->integer('jour');
            $table->integer('temps');
            $table->unsignedBigInteger('id_module');
            $table->foreign('id_module')->references('id')->on('modules')
                ->onDelete('cascade')
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
