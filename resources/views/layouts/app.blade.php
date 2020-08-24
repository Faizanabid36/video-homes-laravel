<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAm4Wvmd2nIeaFQCdhAsxbiSXgBsibDolc&libraries=places"></script>

    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <script>
        window.VIDEO_APP = {
            base_url: '{{url('/')}}',
        }
    </script>
    @yield('links')
</head>
<body class="parentcontainer">
@yield('container')

<script src="{{ asset('js/app.js') }}"></script>
@yield('footer_script')
</body>
</html>
