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
    
        <form action="/forgot" method="POST">
            @csrf
            <div class="form-group text-white">
                <label for="emailUsuario">Correo Electronico</label>
                <input type="email" class="form-control" id="emailUsuario" name="emailUsuario"
                    placeholder="correo@example.com" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-white">Debes ingresar tu correo electronico para
                    validarlo.</small>
            </div>
            <button type="submit" class="btn btn-primary">Validar Correo</button>
        </form>
   

@endsection
