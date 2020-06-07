
        <div class=" col-7 col-lg-8 ">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
               
                <div class="collapse navbar-collapse navLinks" id="navbarSupportedContent">
                    
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
                   


                        
                     
                </div>
            </nav>
        </div>

        <span class="col-5 col-lg-4 my-3   ">
               <a href="{{route('dashboard')}}/#/upload-video" class="links  "> <i class="fa fa-cloud-upload btn btn-primary" color="black">Upload Video  </i>  </a>
                 
               <span class="dropdown nav-item dropdown-Custom  ">
                                   <button class="btn dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown"
                                         aria-haspopup="true" aria-expanded="false">
                                    <div class="image2"></div>
                                      
                                   </button>
                                   <span class="dropdowncontainer ">
                                       <div class="dowpdown-box">
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                              
                                                   <a class="dropdown-item" href="{{route('dashboard')}}/#/profile"><i class="fa fa-user icons"></i></a>
                                                   <a class="dropdown-item" href="{{route('dashboard')}}/#/upload-video"><i
                                                           class="fa fa-cloud-upload icons ">  </i></a>
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
                                             </div>
                                       </div>
                                   </span>
                </span>
        </span>




   <!-- <a href="#" class="notification d-none">
                   <i class="fa fa-bell"> </i>

                                           <span class="badge"> 3 </span>
                                       </a>
                                   
                                  
                                       <i class="fa fa-search d-none"> </i> -->


     <!-- <br>
                                                   <a class="dropdown-item" href="{{route('login')}}"><i
                                                           class="fa fa-sign-in icons"></i></a>
                                                   <a class="dropdown-item" href="{{route('register')}}"><i
                                                           class="fa fa-plus-square icons"></i></a> -->