<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.tagit.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/twemoji-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/lib/sweetalert2/dist/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/lib/notifIt/notifIt/css/notifIt.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}" id="style-css">
    <link rel="stylesheet" href="{{asset('css/custom.style.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom.style.css')}}">
    <script src="{{asset('js/jquery-3.min.js')}}"></script>
    <script src="{{asset('js/jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.form.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/tag-it.min.js')}}"></script>
    <script src="{{asset('js/lib/sweetalert2/dist/sweetalert2.js')}}"></script>
    <script src="{{asset('js/lib/notifIt/notifIt/js/notifIt.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
    <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <script src="{{asset('js/owl.carousel.min')}}.js"></script>
    <script src="{{asset('js/Fingerprintjs2/fingerprint2.js')}}"></script>
    <script src="{{asset('js/emoji/emojionearea/dist/emojionearea.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('js/emoji/emojionearea/dist/emojionearea.min.css')}}"/>
    @yield('links')
</head>
<body id="pt-body">
<header>
{{--    <nav class="navbar navbar-findcond navbar-fixed-top header-layout">--}}
{{--        <div class="pt_main_hdr" id="header_change">--}}
{{--            <div class="navbar-header">--}}
{{--                <a class="navbar-brand logo-img " href="{{route('home')}}">--}}
{{--                    <h4>Video Homes</h4>--}}
{{--                </a>--}}
{{--                <div class="form-group">--}}
{{--                    <?php--}}
{{--                    if (!empty($_GET['is_channel'])) {--}}
{{--                        ?>--}}
{{--                    <?php } ?>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <ul class="nav navbar-nav navbar-right">--}}
{{--                <li class="hide-from-mobile">--}}
{{--                    <a href="#" class="btn upload-button">--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">--}}
{{--                            <path fill="currentColor"--}}
{{--                                  d="M14,13V17H10V13H7L12,8L17,13M19.35,10.03C18.67,6.59 15.64,4 12,4C9.11,4 6.6,5.64 5.35,8.03C2.34,8.36 0,10.9 0,14A6,6 0 0,0 6,20H19A5,5 0 0,0 24,15C24,12.36 21.95,10.22 19.35,10.03Z"/>--}}
{{--                        </svg>--}}
{{--                        <span class="hide-in-mobile">Upload</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="hide-from-mobile pull-left top-header">--}}
{{--                    <a href="##" data-load="?link1=messages">--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">--}}
{{--                            <path fill="currentColor"--}}
{{--                                  d="M20,2H4A2,2 0 0,0 2,4V22L6,18H20A2,2 0 0,0 22,16V4A2,2 0 0,0 20,2M6,9H18V11H6M14,14H6V12H14M18,8H6V6H18"/>--}}
{{--                        </svg>--}}
{{--                        <span id="new-messages"></span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="dropdown hide-from-mobile top-header profile-nav">--}}
{{--                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">--}}
{{--                            <path fill="currentColor"--}}
{{--                                  d="M12,19.2C9.5,19.2 7.29,17.92 6,16C6.03,14 10,12.9 12,12.9C14,12.9 17.97,14 18,16C16.71,17.92 14.5,19.2 12,19.2M12,5A3,3 0 0,1 15,8A3,3 0 0,1 12,11A3,3 0 0,1 9,8A3,3 0 0,1 12,5M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12C22,6.47 17.5,2 12,2Z"></path>--}}
{{--                        </svg>--}}
{{--                    </a>--}}
{{--                    <ul class="dropdown-menu" role="menu">--}}
{{--                        <li><a href="{{route('login')}}">Login</a></li>--}}
{{--                        <li>--}}
{{--                            <a href="{{route('register')}}">Register</a>--}}
{{--                        </li>--}}
{{--                        <li class="divider hidden-lg hidden-md hidden-sm"></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--            <div class="clear"></div>--}}
{{--        </div>--}}
{{--    </nav>--}}
    <nav class="navbar navbar-findcond navbar-fixed-top header-layout">
        <div class="pt_main_hdr" id="header_change">
            <div class="navbar-header">
                <a class="navbar-brand logo-img" href="#">
                    <h4>Video Homes</h4>
                </a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li class="hide-from-mobile">
                    <a href="#" class="btn upload-button" data-load="?link1=upload-video">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                  d="M14,13V17H10V13H7L12,8L17,13M19.35,10.03C18.67,6.59 15.64,4 12,4C9.11,4 6.6,5.64 5.35,8.03C2.34,8.36 0,10.9 0,14A6,6 0 0,0 6,20H19A5,5 0 0,0 24,15C24,12.36 21.95,10.22 19.35,10.03Z"/>
                        </svg>
                        <span class="hide-in-mobile">Upload</span>
                    </a>
                </li>
                <li class="hide-from-mobile pull-left top-header">
                    <a href="#" data-load="?link1=messages">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                  d="M20,2H4A2,2 0 0,0 2,4V22L6,18H20A2,2 0 0,0 22,16V4A2,2 0 0,0 20,2M6,9H18V11H6M14,14H6V12H14M18,8H6V6H18"/>
                        </svg>
                        <span id="new-messages"></span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>
@yield('container')
</body>
</html>
