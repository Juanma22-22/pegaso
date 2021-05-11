@extends('layouts.layoutdomiciliary')
@section('content')

    <div class="card text-center">
        <div class="card-body">
            <h5 class="card-title">Domicilios disponibles</h5>
        </div>
    </div>
    <br>
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">Codigo Pedido</th>
                <th scope="col">Nombre Cliente</th>
                <th scope="col">Direccion de entrega</th>
                <th scope="col">Nombre Producto</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Precio Total</th>
                <th scope="col">Estado</th>
                <th scope="col">Detalles</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedidos as $item)
                <tr>
                    <th scope="row">{{ $item->idPedido }}</th>
                    <td>{{ $item->nombreCliente }}</td>
                    <td>{{ $item->direccionPedido }}</td>
                    <td>{{ $item->nombreProducto }}</td>
                    <td>{{ $item->cantidad }}</td>
                    <td>{{ $item->precioTotal }}</td>
                    <td>{{ $item->nombreEstado }}</td>
                    <td>
                        <form action="/domiciliary/order" method="post">
                            @csrf
                            <input type="hidden" name="direccionPedido" value="{{ $item->direccionPedido }}">
                            <input type="hidden" name="idCliente" id="idCliente" value="{{$item->idCliente}}">
                            <input type="hidden" name="idPedido" id="idPedido" value="{{ $item->idPedido }}">
                            <button type="submit" class="btn btn-primary">Ver Pedido</button>
                        </form>
                    </td>


                </tr>

            @endforeach

        </tbody>
    </table>
@endsection
