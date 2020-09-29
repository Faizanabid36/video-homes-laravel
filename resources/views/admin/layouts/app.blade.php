<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'VideoHome') }}</title>
    <link href="{{asset('css/public.css?version=')}}{{time()}}" rel="stylesheet">
    <script src="https://cdn.tiny.cloud/1/rlsbsechuy5zwieakwp79flrto7ipmojgummzxwwjbbcbtye/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    @yield('style')
    @yield('stylesheets')
    <script>
        window.VIDEO_APP = {
            base_url: '{{url('/')}}',
        };
        @yield('header_script')
    </script>

</head>
<body>
<div class="container-fluid">
    @include('admin.layouts.header')
    @yield('content')
</div>
<script src="{{ asset('js/public.js?version=').time() }}"></script>
@yield('scripts')
@yield('script')
</body>
</html>
