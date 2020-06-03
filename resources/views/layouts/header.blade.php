<div class="row">
    <div class="col-sm-8">
        <div class="headbar-blade">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                @if(!auth()->guest())
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                @endif
                <div class="collapse navbar-collapse navLinks" id="navbarSupportedContent">
                    @if(!auth()->guest())
                        <ul class="navbar-nav mr-auto items">
                            <li class="nav-item ">
                                <a class="nav-link links2" href="{{route('dashboard')}}/#/videos">Videos  <div class="borderBottom"> </div></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link links2" href="{{route('dashboard')}}/#/playlist">Playlist  <div class="borderBottom"> </div></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link links2" href="{{route('dashboard')}}/#/customize_player">Customization  <div class="borderBottom"> </div></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link links2" href="{{route('dashboard')}}/#/analytics">Analytics  <div class="borderBottom"> </div></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link links2" href="#">Upgrade/Downgrade <div class="borderBottom"> </div></a>
                            </li>
                        </ul>
                    @endif


                    <ul class="navbar-nav ml-auto"> 
                        <li>
                            <span class="d-flex justify-content-around align-items-start  header-child3">
                                @if(!auth()->guest())
                                    <span>
                                        <a href="#" class="notification">
                                            <i class="fa fa-bell"> </i>

                                            <span class="badge"> 3 </span>
                                        </a>
                                    </span>
                                    <span>
                                        <i class="fa fa-search"> </i>
                                    </span>
                                @endif
                                <div class="dropdown nav-item dropdown">
                                    <button class="btn dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                        @if(auth()->user())
                                            <div class="image2"></div>
                                        @else
                                            <h1 class="fa fa-user"></h1>
                                        @endif
                                    </button>
                                    <span class="dropdowncontainer ">
                                        <div class="dowpdown-box">
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                @if(auth()->user())
                                                    <a class="dropdown-item" href="{{route('dashboard')}}/#/profile"><i class="fa fa-user icons"></i></a>
                                                    <a class="dropdown-item" href="{{route('dashboard')}}/#/upload-video"><i
                                                            class="fa fa-cloud-upload icons"></i></a>
                                                    <a class="dropdown-item" href="{{route('dashboard')}}/#/settings">
                                                        <i class="fa fa-cog icons"></i>
                                                    </a>
                                                    <a class="dropdown-item" ><i
                                                            class="fa fa-times-circle icons"></i></a>
                                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    <i class="fa fa-sign-out icons"></i>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                                        {{ csrf_field() }}
                                                    </form>
                                                    </a>
                                                @else
                                                    <br>
                                                    <a class="dropdown-item" href="{{route('login')}}"><i
                                                            class="fa fa-sign-in icons"></i></a>
                                                    <a class="dropdown-item" href="{{route('register')}}"><i
                                                            class="fa fa-plus-square icons"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                    </span>
                                </div>
                            </span>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>








