<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamenEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examen_empleados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('examen_id')->unsigned();
            $table->bigInteger('empleado_id')->unsigned();
            $table->float('resultado');
            $table->date('fecha');
            $table->timestamps();
            
            $table->foreign('examen_id')->references('id')->on('examens')->ondelete('no action')->onupdate('cascade');
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
        Schema::dropIfExists('examen_empleados');
    }
}
