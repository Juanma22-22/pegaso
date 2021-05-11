<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use DB;
use DateTime;
use Cart;

class PedidoController extends Controller
{
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $codigo = $request->get('codigoProducto');
        $cantidad = $request->get('cantidad');

        $nombre = DB::select("select \"nombreProducto\" from productos where \"codigoProducto\" = $codigo");
        $precioUnidad = DB::select("select \"precioProducto\" from productos where \"codigoProducto\" = $codigo");
        
       
        foreach ($precioUnidad as $precio) {
            $precioTotal = ($precio->precioProducto) * $cantidad;
        }

        foreach($nombre as $name){
            $n = $name->nombreProducto;
        }
        

        Cart::add(
            $codigo,
            $n,
            $precioTotal,
            $cantidad
        );

        return back();
    }
    public function removeitem(Request $request)
    {
        //$producto = Producto::where('id', $request->id)->firstOrFail();
        $id = $request->get('id');

        Cart::remove([
            'id' => $id,
        ]);
        return back()->with('success', "Producto eliminado con éxito de su carrito.");

        return redirect('/customer');
    }



    public function clear()
    {
        Cart::clear();
        return back()->with('success', "The shopping cart has successfully beed added to the shopping cart!");
    }


    public function viewPay()
    {
        return view('customer/pay');
    }

    public function pay(Request $request)
    {
        $direccion = 'Tienda Pegaso';
        $tipopago = 2;
        $cedulaCliente = 4; //Esto es de momento toca poner que la traiga de la sesion
        $idDomiciliario = 1; //Esto igual
        $latitud = '5.063959852890593';
        $longitud = '-75.49597458954092';
        setlocale(LC_ALL, "es_ES");

        date_default_timezone_set('America/Bogota');
        $fechaActual=date("Y-m-d H:i:s");

        $mifecha = new DateTime();
        $mifecha->modify('+0 hours');
        $mifecha->modify('+0 minute');
        $mifecha->modify('+180 second');
        $fechaModify = $mifecha->format('Y-m-d H:i:s');

        foreach (Cart::getContent() as $item) {
            DB::select("select * from AddPedidoVendor('$direccion',$tipopago,$cedulaCliente,'$latitud','$longitud','$fechaActual','$fechaModify')");
            DB::select("select * from AddPedidoProductoVendor($item->quantity,$item->id)");
        }
        $this->clear();
        return redirect('/vendor');
    }
   
}
