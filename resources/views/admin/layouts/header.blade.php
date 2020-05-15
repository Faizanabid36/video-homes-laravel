<div id="top">
    <!-- .navbar -->
    <nav class="navbar navbar-static-top">
        <div class="container-fluid m-0">
            <a class="navbar-brand float-left" href="index.html">
                <h4> Video Homes</h4>
            </a>
            <div class="topnav dropdown-menu-right float-right">
                <div class="btn-group">
                    <div class="user-settings no-bg">
                        <button type="button" class="btn btn-default no-bg micheal_btn"
                                data-toggle="dropdown">
                            <img src="  {{asset  ('img/admin.jpg')}}"
                                 class="admin_img2 img-thumbnail rounded-circle avatar-img"
                                 alt="avatar"> <strong>{{ Auth::user()->name }} </strong>
                            <span class="fa fa-sort-down white_bg"></span>
                        </button>
                        <div class="dropdown-menu admire_admin">
                            <a class="dropdown-item title" href="#">
                                Admire Admin</a>
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
        </div>
    </nav>
</div>
