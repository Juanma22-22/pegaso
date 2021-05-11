<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadoPedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estado_pedidos', function (Blueprint $table) {
            $table->id('idEstadoPedido');
            $table->timestamp('horaCambioEstado');
            $table->unsignedBigInteger('codigoEstado');
            $table->unsignedBigInteger('idPedido');
            $table->foreign('codigoEstado')->references('codigoEstado')->on('estados');
            $table->foreign('idPedido')->references('idPedido')->on('pedidos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estado_pedidos');
    }
}
