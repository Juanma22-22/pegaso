@extends('layouts.layoutlogin')
@section('content')

    <div>
        <form>
            <div class="col" style="text-decoration-color: brown">
                <h1>Su correo es invalido</h1>
            </div>
            <div class="">
                <a class="btn btn-primary" href="/forgot" role="button">Diligenciar nuevamente el correo</a>
            </div>
            <div class="">
                <a class="btn btn-danger" href="/" role="button">Cancelar</a>
            </div>
        </form>
    </div>

@endsection
