@extends('layouts.layoutdomiciliary')
@section('content')
    <div class="card text-center">
        <div class="card-body">
            <h5 class="card-title">Tus Pedidos</h5>
        </div>
    </div>
    <br>

    <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">Codigo Pedido</th>
                <th scope="col">Direccion Pedido</th>
                <th scope="col">Nombre Cliente</th>
                <th scope="col"># Telefono</th>
                <th scope="col">Precio</th>
                <th scope="col">Nombre Producto</th>
            </tr>
        </thead>
        @php
        $validacion = true;
        @endphp
        <tbody>
            @foreach ($pedidos as $item)
                @if ($item->codigoEstado == 3)
                    @php
                    $validacion = false;

                    @endphp

                @endif
                @php
                $idCliente = $item->idCliente;
                $direccion = $item->direccionPedido;
                $latitud = $item->latitud;
                $longitud = $item->longitud;
                @endphp
                <tr>
                    <th scope="row">{{ $item->idPedido }}</th>
                    <td>{{ $item->direccionPedido }}</td>
                    <td>{{ $item->nombreCliente }}</td>
                    <td>{{ $item->telefonoCliente }}</td>
                    <td>{{ $item->precioTotal }}</td>
                    <td>{{ $item->nombreProducto }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
    <br>
    <div class="card text-center">
        <div class="card-body">
            <h5 class="card-title">Ruta</h5>
        </div>
    </div>
    <div id="contenedor">
        <div class="row">
            <div class="col-md-6">
                <form action="">
                    <div class="row">

                        <input type="hidden" id="txtlat3" class="form-control" name="latitud" value="{{ $latitud }}">
                    </div>
                    <br>
                    <div class="row">

                        <input type="hidden" id="txtlon3" class="form-control" name="longitud" value="{{ $longitud }}">
                    </div>
                    <br>
                </form>
                <div class="col-md-2">
                    <input type="submit" id="submit" value="Generar ruta" class="form-group alert btn btn-primary"/>
                </div>
            </div>
            <div class="col-md-12">
                <div id="map"></div>
                <div id="right-panel">
                    <div>
                        <input type="hidden" id="start" value="5.063959852890593, -75.49597458954092">

                        
                        <input type="hidden" id="waypoints" value="5.063959852890593, -75.49597458954092 ">

                        
                        
                    </div>
                    <div id="directions-panel" hidden></div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDybGeHZQ9OCxepFzH9RzsGFdt7dCEhxJI"></script>
        <script>
            var lat =document.querySelector('#txtlat3');
            var long =document.querySelector('#txtlon3');
           
            var coor = lat.value+','+long.value;
            console.log(coor);
            function initMap() {
              const directionsService = new google.maps.DirectionsService();
              const directionsRenderer = new google.maps.DirectionsRenderer();
              const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 14,
                center: { lat: 5.064247982380116, lng: -75.50287218810463 },
              }); 
              directionsRenderer.setMap(map);
              document.getElementById("submit").addEventListener("click", () => {
                calculateAndDisplayRoute(directionsService, directionsRenderer);
              });
            }
      
            function calculateAndDisplayRoute(directionsService, directionsRenderer) {
              const waypts = [];
              const checkboxArray = document.getElementById("waypoints");
      
              for (let i = 0; i < checkboxArray.length; i++) {
                if (checkboxArray.options[i].selected) {
                  waypts.push({
                    location: checkboxArray[i].value,
                    stopover: true,
                  });
                }
              }
              directionsService.route(
                {
                  origin: document.getElementById("start").value,
                  destination: coor,
                  waypoints: waypts,
                  optimizeWaypoints: true,
                  travelMode: google.maps.TravelMode.DRIVING,
                },
                (response, status) => {
                  if (status === "OK") {
                    directionsRenderer.setDirections(response);
                    const route = response.routes[0];
                    const summaryPanel = document.getElementById("directions-panel");
                    summaryPanel.innerHTML = "";
      
                    // For each route, display summary information.
                    for (let i = 0; i < route.legs.length; i++) {
                      const routeSegment = i + 1;
                      summaryPanel.innerHTML +=
                        "<b>Route Segment: " + routeSegment + "</b><br>";
                      summaryPanel.innerHTML += route.legs[i].start_address + " to ";
                      summaryPanel.innerHTML += route.legs[i].end_address + "<br>";
                      summaryPanel.innerHTML +=
                        route.legs[i].distance.text + "<br><br>";
                    }
                  } else {
                    window.alert("Directions request failed due to " + status);
                  }
                }
              );
            }
          </script>
        <br>
        <div class=" row">
                
                </div>
                @if ($validacion)
                    <form action="/domiciliary/order/give" method="post">
                        @csrf
                        <input type="hidden" name="direccionPedido" value="{{ $direccion }}">
                        <input type="hidden" name="idCliente" value="{{ $idCliente }}">
                        <div class="row">
                            <div class="col">
                                <button type="button" id="btnVolver" class="btn btn-primary">Volver</button>
                                <button type="submit" id="btnRealizarPedido" class="btn btn-primary">Realizar
                                    Pedido</button>
                                <button type="button" id="btnConfirmarEntrega" class="btn btn-primary" disabled>Confimar
                                    Entrega
                                    Pedido</button>
                            </div>
                        </div>
                    </form>

                @else
                    <form action="/domiciliary/order/entregar" method="post">
                        @csrf
                        <input type="hidden" name="direccionPedido" value="{{ $direccion }}">
                        <input type="hidden" name="idCliente" value="{{ $idCliente }}">
                        <div class="row">
                            <div class="col">
                                <button type="button" id="btnVolver" class="btn btn-primary" disabled>Volver</button>
                                <button type="button" id="btnRealizarPedido" class="btn btn-primary" disabled>Realizar
                                    Pedido</button>
                                <button type="submit" id="btnConfirmarEntrega" class="btn btn-primary">Confimar Entrega
                                    Pedido</button>
                            </div>
                        </div>
                    </form>

                @endif

            @endsection
