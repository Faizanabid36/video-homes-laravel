@extends('layouts.public.app')
@section('style')
    <style>
        /* Set the size of the div element that contains the map */
        #map {
            height: 400px; /* The height is 400 pixels */
            width: 100%; /* The width is the width of the web page */
        }
    </style>
@endsection
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 style="text-transform:uppercase">
                    {{$user->name}}
                </h2>
            </div>
        </div>
        <br/>
        <hr/>
        <div class="row">
            <div class=" col-sm-12 col-lg-2 my-3">
                <img

                    @if( !is_null($user->avatar) )
                    src= '{{asset($user->avatar) }}'
                    @else
                    src= 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTMgrxYAqZF6-kdFuLQesPwdAyonhn93LsxvKXax0vzbCCGd_wQ&usqp=CAU'
                    @endif

                    style="width:100% ; ">
                <div class="caption-container">
                    <p id="caption">Profile Image</p>
                </div>
                <hr/>
                <img

                    @if( !is_null($user->company_logo) )
                    src= '{{ $user->company_logo }}'
                    @else
                    src= 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTMgrxYAqZF6-kdFuLQesPwdAyonhn93LsxvKXax0vzbCCGd_wQ&usqp=CAU'
                    @endif

                    style="width:100% ; ">
                <div class="caption-container">
                    <p id="caption">Company Logo</p>
                </div>
            </div>
            <div class="col-md-{{count($related_videos) > 1 ? 7 : 10}} player-video" style="margin-top: 0 !important">
                <div class="video-player pt_video_player " id="pt_video_player">
                    <span class="mejs__offscreen">Video Player</span>
                    @if(!is_null($video))
                        <video id="my-video_html5"
                               style="width: 100%; height: 451.872px; position: relative;"
                               poster="{{asset("storage/$video->thumbnail")}}"
                               preload="none"
                        >
                            @if($video->{'8k'})
                                <source
                                    src="{{asset("storage/".str_replace('240p','4320p',$video->stream_path))}}"
                                    type="video/mp4"
                                    data-quality="4320p" title="4320p" label="4320p" res="4320">
                            @endif
                            @if($video->{'4K'})
                                <source
                                    src="{{asset("storage/".str_replace('240p','2160p',$video->stream_path))}}"
                                    type="video/mp4"
                                    data-quality="2160p" title="2160p" label="2160p" res="2160">
                            @endif
                            @if($video->{'1440p'})
                                <source
                                    src="{{asset("storage/".str_replace('240p','1440p',$video->stream_path))}}"
                                    type="video/mp4"
                                    data-quality="1440p" title="1440p" label="1440p" res="1440">
                            @endif
                            @if($video->{'1080p'})
                                <source
                                    src="{{asset("storage/".str_replace('240p','1080p',$video->stream_path))}}"
                                    type="video/mp4"
                                    data-quality="1080p" title="1080p" label="1080p" res="1080">
                            @endif
                            @if($video->{'720p'})
                                <source
                                    src="{{asset("storage/".str_replace('240p','720p',$video->stream_path))}}"
                                    type="video/mp4"
                                    data-quality="720p" title="720p" label="720p" res="720">
                            @endif
                            @if($video->{'480p'})
                                <source
                                    src="{{asset("storage/".str_replace('240p','480p',$video->stream_path))}}"
                                    type="video/mp4"
                                    data-quality="480p" title="480p" label="480p" res="480">
                            @endif

                            @if($video->{'360p'})
                                <source
                                    src="{{asset("storage/".str_replace('240p','360p',$video->stream_path))}}"
                                    type="video/mp4"
                                    data-quality="360p" title="360p" label="360p" res="360">
                            @endif
                            <source src="{{asset("storage/$video->stream_path")}}" type="video/mp4"
                                    data-quality="240p" title="240p" label="240p" res="240">
                            Your browser does not support HTML5 video.
                        </video>
                        {{--                                <div class="icons hidden">--}}
                        {{--                                    <span class="expend-player"><i class="fa fa-expand fa-fw"></i></span>--}}
                        {{--                                </div>--}}
                        <div class="video-options pt_mn_wtch_opts">
                            <button class="btn btn-primary btn-share" id="share-video">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                          d="M18,16.08C17.24,16.08 16.56,16.38 16.04,16.85L8.91,12.7C8.96,12.47 9,12.24 9,12C9,11.76 8.96,11.53 8.91,11.3L15.96,7.19C16.5,7.69 17.21,8 18,8A3,3 0 0,0 21,5A3,3 0 0,0 18,2A3,3 0 0,0 15,5C15,5.24 15.04,5.47 15.09,5.7L8.04,9.81C7.5,9.31 6.79,9 6,9A3,3 0 0,0 3,12A3,3 0 0,0 6,15C6.79,15 7.5,14.69 8.04,14.19L15.16,18.34C15.11,18.55 15.08,18.77 15.08,19C15.08,20.61 16.39,21.91 18,21.91C19.61,21.91 20.92,20.61 20.92,19A2.92,2.92 0 0,0 18,16.08Z"></path>
                                </svg>
                                Share
                            </button>
                            <button class="btn btn-warning btn-share" id="embed-video">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                          d="M14.6,16.6L19.2,12L14.6,7.4L16,6L22,12L16,18L14.6,16.6M9.4,16.6L4.8,12L9.4,7.4L8,6L2,12L8,18L9.4,16.6Z"></path>
                                </svg>
                                Embed
                            </button>
                            @if(!auth()->guest() && ($video->user_id==auth()->user()->id))
                                <a class="btn btn-share"
                                   href="{{route('dashboard')}}#/edit_video/{{request('v')}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                              d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z"></path>
                                    </svg>
                                    Edit video
                                </a>
                                <a href="{{route('dashboard')}}"
                                   class="btn-share">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                              d="M3,14L3.5,14.07L8.07,9.5C7.89,8.85 8.06,8.11 8.59,7.59C9.37,6.8 10.63,6.8 11.41,7.59C11.94,8.11 12.11,8.85 11.93,9.5L14.5,12.07L15,12C15.18,12 15.35,12 15.5,12.07L19.07,8.5C19,8.35 19,8.18 19,8A2,2 0 0,1 21,6A2,2 0 0,1 23,8A2,2 0 0,1 21,10C20.82,10 20.65,10 20.5,9.93L16.93,13.5C17,13.65 17,13.82 17,14A2,2 0 0,1 15,16A2,2 0 0,1 13,14L13.07,13.5L10.5,10.93C10.18,11 9.82,11 9.5,10.93L4.93,15.5L5,16A2,2 0 0,1 3,18A2,2 0 0,1 1,16A2,2 0 0,1 3,14Z"></path>
                                    </svg>
                                    Analytics
                                </a>
                            @endif
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{action('ReportQueryController@store')}}">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="exampleFormControlInput1">Contact Name</label>
                                                    <input name="name" type="text" required class="form-control" id="exampleFormControlInput1" placeholder="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlInput1">Contact Email</label>
                                                    <input name="email" type="email" required class="form-control" id="exampleFormControlInput1" placeholder="">
                                                </div>
                                                <input type="hidden" name="type" value="video">
                                                <input type="hidden" name="reported_on_video" value="{{$video->title}}">
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">Message Text</label>
                                                    <textarea name="message_body" required class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                </div>
                                                <button class="btn btn-primary">Report Video</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-primary btn-share btn-report pull-right" onclick=""
                                    data-rep="1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                          d="M14.4,6L14,4H5V21H7V14H12.6L13,16H20V6H14.4Z"></path>
                                </svg>
                                <span>Report</span></button>
                            <div class="embed-placement d-none">
                                <textarea name="embed" id="embed" cols="30" rows="3" class="form-control">&lt;iframe src="{{route('embed_video',$video->video_id)}}" frameborder="0" width="700" height="400" allowfullscreen&gt;&lt;/iframe&gt;</textarea>
                            </div>
                            <div class="share-video d-none">
                                <div class="row share-input">
                                    <div class="col-md-4">
                                        <input type="text" value="{{request()->fullUrl()}}"
                                               class="form-control input-md" readonly=""
                                               onclick="this.select();">
                                    </div>
                                </div>
                                <a href="#" onclick="copyToClipboard(this)" class="fa fa-link"
                                   link="{{request()->fullUrl()}}"></a>
                            </div>
                        </div>
                    @else
                        <div>
                            <h1 class="alert alert-info">No Video Uploaded By this User</h1>
                        </div>
                    @endif
                </div>
                <div class="clear"></div>
            </div>
            @if(count($related_videos)>0)
                <div class="col-md-3 no-padding-left pull-right desktop">
                    <div class="content video-list pt_shadow">
                        <div class="ads-placment"></div>
                        <div class="next-video">

                            <div class="next-text pull-left pt_mn_wtch_nxttxt">
                                <h4>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                              d="M16,18H18V6H16M6,18L14.5,12L6,6V18Z"></path>
                                    </svg>
                                    <x></x>
                                    Up Next
                                </h4>
                            </div>
                            <div class="pt_mn_wtch_switch pull-right">
                                {{--                                                <input id="autoplay" type="checkbox" class="tgl autoplay-video">--}}
                                {{--                                                <label class="tgl-btn" for="autoplay">Autoplay</label>--}}
                            </div>
                            <div class="clear"></div>

                            @foreach($related_videos as $related_video)
                                <div class="video-thumb">
                                    <a href="{{route('directory_by_user_video',[$user->username,$related_video->video_id])}}">
                                        <img width="200px" height="200px"
                                             src="{{asset('storage/'.$related_video->thumbnail)}}"
                                             alt="Products">
                                        <div class='play_hover_btn' onmouseenter="show_gif(this,'')"
                                             onmouseleave="hide_gif(this)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-play-circle">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <polygon points="10 8 16 12 10 16 10 8"></polygon>
                                            </svg>
                                        </div>
                                        <div>{{ucfirst($related_video->title)}}</div>
                                        <div class="video-duration">{{gmdate('i:s', $related_video->duration)}}</div>
                                    </a>
                                </div>
                            @endforeach
                            <div></div>
                        </div>
                    </div>
                </div>
            @endif
        </div>



        <!-- 3rd row -->

        <div class="row">
            <div class="col-12">
                <h4 class="font-weight-bold " style="color:gray"> CONTACT INFORMATION
                    <div class="borderBottomBold my-3"></div>
                </h4>

            </div>
            <div class="col-12 contactWidgets my-2 ">
                <div class="d-flex">
                    <div class="font-weight-bold "><i class='fas icon fa-phone'></i> Name</div>
                    <div> {{$user->name}}</div>
                </div>
                <div class="d-flex">
                    <div class="font-weight-bold "><i class='fas icon fa-phone'></i> Address</div>
                    <div> {{$user->address}}</div>
                </div>
                <div class="d-flex">
                    <div class="font-weight-bold "><i class='fas icon fa-phone'></i> Phone</div>
                    <div> {{$user->phone}}</div>
                </div>
                <hr/>
                <div class="d-flex">
                    <div class="font-weight-bold "><i class='fas icon fa-globe'></i> Website</div>
                    <div><a href="{{$user->website_link}}"> {{$user->website_title}} </a></div>
                </div>
                <hr/>
                <div class="d-flex">
                    <div class="font-weight-bold "><i class='fas icon fa-envelope'></i> Email</div>
                    <div><a href="mailto: {{$user->email}}"> {{$user->email}} </a></div>
                </div>
                <hr/>
            </div>

        </div>

        <div class="row">
            <div class="col-12 pr-0">

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    @if(isset($user->address))
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                               aria-controls="home" aria-selected="true">Map</a>
                        </li>
                    @endif
                    @if(isset($user->bio))
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                           aria-controls="profile" aria-selected="false">Bio</a>
                    </li>
                    @endif
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab"
                           aria-controls="reviews" aria-selected="false">Reviews</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                           aria-controls="contact" aria-selected="false">Contact</a>
                    </li>
                    <li class="nav-item" role="Report">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#report" role="tab"
                           aria-controls="report" aria-selected="false">Report</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    @if(isset($user->address))
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                            <div id="map">
                            </div>
                            <br/>

{{--                            <h4 class="my-3"> Get directions from: </h4>--}}
{{--                            <div class="input-group mb-3">--}}
{{--                                <input type="text" class="form-control" placeholder="Enter address or zip code"--}}
{{--                                       aria-label="Recipient's username" aria-describedby="button-addon2">--}}
{{--                                <div class="input-group-append">--}}
{{--                                    <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i--}}
{{--                                            style="color:gray ; font-size:14px" class='fas icon fa-map-marker'></i>--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <p><a href=""> <i style="color:lightBlue ; font-size:14px" class='fas icon fa-circle'></i>{{$user->address}}</a></p>
{{--                            <button class="btn btn-primary"> GET DIRECTION</button>--}}
                        </div>
                    @endif
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <h1 class="my-3 font-weight-bold">{{$user->bio}}</h1>
                    </div>
                    <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                        <button class="btn btn-primary my-3"> Add Review</button>
                        <div class="row">
                            <div class="col-4 rating-star-field">
                                <div class="d-flex align-items-center my-2">
                                    <span> 5 Stars  </span>
                                    <span>
        <div class="progress custom-progress">
            <div class="progress-bar custom-progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0"
                 aria-valuemax="100"></div>
            </div>
        </span>
                                    <span> -0 0%   </span>
                                </div>

                                <div class="d-flex align-items-center my-2">
                                    <span> 4 Stars  </span>
                                    <span>
        <div class="progress custom-progress">
            <div class="progress-bar custom-progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0"
                 aria-valuemax="100"></div>
            </div>
        </span>
                                    <span> -0 0%   </span>
                                </div>


                                <div class="d-flex align-items-center my-2">
                                    <span> 3 Stars  </span>
                                    <span>
        <div class="progress custom-progress">
            <div class="progress-bar custom-progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0"
                 aria-valuemax="100"></div>
            </div>
        </span>
                                    <span> -0 0%   </span>
                                </div>

                                <div class="d-flex align-items-center my-2">
                                    <span> 2 Stars  </span>
                                    <span>
        <div class="progress custom-progress">
            <div class="progress-bar custom-progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0"
                 aria-valuemax="100"></div>
            </div>
        </span>
                                    <span> -0 0%   </span>
                                </div>
                            </div>
                            <div class="col-8">
                                <div id="circleProgress1" class="progressbar-js-circle  rounded p-3">
                                    <svg viewBox="0 0 100 100" style="display: block; width: 100%;">
                                        <path d="M 50,50 m 0,-48 a 48,48 0 1 1 0,96 a 48,48 0 1 1 0,-96" stroke="#eee"
                                              stroke-width="4" fill-opacity="0"></path>
                                        <path d="M 50,50 m 0,-48 a 48,48 0 1 1 0,96 a 48,48 0 1 1 0,-96"
                                              stroke="rgb(159,162,179)" stroke-width="4" fill-opacity="0"
                                              style="stroke-dasharray: 301.635, 301.635; stroke-dashoffset: 199.079;"></path>
                                    </svg>
                                    <div class="progressbar-text"
                                         style="position: absolute; left: 11%; top: 38%; padding: 0px; margin: 0px; transform: translate(-50%, -50%); color: lightblue; font-size: 2rem;">
                                        34
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- reviews end -->
                    <!-- Contact -->
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <h1 class="my-3 font-weight-bold"> Send message to listing owner </h1>
                        <form>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Contact Name</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Contact Email</label>
                                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="">
                            </div>


                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Example textarea</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                            <button class="btn btn-primary"> Send Message</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="report" role="tabpanel" aria-labelledby="report-tab">
                        <!-- .report. -->

                        <h1 class="my-3 font-weight-bold"> Send message to moderator </h1>
                        <form method="POST" action="{{action('ReportQueryController@store')}}">
                            @csrf
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Contact Name</label>
                                <input name="name" type="text" required class="form-control" id="exampleFormControlInput1" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Contact Email</label>
                                <input name="email" type="email" required class="form-control" id="exampleFormControlInput1" placeholder="">
                            </div>
                            <input type="hidden" name="type" value="message">
                            <input type="hidden" name="reported_on_user" value="{{$user->username}}">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Message Text</label>
                                <textarea name="message_body" required class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                            <button class="btn btn-primary"> Send Message</button>
                        </form>


                    </div>
                </div>

            </div>


        </div>


    </div>  <!--parentContainer -->



@endsection;
@section('script')
{{--    <script>--}}
{{--        var slideIndex = 1;--}}
{{--        showSlides(slideIndex);--}}

{{--        function plusSlides(n) {--}}
{{--            showSlides(slideIndex += n);--}}
{{--        }--}}

{{--        function currentSlide(n) {--}}
{{--            showSlides(slideIndex = n);--}}
{{--        }--}}

{{--        function showSlides(n) {--}}
{{--            var i;--}}
{{--            var slides = document.getElementsByClassName("mySlides");--}}
{{--            var dots = document.getElementsByClassName("demo");--}}
{{--            var captionText = document.getElementById("caption");--}}
{{--            if (n > slides.length) {--}}
{{--                slideIndex = 1--}}
{{--            }--}}
{{--            if (n < 1) {--}}
{{--                slideIndex = slides.length--}}
{{--            }--}}
{{--            for (i = 0; i < slides.length; i++) {--}}
{{--                slides[i].style.display = "none";--}}
{{--            }--}}
{{--            for (i = 0; i < dots.length; i++) {--}}
{{--                dots[i].className = dots[i].className.replace(" active", "");--}}
{{--            }--}}
{{--            slides[slideIndex - 1].style.display = "block";--}}
{{--            // dots[slideIndex - 1].className += " active";--}}
{{--            // captionText.innerHTML = dots[slideIndex - 1].alt;--}}
{{--        }--}}
{{--    </script>--}}
{{--    <script>--}}
{{--    var slideIndex = 1;--}}
{{--    showSlides(slideIndex);--}}

{{--    function plusSlides(n) {--}}
{{--        showSlides(slideIndex += n);--}}
{{--    }--}}

{{--    function currentSlide(n) {--}}
{{--        showSlides(slideIndex = n);--}}
{{--    }--}}

{{--    function showSlides(n) {--}}
{{--        var i;--}}
{{--        var slides = document.getElementsByClassName("mySlides");--}}
{{--        var dots = document.getElementsByClassName("demo");--}}
{{--        var captionText = document.getElementById("caption");--}}
{{--        if (n > slides.length) {--}}
{{--            slideIndex = 1--}}
{{--        }--}}
{{--        if (n < 1) {--}}
{{--            slideIndex = slides.length--}}
{{--        }--}}
{{--        for (i = 0; i < slides.length; i++) {--}}
{{--            slides[i].style.display = "none";--}}
{{--        }--}}
{{--        for (i = 0; i < dots.length; i++) {--}}
{{--            dots[i].className = dots[i].className.replace(" active", "");--}}
{{--        }--}}
{{--        slides[slideIndex - 1].style.display = "block";--}}
{{--        // dots[slideIndex - 1].className += " active";--}}
{{--        // captionText.innerHTML = dots[slideIndex - 1].alt;--}}
{{--    }--}}
{{--</script>--}}
{{--    <script type="text/javascript">--}}
{{--        function setCookie(cname, cvalue, exdays) {--}}
{{--            var d = new Date();--}}
{{--            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));--}}
{{--            var expires = "expires=" + d.toUTCString();--}}
{{--            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";--}}
{{--        }--}}

{{--        var myTimeout;--}}

{{--        function show_gif(self, gif) {--}}
{{--            if (gif && gif != '') {--}}
{{--                myTimeout = setTimeout(function () {--}}
{{--                    $(self).append('<img src="' + gif + '">');--}}
{{--                }, 1000);--}}
{{--            }--}}
{{--        }--}}

{{--        function hide_gif(self) {--}}
{{--            $(self).find('img').remove();--}}
{{--            clearTimeout(myTimeout);--}}
{{--        }--}}

{{--        function PT_OpenStripe(pkg, self, video_id = 0, price = 0, user_id = 0) {--}}

{{--            $('#pay-go-pro').modal('hide');--}}
{{--            $('#stripe_modal').modal('show');--}}
{{--            stripe_array['video_id'] = video_id;--}}
{{--            stripe_array['user_id'] = user_id;--}}
{{--            if (pkg == 'rent') {--}}
{{--                stripe_array['pay_type'] = 'rent';--}}
{{--            } else {--}}
{{--                stripe_array['pay_type'] = '';--}}
{{--            }--}}
{{--        }--}}


{{--        var sources = [];--}}
{{--        for (var i = 0; i < $('video').find('source').length; i++) {--}}
{{--            sources[i] = parseFloat($($('video').find('source')[i]).attr('res'));--}}
{{--        }--}}

{{--        var imageAddr = "http://www.kenrockwell.com/contax/images/g2/examples/31120037-5mb.jpg";--}}
{{--        var downloadSize = 4995374;--}}
{{--        // var imageAddr = site_url + "/upload/photos/speed.jpg";--}}
{{--        // var downloadSize = 1082828;--}}

{{--        function getCookie(name) {--}}
{{--            var value = "; " + document.cookie;--}}
{{--            var parts = value.split("; " + name + "=");--}}
{{--            if (parts.length == 2) return parts.pop().split(";").shift();--}}
{{--        }--}}

{{--        function getQuality() {--}}
{{--            MeasureConnectionSpeed();--}}


{{--            function MeasureConnectionSpeed() {--}}
{{--                if (getCookie('internet_speed') > 0) {--}}
{{--                    showResults(getCookie('internet_speed'));--}}
{{--                } else {--}}
{{--                    var startTime, endTime;--}}
{{--                    var download = new Image();--}}
{{--                    download.onload = function () {--}}
{{--                        endTime = (new Date()).getTime();--}}
{{--                        showResults();--}}
{{--                    }--}}

{{--                    download.onerror = function (err, msg) {--}}
{{--                        ShowProgressMessage(0);--}}
{{--                    }--}}

{{--                    startTime = (new Date()).getTime();--}}
{{--                    var cacheBuster = "?nnn=" + startTime;--}}
{{--                    download.src = imageAddr + cacheBuster;--}}
{{--                }--}}

{{--                //console.log($.cookie("internet_speed"));--}}


{{--                function showResults(speed = 0) {--}}
{{--                    if (speed == 0) {--}}
{{--                        var duration = (endTime - startTime) / 1000;--}}
{{--                        var bitsLoaded = downloadSize * 8;--}}
{{--                        var speedBps = (bitsLoaded / duration).toFixed(2);--}}
{{--                        var speedKbps = (speedBps / 1024).toFixed(2);--}}
{{--                        var speedMbps = (speedKbps / 1024).toFixed(2);--}}
{{--                        setCookie("internet_speed", speedKbps, 1);--}}

{{--                    } else {--}}
{{--                        speedKbps = speed;--}}
{{--                        if (speed < 240) {--}}
{{--                            speedKbps = 250;--}}
{{--                        }--}}
{{--                    }--}}
{{--                    for (var i = 0; i < sources.length; i++) {--}}
{{--                        if (sources[i] < parseFloat(speedKbps)) {--}}
{{--                            is_clicked = true;--}}
{{--                            video_source = sources[i];--}}
{{--                            $('#' + $('.mejs__container').attr('id') + '-qualities-' + video_source + 'p').click();--}}
{{--                            $('.mejs__qualities-button').find('button').text('auto');--}}
{{--                            $('.mejs__qualities-selector-label').removeClass('mejs__qualities-selected');--}}
{{--                            $('#quality__auto').addClass('mejs__qualities-selected');--}}
{{--                            break;--}}
{{--                        }--}}
{{--                    }--}}
{{--                }--}}
{{--            }--}}
{{--        }--}}

{{--        function setAuto(self) {--}}
{{--            $('.mejs__qualities-button').find('button').text('auto');--}}
{{--            $('.mejs__qualities-selector-label').removeClass('mejs__qualities-selected');--}}
{{--            $('#quality__auto').addClass('mejs__qualities-selected');--}}
{{--            getQuality();--}}
{{--            setTimeout(function (argument) {--}}
{{--                setCookie('auto', 'auto', 1);--}}
{{--            }, 1000);--}}

{{--        }--}}

{{--        $(document).ready(function () {--}}
{{--            document.querySelector('video').addEventListener("loadeddata", function () {--}}
{{--                setCookie('auto', '', 1);--}}
{{--            });--}}
{{--        });--}}

{{--    </script>--}}

{{--    <script type="text/javascript">--}}
{{--        function go_to_duration(duration) {--}}
{{--            window.scrollTo(0, 0);--}}
{{--            var vid = document.querySelector("video");--}}
{{--            vid.currentTime = duration;--}}
{{--            vid.play();--}}
{{--        }--}}
{{--    </script>--}}
{{--    <script type="text/javascript">--}}


{{--        $('video').mediaelementplayer({--}}
{{--            pluginPath: 'https://cdnjs.com/libraries/mediaelement-plugins/',--}}
{{--            shimScriptAccess: 'always',--}}
{{--            autoplay: true,--}}
{{--            features: ['playpause', 'current', 'progress', 'duration', 'speed', 'skipback', 'jumpforward', 'tracks', 'markers', 'volume', 'chromecast', 'contextmenu', 'flash', 'fullscreen', 'sourcechooser'],--}}
{{--            vastAdTagUrl: '',--}}
{{--            vastAdsType: '',--}}
{{--            setDimensions: true,--}}
{{--            enableAutosize: true,--}}
{{--            jumpForwardInterval: 20,--}}
{{--            adsPrerollMediaUrl: [''],--}}
{{--            adsPrerollAdUrl: [''],--}}
{{--            adsPrerollAdEnableSkip: false,--}}
{{--            adsPrerollAdSkipSeconds: 0,--}}
{{--            success: function (media) {--}}
{{--                media.addEventListener('ended', function (e) {--}}

{{--                    if ($('#autoplay').is(":checked")) {--}}
{{--                        var url = $('#next-video').find('.video-title').find('a').attr('href');--}}
{{--                        if (url) {--}}
{{--                            window.location.href = url;--}}
{{--                        }--}}
{{--                    } else {--}}
{{--                        /* pass */--}}
{{--                    }--}}
{{--                }, false);--}}

{{--                media.addEventListener('playing', function (e) {--}}
{{--                    // if (pt_elexists('.ads-overlay-info')) {--}}
{{--                    //     $('.ads-overlay-info').remove();--}}
{{--                    // }--}}

{{--                    $('.ads-test').remove();--}}

{{--                    if ($('body').attr('resized') == 'true') {--}}
{{--                        PT_Resize(true);--}}
{{--                    }--}}
{{--                    $('.mejs__container').css('height', ($('.mejs__container').width() / 1.77176216) + 'px');--}}
{{--                    $('video, iframe').css('height', '100%');--}}
{{--                });--}}
{{--            },--}}
{{--        });--}}


{{--        if (sources.length > 1) {--}}
{{--            setTimeout(function () {--}}
{{--                $('.mejs__qualities-selector-list').append('<li class="mejs__qualities-selector-list-item" onclick="setAuto(this)"><input class="mejs__qualities-selector-input" type="radio" name="mep_0_qualities" value="auto" id="mep_0-qualities-auto"><label for="mep_0-qualities-auto" class="mejs__qualities-selector-label" id="quality__auto">auto</label></li>');--}}
{{--            }, 1000);--}}
{{--        }--}}


{{--    </script>--}}

{{--    <script>--}}

{{--        jQuery(window).ready(function ($) {--}}
{{--            var width = $('.video-player').width().toString();--}}
{{--            var width = width.substring(0, width.lastIndexOf("."))--}}
{{--            $('.fb-video').attr('data-width', width);--}}
{{--            //$( 'iframe' ).attr( 'src', function ( i, val ) { return val; });--}}
{{--            $("#load-related-videos").click(function (event) {--}}
{{--                let id = 0;--}}
{{--                if ($("div[data-sidebar-video]").length > 0) {--}}
{{--                    id = $("div[data-sidebar-video]").last().attr('data-sidebar-video');--}}
{{--                }--}}

{{--                $("#load-related-videos").find('i.spin').removeClass('hidden');--}}

{{--            });--}}
{{--        });--}}

{{--        $('.ad-link').on('click', function (event) {--}}
{{--            $('.ad-link').remove();--}}
{{--            $('video')[0].play();--}}
{{--        });--}}

{{--        $('.autoplay-video').on('change', function (event) {--}}
{{--            event.preventDefault();--}}
{{--            checked = 1;--}}
{{--            if ($(this).is(":checked")) {--}}
{{--                checked = 2;--}}
{{--            }--}}
{{--            $.post('http://localhost:9002//aj/set-cookies', {name: 'autoplay', value: checked});--}}
{{--        });--}}
{{--        $('.ads-test').on('click', function (event) {--}}
{{--            $(this).remove();--}}
{{--        });--}}


{{--        $(function () {--}}
{{--            $('.rad-transaction').click(function (event) {--}}
{{--                $(this).off("click").removeClass('rad-transaction');--}}
{{--                $.get('http://localhost:9002//aj/ads/rad-transaction', function (data) { /* pass */--}}
{{--                });--}}
{{--            });--}}

{{--            if ($('[data-litsitem-id]').length > 4) {--}}
{{--                var listItemtopPos = $("div[data-litsitem-id=MVVIbINPjrRSP69]").offset();--}}
{{--                $('.play-list-cont').scrollTop((listItemtopPos.top - 170));--}}
{{--            }--}}


{{--            $('#share-video').on('click', function (event) {--}}
{{--                event.preventDefault();--}}
{{--                $('.share-video').toggleClass('hidden');--}}
{{--                if (!$('.embed-placement').hasClass('hidden')) {--}}
{{--                    $('.embed-placement').toggleClass('hidden');--}}
{{--                }--}}
{{--                if (!$('.download-placement').hasClass('hidden')) {--}}
{{--                    $('.download-placement').toggleClass('hidden');--}}
{{--                }--}}
{{--            });--}}
{{--            $('#embed-video').on('click', function (event) {--}}
{{--                event.preventDefault();--}}
{{--                $('.embed-placement').toggleClass('hidden');--}}
{{--                if (!$('.share-video').hasClass('hidden')) {--}}
{{--                    $('.share-video').toggleClass('hidden');--}}
{{--                }--}}
{{--                if (!$('.download-placement').hasClass('hidden')) {--}}
{{--                    $('.download-placement').toggleClass('hidden');--}}
{{--                }--}}
{{--            });--}}
{{--            $('#download-video').on('click', function (event) {--}}
{{--                event.preventDefault();--}}
{{--                $('.download-placement').toggleClass('hidden');--}}
{{--                if (!$('.embed-placement').hasClass('hidden')) {--}}
{{--                    $('.embed-placement').toggleClass('hidden');--}}
{{--                }--}}
{{--                if (!$('.share-video').hasClass('hidden')) {--}}
{{--                    $('.share-video').toggleClass('hidden');--}}
{{--                }--}}
{{--            });--}}

{{--            $('#save-button').on('click', function (event) {--}}
{{--                event.preventDefault();--}}
{{--                var logged = $('#main-container').attr('data-logged');--}}
{{--                if (!logged) {--}}
{{--                    window.location.href = "http://localhost:9002//login?to=http://localhost:9002%2F%2Fpage_loading.php%3Flink1%3Dwatch%26id%3D14-march-2020-loom-recording_MVVIbINPjrRSP69.html%26hash%3D5eb422b39a69f7fec5c053501c62460114fa6e16%26_%3D1587557139927";--}}
{{--                    return false;--}}
{{--                }--}}
{{--                var video_id = $('#video-id').val();--}}
{{--                if ($(this).attr('saved')) {--}}
{{--                    $(this).html('<i class="fa fa-floppy-o fa-fw"></i> Save');--}}
{{--                    $(this).removeAttr('saved');--}}
{{--                } else {--}}
{{--                    $(this).html('<i class="fa fa-check fa-fw"></i> Saved');--}}
{{--                    $(this).attr('saved', 'true');--}}
{{--                }--}}
{{--                $.post('http://localhost:9002//aj/save-video', {video_id: video_id});--}}
{{--            });--}}
{{--            $('.desc').on('click', function (event) {--}}
{{--                event.preventDefault();--}}
{{--                if ($(this).hasClass('expended')) {--}}
{{--                    $('.watch-video-description').css({--}}
{{--                        'max-height': '100px',--}}
{{--                        'height': '100px',--}}
{{--                        'overflow': 'hidden'--}}
{{--                    });--}}
{{--                    $(this).removeClass('expended');--}}
{{--                    $(this).text("Show more");--}}
{{--                } else {--}}
{{--                    $('.watch-video-description').css({--}}
{{--                        'max-height': '4000px',--}}
{{--                        'height': 'auto',--}}
{{--                        'overflow': 'auto'--}}
{{--                    });--}}
{{--                    $(this).addClass('expended');--}}
{{--                    $(this).text("Show less");--}}
{{--                }--}}
{{--            });--}}


{{--            $('.expend-player').on('click', function (event) {--}}
{{--                event.preventDefault();--}}
{{--                var resize = 0;--}}
{{--                if ($('.player-video').hasClass('col-md-12')) {--}}
{{--                    resize = 0;--}}
{{--                } else {--}}
{{--                    resize = 1;--}}
{{--                }--}}
{{--                $.post('http://localhost:9002//aj/set-cookies', {name: 'resize', value: resize});--}}
{{--                PT_Resize();--}}
{{--            });--}}
{{--            $(window).resize(function (event) {--}}
{{--                if ($('body').attr('resized') == 'true') {--}}
{{--                    PT_Resize(true);--}}
{{--                }--}}
{{--            });--}}

{{--        });--}}


{{--        if (document.addEventListener) {--}}
{{--            document.addEventListener('webkitfullscreenchange', exitHandler, false);--}}
{{--            document.addEventListener('mozfullscreenchange', exitHandler, false);--}}
{{--            document.addEventListener('fullscreenchange', exitHandler, false);--}}
{{--            document.addEventListener('MSFullscreenChange', exitHandler, false);--}}
{{--        }--}}

{{--        function exitHandler() {--}}
{{--            if (document.webkitIsFullScreen || document.mozFullScreen || document.msFullscreenElement !== null) {--}}
{{--                setTimeout(function () {--}}
{{--                    PT_Resize(false);--}}
{{--                }, 100);--}}
{{--            }--}}
{{--        }--}}

{{--        function PT_Resize(type) {--}}

{{--            if ($('.player-video').hasClass('col-md-12') && type != true) {--}}
{{--                $('.mejs__layer').css('display', 'none');--}}
{{--                $('.player-video').addClass('col-md-8');--}}
{{--                $('.player-video').removeClass('col-md-12');--}}
{{--                $('.player-video').css('margin-bottom', '0');--}}
{{--                $('.player-video').css('margin-top', '0');--}}
{{--                $('.mejs__container, video, iframe').css('width', '100%');--}}
{{--                $('.mejs__container').css('height', ($('.mejs__container').width() / 1.77176216) + 'px');--}}
{{--                $('video, iframe').css('height', '100%');--}}
{{--                $('.second-header-layout').removeClass('hidden');--}}
{{--                $('.header-layout').css('background', '#fff');--}}
{{--                $('.header-layout').css('border-bottom', '1px solid #f1f1f1');--}}
{{--                $('#search-bar').css('border', '1px solid #f5f5f5');--}}
{{--                $('#search-bar').css('color', '#444');--}}
{{--                $('nav.navbar-findcond ul.navbar-nav.sec_lay_hdr a').css('color', '#3e3e3e');--}}
{{--                $('.hide-resize').removeClass('hidden');--}}
{{--                $('.logo-img').find('img').attr('src', 'http://localhost:9002//themes/default/img/logo.png');--}}
{{--                $('.top-header a').css('color', '#444');--}}
{{--                $('#background').addClass('hidden');--}}
{{--                $('body').attr('resized', 'false');--}}
{{--                $('body').css('padding-top', '0px');--}}
{{--            } else {--}}
{{--                var pixels = ($(window).height() / 100) * 88;--}}
{{--                $('.player-video').removeClass('col-md-8');--}}
{{--                $('.player-video').addClass('col-md-12');--}}
{{--                $('.second-header-layout').addClass('hidden');--}}
{{--                $('.player-video').css('margin-bottom', '10px');--}}
{{--                $('.player-video').css('margin-top', '0px');--}}
{{--                $('body').css('padding-top', '57px !important');--}}
{{--                $('.mejs__container, video, iframe').css('width', '100%');--}}
{{--                $('.mejs__container').css('height', pixels + 'px');--}}
{{--                $('video, iframe').css('height', '100%');--}}
{{--                $('.header-layout').css('background', 'rgb(32,32,32)');--}}
{{--                $('.header-layout').css('border-bottom', 'none');--}}
{{--                $('#search-bar').css('border', '1px solid #555');--}}
{{--                $('#search-bar').css('color', '#fff');--}}
{{--                $('nav.navbar-findcond ul.navbar-nav.sec_lay_hdr a').css('color', '#fff');--}}
{{--                $('.hide-resize').addClass('hidden');--}}
{{--                $('.logo-img').find('img').attr('src', 'http://localhost:9002//themes/default/img/logo-light.png');--}}
{{--                $('.top-header a').css('color', '#fff');--}}
{{--                $('#background').removeClass('hidden');--}}
{{--                $('#background').css('height', '89.4%');--}}
{{--                $('body').attr('resized', 'true');--}}
{{--            }--}}
{{--        }--}}

{{--        $('.player-video').hover(function () {--}}
{{--            $('.icons').removeClass('hidden');--}}
{{--        });--}}
{{--        $('.player-video').mouseleave(function () {--}}
{{--            $('.icons').addClass('hidden');--}}
{{--        });--}}

{{--    </script>--}}
{{--    --}}
<script type="text/javascript">
    $('#share-video').on('click', function (event) {
        event.preventDefault();

        $('.embed-placement').addClass('d-none');
        $('.share-video').toggleClass('d-none');
    });
    $('#embed-video').on('click', function (event) {
        event.preventDefault();
        $('.embed-placement').toggleClass('d-none');
        $('.share-video').addClass('d-none');
    });

    $('video').mediaelementplayer({
        pluginPath: 'https://cdnjs.com/libraries/mediaelement-plugins/',
        shimScriptAccess: 'always',
        autoplay: true,
        features: ['playpause', 'current', 'progress', 'duration', 'speed', 'skipback', 'jumpforward', 'tracks', 'markers', 'volume', 'chromecast', 'contextmenu', 'flash', 'fullscreen', 'sourcechooser'],
        vastAdTagUrl: '',
        vastAdsType: '',
        setDimensions: true,
        enableAutosize: true,
        jumpForwardInterval: 20,
        adsPrerollMediaUrl: [''],
        adsPrerollAdUrl: [''],
        adsPrerollAdEnableSkip: false,
        adsPrerollAdSkipSeconds: 0,
        success: function (media) {
            media.addEventListener('ended', function (e) {

                if ($('#autoplay').is(":checked")) {
                    var url = $('#next-video').find('.video-title').find('a').attr('href');
                    if (url) {
                        window.location.href = url;
                    }
                } else {
                    /* pass */
                }
            }, false);

            media.addEventListener('playing', function (e) {
                // if (pt_elexists('.ads-overlay-info')) {
                //     $('.ads-overlay-info').remove();
                // }

                $('.ads-test').remove();

                if ($('body').attr('resized') == 'true') {
                    PT_Resize(true);
                }
                $('.mejs__container').css('height', ($('.mejs__container').width() / 1.77176216) + 'px');
                $('video, iframe').css('height', '100%');
            });
        },
    });


</script>
    <script>
        function initMap() {
            @if(!is_null($user->user_extra->location_latitude)||!is_null($user->user_extra->location_longitude))
            var uluru = {
                    lat: {{$user->user_extra->location_latitude}},
                    lng: {{$user->user_extra->location_longitude}}
                };
                @endif
            var map = new google.maps.Map(
                document.getElementById('map'), {zoom: 11, center: uluru});


            @if(!is_null($user->user_extra->location_latitude)||!is_null($user->user_extra->location_longitude))
            var uluru = {
                    lat: {{$user->user_extra->location_latitude}},
                    lng: {{$user->user_extra->location_longitude}}
                };
            new google.maps.Marker({position: uluru, map: map});
            @endif
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAm4Wvmd2nIeaFQCdhAsxbiSXgBsibDolc&callback=initMap">
    </script>
@endsection
