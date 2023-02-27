<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('apellidos');
            $table->integer('ci');
            $table->string('ci_exp', 10);
            $table->string('email', 255);
            $table->string('fono');
            $table->string('cel');
            $table->string('dir');
            $table->string('foto', 255);
            $table->string('empresa', 255);
            $table->date('fecha_registro');
            $table->integer('estado');
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
        Schema::dropIfExists('clientes');
    }
}
