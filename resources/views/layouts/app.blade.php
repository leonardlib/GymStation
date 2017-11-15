<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ url('../storage/app/public/img/brand/Weight.png') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <!--<link href="{{ asset('css/app.css') }}" rel="stylesheet">-->
    <link href="{{ asset('css/general.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('bootstrap/css/bootstrap.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @yield('css')

    <!-- Scripts -->
    <!--<script src="{{ asset('js/app.js') }}"></script>-->
    <script src="{{ url('bootstrap/js/jquery-3.2.1.js') }}"></script>
    <script src="{{ url('bootstrap/js/popper.js') }}"></script>
    <script src="{{ url('bootstrap/js/bootstrap.js') }}"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-dark bg-primary">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img id="imagen-empresa" src="{{ url('../storage/app/public/img/brand/weight-50.png') }}"
                     width="50" height="50"  class="d-inline-block align-top" alt="">
                <span id="nombre-empresa">
                    {{ config('app.name', 'GymStation') }}
                </span>
            </a>
            <div class="navbar-nav-scroll">
                <ul class="navbar-nav bd-navbar-nav flex-row">
                    <li class="nav-item">
                        <a href="{{ url('/') }}" id="barra-inicio" class="nav-link">Inicio</a>
                    </li>
                    @if(Auth::guest())
                        <li class="nav-item">
                            <a class="nav-link" id="barra-login" href="{{ route('login') }}">Iniciar sesión</a>
                        </li>
                    @else
                        @if(Auth::user()->datosUsuario->tipoCuenta->tipo == 'administrador')
                            <li class="nav-item">
                                <a href="{{ url('/admin') }}" id="barra-perfil" class="nav-link">Mi perfil</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ url('/usuario') }}" id="barra-perfil" class="nav-link">Mi perfil</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                               Cerrar sesión
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>

        @yield('content')

        @yield('footer')
    </div>
    <!-- Scripts -->
    <!--<script src="{{ asset('js/app.js') }}"></script>-->
    <script src="{{ url('bootstrap/js/jquery-3.2.1.js') }}"></script>
    <script src="{{ url('bootstrap/js/popper.js') }}"></script>
    <script src="{{ url('bootstrap/js/bootstrap.js') }}"></script>
</body>
</html>
