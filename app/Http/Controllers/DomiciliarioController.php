<?php

namespace App\Http\Controllers;

use App\Models\Domiciliario;
use App\Models\Cliente;
use Illuminate\Http\Request;
use DB;

class DomiciliarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('domiciliary/detallepedido',[

        ]);
    }

    public function register()
    {
        return view('domiciliary/viewregister');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $domiciliario = new Domiciliario();

        $domiciliario->nombreCliente = $request->get('nombreCliente');
        $domiciliario->apellidoCliente = $request->get('apellidoCliente');
        $domiciliario->telefonoCliente = $request->get('telefonoCliente');
        $domiciliario->generoCliente = $request->get('generoCliente');
        $domiciliario->cedulaCliente = $request->get('cedulaCliente');
        $domiciliario->emailCliente = $request->get('emailCliente');


        DB::select("select creardomiciliario('$domiciliario->nombreCliente', '$domiciliario->apellidoCliente', '$domiciliario->telefonoCliente', '$domiciliario->generoCliente', $domiciliario->cedulaCliente, '$domiciliario->emailCliente')");

        return redirect('/usuarios');
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Domiciliario  $domiciliario
     * @return \Illuminate\Http\Response
     */
    public function show(Domiciliario $domiciliario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Domiciliario  $domiciliario
     * @return \Illuminate\Http\Response
     */
    public function edit(Domiciliario $domiciliario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Domiciliario  $domiciliario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Domiciliario $domiciliario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Domiciliario  $domiciliario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Domiciliario $domiciliario)
    {
        //
    }
}
