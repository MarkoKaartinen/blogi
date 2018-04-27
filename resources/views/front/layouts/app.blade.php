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
        <header class="py-12 flex flex-col px-4 bg-black">
            <a class="mx-auto inline-block" href="{{ route('front.home') }}"><img class="w-48 border-4 border-white" src="{{ url('img/logo_musta.jpg') }}" alt="{{ config('app.name', 'Laravel') }}" /></a>
            <h1 class="mt-6 text-center text-5xl"><a class="no-underline text-white hover:underline hover:text-white" href="{{ route('front.home') }}">{{ config('app.name', 'Laravel') }}</a></h1>
            <div class="mt-6 mx-auto">
                <ul class="list-reset flex">
                    <li class="mx-4"><a class="li-link" href="#">Blogi</a></li>
                    <li class="mx-4"><a class="li-link" href="#">In English</a></li>
                    <li class="mx-4"><a class="li-link" href="#">Info</a></li>
                    <li class="mx-4"><a class="li-link" href="#">Arkisto</a></li>
                    <li class="mx-4"><a class="li-link" href="#">Ota yhteyttä</a></li>
                </ul>
            </div>
        </header>                  

        <div class="mx-auto container my-16 flex flex-col lg:flex-row">
            <main class="lg:w-3/4 lg:mr-3">
                @yield('content')
            </main>
            <div class="lg:w-1/4">
                @include('front.layouts.sidebar')
            </div>
        </div>

        <footer class="flex flex-col justify-center mx-auto px-4 mb-4">
            <div class="mx-auto mb-2 text-lg font-bold">&copy; {{ config('app.name', 'Laravel') }} {{ date("Y") }}</div>
            <div class="mx-auto text-base mb-2">Sivusto pyörii <a href="http://laravel.com/">Laravel</a> frameworkin päällä. Lähdekoodi löytyy tietenkin <a href="https://github.com/MarkoKaartinen/blogi">Githubista</a>.</div>
            <ul class="list-reset flex mx-auto">
                @guest
                    <li class="mx-3"><a class="text-sm" href="#" @click.prevent="$modal.show('login-form');">Kirjaudu</a></li>
                    <li class="mx-3"><a class="text-sm" href="#" @click.prevent="$modal.show('register-form');">Luo tunnus</a></li>
                @else
                    @if(auth()->user()->isAdmin())
                        <li class="mx-3"><a class="text-sm" href="{{ route('admin.index') }}">Ylläpito</a></li>
                    @endif
                    <li class="mx-3"><a class="text-sm" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Kirjaudu ulos</a></li>
                @endguest
                <li class="mx-3"><a class="text-sm" href="#">RSS</a></li>
            </ul>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </footer>

        <div v-cloak>
            @include('front.modals.all')
        </div>
    </div>
</body>
</html>