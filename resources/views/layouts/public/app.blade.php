<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title> {{$title ?? ''}}{{env('APP_NAME')}}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{asset('css/public.css')}}" rel="stylesheet">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css">
    @yield('style')
    <script>
        window.VIDEO_APP = {
            base_url: '{{url('/')}}',
        }
    </script>
</head>
<body>
<div class="container-fluid m-0 p-0">

    <div class="row  m-0 p-0">
        <div class="col m-0 p-0 ">
            <!-- Nav       -->

            <nav class="navbar navbar-expand-lg navbar-light bg-light home-nav ">
                <a class="navbar-brand" href="{{url('/')}}">

                    <img src="{{asset('img/cropped-VideoHomes-3.png')}}"
                         class="logo" alt="videoHomes Logo"/>


                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto links-home">
                        @auth('auth')
                            <li class="nav-item ">
                                <a class="nav-link" href="{{route('dashboard')}}">DASHBOARD </a>
                            </li>
                            @auth('admin')
                                <li class="nav-item ">
                                    <a class="nav-link" href="{{route('admin_panel')}}">Admin </a>
                                </li>
                        @else
                            <li class="nav-item ">
                                <a class="nav-link" href="{{route('login')}}">LOGIN </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="{{route('register')}}">REGISTER </a>
                            </li>
                        @endguest
                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('directory')}}">DIRECTORY <span
                                    class="sr-only">(current)</span></a>
                        </li>
                        @foreach($pages as $page)
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{route('public.page',$page->slug)}}">{{strtoupper($page->title)}}</a>
                            </li>
                        @endforeach
                    </ul>

                </div>
            </nav>
            <!-- Nav-end -->
        </div>


    </div>
    <div style="min-height:100vh;">
        @yield('content')
    </div>
    <div class="row sayHello m-0 p-0 ">
        <div class="col-12 m-0 p-0 ">
            <div class="footer1"><h3> © VideoHomes.com LLC 2020 </h3></div>
        </div>
    </div>


</div>
<script src="{{ asset('js/public.js') }}"></script>
@yield('script')
</body>
</html>
