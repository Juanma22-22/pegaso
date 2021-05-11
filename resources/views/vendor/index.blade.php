@extends('layouts.layoutvendor')
@section('content')
    <div class="card text-center">
        <div class="card-body">
            <h2 class="card-title">Agregar Venta</h2>
        </div>
    </div>
    <br>
    <form action="vendor/add" method="POST">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCode4">Codigo</label>
                <input type="text" class="form-control" id="codigoProducto" name="codigoProducto" placeholder="Codigo">
            </div>
            <div class="form-group col-md-6">
                <label for="inputLastAmount4">Cantidad</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Cantidad">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Agregar</button>
    </form>
    <br>
    <div class="card text-center">
        <div class="card-body">
            <h2 class="card-title">Productos Agregados</h2>
        </div>
    </div>
    <br>



    <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">id</th>
                <th scope="col">Nombre Producto</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Precio Total</th>
                <th scope="col">Eliminar del Carrito</th>
            </tr>
        </thead>
        <tbody>
            @php
            $total = 0;
            @endphp
            @foreach (Cart::getContent() as $item)

                <form action="/vendor/cart-removeitem" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ $item->price }}</td>
                        <td>

                            <button type="submit" class="btn btn-primary">Eliminar</button>

                        </td>
                    </tr>
                </form>
                @php
                $total += $item->price;
                @endphp
            @endforeach
            <tr>
                <th scope="row"></th>
                <td></td>
                <td>Total:</td>
                <td>{{ $total }}</td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <br>
    <form action="/vendor/pay" method="POST">
        @csrf
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">Calcular</button>
        <button type="submit" class="btn btn-primary">Comprar</button>
    </form>


@endsection
