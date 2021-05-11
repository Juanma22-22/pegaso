<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::get('/owner', function () {
    return view('owner/salesowner',[
        'pedidos' => DB::select("select pe.\"idPedido\",pe.\"direccionPedido\",cl.\"nombreCliente\",pepo.\"cantidad\",es.\"nombreEstado\",pepo.\"precioTotal\",pro.\"nombreProducto\",es.\"nombreEstado\"
        FROM pedidos pe 
            INNER JOIN pedido_productos pepo
                ON pe.\"idPedido\" = pepo.\"idPedido\"
         INNER JOIN productos pro
             ON pro.\"codigoProducto\" = pepo.\"codigoProducto\"
         INNER JOIN estado_pedidos espe
             ON espe.\"idPedido\" = pe.\"idPedido\" 
         INNER JOIN estados es
             ON es.\"codigoEstado\" = espe.\"codigoEstado\"
         INNER JOIN clientes cl
             ON cl.\"idCliente\" = pe.\"idCliente\"
         ")
    ]);
})->middleware('auth');

Route::get('/vendor', function(){
    return view('vendor/index');
});
Route::post('/vendor/add', 'App\Http\Controllers\PedidoController@store');
Route::post('/vendor/cart-removeitem', 'App\Http\Controllers\PedidoController@removeitem');
Route::post('/vendor/pay', 'App\Http\Controllers\PedidoController@pay');



Route::get('/domiciliary',function(){
    return view('domiciliary/index',[
        'pedidos' => DB::select("select pe.\"idPedido\",pe.\"direccionPedido\",cl.\"idCliente\",cl.\"nombreCliente\",pepo.\"cantidad\",es.\"nombreEstado\",pepo.\"precioTotal\",pro.\"nombreProducto\",espe.\"codigoEstado\"
        FROM pedidos pe 
            INNER JOIN pedido_productos pepo
                ON pe.\"idPedido\" = pepo.\"idPedido\"
         INNER JOIN productos pro
             ON pro.\"codigoProducto\" = pepo.\"codigoProducto\"
         INNER JOIN estado_pedidos espe
             ON espe.\"idPedido\" = pe.\"idPedido\" 
         INNER JOIN estados es
             ON es.\"codigoEstado\" = espe.\"codigoEstado\"
         INNER JOIN clientes cl
             ON cl.\"idCliente\" = pe.\"idCliente\"
         where espe.\"codigoEstado\" = 1 or espe.\"codigoEstado\" = 2")
   ]);
});

// Route::get('/domiciliary/order',function(){
//     return view('domiciliary/detallepedido');
// });

Route::get('/mapa', function() {
    return view('index');
});

/* Rutas para redireccion de las vistas del admin */
Route::get('/admin', 'App\Http\Controllers\AdminController@index')->middleware('auth');
Route::post('/domiciliary/order/give','App\Http\Controllers\EstadoPedidoController@store');


Route::get('/domiciliary/register','App\Http\Controllers\DomiciliarioController@register');
Route::get('/customers/register','App\Http\Controllers\ClienteController@register');
Route::post('/domiciliary/register','App\Http\Controllers\DomiciliarioController@store');
Route::post('/customers/register','App\Http\Controllers\ClienteController@store');

Route::post('/domiciliary/order/entregar','App\Http\Controllers\EstadoPedidoController@Entregar');
//Route::get('/admin/customers', 'App\Http\Controllers\AdminController@viewCustomer');
// ----------------------------------------------------------- //


/* Rutas para redireccion de las vistas del cliente */

Route::get('/customer','App\Http\Controllers\ClienteController@viewIndexCustomer')->middleware('auth');
Route::post('/customer/search','App\Http\Controllers\ClienteController@BuscarProductoPorNombre');

//Route::get('/customer/configuration', function () {
   // return view('customer/configuration');
//});

Route::get('/customer/orders', 'App\Http\Controllers\ClienteController@orders');
Route::post('/customer/orders/cancel', 'App\Http\Controllers\ClienteController@destroy');


Route::get('/customer/shopcart', function () {
    return view('customer/shopCart');
});


// ----------------------------------------------------------- //

//Rutas para el carrito

Route::post('/cart-add','App\Http\Controllers\CarritoController@add');
Route::get('/cart-checkout','App\Http\Controllers\CarritoController@cart');

Route::post('/cart-clear','App\Http\Controllers\CarritoController@clear');
Route::post('/customer/orders/cart-removeitem', 'App\Http\Controllers\CarritoController@removeitem');





Route::get('/customer/orders/pay', 'App\Http\Controllers\CarritoController@viewPay');
Route::post('/customer/orders/pay', 'App\Http\Controllers\CarritoController@pay');
// -----------------------------------------------------------//

Route::get('/','App\Http\Controllers\Auth\LoginController@showLoginForm');

Route::post('/login','App\Http\Controllers\LoginController@login');



Route::post('/domiciliary/order', function(){
    return view('domiciliary/detallepedido',[
        'pedidos' => DB::select("select  pe.\"longitud\",pe.\"latitud\",pe.\"idPedido\",pe.\"direccionPedido\",cl.\"nombreCliente\",pepo.\"precioTotal\",pro.\"nombreProducto\",pe.\"idCliente\",cl.\"telefonoCliente\",espe.\"codigoEstado\"
        FROM pedidos pe 
            INNER JOIN pedido_productos pepo
                ON pe.\"idPedido\" = pepo.\"idPedido\"
         INNER JOIN productos pro
             ON pro.\"codigoProducto\" = pepo.\"codigoProducto\"
         INNER JOIN estado_pedidos espe
             ON espe.\"idPedido\" = pe.\"idPedido\" 
         INNER JOIN estados es
             ON es.\"codigoEstado\" = espe.\"codigoEstado\"
         INNER JOIN clientes cl
             ON cl.\"idCliente\" = pe.\"idCliente\"
         where espe.\"codigoEstado\" = 1 or espe.\"codigoEstado\" = 2")
    ]);
});




Route::resource('/productos', 'App\Http\Controllers\ProductoController')->middleware('auth');
Route::post('/productos/update', 'App\Http\Controllers\ProductoController@update');

Route::resource('/clientes', 'App\Http\Controllers\ClienteController')->middleware('auth');

Route::get('admin/customer/search', 'App\Http\Controllers\ProductoController@BuscarProductoPorNombre');

Route::resource('/usuarios', 'App\Http\Controllers\UsuarioController')->middleware('auth');
Route::post('/usuarios/search', 'App\Http\Controllers\UsuarioController@search');
Route::resource('/forgot','App\Http\Controllers\ValidarController')->middleware('auth');

Route::get('/forgot/reco','App\Http\Controllers\ValidarController@reco');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//-------------------------------------------------

