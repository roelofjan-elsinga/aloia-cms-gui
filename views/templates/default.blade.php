<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @section('meta')
        <meta name="keywords" content="{{ $page->keywords() }}">
        <meta name="description" content="{{ $page->description() }}">
        <meta name="author" content="{{ $page->author() }}">

        <meta property="og:title" content="{{ $page->title() }}"/>
        <meta property="og:type" content="website"/>
        <meta property="og:image" content="{{ $page->thumbnail() }}"/>
        <meta property="og:url" content="{{ Request::url() }}"/>
        <meta property="og:description" content="{{ $page->description() }}"/>

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:url" content="{{ Request::url() }}">
        <meta name="twitter:title" content="{{ $page->title() }}">
        <meta name="twitter:description" content="{{ $page->description() }}">
        <meta name="twitter:image" content="{{ $page->image()  }}">

        @if(!is_null($page->canonicalLink()))
            <link rel="canonical" href="{{$page->canonicalLink()}}" />
        @endif

        <title>{{ $page->title() }}</title>
    @show

    <link rel="dns-prefetch" href="https://www.google-analytics.com">

    {{-- These are prev and next links for pagination --}}

    @if(isset($pagination_tags['prev']) && !is_null($pagination_tags['prev']))
        <link rel="prev" href="{{url($pagination_tags['prev'])}}" />
    @endif

    @if(isset($pagination_tags['next']) && !is_null($pagination_tags['next']))
        <link rel="next" href="{{url($pagination_tags['next'])}}" />
    @endif

    {{-- If there is pagination, display the canonical link --}}

    @if(isset($pagination_tags))
        <link rel="canonical" href="{{\Main\Classes\Canonical::getLink()}}" />
    @endif

    {{-- Display the canonical URL if necessary and if it's not already included --}}

    @if(!isset($pagination_tags) && \Main\Classes\Canonical::needsLink())
        <link rel="canonical" href="{{\Main\Classes\Canonical::getLink()}}" />
    @endif

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
        <link href="{{ mix('css/front.css') }}" rel="stylesheet" defer>
@show

</head>
<body class="{{isset($customClass) ? $customClass : ''}} container mx-auto text-blue-darkest px-4 lg:px-0">

@section('navigation')

    @include('flatfilecmsgui::templates.header')

@show

@yield('content')

@section('footer')

    @include('flatfilecmsgui::templates.footer')

@show
</body>
</html>
