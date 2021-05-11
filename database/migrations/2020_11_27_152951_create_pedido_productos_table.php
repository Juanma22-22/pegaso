<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_productos', function (Blueprint $table) {
            $table->id('idPedidoProducto');
            $table->integer('cantidad');
            $table->integer('precioTotal');
            $table->unsignedBigInteger('codigoProducto');
            $table->unsignedBigInteger('idPedido');
            $table->foreign('codigoProducto')->references('codigoProducto')->on('productos');
            $table->foreign('idPedido')->references('idPedido')->on('pedidos');
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
        Schema::dropIfExists('pedido_productos');
    }
}
