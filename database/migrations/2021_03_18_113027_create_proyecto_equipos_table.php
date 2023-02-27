<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyectoEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyecto_equipos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('proyecto_id')->unsigned();
            $table->bigInteger('empleado_id')->unsigned();
            $table->timestamps();


            $table->foreign('proyecto_id')->references('id')->on('proyectos')->ondelete('no action')->onupdate('cascade');
            $table->foreign('empleado_id')->references('id')->on('empleados')->ondelete('no action')->onupdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proyecto_equipos');
    }
}
