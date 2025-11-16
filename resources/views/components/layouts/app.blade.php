<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <x-seo::meta />

    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="MarkoKaartinen.net" />
    <link rel="manifest" href="/site.webmanifest" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=jetbrains-mono:400,400i,500,600,700,700i,800" rel="stylesheet" />

    <link rel="alternate" type="application/atom+xml" href="{{ route("feed") }}" title="MarkoKaartinen.net">

    <link href="https://github.com/MarkoKaartinen" rel="me">

    @production
        @guest
            <script defer data-api="/pla/event" data-domain="markokaartinen.net" data-spa="auto" src="/pla/script.js"></script>
        @endguest
    @endproduction

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="font-mono  md:text-lg text-nord-6 bg-nord-0">

    <x-layouts.partials.header />

    <div class="container mx-auto py-6 md:py-12">
        {{ $slot }}
    </div>

    <x-layouts.partials.footer />
</body>
</html>
