<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'My-app') }}</title>
        <!-- Scripts -->
        <!--<script src="https://code.jquery.com/jquery-3.3.1.js"></script>-->
        <script src="/js/app.js"></script>
        <script src="/js/myfunction.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <!--<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>-->
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
        <!--<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css" rel="stylesheet" type="text/css">-->
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        @stack('scripts')
        
        <!--<link rel="stylesheet" type="text/css" href="css/semantic.min.css">
        <script src="js/semantic.min.js"></script>-->
    </head>
    <body id="test"><!--  style="background-color: #eaeaea;" -->
        @if(Request::url() === 'http://monappli:3232/home')
        <script type="text/javascript">
            $("html").prepend('<div id="loader" class="spinner-border text-danger" role="status"><span class="sr-only">Loading...</span></div>');
            //$('#test').hide();
        </script>
        @endif
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'My-app') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">{{ __('Accueil') }}</a>
                            </li>
                            @auth
                            @if(Auth::user()->type=='admin')
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Administration<span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/admin">Page admin</a>
                                    <a class="dropdown-item" href="http://monappli:3232/ajout_fournisseur">Ajouter un fournisseur</a>
                                    <a class="dropdown-item" href="http://monappli:3232/ajout_actionIntitule">Ajouter une action</a>
                                    <a class="dropdown-item" href="/logs">Logs</a><br/>
                                </div>
                            </li>
                            @endif          
                            @if(Auth::user()->type=='manager' or Auth::user()->type=='admin' or Auth::user()->type=='assistant')
                            <a class="nav-link" href="/manager">Ajout action</a>
                            @endif
                            @if (Auth::user()->type=='admin' or Auth::user()->type=='serviceclient')
                            <a class="nav-link" href="/service_client">Service client</a>
                            @endif
                            @if (Auth::user()->type=='admin' or Auth::user()->type=='servicecomm')
                            <a class="nav-link" href="/service_communication">Service communication</a>
                            @endif
                            <!--@if (Auth::user()->type=='admin' or Auth::user()->type=='web')
                            <a class="nav-link" href="/pweb">Web</a>
                            @endif-->
                            @endauth
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Connexion') }}</a>
                            </li>
                            @if (Route::has('register'))
                            <!--<li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Inscription') }}</a>
                            </li>-->
                            @endif
                            @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/user/profile">
                                      Profile
                                    </a>
                                    
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                        {{ __('Déconnexion') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
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