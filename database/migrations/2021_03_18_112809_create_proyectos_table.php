<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre', 255);
            $table->bigInteger('cliente_id')->unsigned();
            $table->date('fecha_ini');
            $table->date('fecha_fin');
            $table->string('tarifa');
            $table->string('prioridad');
            $table->bigInteger('lider_proyecto')->unsigned();
            $table->text('descripcion');
            $table->string('archivo', 255);
            $table->date('fecha_registro');
            $table->integer('estado');
            $table->timestamps();

            $table->foreign('cliente_id')->references('id')->on('clientes')->ondelete('no action')->onupdate('cascade');
            $table->foreign('lider_proyecto')->references('id')->on('empleados')->ondelete('no action')->onupdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proyectos');
    }
}
