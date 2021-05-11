<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <style type="text/css">
            #right-panel {
              font-family: "Roboto", "sans-serif";
              line-height: 30px;
              padding-left: 10px;
            }
      
            #right-panel select,
            #right-panel input {
              font-size: 15px;
            }
      
            #right-panel select {
              width: 100%;
            }
      
            #right-panel i {
              font-size: 12px;
            }
      
            html,
            body {
              height: 100%;
              margin: 0;
              padding: 0;
            }
      
            #map {
              height: 100%;
              
              width: 70%;
              
            }
      
            #right-panel {
              margin: 20px;
              border-width: 2px;
              width: 20%;
              height: 400px;
              float: left;
              text-align: left;
              padding-top: 0;
            }
      
            #directions-panel {
              margin-top: 10px;
              background-color: #ffee77;
              padding: 10px;
              overflow: scroll;
              height: 174px;
            }
            #contenedor{
                width: 100%;
            }
          </style>
</head>

<body>
    <div class="card text-center">
        <div class="card-header" style="background-color: #273B47">
            <div class="nav nav-tabs card-header-tabs row">
                <div class="nav-item col-6 ">
                    <a class="nav-link col-2 text-white" href="/domiciliary">Pegaso</a>
                </div>

                <div class="nav-item col-4">

                </div>
                <!--<div class="nav-item col-2">
                    <a class="nav-link text-white" href="/customer/shopcart">Carrito</a>
                </div>-->
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Menu
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="container py-4">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDybGeHZQ9OCxepFzH9RzsGFdt7dCEhxJI&callback=initMap&libraries=&v=weekly"
      defer
    ></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->

    <div class="card-footer text-muted text-center" style="background-color: #273B47">
        <a class="text-white">&copy; 2020 Panaderia Pegaso Inc</a>
    </div>
</body>

</html>
