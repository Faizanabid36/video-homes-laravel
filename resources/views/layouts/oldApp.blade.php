<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.tagit.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/twemoji-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/lib/sweetalert2/dist/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/lib/notifIt/notifIt/css/notifIt.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}" id="style-css">
    <link rel="stylesheet" href="{{asset('css/custom.style.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('js/emoji/emojionearea/dist/emojionearea.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/mediaelementplayer.min.css')}}">

    <script>
        window.VIDEO_APP = {
            base_url: '{{url('/')}}',
        }
    </script>
    @yield('links')
</head>
<body id="pt-body">

<header>
    <nav class="navbar navbar-findcond navbar-fixed-top header-layout">
        <div class="navbar-header" style="position: fixed;float: left">
            <a class="navbar-brand logo-img" href="{{route('dashboard')}}">
                <h4>Video Homes</h4>
            </a>
        </div>
        <div class="pt_main_hdr pull-right" id="header_change">
            <ul class="nav navbar-nav navbar-right" style="display: inline;float: right !important">
                @if(auth()->user())
                    <li>
                        <a href="{{route('dashboard')}}/#/upload_video" class="btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                      d="M14,13V17H10V13H7L12,8L17,13M19.35,10.03C18.67,6.59 15.64,4 12,4C9.11,4 6.6,5.64 5.35,8.03C2.34,8.36 0,10.9 0,14A6,6 0 0,0 6,20H19A5,5 0 0,0 24,15C24,12.36 21.95,10.22 19.35,10.03Z"></path>
                            </svg>
                            <span class="hide-in-mobile">Upload</span>
                        </a>
                    </li>
                    <li class="hide-from-mobile pull-left top-header">
                        <a href="{{route('dashboard')}}/#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                      d="M20,2H4A2,2 0 0,0 2,4V22L6,18H20A2,2 0 0,0 22,16V4A2,2 0 0,0 20,2M6,9H18V11H6M14,14H6V12H14M18,8H6V6H18"></path>
                            </svg>
                            <span id="new-messages"></span>
                        </a>
                    </li>
                    <li class="hide-from-mobile dropdown pull-left top-header">
                        <a href="javascript:void(0);" id="get-notifications" class=" dropdown-toggle"
                           data-toggle="dropdown">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                      d="M21,19V20H3V19L5,17V11C5,7.9 7.03,5.17 10,4.29C10,4.19 10,4.1 10,4A2,2 0 0,1 12,2A2,2 0 0,1 14,4C14,4.1 14,4.19 14,4.29C16.97,5.17 19,7.9 19,11V17L21,19M14,21A2,2 0 0,1 12,23A2,2 0 0,1 10,21M19.75,3.19L18.33,4.61C20.04,6.3 21,8.6 21,11H23C23,8.07 21.84,5.25 19.75,3.19M1,11H3C3,8.6 3.96,6.3 5.67,4.61L4.25,3.19C2.16,5.25 1,8.07 1,11Z"></path>
                            </svg>
                            <span id="new-notifications"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right notfi-dropdown" id="notifications">
                            <li>
                                <h5>
                                    <b id="all-notifications"></b> Notifications
                                    <i class="fa fa-circle-o-notch spin hidden"></i>
                                </h5>
                            </li>
                            <li>
                                <ul id="notifications-list"></ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown hide-from-mobile pull-left profile-nav">
                        <a href="{{route('dashboard')}}/#/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <img class="header-image"
                                 src="{{asset('upload/photos/d-avatar.jpg')}}">
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{route('dashboard')}}#/profile">
                                    <img width="20"
                                         src="{{asset('upload/photos/d-avatar.jpg')}}"/>{{auth()->user()->name}}
                                </a>
                            </li>
                            <li>
                                <a href="/#/customize_player">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                              d="M21,19V17H8V19H21M21,13V11H8V13H21M8,7H21V5H8V7M4,5V7H6V5H4M3,5A1,1 0 0,1 4,4H6A1,1 0 0,1 7,5V7A1,1 0 0,1 6,8H4A1,1 0 0,1 3,7V5M4,11V13H6V11H4M3,11A1,1 0 0,1 4,10H6A1,1 0 0,1 7,11V13A1,1 0 0,1 6,14H4A1,1 0 0,1 3,13V11M4,17V19H6V17H4M3,17A1,1 0 0,1 4,16H6A1,1 0 0,1 7,17V19A1,1 0 0,1 6,20H4A1,1 0 0,1 3,19V17Z"></path>
                                    </svg>
                                    Customize Player
                                </a>
                            </li>
                            <li>
                                <a href="{{route('dashboard')}}#/playlist">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                              d="M19,9H2V11H19V9M19,5H2V7H19V5M2,15H15V13H2V15M17,13V19L22,16L17,13Z"></path>
                                    </svg>
                                    PlayLists
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{route('dashboard')}}/#/">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                              d="M17,10.5L21,6.5V17.5L17,13.5V17A1,1 0 0,1 16,18H4A1,1 0 0,1 3,17V7A1,1 0 0,1 4,6H16A1,1 0 0,1 17,7V10.5M14,16V15C14,13.67 11.33,13 10,13C8.67,13 6,13.67 6,15V16H14M10,8A2,2 0 0,0 8,10A2,2 0 0,0 10,12A2,2 0 0,0 12,10A2,2 0 0,0 10,8Z"></path>
                                    </svg>
                                    Video Studio
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{route('dashboard')}}/#/settings">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                              d="M12,15.5A3.5,3.5 0 0,1 8.5,12A3.5,3.5 0 0,1 12,8.5A3.5,3.5 0 0,1 15.5,12A3.5,3.5 0 0,1 12,15.5M19.43,12.97C19.47,12.65 19.5,12.33 19.5,12C19.5,11.67 19.47,11.34 19.43,11L21.54,9.37C21.73,9.22 21.78,8.95 21.66,8.73L19.66,5.27C19.54,5.05 19.27,4.96 19.05,5.05L16.56,6.05C16.04,5.66 15.5,5.32 14.87,5.07L14.5,2.42C14.46,2.18 14.25,2 14,2H10C9.75,2 9.54,2.18 9.5,2.42L9.13,5.07C8.5,5.32 7.96,5.66 7.44,6.05L4.95,5.05C4.73,4.96 4.46,5.05 4.34,5.27L2.34,8.73C2.21,8.95 2.27,9.22 2.46,9.37L4.57,11C4.53,11.34 4.5,11.67 4.5,12C4.5,12.33 4.53,12.65 4.57,12.97L2.46,14.63C2.27,14.78 2.21,15.05 2.34,15.27L4.34,18.73C4.46,18.95 4.73,19.03 4.95,18.95L7.44,17.94C7.96,18.34 8.5,18.68 9.13,18.93L9.5,21.58C9.54,21.82 9.75,22 10,22H14C14.25,22 14.46,21.82 14.5,21.58L14.87,18.93C15.5,18.67 16.04,18.34 16.56,17.94L19.05,18.95C19.27,19.03 19.54,18.95 19.66,18.73L21.66,15.27C21.78,15.05 21.73,14.78 21.54,14.63L19.43,12.97Z"></path>
                                    </svg>
                                    Settings
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                              d="M16.56,5.44L15.11,6.89C16.84,7.94 18,9.83 18,12A6,6 0 0,1 12,18A6,6 0 0,1 6,12C6,9.83 7.16,7.94 8.88,6.88L7.44,5.44C5.36,6.88 4,9.28 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12C20,9.28 18.64,6.88 16.56,5.44M13,3H11V13H13"></path>
                                    </svg>
                                    {{ __('Sign Out') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    {{ csrf_field() }}
                                </form>

                            </li>
                            <li class="divider"></li>

                            <span class="headtoppoint"></span>
                        </ul>
                    </li>
                @else
                    <li class="dropdown hide-from-mobile top-header profile-nav">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                      d="M12,19.2C9.5,19.2 7.29,17.92 6,16C6.03,14 10,12.9 12,12.9C14,12.9 17.97,14 18,16C16.71,17.92 14.5,19.2 12,19.2M12,5A3,3 0 0,1 15,8A3,3 0 0,1 12,11A3,3 0 0,1 9,8A3,3 0 0,1 12,5M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12C22,6.47 17.5,2 12,2Z"></path>
                            </svg>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{route('login')}}">Login</a></li>
                            <li>
                                <a href="{{route('register')}}">Register</a>
                            </li>
                            <li class="divider hidden-lg hidden-md hidden-sm"></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
    <div class="clear"></div>
</header>
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