<div class="wrapper">
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
                    <a href="{{route('videos_for_approval')}}">
                        <i class="fa fa-tachometer"></i>
                        <span class="link-title menu_hide">&nbsp;Videos For Apporval

                            </span>
                    </a>
                </li>

                <li class="">
                    <a href="{{route('category')}}">
                        <i class="fa fa-tachometer"></i>
                        <span class="link-title menu_hide">&nbsp;Categories

                        </span>
                    </a>
                </li>

                <li class="">
                    <a href="{{route('user_tags')}}">
                        <i class="fa fa-tachometer"></i>
                        <span class="link-title menu_hide">&nbsp;User Tags
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


</div>
