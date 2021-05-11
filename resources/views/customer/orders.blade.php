@extends('layouts.layoutcustomer')
@section('content')
    <div class="card text-center">
        <div class="card-body">
            <h5 class="card-title">Tus Pedidos</h5>
        </div>
    </div>
    <br>
    <table class="table">
        <thead class="thead-light">
            <tr>

                <th scope="col">Codigo Pedido</th>
                <th scope="col">Nombre Producto</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Precio</th>
                <th scope="col">Estado</th>
                <th scope="col">Cancelar</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($datos as $dato)
                <tr>
                    <td scope="row">{{ $dato->idPedido }}</td>
                    <td>{{ $dato->nombreProducto }}</td>
                    <td>{{ $dato->cantidad }}</td>
                    <td>${{ $dato->precioTotal }}</td>
                    <td>{{ $dato->nombreEstado }}</td>
                    @if ($FechaActual > $dato->fecha_Cancelacion)
                        <td> <button type="submit" class="btn btn-primary" disabled>Cancelar</button></td>
                    @else
                        <form action="/customer/orders/cancel" method="post">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{ $dato->idPedido }}">
                            <td> <button type="submit" class="btn btn-primary">Cancelar</button></td>
                        </form>

                    @endif
                </tr>
            @endforeach

        </tbody>
    </table>
@endsection
