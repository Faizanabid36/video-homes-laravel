<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    
    <link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.tagit.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/twemoji-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('css/lib/sweetalert2/dist/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/lib/notifIt/notifIt/css/notifIt.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}" id="style-css">
    <link rel="stylesheet" href="{{asset('css/custom.style.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('js/emoji/emojionearea/dist/emojionearea.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/mediaelementplayer.min.css')}}">
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


<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{asset('js/jquery-3.min.js')}}"></script>
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.form.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/tag-it.min.js')}}"></script>
<script src="{{asset('js/lib/sweetalert2/dist/sweetalert2.js')}}"></script>
<script src="{{asset('js/lib/notifIt/notifIt/js/notifIt.min.js')}}"></script>
<script src="{{asset('js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('js/owl.carousel.min')}}.js"></script>
<script src="{{asset('js/Fingerprintjs2/fingerprint2.js')}}"></script>
<script src="{{asset('js/emoji/emojionearea/dist/emojionearea.js')}}"></script>
<script src="{{asset('js/mediaelement-and-player.min.js')}}"></script>
@yield('footer_script')
</body>
</html>
