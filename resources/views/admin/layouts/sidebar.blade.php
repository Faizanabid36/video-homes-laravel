
    <div id="left">
        <div class="menu_scroll">
            <div class="left_media">
                <div class="media user-media">
                    <div class="user-media-toggleHover">
                        <span class="fa fa-user"></span>
                    </div>
                    <div class="user-wrapper">
                        <a class="user-link" href="#">
                            <img class="media-object img-thumbnail user-img rounded-circle admin_img3"
                                 alt="User Picture"
                                 src="{{ asset('img/admin.jpg') }}">
                            <p class="user-info menu_hide">Welcome {{ Auth::user()->name }} </p>
                        </a>
                    </div>
                </div>
                <hr/>
            </div>
            <ul id="menu">
                <li>
                    <a href="{{route('dashboard')}}">
                        <i class="fa fa-home"></i>
                        <span class="link-title menu_hide">&nbsp;Dashboard</span>
                    </a>
                </li>
                <li class="">
                    <a href="{{route('public_pages.index')}}">
                        <i class="fa fa-tachometer"></i>
                        <span class="link-title menu_hide">&nbsp;Public Pages

                            </span>
                    </a>
                </li>
                <li class="">
                    <a href="{{route('admin.list_user')}}">
                        <i class="fa fa-tachometer"></i>
                        <span class="link-title menu_hide">&nbsp;Users List

                            </span>
                    </a>
                </li>
                <li class="">
                    <a href="{{route('videos_for_approval')}}">
                        <i class="fa fa-tachometer"></i>
                        <span class="link-title menu_hide">&nbsp;Videos For Apporval

                            </span>
                    </a>
                </li>

                <li class="">
                    <a href="{{route('category')}}">
                        <i class="fa fa-tachometer"></i>
                        <span class="link-title menu_hide">Video&nbsp;Categories

                        </span>
                    </a>
                </li>

                <li class="">
                    <a href="{{route('user_tags')}}">
                        <i class="fa fa-tachometer"></i>
                        <span class="link-title menu_hide">&nbsp;Define User Roles
                        </span>
                    </a>
                </li>
                <li class="">
                    <a href="{{route('all_user_categories')}}">
                        <i class="fa fa-tachometer"></i>
                        <span class="link-title menu_hide">&nbsp;Roles Categories
                        </span>
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
            <!-- /#menu -->
        </div>
    </div>
    <!-- /#left -->


    <!-- Modal -->
    <div class="modal fade" id="search_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <form>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="float-right" aria-hidden="true">&times;</span>
                    </button>
                    <div class="input-group search_bar_small">
                        <input type="text" class="form-control" placeholder="Search..." name="search">
                        <span class="input-group-btn">
        <button class="btn btn-secondary" type="submit"><i class="fa fa-search"></i></button>
      </span>
                    </div>
                </div>
            </div>
        </form>
    </div>
