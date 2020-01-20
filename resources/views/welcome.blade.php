<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <!-- Call App Mode on ios devices -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <!-- Place favicon.ico in the root directory -->
    <!--    <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">-->
    <!--    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">-->
    <!--    <link rel="mask-icon" href="img/favicon/safari-pinned-tab.svg" color="#5bbad5">-->
    <!--    <link rel="stylesheet" media="screen, print" href="css/your_styles.css">-->
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles -->
    <link href="{{ asset('css/vendors.bundle.css', env('APP_ENABLE_SSL')) }}" rel="stylesheet">
    <link href="{{ asset('css/app.bundle.css', env('APP_ENABLE_SSL')) }}" rel="stylesheet">
    <link href="{{ asset('css/app.css', env('APP_ENABLE_SSL')) }}" rel="stylesheet">
    <!-- Scripts -->
    <script>
        const api_token = "{{ $token }}";
    </script>
    <script src="{{ asset('js/app.js', env('APP_ENABLE_SSL')) }}" defer></script>
</head>
<body>
<div id="app"></div>
</body>
</html>
