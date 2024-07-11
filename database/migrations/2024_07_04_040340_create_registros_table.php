<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::create('registros', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_propietario');
            $table->string('marca_auto');
            $table->string('placa_auto');
            $table->double('precio_pagado');
            $table->string('url_pdf');
            $table->string('tipo_vehiculo');
            $table->boolean('status');
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
        Schema::dropIfExists('registros');
    }
}
