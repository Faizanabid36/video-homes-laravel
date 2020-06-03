<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    @yield('style');
</head>
<body>

@yield('content')
@yield('script');
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
