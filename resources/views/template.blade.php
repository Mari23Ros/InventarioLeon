<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- style -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Iconos de Fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::to('/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ URL::to('/css/own_styles.css') }}">
    <title>Hello, world!</title>
 
  </head>
  <body><div class="container-fluid" id="app">
        <div class="row">
            <div class="col-sm-12 col-lg-2 pb-3" style="background-color:lightyellow"
            >
                <a class="d-flex justify-content-center align-items-center" href="#">
                    <img class="" src="{{ URL::to('/img/logo.png') }}" alt="Electroconstrucciones Leon">
                </a>
                <div class="accordion" id="sideBar">
                    <div class="card">
                      <div class="card-header" id="ingresos">
                        <h2 class="mb-0">
                          <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseIngresos" aria-expanded="true" aria-controls="collapseIngresos">
                            INGRESOS
                          </button>
                        </h2>
                      </div>

                      <div id="collapseIngresos" class="collapse" aria-labelledby="ingresos" data-parent="#sideBar">
                        <div class="card-body">
                            <div class="list-group">
                                <a href="#" class="list-group-item list-group-item-action">Elementos nuevos</a>
                                <a href="#" class="list-group-item list-group-item-action">Ingreso de elementos</a>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-header" id="salidas">
                        <h2 class="mb-0">
                          <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSalidas" aria-expanded="false" aria-controls="collapseSalidas">
                            SALIDAS
                          </button>
                        </h2>
                      </div>
                      <div id="collapseSalidas" class="collapse" aria-labelledby="salidas" data-parent="#sideBar">
                        <div class="card-body">
                            <div class="list-group">
                                <a href="#" class="list-group-item list-group-item-action">Por historial de elemento</a>
                                <a href="#" class="list-group-item list-group-item-action">Por guia de remision</a>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-header" id="consultas">
                        <h2 class="mb-0">
                          <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseConsultas" aria-expanded="false" aria-controls="collapseConsultas">
                            CONSULTAS
                          </button>
                        </h2>
                      </div>
                      <div id="collapseConsultas" class="collapse" aria-labelledby="consultas" data-parent="#sideBar">
                        <div class="card-body">
                            <div class="list-group">
                                <a href="#" class="list-group-item list-group-item-action">Consulta general</a>
                                <a href="#" class="list-group-item list-group-item-action">Uso en obra</a>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-header" id="reportes">
                        <h2 class="mb-0">
                          <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseReportes" aria-expanded="false" aria-controls="collapseReportes">
                            REPORTES
                          </button>
                        </h2>
                      </div>
                      <div id="collapseReportes" class="collapse" aria-labelledby="reportes" data-parent="#sideBar">
                        <div class="card-body">
                            <div class="list-group">
                                <a href="#" class="list-group-item list-group-item-action">Entre almacenes</a>
                                <a href="#" class="list-group-item list-group-item-action">Uso en obra</a>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-10 col-fluid" style="">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" href="#">Inicio</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Administracion
                          </a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Cambiar Password</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Cerrar Sesion</a>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </nav>

                  <div class="container">
                     @yield('block')
                  </div>



            </div>
        </div>
    </div>
    <div class="container-fluid" style="background-color:lightgreen">
        <p class="d-flex justify-content-center align-items-center pt-3 pb-3">Sistema de Almacen - Electroconstrucciones Leon &copy; 2019</p>
    </div>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
