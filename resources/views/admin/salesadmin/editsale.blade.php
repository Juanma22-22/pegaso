@extends('layouts.layoutadmin')
@section('content')

    <div class="row text-center alert bg-secondary text-white">
        <div class="col">
            <h1>Editar</h1>
        </div>
    </div>

    <body class="col">
        <div class="row alert alert-success">

            <form action="#" method="POST">
                <div class="col">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                - {{ $error }}<br>
                            @endforeach
                        </div>
                    @endif
                </div>
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="form-group font-weight-bold">
                        <label for="c_customer">C_Cliente:</label>
                        <input type="number" class="form-control" id="id_customer" name="id_customer" value="">
                    </div>
                    <div class="form-group font-weight-bold">
                        <label for="c_domiciliary">C_Domiciliario:</label>
                        <input type="number" class="form-control" id="c_domiciliary" name="c_domiciliary" value="">
                    </div>
                </div>
                <div class="form-group font-weight-bold">
                    <label for="c_vendor">C_Vendedor:</label>
                    <input type="number" class="form-control" id="c_vendor" name="c_vendor" value="">
                </div>
                <div class="form-row">
                    <div class="form-group font-weight-bold">
                        <label for="f_sale">Fecha venta</label>
                        <input type="date" name="f_sale" id="f_sale">
                    </div>
                    <div class="form-group font-weight-bold">
                        <label for="hour_sale">Hora venta</label>
                        <input type="number" name="hour_sale" id="hour_sale">
                    </div>
                </div>
                <div class="form-group font-weight-bold">
                    <label for="id_product">IdProducto:</label>
                    <input type="number" class="form-control" id="id_product" name="id_product" value="">
                </div>
                <a href="#" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </form>

        </div>
        <br>
    @endsection
