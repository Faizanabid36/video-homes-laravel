<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAm4Wvmd2nIeaFQCdhAsxbiSXgBsibDolc&libraries=places&callback=initMap"></script>

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

{{--<script src="{{asset('js/jquery-3.min.js')}}"></script>--}}
{{--<script src="{{asset('js/jquery-ui.min.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{asset('js/jquery.form.min.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{asset('js/tag-it.min.js')}}"></script>--}}
{{--<script src="{{asset('js/lib/sweetalert2/dist/sweetalert2.js')}}"></script>--}}
{{--<script src="{{asset('js/lib/notifIt/notifIt/js/notifIt.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap-select.min.js')}}"></script>--}}
{{--<script src="{{asset('js/owl.carousel.min')}}.js"></script>--}}
{{--<script src="{{asset('js/Fingerprintjs2/fingerprint2.js')}}"></script>--}}
{{--<script src="{{asset('js/emoji/emojionearea/dist/emojionearea.js')}}"></script>--}}
{{--<script src="{{asset('js/mediaelement-and-player.min.js')}}"></script>--}}
<script src="{{ asset('js/app.js') }}"></script>
@yield('footer_script')
</body>
</html>
