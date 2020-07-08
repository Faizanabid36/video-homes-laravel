<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{env('APP_NAME')}}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
     <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"> -->
    <link href="{{asset('css/public.css')}}" rel="stylesheet">
<!-- <link href="{{asset('css/app.css')}}" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="{{asset('css/mediaelementplayer.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.tagit.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css">
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

                    <img src="https://www.videohomes.com/wp-content/uploads/2020/04/cropped-VideoHomes-3.png"
                         class="logo" alt="video Homes Logo"/>


                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto links-home">
                    <li class="nav-item ">
                            <a class="nav-link" href="{{route('login')}}">LOGIN </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('directory')}}">DIRECTORY <span class="sr-only">(current)</span></a>
                        </li>
                        @foreach($pages as $page)
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('public.page',$page->slug)}}">{{strtoupper($page->title)}}</a>
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
{{--            <div class="footer-top"></div>--}}
            <div class="footer1"><h3> © VideoHomes.com LLC 2020 </h3></div>
        </div>
    </div>


</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{asset('js/jquery-3.min.js')}}"></script>
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
<script src="{{asset('js/mediaelement-and-player.min.js')}}"></script>
@yield('script')
</body>
</html>
