@extends('layouts.layoutcustomer')
@section('content')

    <div class="card text-center">
        <div class="card-body">
            <h5 class="card-title">Carrito de Compras</h5>
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
        @php
        $validacion = false;
        @endphp
        <tbody>
            @foreach (Cart::getContent() as $item)
                @php
                $validacion = true;
                @endphp

                <form action="/customer/orders/cart-removeitem" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ $item->price * $item->quantity }}</td>
                        <td>

                            <button type="submit" class="btn btn-primary">Eliminar</button>

                        </td>
                    </tr>
                </form>
            @endforeach
        </tbody>
    </table>
    <br>
    <a type="button" class="btn btn-primary" href="/customer">Añadir Producto</a>

    @if ($validacion)
        <a type="button" class="btn btn-primary" href="/customer/orders/pay">Comprar</a>
    @else
        <a class="btn btn-primary disabled" tabindex="-1" role="button" aria-disabled="true">Comprar</a>
    @endif
@endsection
