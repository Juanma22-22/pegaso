@extends('layouts.layoutcustomer')
@section('content')
    <div class="card text-center">
        <div class="card-body">
            <h5 class="card-title">Configuracion de Datos Personales</h5>
        </div>
    </div>
    <br>

    @foreach ($clientes as $cliente)
        <form action="/clientes/{{ $cliente->idCliente }}" method="POST">
            @csrf
            @method('PUT')
            <div class="col">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            - {{ $error }}<br>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nombreCliente">Nombre: </label>
                    <input type="text" class="form-control" id="nombreCliente" name="nombreCliente" value="{{ old('nombreCliente', $cliente->nombreCliente) }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="apellidoCliente">Apellido: </label>
                    <input type="text" class="form-control" id="apellidoCliente" name="apellidoCliente" value="{{old('apellidoCliente', $cliente->apellidoCliente)}}">
                </div>
            </div>
            <br>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="telefonoCliente">Telefono: </label>
                    <input type="text" class="form-control" id="telefonoCliente" name="telefonoCliente" value="{{old('telefonoCliente', $cliente->telefonoCliente)}}">
                </div>
                <div class="form-group font-weight-bold col">
                    <label for="generoCliente">Genero: </label>
                    <select name="generoCliente">
                        @if ($cliente->generoCliente == 'Masculino'){
                            <option value="">Seleccionar..</option>
                            <option value="Masculino" selected>Masculino</option>
                            <option value="Femenino">Femenino</option>
                            <option value="Otro">Otro</option>
                        }@elseif($cliente->generoCliente=="Femenino"){
                            <option value="">Seleccionar..</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino" selected>Femenino</option>
                            <option value="Otro">Otro</option>
                        }@else {
                            <option value="">Seleccionar..</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                            <option value="Otro" selected>Otro</option>
                            }
                        @endif
                    </select>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    @endforeach
@endsection
