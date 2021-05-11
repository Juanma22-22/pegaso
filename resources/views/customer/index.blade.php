@extends('layouts.layoutcustomer')
@section('content')

<form action="/customer/search" method="POST" class="form-inline">
    <input class="form-control col-10" type="search" placeholder="Search" name="nombreProducto" id="nombreProducto" aria-label="Search">
    <button class="btn btn-outline-success col-2" type="submit">Search</button>
</form>
<br>

<div class="card-deck">

    @foreach($productos as $producto)
    <div class="col-sm-2 col-md-4 col-lg-3 col-12">
        <div class="card" id="card">
            <img src="{{url('image/'.$producto->direccionImagenProducto)}}" class="card-img" alt="..." height="150px" width="150px">
            <div class="card-body">
                <h4 class="card-title">{{$producto->nombreProducto}}</h4>
                <p class="card-text">${{$producto->precioProducto}}</p>
            </div>
            <div class="card-footer">
                <button type="button" onclick="cambiarPrecio('{{$producto->codigoProducto}}')" class="btn btn-primary btnAgregar" id="btnAgregar{{$producto->codigoProducto}}" data-toggle="modal" data-target="#exampleModalLong{{$producto->codigoProducto}}">
                    Agregar
                </button>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalLong{{$producto->codigoProducto}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{$producto->nombreProducto}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/cart-add" method="post">
                    @csrf
                    <div class="modal-body">
                        <img src="{{url('image/'.$producto->direccionImagenProducto)}}" class="card-img-top" alt="---Tenemos problemas para cargar la imagen---">
                        <div class="card-body">
                            <h5 class="card-title">{{$producto->nombreProducto}}</h5>
                            <p class="card-text">{{$producto->descripcionProducto}}</p>
                            <p class="card-text">Precio Unidad: $<input type="texto" class="precio" name="precio" id="precio{{$producto->codigoProducto}}" value="{{$producto->precioProducto}}" disabled></p>
                            <p class="card-text">Cantidad: <input type="number" min="1" step="1" class="cantidad" name="cantidad" id="cantidad{{$producto->codigoProducto}}" value="1"></p>
                            <p class="card-text">Precio Total: $<input type="number" class="precioTotal" name="precioTotal" id="precioTotal{{$producto->codigoProducto}}" value="{{$producto->precioProducto}}" disabled></p>
                        </div>
                    </div>

                    <div class="modal-footer">

                        <input type="hidden" name="nombreProducto" value="{{$producto->nombreProducto}}">
                        <input type="hidden" name="codigoProducto" value="{{$producto->codigoProducto}}">
                        <input type="hidden" name="precioProducto" value="{{$producto->precioProducto}}">
                        
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Agregar al Carrito</button>


                    </div>
                </form>

            </div>
        </div>
    </div>

    @endforeach
</div>




@endsection