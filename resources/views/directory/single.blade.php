@extends('layouts.public.app',["title"=>$video->title])
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 style="text-transform:uppercase">{{$user->name}}</h2>
                @if(!$video->is_video_approved)
                    <div class="alert alert-warning">This page is not public yet, because your video is pending mode, it
                        needs admin approval.
                    </div>
                @endif
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-2 my-3">
                <img
                    class="w-100"
                    src='{{$user->user_extra->profile_picture ?? 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTMgrxYAqZF6-kdFuLQesPwdAyonhn93LsxvKXax0vzbCCGd_wQ&usqp=CAU' }}'
                />
                <div class="caption-container">
                    <p id="caption">{{$user->name}}
                        <br>
                        @if ($user->user_extra->facebook && $user->user_extra->facebook !== '')
                            <a href="https://www.facebook.com/{{$user->user_extra->facebook}}"><i
                                    class="fa fa-facebook-f"></i></a>
                        @endif
                        @if ($user->user_extra->instagram && $user->user_extra->instagram !== '')
                            <a href="https://www.instagram.com/{{$user->user_extra->instagram}}"><i
                                    class="fa fa-instagram"></i></a>
                        @endif
                        @if ($user->user_extra->youtube && $user->user_extra->youtube !== '')
                            <a href="https://www.twitter.com/{{$user->user_extra->youtube}}"><i
                                    class="fa fa-twitter"></i></a>
                        @endif
                    </p>
                </div>
                <hr/>
                <img
                    src='{{$user->user_extra->company_logo ?? 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTMgrxYAqZF6-kdFuLQesPwdAyonhn93LsxvKXax0vzbCCGd_wQ&usqp=CAU' }}'
                    style="width:100%;">
                <div class="caption-container">
                    <p id="caption">{{$user->user_extra->company_name}}</p>
                </div>
            </div>
            <div class="col-md-{{$related_videos->count() ? 7 : 10}} player-video mt-0">
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
                                    dataQuality="1080p"
                                    data-quality="1080p" quality-text="1080" title="1080p" label="1080p" res="1080">
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

                        <div class="video-options pt_mn_wtch_opts pt-4">
                            <button class="btn btn-outline-info btn-share" id="info-video">
                                <i class="fa fa-info text-black"></i>
                                More info
                            </button>
                            <button class="btn btn-primary btn-share" id="share-video">
                                <i class="fa fa-share-alt text-white"></i>
                                Share
                            </button>
                            <button class="btn btn-info btn-share text-white" id="embed-video">
                                <i class="fa fa-code"></i>
                                Embed
                            </button>
                            @if(auth()->check() && ($video->user_id==auth()->user()->id))
                                <a class="btn btn-outline-success"
                                   href="{{url("dashboard#/edit_video/$video->video_id")}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                              d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z"></path>
                                    </svg>
                                    Edit video
                                </a>
                                <a href="{{url('dashboard#/analytics')}}"
                                   class="btn btn-outline-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                              d="M3,14L3.5,14.07L8.07,9.5C7.89,8.85 8.06,8.11 8.59,7.59C9.37,6.8 10.63,6.8 11.41,7.59C11.94,8.11 12.11,8.85 11.93,9.5L14.5,12.07L15,12C15.18,12 15.35,12 15.5,12.07L19.07,8.5C19,8.35 19,8.18 19,8A2,2 0 0,1 21,6A2,2 0 0,1 23,8A2,2 0 0,1 21,10C20.82,10 20.65,10 20.5,9.93L16.93,13.5C17,13.65 17,13.82 17,14A2,2 0 0,1 15,16A2,2 0 0,1 13,14L13.07,13.5L10.5,10.93C10.18,11 9.82,11 9.5,10.93L4.93,15.5L5,16A2,2 0 0,1 3,18A2,2 0 0,1 1,16A2,2 0 0,1 3,14Z"></path>
                                    </svg>
                                    Analytics
                                </a>
                            @endif
                            @if(auth()->check() && ($video->user_id!=auth()->user()->id))
                                <button data-toggle="modal" data-target="#report"
                                        class="btn btn-primary btn-report pull-right" onclick=""
                                        data-rep="1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                              d="M14.4,6L14,4H5V21H7V14H12.6L13,16H20V6H14.4Z"></path>
                                    </svg>
                                    <span>Report</span></button>
                            @endif
                            <div class="embed-video d-none">
                                <div class="card w-100">
                                    <div class="card-body">
                                        <div class="input-group">
                                            <textarea name="embed" id="embed" cols="30" rows="3"
                                                      class="form-control copyembed">&lt;iframe src="{{route('embed_video',$video->video_id)}}" frameborder="0" width="100%" height="400" allowfullscreen&gt;&lt;/iframe&gt;</textarea>
                                            <div class="input-group-prepend">
                                                <button class="btn btn-primary copyembed"><i class="fa fa-link">
                                                        Copy</i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="share-video d-none">
                                <div class="card w-100">
                                    <div class="card-body">
                                        <div class="input-group mb-3">
                                            <input type="text"
                                                   value="{{route('directory_by_username',[request('slug'),request('video_id',$video->video_id)])}}"
                                                   class="form-control input-md copylink" readonly=""
                                            >
                                            <div class="input-group-prepend">
                                                <button class="btn btn-primary copylink"><i class="fa fa-link"> Copy</i>
                                                </button>
                                            </div>
                                        </div>
                                        <button
                                            data-url="https://www.facebook.com/sharer/sharer.php?u={{route('directory_by_username',[request('slug'),request('video_id',$video->video_id)])}}"
                                            class="btn btn-primary share-social"><i class="fa fa-facebook"></i>
                                        </button>
                                        <button
                                            data-url="https://wa.me/?text={{route('directory_by_username',[request('slug'),request('video_id',$video->video_id)])}}"
                                            class="btn btn-primary share-social"><i class="fa fa-whatsapp"></i>
                                        </button>
                                        <button
                                            data-url="https://twitter.com/intent/tweet?url={{route('directory_by_username',[request('slug'),request('video_id',$video->video_id)])}}"
                                            class="btn btn-primary share-social"><i class="fa fa-twitter"></i>
                                        </button>
                                        <button
                                            data-url="https://www.linkedin.com/shareArticle?mini=true&url={{route('directory_by_username',[request('slug'),request('video_id',$video->video_id)])}}&title={{$video->title}}"
                                            class="btn btn-primary share-social"><i class="fa fa-linkedin"></i>
                                        </button>
                                        <button
                                            data-url="https://pinterest.com/pin/create/button/?url={{route('directory_by_username',[request('slug'),request('video_id',$video->video_id)])}}&media={{asset("storage/$video->stream_path")}}"
                                            class="btn btn-primary share-social"><i class="fa fa-pinterest"></i>
                                        </button>
                                        <button
                                            data-url="https://www.tumblr.com/share/link?url={{route('directory_by_username',[request('slug'),request('video_id',$video->video_id)])}}"
                                            class="btn btn-primary share-social"><i
                                                class="fa fa-tumblr"></i>
                                        </button>
                                        <button
                                            data-url="https://www.reddit.com/submit?url={{route('directory_by_username',[request('slug'),request('video_id',$video->video_id)])}}"
                                            class="btn btn-primary share-social"><i
                                                class="fa fa-reddit"></i></button>
                                    </div>
                                </div>

                            </div>
                            <div class="info-video d-none">
                                <div class="card w-100">
                                    <div class="card-body">
                                        {{$video->title}}
                                        <p>{{$video->description}}</p>
                                        @if(!is_array($video->tags))
                                            Tags: @foreach($video->tags as $tags)
                                                {{--                                            <span class="badge badge-primary">{{str_replace(",",'</span><span class="badge badge-primary">',$video->tags)}}</span>--}}
                                                <span class="badge badge-primary">{{$tags}}</span>
                                            @endforeach
                                        @endif
                                        <br>
                                        Category: {{$video->category->name}}
                                        <br>
                                        Views: {{$views}}
                                    </div>
                                </div>


                            </div>
                            @if(auth()->check() && ($video->user_id!=auth()->id()))
                                <div class="modal fade" id="report" tabindex="-1" role="dialog"
                                     aria-labelledby="reportTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Report Video</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{route('to_user')}}">
                                                    @csrf
                                                    <input type="hidden" name="type" value="report">
                                                    <input type="hidden" name="video_id" value="{{$video->id}}">
                                                    <input type="hidden" name="contact_user_id"
                                                           value="{{auth()->id()}}">
                                                    <div class="form-group">
                                                        <label for="contact_message">Message Text</label>
                                                        <textarea name="message" required class="form-control"
                                                                  id="contact_message" rows="3"></textarea>
                                                    </div>
                                                    <button class="btn btn-primary">Report Video</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @else
                        <div>
                            <h1 class="alert alert-info">No Video Uploaded By this User</h1>
                        </div>
                    @endif
                </div>
                <div class="clear"></div>
            </div>
            @if($related_videos->count())
                <div class="col-md-3">
                    <div class="container m-0 p-0">
                        <div class="row">
                            <div class="col-12 m-0 p-0">
                                <div class="next-video">
                                    <div class="next-text pull-left pt_mn_wtch_nxttxt">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                  d="M16,18H18V6H16M6,18L14.5,12L6,6V18Z"></path>
                                        </svg>
                                        <span>Up Next</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row video-list">
                            @foreach($related_videos as $related_video)
                                <div class="col-12 m-0 p-0 my-2" id="related_video">
                                    <a href="{{route('directory_by_username',[$user->username,$related_video->video_id])}}">
                                        <div class="p-2 shadow-lg bg-white rounded video-thumb overlay"
                                             style="background-image: url({{asset('storage/'.$related_video->thumbnail)}});background-size: cover;height:200px;">
                                            <div class='play_hover_btn'
                                                 style="top: 50%;left: 50%;position: absolute;transform: translate(-50%, -50%);">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                     class="text-white feather feather-play-circle">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <polygon points="10 8 16 12 10 16 10 8"></polygon>
                                                </svg>
                                            </div>
                                            <span style="text-shadow: 1px 1px 2px #000;"
                                                  class="text-light font-weight-light">{{ucfirst($related_video->title)}}</span>
                                            <span style="text-shadow: 1px 1px 2px #000;"
                                                  class="text-light font-weight-light video-duration">{{gmdate('i:s', $related_video->duration)}}</span>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>


        <!-- 3rd row -->

        <div class="row my-4">
            <div class="col-12">
                <h4 class="font-weight-bold " style="color:gray"> CONTACT INFORMATION</h4>
                @if (session()->has('message_sent'))
                    <div class="alert alert-success">
                        {{ session()->get('message_sent') }}
                    </div>
                @endif
                <div class="borderBottomBold my-3"></div>

            </div>
            <div class="col-12 contactWidgets my-2 ">
                @if($user->name)
                    <div class="d-flex">
                        <div class="font-weight-bold "><i class='fa icon fa-id-card'></i> Name</div>
                        <div> {{$user->name}}</div>
                    </div>
                    <hr/>
                @endif
                @if ($user->user_extra->bio)
                    <div class="d-flex">
                        <div class="font-weight-bold "><i class='fa icon fa-id-card'></i> Name</div>
                        <div>
                            {!! $user->user_extra->bio !!}
                        </div>
                    </div>
                @endif
                @if($user->user_extra->company_name)
                    <div class="d-flex">
                        <div class="font-weight-bold "><i class='fa icon fa-id-card'></i> Company Name</div>
                        <div> {{$user->user_extra->company_name}}</div>
                    </div>
                    <hr/>
                @endif
                @if($user->user_extra->address)
                    <div class="d-flex">
                        <div class="font-weight-bold "><i class='fa icon fa-map-marker'></i> Address</div>
                        <div> {{$user->user_extra->address}}</div>
                    </div>
                    <hr/>
                @endif
                @if($user->user_extra->direct_phone)
                    <div class="d-flex">
                        <div class="font-weight-bold "><i class='fa icon fa-phone'></i> Direct Phone</div>
                        <div><a href="tel:{{$user->user_extra->direct_phone}}">{{$user->user_extra->direct_phone}}</a>
                        </div>
                    </div>
                    <hr/>
                @endif
                @if($user->user_extra->office_phone)
                    <div class="d-flex">
                        <div class="font-weight-bold "><i class='fa icon fa-phone'></i> Office Phone</div>
                        <div><a href="tel:{{$user->user_extra->office_phone}}">{{$user->user_extra->office_phone}}</a>
                        </div>
                    </div>
                    <hr/>
                @endif
                @if($user->user_extra->website)
                    <div class="d-flex">
                        <div class="font-weight-bold "><i class='fa icon fa-globe'></i> Website</div>
                        <div><a href="{{$user->user_extra->website}}"> {{$user->user_extra->website}} </a></div>
                    </div>
                    <hr/>
                @endif
                @if($user->user_extra->license_no)
                    <div class="d-flex">
                        <div class="font-weight-bold "><i class='fa icon fa-globe'></i> License #</div>
                        <div>{{$user->user_extra->license_no}} </div>
                    </div>
                    <hr/>
                @endif
            </div>

        </div>

        <div class="row">
            <div class="col-12">

                <ul class="nav nav-tabs" role="tablist">
                    @if(isset($user->user_extra->address))
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                               aria-controls="home" aria-selected="true">Map</a>
                        </li>
                    @endif
                    @if(isset($user->user_extra->bio))
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
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#report_message" role="tab"
                           aria-controls="report_message" aria-selected="false">Report</a>
                    </li>
                </ul>
                <div class="tab-content p-3 card">
                    @if(isset($user->user_extra->address))
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div id="map"></div>
                        </div>
                    @endif
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <p>{!! $user->user_extra->bio !!}</p>
                    </div>
                    <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">

                        @if(auth()->check() && ($video->user_id!=auth()->id()))
                            <button class="btn btn-primary my-3" data-toggle="modal" data-target="#review"> Add Review
                            </button>
                            <div class="modal fade" id="review" tabindex="-1" role="dialog"
                                 aria-labelledby="reportTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Add Review</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{route('to_user')}}">
                                                @csrf
                                                <input type="hidden" name="type" value="rating">
                                                <input type="hidden" name="video_id" value="{{$video->id}}">
                                                <input type="hidden" name="contact_user_id" value="{{auth()->id()}}">

                                                <div class="form-group">
                                                    <label for="contact_message">Message Text</label>
                                                    <textarea name="message" required class="form-control"
                                                              id="contact_message" rows="3"></textarea>
                                                    <div class="text-right">
                                                        <input type="hidden" name="rating" value="1">
                                                        <span class="float-right">
                                                            <i data-value="1" class="text-secondary fa fa-star"></i>
                                                            <i data-value="2" class="text-secondary fa fa-star"></i>
                                                            <i data-value="3" class="text-secondary fa fa-star"></i>
                                                            <i data-value="4" class="text-secondary fa fa-star"></i>
                                                            <i data-value="5" class="text-secondary fa fa-star"></i>
                                                        </span>
                                                    </div>
                                                </div>

                                                <button class="btn btn-primary">Add Review</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <a href="{{route('login')}}" class="btn btn-info text-white">Login to Add Review</a>
                        @endif
                        <div class="row">
                            <div class="col-4 rating-star-field">
                                <div class="d-flex align-items-center my-2">
                                    <span><i class="text-success fa fa-star"></i> 5 </span>
                                    <div class="progress w-75 ml-3">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 25%"
                                             aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center my-2">
                                    <span><i class="text-info fa fa-star"></i> 4 </span>
                                    <div class="progress w-75 ml-3">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%"
                                             aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="d-flex align-warning-center my-2">
                                    <span><i class="text-warning fa fa-star"></i> 3 </span>
                                    <div class="progress w-75 ml-3">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 75%"
                                             aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center my-2">
                                    <span><i class="text-danger fa fa-star"></i> 2 </span>
                                    <div class="progress w-75 ml-3">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 100%"
                                             aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center my-2">
                                    <span><i class="text-danger fa fa-star"></i> 1 </span>
                                    <div class="progress w-75 ml-3">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 100%"
                                             aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- reviews end -->
                    <!-- Contact -->
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <h1 class="my-3 font-weight-bold"> Contact to {{$user->name}} </h1>
                        @if(auth()->check() && ($video->user_id!=auth()->id()))
                            <form method="POST" action="{{route('to_user')}}">
                                @csrf
                                <input type="hidden" name="contact_user_id" value="{{auth()->id()}}">
                                <input type="hidden" name="video_id" value="{{$video->id}}">
                                <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea name="message" class="form-control" id="message" rows="3"
                                              placeholder="Message here"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary"> Send</button>
                            </form>
                        @else
                            <a href="{{route('login')}}" class="btn btn-info text-white">Login to
                                Contact {{$user->name}}</a>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="report_message" role="tabpanel" aria-labelledby="report-tab">
                        <!-- .report. -->

                        <h1 class="my-3 font-weight-bold"> Report Video</h1>
                        @if(auth()->check() && ($video->user_id!=auth()->id()))
                            <form method="POST" action="{{route('to_user')}}">
                                @csrf
                                <input type="hidden" name="contact_user_id" value="{{auth()->id()}}">
                                <input type="hidden" name="video_id" value="{{$video->id}}">
                                <input type="hidden" name="type" value="report">
                                <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea name="message" class="form-control" id="message" rows="3"
                                              placeholder="Message here"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary"> Send</button>
                            </form>
                        @else
                            <a href="{{route('login')}}" class="btn btn-info text-white">Login to Report Video</a>
                        @endif


                    </div>
                </div>

            </div>


        </div>


    </div>  <!--parentContainer -->
@endsection
@section('script')
    <script>
        function initMap() {
                @if(!is_null($user->user_extra->location_latitude) && !is_null($user->user_extra->location_longitude))
            let position = {
                    lat: {{$user->user_extra->location_latitude}},
                    lng: {{$user->user_extra->location_longitude}}
                };
            var map = new google.maps.Map(
                document.getElementById('map'), {zoom: 11, center: position});
            new google.maps.Marker({position: position, map: map});
            @endif
        }

    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAm4Wvmd2nIeaFQCdhAsxbiSXgBsibDolc&libraries=places&callback=initMap">
    </script>

@endsection
@section('meta')
    <meta name="description" content="{{$video->description}}. Author: {{$user->name}}"/>
    <link rel="image_src" href="{{asset("storage/$video->thumbnail")}}"/>
    <meta property="og:title" content="{{$video->title}}"/>
    <meta property="og:site_name" content="{{env('APP_NAME')}}"/>
    <meta property="og:url"
          content="{{route('directory_by_username',[request('slug'),request('video_id',$video->video_id)])}}"/>
    <meta property="og:description" content="{{$video->description}}. Author: {{$user->name}}"/>
    <meta property="og:type" content="video.other"/>
    <meta property="og:image" content="{{asset("storage/$video->thumbnail")}}">
    {{--    <meta property="og:locale" content="en-us" />--}}
    {{--    <meta property="og:locale:alternate" content="en-us" />--}}
    {{--    <meta property="og:video" content="{{route('embed_video',$video->video_id)}}"/>--}}
    {{--    <meta property="og:video:type" content="video/mp4"/>--}}
    {{--    <meta property="og:video:secure_url"--}}
    {{--          content="{{route('embed_video',$video->video_id)}}"/>--}}
    {{--    <meta property="og:video:width" content="640"/>--}}
    {{--    <meta property="og:video:height" content="360"/>--}}
    {{--    <meta property="og:image:url" content="{{url()->current()}}">--}}

    <!-- Twitter -->
    <meta name="twitter:card" content="player">
    <meta name="twitter:site" content="@@{{ env('APP_NAME' }}">
    <meta name="twitter:title" content="{{$video->title}}">
    <meta name="twitter:description" content="{{$video->description}}. Author: {{$user->name}}"/>
    <meta name="twitter:image" content="{{asset("storage/$video->thumbnail")}}">
    <meta name="twitter:player" content="{{route('embed_video',$video->video_id)}}?track_url=twitter.com">
    <meta name="twitter:player:width" content="640">
    <meta name="twitter:player:height" content="360">
    {{--    <meta name="twitter:player:stream" content="{{route('embed_video',$video->video_id)}}?track_url=twitter.com">--}}
    {{--    <meta name="twitter:player:stream:content_type" content="video/mp4">--}}

    <!-- Others -->
    {{--    <meta name="medium" content="video"/>--}}
    {{--    <meta name="video_type" content="application/x-shockwave-flash"/>--}}
    {{--    <link rel="video_src" href="{{asset("storage/".str_replace('240p','360p',$video->stream_path))}}"/>--}}
@endsection
@section('header_script')
    window.VIDEO_APP.video_url = "{{route('is_played',$video->id)}}";
@endsection
