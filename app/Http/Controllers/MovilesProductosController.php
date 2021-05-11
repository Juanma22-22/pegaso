<?php

namespace App\Http\Controllers;
use App\Models\Producto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class MovilesProductosController extends Controller
{
    //
    public function index(){
        $producto = DB::select('select * from ListarProductos()');
        return response()->json($producto);
    }

}
