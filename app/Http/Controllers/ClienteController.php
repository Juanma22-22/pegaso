<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use DB;
use DateTime;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function orders($cliente){
    //     return view('customer.orders',[
    //         'clientes' => $cliente
    //     ]);
    // }

    public function orders(){

        setlocale(LC_ALL, "es_ES");

        date_default_timezone_set('America/Bogota');
        $fechaActual=date("Y-m-d H:i:s");


        $idCliente = session('idCliente');
        return view('customer.orders',[
            'datos' => DB::select(" select pe.\"fecha_Cancelacion\",pe.\"idPedido\",pepo.\"cantidad\",pepo.\"precioTotal\",pro.\"nombreProducto\",es.\"nombreEstado\"
            FROM pedidos pe 
                INNER JOIN pedido_productos pepo
                    ON pe.\"idPedido\" = pepo.\"idPedido\"
             INNER JOIN productos pro
                 ON pro.\"codigoProducto\" = pepo.\"codigoProducto\"
             INNER JOIN estado_pedidos espe
                 ON espe.\"idPedido\" = pe.\"idPedido\" 
             INNER JOIN estados es
                 ON es.\"codigoEstado\" = espe.\"codigoEstado\"
             where pe.\"idCliente\" = $idCliente "),
             
             'FechaActual' => $fechaActual
             
        ]);
    }

    public function index()
    {
        return view('admin/customersadmin.indexcustomers', [
            'clientes' => DB::select('select * from ListarClientes()'),
            'documentos'=> DB::select('select * from ListarDocumentos()')
        ]);
    }

    public function register()
    {
        return view('customer/viewregister');
    }

    public function viewIndexCustomer(){
        return view('customer.index',[
            'productos' => DB::select('select * from listarproductos()')
        ]);
    }

    public function BuscarProductoPorNombre(Request $request)
    {
        $nombre = $request->get("nombreProducto");
        return view('customer/index', [
            'productos' => DB::select("select * from BuscarNombreProducto('$nombre')")
        ]);
    }
    
    public function save(Request $request)
    {  
        
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('login.viewregister');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente = new Cliente();

        $cliente->nombreCliente = $request->get('nombreCliente');
        $cliente->apellidoCliente = $request->get('apellidoCliente');
        $cliente->telefonoCliente = $request->get('telefonoCliente');
        $cliente->generoCliente = $request->get('generoCliente');
        $cliente->idTipoIdentificacion = $request->get('idTipoIdentificacion');
        $cliente->cedulaCliente = $request->get('cedulaCliente');
        $cliente->emailCliente = $request->get('emailCliente');



        DB::select("select CrearCliente('$cliente->nombreCliente', '$cliente->apellidoCliente', '$cliente->telefonoCliente', '$cliente->generoCliente', $cliente->idTipoIdentificacion, '$cliente->cedulaCliente', '$cliente->emailCliente')");

        return redirect('/customer');
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit($idCliente)
    {
        return view('customer.configuration', [
            'clientes' => DB::select("select * from configuraciónCliente('$idCliente')")
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idCliente)
    {
        $cliente = new Cliente();

        $cliente->idCliente = $idCliente;
        $cliente->nombreCliente = $request->get('nombreCliente');
        $cliente->apellidoCliente = $request->get('apellidoCliente');
        $cliente->telefonoCliente = $request->get('telefonoCliente');
        $cliente->generoCliente = $request->get('generoCliente');

        DB::select("select * from actualizarcliente( $cliente->idCliente, '$cliente->nombreCliente', '$cliente->apellidoCliente', ' $cliente->telefonoCliente', '$cliente->generoCliente')");
        Return redirect('/customer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->get('id');
        DB::select("delete from pedido_productos where \"idPedido\"=$id ");
        DB::select("delete from estado_pedidos where \"idPedido\"=$id ");
        DB::select("delete from pedidos where \"idPedido\"=$id ");
        return redirect('/customer/orders');
    }
}
