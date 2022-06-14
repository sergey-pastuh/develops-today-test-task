<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>YAGNB</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <meta name="_token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="main-title">
                <a href="/">
                    <div class="header-first-letter">Y</div>et Another Generic News Board
                </a>
            </div>
            <div class="auth-box">
                @guest
                    <a href="/users/auth/">Login/Register</a>
                @endguest
                @auth
                    {{auth()->user()->name}} | <a href="/users/auth/logout">Logout</a>
                @endauth
            </div>
        </div>
        <div class="content">
            @yield('content')
        </div>
    </div>


    <!-- Scripts -->

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                }
            });
        });
    </script>
</body>
</html>