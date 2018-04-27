<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">

    <div class="flex flex-col lg:flex-row">
        <div class="lg:w-1/6 bg-brand h-100 min-h-screen">
            <div class="text-center p-4"><a href="{{ route('admin.index') }}"><img class="w-1/2 border-4 border-white" src="{{ url('img/logo_musta.jpg') }}" alt="{{ config('app.name', 'Laravel') }}" /></a></div>

            <ul class="list-reset admin-menu">
                <li><a href="{{ route('admin.posts.index') }}">Artikkelit</a></li>
                <li><a href="#">Sivut</a></li>
                <li><a href="#">Media</a></li>
                <li><a href="#">Kommentit</a></li>
                <li><a href="{{ route('front.home') }}">Sivusto</a></li>
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Kirjaudu ulos</a></li>
            </ul>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

        </div>
        <main class="lg:w-5/6 p-4">
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>