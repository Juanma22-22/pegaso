<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id('idPedido');
            $table->string('direccionPedido');
            $table->unsignedBigInteger('codigoFormaPago');
            $table->unsignedBigInteger('idCliente');
            $table->unsignedBigInteger('cedulaDomiciliario');
            $table->foreign('codigoFormaPago')->references('codigoFormaPago')->on('forma_pagos');
            $table->foreign('idCliente')->references('idCliente')->on('clientes');
            $table->foreign('cedulaDomiciliario')->references('cedulaDomiciliario')->on('domiciliarios');
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
        Schema::dropIfExists('pedidos');
    }
}
