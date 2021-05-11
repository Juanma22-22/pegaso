@extends('layouts.layoutadmin')
@section('content')

    <div class="row text-center alert bg-secondary text-white">
        <div class="col">
            @foreach ($productos as $producto)
                <h1>Editar producto {{ $producto->nombreProducto }}</h1>
            @endforeach
        </div>
    </div>

    <body class="col">
        <div class="row alert alert-success">
            @foreach ($productos as $producto)
                <form action="/productos/update" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    - {{ $error }}<br>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <input type="hidden" name="codigoProducto" value="{{ $producto->codigoProducto }}">

                    <div class="form-row">
                        <div class="form-group font-weight-bold">
                            <label for="nombreProducto">Nombre:</label>
                            <br>
                            <input type="text" class="form-control" id="nombreProducto" name="nombreProducto"
                                value="{{ old('nombreProducto', $producto->nombreProducto) }}">
                        </div>
                        <div class="form-group font-weight-bold">
                            <label for="precioProducto">Precio Producto: $</label>
                            <input type="number" name="precioProducto" id="precioProducto"
                                value="{{ old('precioProducto', $producto->precioProducto) }}">
                        </div>
                    </div>
                    <div class="form-row form-group font-weight-bold">
                        <label for="descripcionProducto">Description:</label>
                        <textarea name="descripcionProducto" id="descripcionProducto" cols="30" rows="10"
                            value="">{{ old('descripcionProducto', $producto->descripcionProducto) }}</textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="image">Image:  </label>
                            <input type="file" class="form-control-file" name="direccionImagenProducto" id="direccionImagenProducto" >
                        </div>
                    </div>
                    <a href="/productos" class="btn btn-danger">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>

            @endforeach
        </div>
        <br>
    @endsection
