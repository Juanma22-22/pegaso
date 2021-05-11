<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Cart;
use Darryldecode\Cart\Cart as CartCart;
use DB;

class EstadoPedidoController extends Controller
{
  
    public function store(Request $request)
    {
        $idCliente = $request->get('idCliente');
        $direccion = $request->get('direccionPedido');

        $cedula = session('cedulaDomiciliario');

        $pedidos = DB::select("select * from pedidos where \"direccionPedido\" = '$direccion' and \"idCliente\" = '$idCliente' ");
        foreach($pedidos as $pedido){
            DB::select("select * from actualizarEstadoPedido($pedido->idPedido,3)");
            DB::select("select * from actualizarpedidodomi($pedido->idPedido,$cedula)");
        }
        
        
        return view('domiciliary/detallepedido',[
            'pedidos' => DB::select("select  pe.\"longitud\",pe.\"latitud\",pe.\"idPedido\",espe.\"codigoEstado\",pe.\"direccionPedido\",cl.\"nombreCliente\",pepo.\"precioTotal\",pro.\"nombreProducto\",pe.\"idCliente\",cl.\"telefonoCliente\",espe.\"codigoEstado\"
            FROM pedidos pe 
                INNER JOIN pedido_productos pepo
                    ON pe.\"idPedido\" = pepo.\"idPedido\"
             INNER JOIN productos pro
                 ON pro.\"codigoProducto\" = pepo.\"codigoProducto\"
             INNER JOIN estado_pedidos espe
                 ON espe.\"idPedido\" = pe.\"idPedido\" 
             INNER JOIN estados es
                 ON es.\"codigoEstado\" = espe.\"codigoEstado\"
             INNER JOIN clientes cl
                 ON cl.\"idCliente\" = pe.\"idCliente\"
             where espe.\"codigoEstado\" = 3 and upper(pe.\"direccionPedido\") = upper('$direccion')")
        ]);
    }

    public function Entregar(Request $request)
    {
        $idCliente = $request->get('idCliente');
        $direccion = $request->get('direccionPedido');

        $pedidos = DB::select("select * from pedidos where \"direccionPedido\" = '$direccion' and \"idCliente\" = '$idCliente' ");
        foreach($pedidos as $pedido){
            DB::select("select * from actualizarEstadoPedido($pedido->idPedido,4)");
        }

        return redirect('/domiciliary');
    }
  
}
