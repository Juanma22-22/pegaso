<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/useradmin.indexuser', [
            'usuarios' => DB::select('select * from ListarUsuarios()'),
            'tipos'=> DB::select('select * from ListarTipoUsuarios()')
        ]);
    }

    public function search(Request $request)
    {
        return view('admin/useradmin.indexuser', [
            'usuarios' => DB::select("select * from buscarusuarioemail('$request->nombre')"),
            'tipos'=> DB::select('select * from ListarTipoUsuarios()')
        ]);
    }
    /**
     * 
     * nanotecnologia
     * tecnologia 
     * predicciones yoga
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/useradmin.createuser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario = new Usuario();

        $usuario->emailUsuario = $request->get('emailUsuario');
        $usuario->passwordUsuario = Hash::make($request->get('passwordUsuario'));
        $usuario->idTipoUsuario = $request->get('idTipoUsuario');

        DB::select("select CrearUsuario(' $usuario->emailUsuario','$usuario->passwordUsuario',$usuario->idTipoUsuario)");
        return redirect('/usuarios');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idUsuario)
    {
        return view('admin/useradmin.edituser', [
            'usuarios' => DB::select("select * from EditarUsuario('$idUsuario')")
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idUsuario)
    {
        $usuario = new Usuario();

        $usuario->idUsuario = $idUsuario;
        $usuario->emailUsuario = $request->get('emailUsuario');
        $usuario->passwordUsuario = Hash::make($request->get('passwordUsuario'));
        $usuario->idTipoUsuario = $request->get('idTipoUsuario');

        DB::select("select ActualizarUsuario($usuario->idUsuario, '$usuario->emailUsuario', '$usuario->passwordUsuario',$usuario->idTipoUsuario)");
        return redirect('/usuarios');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
