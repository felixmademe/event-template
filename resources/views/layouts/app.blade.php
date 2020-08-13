<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset( 'img/favicon/apple-touch-icon.png' ) }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset( 'img/favicon/favicon-32x32.png' ) }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset( 'img/favicon/favicon-16x16.png' ) }}">
    <link rel="manifest" href="{{ asset( 'site.webmanifest' ) }}">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script defer type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script defer type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" ></script>
    <script src="{{ asset( 'js/app.js' ) }}"></script>
    @if( config( 'services.recaptcha.sitekey' ) )
        <script src='https://www.google.com/recaptcha/api.js?render={{ config( 'services.recaptcha.sitekey' ) }}'></script>
        <script defer>
            grecaptcha.ready(function() {
                grecaptcha.execute( '{{ config( 'services.recaptcha.sitekey' ) }}', { action: 'eventRegister' } ).then( function( token )
                {
                    if( token )
                    {
                        if( document.getElementById( 'recaptcha' ) )
                        {
                            document.getElementById( 'recaptcha' ).value = token;
                        }
                    }
                });
            });
            grecaptcha.ready(function() {
                grecaptcha.execute( '{{ config( 'services.recaptcha.sitekey' ) }}', { action: 'contactForm' } ).then( function( token )
                {
                    if( token )
                    {
                        if( document.getElementById( 'recaptcha-contact' ) )
                        {
                            document.getElementById( 'recaptcha-contact' ).value = token;
                        }
                    }
                });
            });
        </script>
    @endif
</head>
<body>
    <div id="background-image"></div>
    <div id="background-overlay"></div>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route( 'events.index' ) }}">Evenemang</a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a class="nav-link text-secondary" href="{{ route( 'events.create' ) }}">Skapa evenemang</a>
                            </li>
                        @endauth
                    </ul>

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route( 'contacts' ) }}">Kontakt</a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a class="nav-link text-secondary" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                    Logga ut
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                @include( 'partials.layouts.flash-messages' )
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
