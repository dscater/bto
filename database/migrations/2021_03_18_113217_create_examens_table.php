<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('empresa_id')->unsigned();
            $table->bigInteger('departamento_id')->unsigned();
            $table->bigInteger('designacion_id')->unsigned();
            $table->string('nombre');
            $table->date('fecha_registro');
            $table->integer('estado');
            $table->timestamps();

            $table->foreign('empresa_id')->references('id')->on('empresas')->ondelete('no action')->onupdate('cascade');
            $table->foreign('departamento_id')->references('id')->on('departamentos')->ondelete('no action')->onupdate('cascade');
            $table->foreign('designacion_id')->references('id')->on('designacions')->ondelete('no action')->onupdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('examens');
    }
}
