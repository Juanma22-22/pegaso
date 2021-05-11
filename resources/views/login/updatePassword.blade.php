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
    @foreach ($validar as $val)
        <form>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Correo electronico</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="emailUsuario" name="emailUsuario"
                        value="{{ old('emailUsuario', $val->emailUsuario) }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Ingrese su nueva contraseña</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="passwordUsuario" name="passwordUsuario">
                </div>
            </div>
        </form>
    @endforeach

@endsection
