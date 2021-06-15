<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Notes', function (Blueprint $table) {
            $table->id();
            $table->float('valeur');
            $table->unsignedBigInteger('id_module');
            $table->foreign('id_module')->references('id')->on('modules')
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
        Schema::dropIfExists('notes');
    }
}
