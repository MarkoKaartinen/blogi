<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? config('app.name') }}</title>

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
        {{ $slot }}
    </div>

    <x-layouts.partials.footer />
</body>
</html>
