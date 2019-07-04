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

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="{{isset($customClass) ? $customClass : ''}} container mx-auto text-blue-darkest px-4 lg:px-0">

@section('navigation')

    @include('blocks.navigation')

@show

@yield('content')

@section('footer')

    @include('blocks.mailchimp_form')

    @include('blocks.navigation')

@show

<script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "Organization",
          "url": "https://plantcareforbeginners.com",
          "name": "Plant care for beginners",
          "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+31-6-2232-4113",
            "contactType": "Customer service"
          }
        }
        </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    (function() {
        $('a').click(function () {
            $('html, body').animate({
                scrollTop: $($(this).attr('href')).offset().top
            }, 500);
            return false;
        });
    })();
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-139200670-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-139200670-1');
</script>
<script>
    if('serviceWorker' in navigator) {
        navigator.serviceWorker.getRegistrations()
            .then(function(registrations) {
                for(let registration of registrations) {
                    registration.unregister()
                }
            })
    }
</script>

{{--<script>--}}
{{--if('serviceWorker' in navigator) {--}}
{{--navigator.serviceWorker--}}
{{--.register('/sw.js')--}}
{{--.then(function() { console.log("Service Worker Registered"); });--}}
{{--}--}}
{{--</script>--}}
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:1254063,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>
</body>
</html>
