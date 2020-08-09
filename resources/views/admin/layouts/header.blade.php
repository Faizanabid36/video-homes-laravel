
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
    <a class="navbar-brand mr-auto mr-lg-0" href="{{route('admin_panel')}}">{{env('APP_NAME')}}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin_panel')}}">
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('pages.index')}}">
                    Pages
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('users.index')}}">
                    Users
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('videos.index')}}">

                    Videos List
                </a>
            </li>
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" href="{{route('admin.videos_list')}}">--}}
{{--                    Videos List--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" href="{{route('categories.index')}}">--}}
{{--                    Video&nbsp;Categories--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            --}}{{--                <li class="">--}}
{{--            --}}{{--                    <a class="nav-link" href="{{route('user_tags')}}">--}}
{{--            --}}{{--                        <i class="fa fa-tachometer"></i>--}}
{{--            --}}{{--                        <span class="link-title menu_hide">&nbsp;Industry--}}
{{--            --}}{{--                        </span>--}}
{{--            --}}{{--                    </a>--}}
{{--            --}}{{--                </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" href="{{route('user-categories.index')}}">--}}
{{--                    User Categories--}}
{{--                </a>--}}
{{--            </li>--}}

            <li class="nav-item">
                <a class="nav-link" href="{{action('ReportQueryController@index')}}">
                    Reported Messages
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{action('ReportQueryController@reported_videos')}}">
                    Reported Videos
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{asset('img/admin.jpg')}}"
                         class="w-25 img-thumbnail rounded-circle avatar-img"
                         alt="avatar"> <strong>{{ auth()->user()->name }} </strong>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="fa fa-lock"></i> {{ __('Logout') }}
                    </a>
{{--                    <a class="dropdown-item" href="#">Another action</a>--}}
{{--                    <div class="dropdown-divider"></div>--}}
{{--                    <a class="dropdown-item" href="#">Something else here</a>--}}
                </div>
            </li>
        </ul>
        <form id="logout-form" class="d-none" action="{{ route('logout') }}" method="POST">
            @csrf
        </form>
    </div>
</nav>
