<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('paterno');
            $table->string('materno');
            $table->string('ci');
            $table->string('ci_exp');
            $table->string('codigo_empleado');
            $table->date('fecha_ingreso');
            $table->string('fono');
            $table->string('cel');
            $table->string('dir');
            $table->string('email')->nullable();
            $table->bigInteger('empresa_id')->unsigned();
            $table->bigInteger('departamento_id')->unsigned();
            $table->bigInteger('designacion_id')->unsigned();
            $table->string('estado');
            $table->date('fecha_registro');
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('empresa_id')->references('id')->on('empresas')->ondelete('no action')->onupdate('cascade');
            $table->foreign('departamento_id')->references('id')->on('departamentos')->ondelete('no action')->onupdate('cascade');
            $table->foreign('designacion_id')->references('id')->on('designacions')->ondelete('no action')->onupdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->ondelete('no action')->onupdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}
