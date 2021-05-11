<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use DB;

class MovilesClienteController extends Controller
{
    //
    public function store(Request $request){
        $cliente = DB::select("select CrearCliente('$request->nombreCliente', '$request->apellidoCliente', '$request->telefonoCliente', '$request->generoCliente', $request->idTipoIdentificacion, $request->cedulaCliente, '$request->emailCliente', '$request->passwordCliente')");
        $usuario = DB::select("select CrearUsuario('$request->email', '$request->password',1)");

        return response()->json($cliente, $usuario);
    }
}
