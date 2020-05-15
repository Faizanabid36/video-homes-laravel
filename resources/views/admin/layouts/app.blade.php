<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Video Home') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app1.js') }}" defer></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link type="text/css" href="{{ asset('css/components.css') }}" rel="stylesheet"/>
    <link type="text/css" href="{{ asset('css/custom.css') }}" rel="stylesheet"/>
    <!-- end of global styles-->
    <link type="text/css" href="{{ asset('vendors/chartist/css/chartist.min.css') }}" rel="stylesheet" href=""/>
    <link type="text/css" href="{{ asset('css/components.css') }}" rel="stylesheet"
          href="vendors/circliful/css/jquery.circliful.css">
    <link type="text/css" href="{{ asset('css/components.css') }}" rel="stylesheet" href="css/pages/index.css">
    <link type="text/css" href="{{ asset('css/pages/tables.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    @yield('stylesheets')
</head>
<body>
<div id="app">
    @auth
        <div id="wrap">
            @include('admin.layouts.header')
            @include('admin.layouts.sidebar')
            @endauth


            <div id="content" class="bg-container" style="min-height: 610px;">
                @yield('content')
            </div>


        </div>

        <script src="{{ asset('js/components.js') }}"></script>
        <script src="{{ asset('js/custom.js') }}"></script>
        <!--end of global scripts-->
        <!--  plugin scripts -->
        @yield('scripts')
        <script src="{{ asset('vendors/countUp.js/js/countUp.min.js') }}"></script>
        <script src="{{ asset('vendors/flip/js/jquery.flip.min.js') }}"></script>
        <script src="{{ asset('js/pluginjs/jquery.sparkline.js') }}"></script>
        <script src="{{ asset('vendors/chartist/js/chartist.min.js') }}"></script>
        <script src="{{ asset('js/pluginjs/chartist-tooltip.js') }}"></script>
        <script src="{{ asset('/vendors/swiper/js/swiper.min.js') }}"></script>
        <script src="{{ asset('vendors/circliful/js/jquery.circliful.min.js') }}"></script>
        <script src="{{ asset('vendors/flotchart/js/jquery.flot.js') }}"></script>
        <script src="{{ asset('vendors/flotchart/js/jquery.flot.resize.js') }}"></script>
        <!--end of plugin scripts-->
        <script src="{{ asset('js/pages/index.js') }}"></script>
</body>
</html>
