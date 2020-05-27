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
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    @if(!auth()->guest())
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item ">
                                <a class="nav-link" href="{{route('dashboard')}}/#/videos"><h4 class="links2"> Videos </h4></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><h4 class="links2"> Playlist </h4></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><h4 class="links2"> Customization </h4></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><h4 class="links2"> Analytic </h4></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><h4 class="links2"> Downgrade/Upgrade </h4></a>
                            </li>
                        </ul>
                    @endif


                    <div class=" d-flex w-25   justify-content-around align-items-center">
                        @if(!auth()->guest())
                            <div>
                                <a href="#" class="notification">

                                    <i class="fa fa-bell"> </i>

                                    <span class="badge"> 3 </span>
                                </a>
                            </div>
                            <div>
                                <i class="fa fa-search"> </i>
                            </div>
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
                                            <a class="dropdown-item" href="{{route('dashboard')}}/#/upload-video"><i
                                                    class="fa fa-cloud-upload icons"></i></a>
                                            <a class="dropdown-item" href="#"><i class="fa fa-wifi icons"></i></a>
                                            <a class="dropdown-item" href="#"><i class="fa fa-cloud icons"></i></a>
                                            <a class="dropdown-item" href="#"><i
                                                    class="fa fa-times-circle icons"></i></a>
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
                    </div>
                </div>
            </nav>
        </div>
    </div>








