<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests\PagoRequest;
use Cart;
use App\Models\Producto;
use Darryldecode\Cart\Cart as CartCart;
use DB;
use Illuminate\Support\Facades\Session;
use DateTime;

class CarritoController extends Controller
{
    public function add(Request $request)
    {
        $codigo = $request->get('codigoProducto');
        $cantidad = $request->get('cantidad');
        $precioUnidad = $request->get('precioProducto');
        $nombre = $request->get('nombreProducto');


        Cart::add(
            $codigo,
            $nombre,
            $precioUnidad,
            $cantidad
        );
        return back();
    }



    public function cart()
    {

        return view('checkout');
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

    public function pay(PagoRequest $request)
    {
        
        $direccion = $request->get('direccion');
        $tipopago = $request->get('tipoPago');

        $cedulaCliente = session('idCliente'); //Esto es de momento toca poner que la traiga de la sesion
        $latitud = $request->get('latitud');
        $longitud = $request->get('longitud');

        setlocale(LC_ALL, "es_ES");

        date_default_timezone_set('America/Bogota');
        $fechaActual=date("Y-m-d H:i:s");

        $mifecha = new DateTime();
        $mifecha->modify('+0 hours');
        $mifecha->modify('+0 minute');
        $mifecha->modify('+180 second');
        $fechaModify = $mifecha->format('Y-m-d H:i:s');

        foreach (Cart::getContent() as $item) {
            DB::select("select * from AddPedido('$direccion',$tipopago,$cedulaCliente,'$latitud','$longitud','$fechaActual','$fechaModify')");
            DB::select("select * from AddPedidoProducto($item->quantity,$item->id)");
        }
        $this->clear();
        return redirect('/customer');
    }
}
