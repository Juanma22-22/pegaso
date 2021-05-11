@extends('layouts.layoutcustomer')
@section('content')
    <div class="card-header">
        <h2>Formulario de direccion</h2>
    </div>
    <br>
    <div id="container">
        <div class="row">
            <div class="col-md-6">
                <form action="">
                    <div class="row">
                        <label for="txt">Ciudad</label>
                        <input type="text" id="txtCiudad" class="form-control">
                    </div>
                    <br>
                    <div class="row">
                        <label for="txt">Departamento</label>
                        <input type="text" id="txtEstado" class="form-control">
                    </div>
                    <br>
                    <div class="row">
                        <label for="txt">Direccion</label>
                        <input type="text" id="txtDireccion" class="form-control">
                    </div>
                    <br>
                    
                </form>
            </div>
            <div class="col-md-6">
                <div id="map_canvas"></div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDybGeHZQ9OCxepFzH9RzsGFdt7dCEhxJI"></script>
    <script>
        var vMarker
        var map
        map = new google.maps.Map(document.getElementById('map_canvas'), {
            zoom: 14,
            center: new google.maps.LatLng(5.064247982380116, -75.50287218810463),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        vMarker = new google.maps.Marker({
            position: new google.maps.LatLng(5.064247982380116, -75.50287218810463),
            draggable: true
        });
        google.maps.event.addListener(vMarker, 'dragend', function(evt) {
            $("#txtLat").val(evt.latLng.lat().toFixed(6));
            $("#txtLng").val(evt.latLng.lng().toFixed(6));

            $("#txtLat2").val(evt.latLng.lat().toFixed(6));
            $("#txtLng2").val(evt.latLng.lng().toFixed(6));

            map.panTo(evt.latLng);


        });
        map.setCenter(vMarker.position);
        vMarker.setMap(map);

        $("#txtCiudad, #txtEstado").change(function() {
            movePin();
        });

        $("#txtDireccion").change(function() {
            var direccion = $("#txtDireccion").val();
            
            $("#txtDireccion1").val(direccion);
            $("#txtDireccion2").val(direccion);
            

            movePin();
        });

        function movePin() {
            var geocoder = new google.maps.Geocoder();
            var textSelectM = $("#txtCiudad").text();
            var textSelectE = $("#txtEstado").val();
            var inputAddress = $("#txtDireccion").val() + ' ' + textSelectM + ' ' + textSelectE;

            geocoder.geocode({


                "address": inputAddress


            }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    vMarker.setPosition(new google.maps.LatLng(results[0].geometry.location.lat(), results[0]
                        .geometry.location.lng()));
                    map.panTo(new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry
                        .location.lng()));
                    $("#txtLat").val(results[0].geometry.location.lat());
                    $("#txtLng").val(results[0].geometry.location.lng());

                    $("#txtLat2").val(results[0].geometry.location.lat());
                    $("#txtLng2").val(results[0].geometry.location.lng());
                }


            });

        }

    </script>
    <br>
    <div id="accordion">
        <div class="card">
            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                aria-controls="collapseOne">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">

                        Pago con tarjeta de Credito o Debito.

                    </h5>
                </div>
            </button>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body" style="height: 600px">

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            @foreach ($errors->all() as $error)
                                                - {{ $error }}<br>
                                            @endforeach
                                        </div>
                                    @endif

                                    <!-- Formulario -->
                                    <form action="/customer/orders/pay" class="formulario-tarjeta active"
                                        id="formulario-tarjeta" method="POST">
                                        @csrf
                                        <div class="row">
                                            <input  type="hidden" id="txtLat" name="latitud" class="form-control">
                                        </div>
                                        <div class="row">
                                            <input  type="hidden" id="txtLng" name="longitud" class="form-control">
                                        </div>
                                        <div class="row">
                                            <input  type="hidden" id="txtDireccion1" name="direccion" class="form-control">
                                        </div>
                                        <div class="grupo">
                                            <label for="inputNumero">Numero Tarjeta</label>
                                            <input type="text" id="inputNumero" name="numeroTarjeta" maxlength="19"
                                                autocomplete="off">
                                        </div>
                                        <div class="grupo">
                                            <label for="inputNombre">Nombre Tarjeta</label>
                                            <input type="text" id="inputNombre" name="nombreTarjeta" maxlength="19"
                                                autocomplete="off">
                                        </div>
                                        <div class="flexbox">
                                            <div class="grupo expira">
                                                <label for="selectMes">Expiracion</label>
                                                <div class="flexbox">
                                                    <div class="grupo-select">
                                                        <select name="mes" id="selectMes">
                                                            <option disabled selected>Mes</option>
                                                        </select>
                                                        <i class="fas fa-angle-down"></i>
                                                    </div>
                                                    <div class="grupo-select">
                                                        <select name="year" id="selectYear">
                                                            <option disabled selected>Año</option>
                                                        </select>
                                                        <i class="fas fa-angle-down"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="grupo ccv">
                                                <label for="inputCCV">CCV</label>
                                                <input type="text" name="inputCCV" id="inputCCV" maxlength="3">
                                            </div>
                                        </div>
                                        <input type="hidden" name="tipoPago" value="1">
                                        <button type="submit" class="btn-enviar">Pagar</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body " style="height: 600px">
                                    {{---------------------- Tarjeta
                                    -------------------}}
                                    <section class="tarjeta" id="tarjeta">
                                        <div class="delantera">
                                            <div class="logo-marca" id="logoMarca">

                                            </div>
                                            <img src="/img/chip-tarjeta.png" class="chip" alt="">
                                            <div class="datos">
                                                <div class="grupo" id="numero">
                                                    <p class="label">Número Tarjeta</p>
                                                    <p class="numero">#### #### #### ####</p>
                                                </div>
                                                <div class="flexbox">
                                                    <div class="grupo" id="nombre">
                                                        <p class="label">Nombre Tarjera</p>
                                                        <p class="nombre">Jhon Doe</p>
                                                    </div>

                                                    <div class="grupo" id="expiracion">
                                                        <p class="label">Expiracion</p>
                                                        <p class="expiracion"><span class="mes">MM</span> / <span
                                                                class="year">AA</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="trasera">
                                            <div class="barra-magnetica"></div>
                                            <div class="datos">
                                                <div class="grupo" id="firma">
                                                    <p class="label">Firma</p>
                                                    <div class="firma">
                                                        <p></p>
                                                    </div>
                                                </div>
                                                <div class="grupo" id="ccv">
                                                    <p class="label">CCV</p>
                                                    <p class="ccv"></p>
                                                </div>
                                            </div>

                                            <p class="leyenda">
                                                Lorem ipsum dolor sit amet consectetur for you house Playvox
                                            </p>
                                            <a href="#" class="link-blanco">wwww.tubanco.com</a>


                                        </div>

                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




        </div>
        <div class="card">
            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                aria-controls="collapseTwo">
                <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">

                        Pago en Efectivo (Pago ContraEntrega)

                    </h5>
                </div>
            </button>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                <div class="card-body">
                    <form action="/customer/orders/pay" method="post">
                        @csrf
                        <div class="row">
                            <input  type="hidden" id="txtLat2" name="latitud" class="form-control">
                        </div>
                        <div class="row">
                            <input  type="hidden" id="txtLng2" name="longitud" class="form-control">
                        </div>
                        <div class="row">
                            <input  type="hidden" id="txtDireccion2" name="direccion" class="form-control">
                        </div>
                        <input type="hidden" name="tipoPago" value="2">
                        <h3>Mensaje:</h3>
                        <p>Usted pagara un monto total de: $(Cantidad), y realizara el pago cuando nuestro domiciliaro
                            llegue al
                            lugar de entrega.
                        </p>
                        <p>
                            Gracias por comprar en Panaderia pegaso.
                        </p>
                        <button type="submit" class="btn-enviar">Confirmar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
