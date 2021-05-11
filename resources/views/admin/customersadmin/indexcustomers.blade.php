@extends('layouts.layoutadmin')

@section('content')
    <div class="row text-center alert alert-secondary text-weight-bold">
        <div class="col">
            <h1>Clientes</h1>
        </div>
    </div>
    <div class="row">
        <div class="col text-left form-inline">
            <a href="/admin" class="btn bg-danger text-white">Regresar</a>
           
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col">
            <table class="table">
                <thead class="alert alert-secondary text-weight-bold">
                    <td class="font-weight-bold">Documento</td>
                    <td class="font-weight-bold">Nombre</td>
                    <td class="font-weight-bold">Apellido</td>
                    <td class="font-weight-bold">Correo electronico</td>
                    <td class="font-weight-bold">Telefono</td>
                    <td class="font-weight-bold">Genero</td>
                    <td class="font-weight-bold">Tipo documento</td>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->cedulaCliente }}</td>
                            <td>{{ $cliente->nombreCliente }}</td>
                            <td>{{ $cliente->apellidoCliente }}</td>
                            <td>{{ $cliente->emailCliente }}</td>
                            <td>{{ $cliente->telefonoCliente }}</td>
                            <td>{{ $cliente->generoCliente }}</td>

                            @foreach ($documentos as $documento)
                                @if ($documento->idTipoIdentificacion == $cliente->idTipoIdentificacion)
                                    <td>{{ $documento->nombreDocumento }}</td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
