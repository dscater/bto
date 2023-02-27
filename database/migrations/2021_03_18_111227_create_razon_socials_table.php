<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRazonSocialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('razon_socials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigo');
            $table->string('nombre');
            $table->string('alias')->nullable();
            $table->string('ciudad');
            $table->string('dir');
            $table->string('nro_aut');
            $table->string('fono');
            $table->string('cel');
            $table->string('casilla')->nullable();
            $table->string('correo')->nullable();
            $table->string('logo');
            $table->string('actividad_economica');
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
        Schema::dropIfExists('razon_socials');
    }
}
