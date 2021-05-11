@extends('layouts.layoutadmin')

@section('content')
    <div class="row text-center alert alert-secondary">
        <div class="col">
            <h1>Usuarios</h1>
        </div>
    </div>
    <div class="row">
        <div class="col text-left form-inline">
            <a href="/administrador" class="btn bg-danger text-white">Regresar</a>
            <form class="col form-inline" action="/usuarios/search" method="POST">
                @csrf
                <input class="form-control col-10" name="nombre" type="search" placeholder="Buscar por documento" aria-label="Search">
                <button class="btn btn-outline-success col-2" type="submit">Buscar</button>
            </form>
            <a href="/usuarios/create" class="btn bg-info text-white">Crear nuevo usuario</a>
        </div>
    </div>
    <br>
    <div class="row ">
        <div class="col">
            <table class="table">
                <thead class="alert alert-secondary text-weight-bold">
                    <td class="font-weight-bold">IdUsuario</td>
                    <td class="font-weight-bold">Correo Electronico</td>
                    <td class="font-weight-bold">Tipo de usuario</td>
                    <td class="font-weight-bold">Editar</td>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                        <tr>
                        <td>{{$usuario->id}}</td>
                        <td>{{$usuario->email}}</td>
                        @foreach ($tipos as $tipo)
                            @if ($tipo->idTipoUsuario == $usuario->idTipoUsuario)
                                <td>{{$tipo->nombreTipoUsuario}}</td>
                            @endif
                        @endforeach
                        <td>
                            <a class="btn btn-warning" href="/usuarios/{{ $usuario->id }}/edit">Edit</a>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
