<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-verypale">
<header class="sticky top-0 z-50">
    @auth()
        @include('components.header')
    @else
        @include('components.header-guest')
    @endauth
</header>
<main class="min-h-[calc(100vh-270px)]">
    @yield('content')
</main>
@include('components.footer')
</body>
</html>
