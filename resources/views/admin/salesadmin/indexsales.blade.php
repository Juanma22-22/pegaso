@extends('layouts.layoutadmin')

@section('content')
    <div class="row text-center alert bg-secondary text-white">
        <div class="col">
            <h1>Ventas</h1>
        </div>
    </div>
    <div class="row">
        <div class="col text-left form-inline">
            <a href="/admin/index" class="btn bg-danger text-white">Regresar</a>
            <form class="col form-inline">
                <input class="form-control col-6" type="search" placeholder="Buscar por id de venta" aria-label="Search">
                <button class="btn btn-outline-success col-2" type="submit">Buscar</button>
            </form>
        </div>
    </div>
    <br>
    <div class="row alert alert-success text-white">
        <div class="col">
            <table class="table">
                <thead>
                    <td class="font-weight-bold">IdVenta</td>
                    <td class="font-weight-bold">C_Cliente</td>
                    <td class="font-weight-bold">C_Domiciliario</td>
                    <td class="font-weight-bold">C_Vendedor</td>
                    <td class="font-weight-bold">IdProducto</td>
                    <td class="font-weight-bold">F_Venta</td>
                    <td class="font-weight-bold">Precio Total</td>
                    <td class="font-weight-bold">Hora Venta</td>
                </thead>
            </table>
        </div>
    </div>

@endsection