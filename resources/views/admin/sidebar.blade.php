<div class="col-md-3">
    <div class="card">
        <div class="card-header">
            Sidebar
        </div>

        <div class="card-body">
            <ul class="nav" role="tablist">
                <li>
                    <a href="{{route('admin_panel')}}">
                        <i class="fa fa-home"></i>
                        <span class="link-title menu_hide">&nbsp;Dashboard</span>
                    </a>
                </li>
                <li class="">
                    <a href="{{route('pages.index')}}">
                        <i class="fa fa-tachometer"></i>
                        <span class="link-title menu_hide">&nbsp;Pages

                            </span>
                    </a>
                </li>
                <li class="">
                    <a href="{{route('admin.list_user')}}">
                        <i class="fa fa-tachometer"></i>
                        <span class="link-title menu_hide">&nbsp;Users

                            </span>
                    </a>
                </li>
                <li class="">
                    <a href="{{route('videos_for_approval')}}">
                        <i class="fa fa-tachometer"></i>
                        <span class="link-title menu_hide">&nbsp;User's Videos</span>
                    </a>
                </li>
                <li class="">
                    <a href="{{route('admin.videos_list')}}">
                        <i class="fa fa-tachometer"></i>
                        <span class="link-title menu_hide">&nbsp;Videos List
                        </span>
                    </a>
                </li>

                <li class="">
                    <a href="{{route('categories.index')}}">
                        <i class="fa fa-tachometer"></i>
                        <span class="link-title menu_hide">Video&nbsp;Categories

                        </span>
                    </a>
                </li>

                {{--                <li class="">--}}
                {{--                    <a href="{{route('user_tags')}}">--}}
                {{--                        <i class="fa fa-tachometer"></i>--}}
                {{--                        <span class="link-title menu_hide">&nbsp;Industry--}}
                {{--                        </span>--}}
                {{--                    </a>--}}
                {{--                </li>--}}
                <li class="">
                    <a href="{{route('user-categories.index')}}">
                        <i class="fa fa-tachometer"></i>
                        <span class="link-title menu_hide">&nbsp;Industry/Profession/Expertise
                        </span>
                    </a>
                </li>

                <li class="">
                    <a href="{{action('ReportQueryController@index')}}">
                        <i class="fa fa-tachometer"></i>
                        <span class="link-title menu_hide">&nbsp;Reported Messages
                        </span>
                    </a>
                </li>
                <li class="">
                    <a href="{{action('ReportQueryController@reported_videos')}}">
                        <i class="fa fa-tachometer"></i>
                        <span class="link-title menu_hide">&nbsp;Reported Videos
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
