<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title> {{$title ?? ''}} - {{env('APP_NAME')}}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@yield('meta');
    <link href="{{asset('css/public.css?version=')}}{{time()}}" rel="stylesheet">
    @yield('style')

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-47773357-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-47773357-2');
    </script>
    <script>
        window.VIDEO_APP = {
            base_url: '{{url('/')}}',
        };
        @yield('header_script')
    </script>

</head>
<body>
<div class="container-fluid bg-white shadow-lg">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg navbar-light navbar-header">
                    <a class="navbar-brand" href="{{url('/')}}">
                        <img src="{{asset('img/cropped-VideoHomes-3.png')}}"
                             class="logo" alt="VideoHomes Logo"/>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
{{--                            <li class="nav-item"><a href="{{route('home')}}" class="nav-link">HOME</a></li>--}}
                            @auth
                                @if (auth()->user()->isAdmin())
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('admin_panel')}}">ADMIN PANEL</a>
                                    </li>
                                @else
                                    <li class="nav-item ">
                                        <a class="nav-link" href="{{route('dashboard')}}">DASHBOARD </a>
                                    </li>
                                @endif

                            @else
                                <li class="nav-item ">
                                    <a class="nav-link" href="{{route('login')}}">LOGIN </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" href="{{route('register')}}">REGISTER </a>
                                </li>
                            @endauth
                            <li class="nav-item ">
                                <a class="nav-link" href="{{route('directory')}}">DIRECTORY <span
                                        class="sr-only">(current)</span></a>
                            </li>
                            @foreach($pages as $page)
                                <li class="nav-item">
                                    <a class="nav-link"
                                       href="{{route('directory_by_username',$page->slug)}}">{{strtoupper($page->title)}}</a>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                </nav>
                <!-- Nav-end -->
            </div>
        </div>
    </div>
</div>
<div class="container my-3">
    <div class="row">
        <div class="col">
            {{Breadcrumbs::render()}}
        </div>
    </div>
</div>
@yield('content')
    <div class="container-fluid bg-dark ">
        <div class="row">
            <div class="col-12  border-primary text-white py-5 text-center" style="border-top: 5px solid;">
                {!! $footer !!}
            </div>
        </div>
    </div>
    <script src="{{ asset('js/public.js?version=').time() }}"></script>
@yield('script')
</body>
</html>
