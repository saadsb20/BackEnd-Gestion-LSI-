<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePvesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Pfe', function (Blueprint $table) {
            $table->id();
            $table->string('Sujet');
            $table->double('note');
            $table->unsignedBigInteger('id_prof');
            $table->foreign('id_prof')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('id_etudiant');
            $table->foreign('id_etudiant')->references('id')->on('users')
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
        Schema::dropIfExists('pves');
    }
}
