<div id="top">

    <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
        <a class="navbar-brand mr-auto mr-lg-0" href="#">{{env('APP_NAME')}}</a>
        <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="{{route('admin_panel')}}">
                        <i class="fa fa-home"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('pages.index')}}">
                        <i class="fa fa-tachometer"></i> Pages
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.list_user')}}">
                        <i class="fa fa-tachometer"></i> Users
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('videos_for_approval')}}">
                        <i class="fa fa-tachometer"></i>
                        <span class="link-title menu_hide">&nbsp;User's Videos</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.videos_list')}}">
                        <i class="fa fa-tachometer"></i> Videos List
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('categories.index')}}">
                        <i class="fa fa-tachometer"></i> Video&nbsp;Categories
                    </a>
                </li>

                {{--                <li class="">--}}
                {{--                    <a href="{{route('user_tags')}}">--}}
                {{--                        <i class="fa fa-tachometer"></i>--}}
                {{--                        <span class="link-title menu_hide">&nbsp;Industry--}}
                {{--                        </span>--}}
                {{--                    </a>--}}
                {{--                </li>--}}
                <li class="nav-item">
                    <a href="{{route('user-categories.index')}}">
                        <i class="fa fa-tachometer"></i> User Categories
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{action('ReportQueryController@index')}}">
                        <i class="fa fa-tachometer"></i> Reported Messages
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{action('ReportQueryController@reported_videos')}}">
                        <i class="fa fa-tachometer"></i> Reported Videos
                    </a>
                </li>
            </ul>
            <div class="btn-group float-right">
                <div class="user-settings no-bg">
                    <button type="button" class="btn btn-default no-bg micheal_btn"
                            data-toggle="dropdown">
                        <img src="{{asset('img/admin.jpg')}}"
                             class="admin_img2 img-thumbnail rounded-circle avatar-img"
                             alt="avatar"> <strong>{{ auth()->user()->name }} </strong>
                        <i class="fa fa-sort-down white_bg"></i>
                    </button>
                    <div class="dropdown-menu admire_admin">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="fa fa-lock"></i> {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>
