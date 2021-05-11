@extends('layouts.layoutlogin')

@section('content')
    <div class="col">
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    - {{ $error }}<br>
                @endforeach
            </div>
        @endif
    </div>
    <div class="card mb" style="background-color:none" style="padding: 30px">
        <form action="/clientes" method="POST" class="col">
            @csrf
            <div class="col">
                <br>
                <div class="form-group">
                    <div class="form-group col-md-6">
                        <label for="nombreCliente">Nombres</label>
                        <input type="text" class="form-control" id="nombreCliente" name="nombreCliente" value="{{ old('nombreCliente') }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="apellidoCliente">Apellidos</label>
                        <input type="text" class="form-control" id="apellidoCliente" name="apellidoCliente" value="{{ old('apellidoCliente') }}">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="telefonoCliente">Telefono</label>
                    <input type="number" class="form-control" id="telefonoCliente" name="telefonoCliente" value="{{ old('telefonoCliente') }}">
                </div>
                <div class="form-group col-md-4">
                    <label for="generoCliente">Genero</label>
                    <select id="generoCliente" class="form-control" name="generoCliente">
                        <option value="">seleccionar...</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>
                <div class="form-group">
                    <div class="form-group col-md-4">
                        <label for="idTipoIdentificacion">Tipo de documento</label>
                        <select id="idTipoIdentificacion" name="idTipoIdentificacion" class="form-control">
                            <option value="">seleccionar</option>
                            <option value="1">Cedula de ciudadania</option>
                            <option value="2">Cedula extranjera</option>
                            <option value="3">Tarjeta de identidad</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="cedulaCliente">Numero de documento</label>
                        <input type="number" class="form-control" id="cedulaCliente" name="cedulaCliente" value="{{ old('cedulaCliente') }}">
                    </div>
                    <div class="form-group">
                        <div class="form-group col-md-6">
                            <label for="emailCliente">Correo electronico</label>
                            <input type="email" class="form-control" id="emailCliente" name="emailCliente" placeholder="name@example.com"
                                value="{{ old('emailCliente') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="passwordCliente">Contraseña</label>
                            <input type="password" class="form-control" id="passwordCliente" name="passwordCliente"
                                value="{{ old('passwordCliente') }}">
                            <small id="passwordHelpInline" class="text-muted">
                                Debe tener entre 8 y 20 caracteres.
                            </small>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary">Registrarse</button>
                </div>
            </div>
        </form>
    </div>
@endsection
