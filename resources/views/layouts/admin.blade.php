<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css', env('APP_ENABLE_SSL')) }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js', env('APP_ENABLE_SSL')) }}" defer></script>
</head>
<body>
<main class="container pt-5">
    @yield('content')
</main>
</body>
</html>
