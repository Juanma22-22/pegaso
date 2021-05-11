<?php
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::get('/listarProductos', 'App\Http\Controllers\MovilesProductosController@index');

Route::post('/crearCliente', 'App\Http\Controllers\MovilesClienteController@store');
//Route::get('/listarProductos', 'App\Http\Controllers\AdminController@index');
