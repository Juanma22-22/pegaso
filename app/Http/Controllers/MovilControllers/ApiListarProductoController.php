<?php

namespace App\Http\Controllers\MovilControler;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use DB;

class ApiListarProductoController extends Controller
{
    public function index(){
        $producto =Producto::all();
        return response()->json($producto);
    }

}
