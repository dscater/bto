<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSueldosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sueldos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('empleado_id')->unsigned();
            $table->decimal('sueldo', 24, 2);
            $table->string('moneda');
            $table->string('tipo_pago');
            $table->date('fecha_registro');
            $table->timestamps();

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
        Schema::dropIfExists('sueldos');
    }
}
