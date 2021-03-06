<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>

    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('images/icons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/icons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/icons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('images/icons/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('images/icons/safari-pinned-tab.svg') }}" color="#5bbad5">
    <link rel="shortcut icon" href="{{ asset('images/icons/favicon.ico') }}">
    <meta name="apple-mobile-web-app-title" content="Plant care for Beginners">
    <meta name="application-name" content="Plant care for Beginners">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="{{ asset('images/icons/browserconfig.xml') }}">
    <meta name="theme-color" content="#ffffff">

    <!-- Bootstrap -->
    @section('stylesheets')
        <link href="{{ asset(mix('style.css', 'vendor/aloiacmsgui')) }}" rel="stylesheet" defer>
    @show

    <script type="module" src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
    <script nomodule src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine-ie11.min.js" defer></script>

    @stack('scripts')

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="text-blue-darkest flex flex-col md:flex-row h-auto">

@section('navigation')

    @include('aloiacmsgui::blocks.navigation')

@show

<main class="flex-1 pt-8 px-4 md:px-8">
    @yield('content')
</main>

</body>
</html>
