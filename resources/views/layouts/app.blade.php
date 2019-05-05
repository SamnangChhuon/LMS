<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100%!important;
            margin: 0;
        }
        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
            z-index: 10;
        }
        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
        .background-left{
            height: 100%;
            background-image: url('/img/login/bg.jpg');
            background-position: right;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>
<body>
    <div class="top-right links">
        @auth
            <a href="{{ url('/dashboard') }}">Dashboard</a>
        @else
            <a href="{{ url('/') }}">Welcome Page</a>
        @endauth
    </div>
    <div class="container-fluid" style="height:inherit;">
        <div class="row" style="height:inherit;">
            <div class="col-sm-6" style="height:inherit;padding:0;z-index:1;">
                <div class="background-left"></div>
            </div>
            <div class="col-sm-6" style="height:inherit;">
                <div class="content pl-3">
                    <div id="app">
                        <main style="padding-top:33%;">
                            @yield('content')
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>
