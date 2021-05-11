@extends('layouts.layoutadmin')
@section('content')

    <div class="row text-center alert bg-secondary text-white">
        <div class="col">
            @foreach ($usuarios as $usuario)
        <h1>Editar {{$usuario->email}}</h1>
            @endforeach
        </div>
    </div>

    <body class="col">
        <div class="row alert alert-success">
            @foreach ($usuarios as $usuario)
                <form action="/usuarios/{{ $usuario->id }}" method="POST">
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
                        <div class="form-group font-weight-bold">
                            <label for="emailUsuario">Correo electronico:</label>
                            <input type="email" class="form-control" id="emailUsuario" name="emailUsuario"  placeholder="example@correo.com" value="{{ old('emailUsuario', $usuario->email) }}">
                        </div>
                    </div>
                    <div class="form-group font-weight-bold">
                        <label for="passwordUsuario">Contraseña:</label>
                    <input type="text" class="form-control" id="passwordUsuario" name="passwordUsuario" value="{{old('passwordUsuario', $usuario->password)}}">
                    </div>
                    <div class="form-row">
                        <div class="form-group font-weight-bold">
                            <label for="idTipoUsuario">Tipo de usuario: </label>
                            <select name="idTipoUsuario">
                                @if($usuario->idTipoUsuario == 2){
                                    <option value="">Seleccionar..</option>
                                    <option value=2 selected>Administrador</option>
                                    <option value=3>Dueño</option>
                                    <option value=4>Domiciliario</option>
                                    <option value=5>Vendedor</option>
                                    
                                }@elseif($usuario->idTipoUsuario == 3){
                                    <option value="">Seleccionar..</option>
                                    <option value=2>Administrador</option>
                                    <option value=3 selected>Dueño</option>
                                    <option value=4>Domiciliario</option>
                                    <option value=5>Vendedor</option>
                                    
                                }@elseif($usuario->idTipoUsuario == 4){
                                    <option value="">Seleccionar..</option>
                                    <option value=2>Administrador</option>
                                    <option value=3>Dueño</option>
                                    <option value=4 selected>Domiciliario</option>
                                    <option value=5>Vendedor</option>
                                }@elseif($usuario->idTipoUsuario == 4){
                                    <option value="">Seleccionar..</option>
                                    <option value=2>Administrador</option>
                                    <option value=3>Dueño</option>
                                    <option value=4>Domiciliario</option>
                                    <option value=5 selected>Vendedor</option>
                                }
                                @endif
                            </select>
                        </div>
                    </div>
                    <a href="/usuarios" class="btn btn-danger">Descartar cambios</a>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </form>
            @endforeach
        </div>
        <br>
    @endsection
