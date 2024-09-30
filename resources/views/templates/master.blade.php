<!doctype html>
<html lang="es">
    <head>
        <title>Hostal del Sur</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        {{-- bootstrap --}}
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        {{-- material icons google --}}
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        {{-- leaflet maps --}}
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        {{-- link css --}}
        <link rel="stylesheet" href="{{ asset('css/stylesheet.css') }}">
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container">
                    <a class="navbar-brand" href="{{ route('home.index') }}">
                        <div class="image-container-logo">
                            <img src="{{ asset('images/logohostal.jpg') }}" class="img-logo">
                        </div>
                    </a>
                    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="collapsibleNavId">
                        <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                            <li class="nav-item">
                                <a class="nav-link @if(Route::current()->getName()=='home.index') active @endif" href="{{ route('home.index') }}" aria-current="page">INICIO
                                    <span class="visually-hidden">(current)</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(Route::current()->getName()=='home.about') active @endif" href="{{ route('home.about') }}">QUIENES SOMOS</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(Route::current()->getName()=='home.rooms') active @endif" href="{{ route('home.rooms') }}">HABITACIONES</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(Route::current()->getName()=='home.location') active @endif" href="{{ route('home.location') }}">UBICACION</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(Route::current()->getName()=='home.contact') active @endif" href="{{ route('home.contact') }}">CONTACTO</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            <!-- Mostrar botón de logout si el usuario está autenticado -->
                            @if (Auth::check())
                                <li class="nav-item">
                                    <a class="nav-link @if(Route::current()->getName()=='admin.dashboard') active @endif" href="{{ route('admin.dashboard') }}">DASHBOARD</a>
                                </li>
                                <li class="nav-item">
                                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        LOGOUT
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <div class="container">
                @yield('main-content')
            </div>
        </main>
        <footer>
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
