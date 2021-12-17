<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en"> <!--<![endif]-->
<head>
    @hasSection('title')
        <title>@yield('title') - {{ config('app.name') }}</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/icons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/icons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/icons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/icons/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('assets/icons/safari-pinned-tab.svg') }}" color="#b92025">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <meta name="msapplication-TileColor" content="#222222">
    <meta name="msapplication-config" content="{{ asset('assets/icons/browserconfig.xml') }}">
    <meta name="theme-color" content="#222222">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{--
        Usually I would handle the assets (CSS & JS) via Laravel Mix/Webpack, however, since it was provided to me via a RAR file
        with most files already "compiled", I decided to use the "raw" version of the files here. Don't blame me, blame JM :kappa:
     --}}

        @bukStyles(true)
        @stack('scripts-top')
</head>
<body class="dark">
<div class="wrapper">
    @include('includes.header')

    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left">@yield('title')</h1>
            <ul class="pull-right breadcrumb">
                @yield('breadcrumbs')
            </ul>
        </div>
    </div>

    @yield('content')

    @include('includes.footer')
</div>

<script type="text/javascript" src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('assets/plugins/back-to-top.js') }}"></script>

<script type="text/javascript" src="{{ asset('assets/js/custom.js') }}"></script>

<script type="text/javascript" src="{{ asset('assets/js/app.js') }}"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        App.init()
    })
</script>

<script src="{{ asset('assets/js/flatpickr.min.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    flatpickr("#start_at, #end_at", {
        enableTime: true,
        minDate: new Date().fp_incr(15),
        time_24hr: true,
        altInput: true,
        altFormat: "d M Y H:00 \\U\\T\\C",
        dateFormat: "Y-m-d H:i:00",
    });
</script>

<!--[if lt IE 9]>
<script src="{{ asset('assets/plugins/respond.js') }}"></script>
<script src="{{ asset('assets/plugins/html5shiv.js') }}"></script>
<script src="{{ asset('assets/plugins/placeholder-IE-fixes.js') }}"></script>
<![endif]-->

<script type="text/javascript">
    window.addEventListener('load', function () {
        window.cookieconsent.initialise({
            'palette': {
                'popup': {
                    'background': '#000',
                    'text': '#fff'
                },
                'button': {
                    'background': '#72c02c',
                    'text': '#fff'
                }
            },
            'theme': 'edgeless',
            'content': {
                'href': '/policy'
            }
        })
    })
</script>
<script type="text/javascript" src="{{ asset('assets/plugins/cookieconsent2/cookieconsent.min.js') }}"></script>

<script
    type="text/javascript">$.ajaxSetup({headers: {'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')}})</script>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
@stack('scripts-bottom')
@bukScripts(true)
</body>
</html>
