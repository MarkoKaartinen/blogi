<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('code') @yield('title') - MarkoKaartinen.net</title>

    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="MarkoKaartinen.net" />
    <link rel="manifest" href="/site.webmanifest" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=jetbrains-mono:400,400i,500,600,700,700i,800" rel="stylesheet" />

    @include('feed::links')

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="font-mono  md:text-lg text-nord-6 bg-nord-0">

    <x-layouts.partials.header />

    <div class="container mx-auto py-6 md:py-12">
        <div class="text-center wrapper">
            <h1 class="font-extrabold text-3xl md:text-4xl lg:text-5xl">
                @yield('code')
                @yield('message')
            </h1>
            <div class="textcontent">
                <p class="lead text-nord-11">Jotain meni selkeästi pieleen. Teitkö jotain mitä ei olisi saanut vai eksyitkö vanhentuneeseen osoitteeseen 🤔</p>
                <p class="lead text-nord-11">Tässä tilanteessa kannattanee koittaa mennä <a href="{{ route('search') }}">hakuun</a> tai <a href="{{ route('blog') }}">blogiin</a>.</p>
            </div>
        </div>

    </div>

    <x-layouts.partials.footer />
</body>
</html>
