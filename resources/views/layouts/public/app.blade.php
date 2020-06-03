<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{env('APP_NAME')}}</title>

    <link href="{{asset('css/public.css')}}" rel="stylesheet">
    @yield('style')
    <script>
        window.VIDEO_APP = {
            base_url: '{{url('/')}}',
        }
    </script>
</head>
<body>

@yield('content')
@yield('script')
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
