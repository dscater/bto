<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('empleado_id')->unsigned();
            $table->time('hi_lu');
            $table->time('hf_lu');
            $table->time('hi_mar');
            $table->time('hf_mar');
            $table->time('hi_mier');
            $table->time('hf_mier');
            $table->time('hi_jue');
            $table->time('hf_jue');
            $table->time('hi_vier');
            $table->time('hf_vier');
            $table->time('hi_sa');
            $table->time('hf_sa');
            $table->time('hi_do');
            $table->time('hf_do');
            $table->integer('horas_trabajo');
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
        Schema::dropIfExists('horarios');
    }
}
