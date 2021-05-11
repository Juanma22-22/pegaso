<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Usuario;
use Illuminate\Http\Request;
use DB;

class LoginController extends Controller
{
    public function index(){
        return view('login.viewlogin');
    }

    public function login(Request $request){
        $usuario = new Usuario();
        
        $usuario->emailUsuario = $request->get("InputEmail");
        $usuario->passwordUsuario = $request->get("InputPassword");
        
        $conexion = DB::select("select * from login('$usuario->emailUsuario','$usuario->passwordUsuario')");
        
        foreach ($conexion as $key => $value) {
            
                if ($value->idTipoUsuario == '1') {
                    $cliente = DB::select("select * from BuscarClienteEmail('$value->emailUsuario')");
                    
                    return view('customer.index',[
                        'clientes' => $cliente
                    ]);
                }else if($value->idTipoUsuario == '2'){
                    return view('admin.index',[
                        'usuarios' => $conexion
                    ]);
                }else if($value->idTipoUsuario == '3'){
                    dd('Sos un dueño');
                }else if($value->idTipoUsuario == '4'){
                    dd('sos Domiciliario');
                }else if($value->idTipoUsuario == '5'){
                    dd('sos Vendedor');
                }else{
                    dd('No eres nadie');
                }
                
            
        }
    }

    public function viewregister(){
        return view('login.viewregister');
    } 

    public function register(){

    }

    

}
