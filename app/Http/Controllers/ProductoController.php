<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use DB;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/productsadmin.indexproducts', [
            'productos' => DB::select('select * from ListarProductos()')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/productsadmin.createproduct');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $producto = new Producto();

        if ($request->has('direccionImagenProducto')) {
            $file = $request->file('direccionImagenProducto');
            $producto->direccionImagenProducto = time() . '' . $file->getClientOriginalName();
            $file->move(public_path() . '/image/', ' ' . $producto->direccionImagenProducto);
        }

        $producto->nombreProducto = $request->get('nombreProducto');
        $producto->descripcionProducto = $request->get('descripcionProducto');
        $producto->precioProducto = $request->get('precioProducto');
        DB::select("select CrearProducto('$producto->nombreProducto', '$producto->descripcionProducto', $producto->precioProducto, ' $producto->direccionImagenProducto' )");

        return redirect('/productos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($codigoProducto)
    {
        return view('admin/productsadmin.editproduct', [
            'productos' => DB::select("select * from EditarProducto('$codigoProducto')")
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $producto = new Producto();
        if ($request->file('direccionImagenProducto')) {
            if ($request->has('direccionImagenProducto')) {
                $file = $request->file('direccionImagenProducto');
                $producto->direccionImagenProducto = time() . '' . $file->getClientOriginalName();
                $file->move(public_path() . '/image/', $producto->direccionImagenProducto);

                $producto->codigoProducto = $request->get('codigoProducto');
                $producto->nombreProducto = $request->get('nombreProducto');
                $producto->descripcionProducto = $request->get('descripcionProducto');
                $producto->precioProducto = $request->get('precioProducto');

                DB::select("select ActualizarProducto($producto->codigoProducto,'$producto->nombreProducto', '$producto->descripcionProducto', $producto->precioProducto, '$producto->direccionImagenProducto')");
                return redirect('/productos');
            }
        } else {
            $producto->codigoProducto = $request->get('codigoProducto');
            $producto->nombreProducto = $request->get('nombreProducto');
            $producto->descripcionProducto = $request->get('descripcionProducto');
            $producto->precioProducto = $request->get('precioProducto');

            DB::select("select ActualizarProductoSinImagen($producto->codigoProducto,'$producto->nombreProducto', '$producto->descripcionProducto', $producto->precioProducto)");
            return redirect('/productos');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($codigoProducto)
    {
        DB::select("select EliminarProducto($codigoProducto)");
        return back();
    }
    public function BuscarProductoPorNombre(Request $request)
    {
        $nombre = $request->get("nombreProducto");
        return view('admin/productsadmin/indexproducts', [
            'productos' => DB::select("select * from BuscarNombreProducto('$nombre')")
        ]);
    }
}
