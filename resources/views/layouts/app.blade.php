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
    <link href="{{ asset('css/vendors.bundle.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.bundle.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
<div class="mod-bg-1 header-function-fixed" id="app">
    <!-- BEGIN Page Wrapper -->
    <div class="page-wrapper">
        <div class="page-inner">
            <!-- BEGIN Left Aside -->
            <aside class="page-sidebar">
                <div class="page-logo">
                    <a class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-target="#modal-shortcut" data-toggle="modal" href="#">
                        <i class="fal fa-users"></i>
                        <span class="page-logo-text mr-1">{{ config('app.name', 'Laravel') }}</span>
                        <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
                    </a>
                </div>
                <!-- BEGIN PRIMARY NAVIGATION -->
                <nav class="primary-nav">
                    <ul class="nav-menu">
                        <li>
                            <a href="#" title="Application Intel">
                                <i class="fal fa-clipboard-list"></i>
                                <span class="nav-link-text">Agile</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- END PRIMARY NAVIGATION -->
            </aside>
            <!-- END Left Aside -->
            <div class="page-content-wrapper">
                <!-- BEGIN Page Header -->
                <header class="page-header" role="banner">
                    <!-- DOC: nav menu layout change shortcut -->
                    <div class="hidden-md-down dropdown-icon-menu position-relative">
                        <a class="header-btn btn js-waves-off" data-action="toggle" data-class="nav-function-hidden" href="#" title="Hide Navigation">
                            <i class="ni ni-menu"></i>
                        </a>
                        <ul>
                            <li>
                                <a class="btn js-waves-off" data-action="toggle" data-class="nav-function-minify" href="#" title="Minify Navigation">
                                    <i class="ni ni-minify-nav"></i>
                                </a>
                            </li>
                            <li>
                                <a class="btn js-waves-off" data-action="toggle" data-class="nav-function-fixed" href="#" title="Lock Navigation">
                                    <i class="ni ni-lock-nav"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- DOC: mobile button appears during mobile width -->
                    <div class="hidden-lg-up">
                        <a class="header-btn btn press-scale-down" data-action="toggle" data-class="mobile-nav-on" href="#">
                            <i class="ni ni-menu"></i>
                        </a>
                    </div>
                    <div class="ml-auto d-flex">
                        <!-- app settings -->
                        <div class="hidden-md-down">
                            <a class="header-icon" href="#">
                                <i class="fal fa-cog"></i>
                            </a>
                        </div>
                        <!-- app notification -->
                        <div>
                            <a class="header-icon" data-toggle="dropdown" href="#" title="You got 11 notifications">
                                <i class="fal fa-bell"></i>
                                <span class="badge badge-icon">11</span>
                            </a>
                        </div>
                        <!-- app user menu -->
                        <div>
                            <a class="header-icon d-flex align-items-center justify-content-center ml-2" data-toggle="dropdown" href="#" title="drlantern@gotbootstrap.com">
                                <img alt="Dr. Codex Lantern" class="profile-image rounded-circle" src="img/demo/avatars/avatar-admin.png">
                            </a>
                        </div>
                    </div>
                </header>
                <!-- END Page Header -->
                <!-- the #js-page-content id is needed for some plugins to initialize -->
                <main class="page-content">
                    @yield('content')
                </main>
                <!-- this overlay is activated only when mobile menu is triggered -->
            </div>
        </div>
    </div>
    <!-- END Page Wrapper -->
</div>
</body>
</html>
