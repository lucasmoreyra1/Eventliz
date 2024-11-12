<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Eventliz') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> --}}
    

    {{-- alertas dinamicas de crear y editar--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- tabla dinamica para mostrar los datos-->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />
    <script type="module" src="{{ asset('js/data-table.js') }}"></script>


    <!-- modulos de graficos -->
    <script src="https://cdn.anychart.com/releases/v8/js/anychart-base.min.js"></script>
    <script src="https://cdn.anychart.com/releases/v8/js/anychart-ui.min.js"></script>
    <script src="https://cdn.anychart.com/releases/v8/js/anychart-exports.min.js"></script>
    <link href="https://cdn.anychart.com/releases/v8/css/anychart-ui.min.css" type="text/css" rel="stylesheet">
    <link href="https://cdn.anychart.com/releases/v8/fonts/css/anychart-font.min.css" type="text/css" rel="stylesheet">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <!-- Modulo de js -->
    <script type="module" src="{{ asset('js/app.js') }}"></script>
    <!-- Scripts boostrap se importa en el archivo scss -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        .selected-row {
            background-color: red; /* Cambia el color de fondo según tu preferencia */
        }

        #containerGraficos {
            width: 33%;
            height: 30rem;
            margin: 0;
            padding: 0;
        }

        
        .nav-link.active {
            background-color: #dce9fd; /* Cambia esto al color de fondo que prefieras */
            color: white; /* Cambia esto al color de texto que prefieras */
            border-radius: 6px; /* Opcional: redondea las esquinas */
            padding: 3px 6px; /* Opcional: ajusta el relleno */
            font-weight: bold; /* Opcional: hace el texto en negrita */
        }




    </style>
</head>
<body style="background-color: #fffaf0">
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <div id="app">
        <nav class="navbar  navbar-expand-md navbar-light" style="background-color: #f7f2d4;" >
            
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'EVENTLIZ') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                @auth
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('eventos') ? 'active' : '' }}" href="{{ route('eventos.index') }}">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('locaciones') ? 'active' : '' }}" href="{{ route('locaciones.index') }}">Locaciones</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('menus') ? 'active' : '' }}" href="{{ route('menus.index') }}">Menus</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('clientes') ? 'active' : '' }}" href="{{ route('clientes.index') }}">Clientes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('tipoEventos') ? 'active' : '' }}" href="{{ route('tipoEventos.index') }}">Tipo Evento</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('eventos/archivados') ? 'active' : '' }}" href="{{ route('eventos.archivados') }}">Ver Archivados</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('eventos/finalizados') ? 'active' : '' }}" href="{{ route('eventos.finalizados') }}">Ver Finalizados</a>
                        </li>

                    </ul>
                </div>

                @endauth


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>


                                    <a class="dropdown-item" href="{{ route('perfil.index') }}">
                                      Perfil
                                    </a>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    
</body>
</html>
