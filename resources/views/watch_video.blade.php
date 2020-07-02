@extends('layouts.oldApp')
@section('container')
    <div id="main-container" style="margin-top:100px" class="main-content  container" data-logged="true">
        <div id="container_content">
            <div class="top-video video-player-page">
                @if(Session::has('error'))
                    <div class="alert alert-danger">
                        {{Session::get('error')}}
                    </div>
                @endif
                @if(Session::has('success'))
                    <div class="alert alert-danger">
                        {{Session::get('success')}}
                    </div>
                @endif
                <div class="row">
                    <div id="background" class="hidden"></div>
                    <div class="col-md-8 player-video" style="margin-top: 0 !important">
                        <div class="video-player pt_video_player " id="pt_video_player">
                            <span class="mejs__offscreen">Video Player</span>
                            <video id="my-video_html5"
                                   style="width: 100%; height: 451.872px; position: relative;"
                                   poster="{{asset("storage/$video->thumbnail")}}"
                                   preload="none"
                                   ontimeupdate="video_player_tracker({{$video_actions}})"
                                   onplay="create_links({{$video_actions}})"
                            >
                                @if($video->{'8k'})
                                    <source src="{{asset("storage/".str_replace('240p','4320p',$video->stream_path))}}"
                                            type="video/mp4"
                                            data-quality="4320p" title="4320p" label="4320p" res="4320">
                                @endif
                                @if($video->{'4K'})
                                    <source src="{{asset("storage/".str_replace('240p','2160p',$video->stream_path))}}"
                                            type="video/mp4"
                                            data-quality="2160p" title="2160p" label="2160p" res="2160">
                                @endif
                                @if($video->{'1440p'})
                                    <source src="{{asset("storage/".str_replace('240p','1440p',$video->stream_path))}}"
                                            type="video/mp4"
                                            data-quality="1440p" title="1440p" label="1440p" res="1440">
                                @endif
                                @if($video->{'1080p'})
                                    <source src="{{asset("storage/".str_replace('240p','1080p',$video->stream_path))}}"
                                            type="video/mp4"
                                            data-quality="1080p" title="1080p" label="1080p" res="1080">
                                @endif
                                @if($video->{'720p'})
                                    <source src="{{asset("storage/".str_replace('240p','720p',$video->stream_path))}}"
                                            type="video/mp4"
                                            data-quality="720p" title="720p" label="720p" res="720">
                                @endif
                                @if($video->{'480p'})
                                    <source src="{{asset("storage/".str_replace('240p','480p',$video->stream_path))}}"
                                            type="video/mp4"
                                            data-quality="480p" title="480p" label="480p" res="480">
                                @endif

                                @if($video->{'360p'})
                                    <source src="{{asset("storage/".str_replace('240p','360p',$video->stream_path))}}"
                                            type="video/mp4"
                                            data-quality="360p" title="360p" label="360p" res="360">
                                @endif
                                <source src="{{asset("storage/$video->stream_path")}}" type="video/mp4"
                                        data-quality="240p" title="240p" label="240p" res="240">
                                Your browser does not support HTML5 video.
                            </video>
                            <div class="icons hidden">
                                <span class="expend-player"><i class="fa fa-expand fa-fw"></i></span>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="col-md-4 no-padding-left pull-right desktop">
                        <div class="content pt_shadow">
                            <div class="ads-placment"></div>
                            <div class="next-video">
                                <div class="next-text pull-left pt_mn_wtch_nxttxt">
                                    <h4>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M16,18H18V6H16M6,18L14.5,12L6,6V18Z"></path>
                                        </svg>
                                        Up next
                                    </h4>
                                </div>
                                <div class="pt_mn_wtch_switch pull-right">
                                    <input id="autoplay" type="checkbox" class="tgl autoplay-video">
                                    <label class="tgl-btn" for="autoplay">Autoplay</label>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="videos-list pt_mn_wtch_rlts_prnt pt_mn_wtch_upnxt_prnt" id="next-video">
                                @foreach($related_videos as $related_video)
                                    <div
                                        class="video-wrapper top-video-wrapper pt_video_side_vids pt_pt_mn_wtch_rltvids"
                                        data-sidebar-video="2">
                                        <div class="video-thumb">
                                            <a href="{{url()->current().'?v='.$related_video->video_id}}">
                                                <img
                                                    src="{{asset('storage/'.$related_video->thumbnail)}}"
                                                    alt="Products">
                                                <div class="play_hover_btn" onmouseenter="show_gif(this,'')"
                                                     onmouseleave="hide_gif(this)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-play-circle">
                                                        <circle cx="12" cy="12" r="10"></circle>
                                                        <polygon points="10 8 16 12 10 16 10 8"></polygon>
                                                    </svg>
                                                </div>
                                                <div
                                                    class="video-duration">{{gmdate("H:i:s",$related_video->duration)}}</div>
                                            </a>
                                        </div>
                                        <div class="video-title">
                                            <a href="#">{{$related_video->title}}</a>
                                        </div>
                                        <div class="vid_pub_info">
                                            <a href="#"><span class="video-publisher">
                                                <img class="header-image" src="{{asset('upload/photos/d-avatar.jpg')}}">
                                                {{$related_video->user->username}}
                                            </span></a>
                                            <span class="bold">|</span>
                                            <span class="video-views">2 Views</span>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                @endforeach
                            </div>
{{--                            <div class="load-related-videos">--}}
{{--                                <button class="btn btn-default" id="load-related-videos">--}}
{{--                                    <span>Load More</span><i class="fa fa-circle-o-notch spin hidden"></i>--}}
{{--                                </button>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                    <div class="col-md-8 ">
                        <div class="content pt_shadow">
                            <div class="video-title pt_video_info">
                                <input type="hidden" value="1" id="video-id">
                                <div class="video-big-title">
                                    <h1 itemprop="title">{{$video->title}}
                                    </h1>
                                </div>
                                <div class="video-views">
                                    <span id="video-views-count">{{$totalViews}}</span> {{$totalViews>1?'Views':'View'}}
                                </div>
                                @if(!auth()->guest() && ($video->user_id==auth()->user()->id))
                                    <div class="form-group">
                                        <form action="{{route('createVideoAction')}}" method="POST"><br>
                                            @csrf
                                            Start Time:
                                            <input type="hidden" name="video_id" value="{{$video->id}}"></input>
                                            <input type="number" value="0" name="start_minute" min="0" max="100"
                                                   placeholder="00">:
                                            <input type="number" value="00" name="start_second" min="0" max="60"
                                                   placeholder="00">
                                            Title:
                                            <input required type="text" name="title" placeholder="title">
                                            <br><br>
                                            Final Time:
                                            <input type="number" value="0" name="end_minute" min="0" max="100"
                                                   placeholder="00">:
                                            <input type="number" value="00" name="end_second" min="0" max="60"
                                                   placeholder="00">
                                            Link:
                                            <input required type="text" name="url" placeholder="URL"><br>
                                            <input type="submit" value="Save Action">
                                        </form>
                                    </div>
                                @endif
                                <div class="video-options pt_mn_wtch_opts">
                                    <button class="btn-share" id="share-video">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                  d="M18,16.08C17.24,16.08 16.56,16.38 16.04,16.85L8.91,12.7C8.96,12.47 9,12.24 9,12C9,11.76 8.96,11.53 8.91,11.3L15.96,7.19C16.5,7.69 17.21,8 18,8A3,3 0 0,0 21,5A3,3 0 0,0 18,2A3,3 0 0,0 15,5C15,5.24 15.04,5.47 15.09,5.7L8.04,9.81C7.5,9.31 6.79,9 6,9A3,3 0 0,0 3,12A3,3 0 0,0 6,15C6.79,15 7.5,14.69 8.04,14.19L15.16,18.34C15.11,18.55 15.08,18.77 15.08,19C15.08,20.61 16.39,21.91 18,21.91C19.61,21.91 20.92,20.61 20.92,19A2.92,2.92 0 0,0 18,16.08Z"></path>
                                        </svg>
                                        Share
                                    </button>
                                    @if(!auth()->guest() && ($video->user_id==auth()->user()->id))
                                    <button class="btn-share" id="embed-video">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                  d="M14.6,16.6L19.2,12L14.6,7.4L16,6L22,12L16,18L14.6,16.6M9.4,16.6L4.8,12L9.4,7.4L8,6L2,12L8,18L9.4,16.6Z"></path>
                                        </svg>
                                        Embed
                                    </button>
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
                                    <button data-toggle="modal" data-target="#exampleModalCenter" class="btn-share btn-report pull-right" onclick=""
                                            data-rep="1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                  d="M14.4,6L14,4H5V21H7V14H12.6L13,16H20V6H14.4Z"></path>
                                        </svg>
                                        <span>Report</span></button>
                                    <div class="embed-placement hidden">
                                        <textarea name="embed" id="embed" cols="30" rows="3" class="form-control">&lt;iframe src="{{route('embed_video',$video->video_id)}}" frameborder="0" width="700" height="400" allowfullscreen&gt;&lt;/iframe&gt;</textarea>
                                    </div>
                                    <div class="share-video hidden">
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
                                <div class="publisher-element pull-left pt_mn_wtch_pub">
                                    <div class="publisher-avatar pull-left hide-in-mobile-720">
                                        <a href="#" class="mt-5">
                                            @if(!is_null(auth()->user()->avatar))
                                                <img class="header-image"
                                                     src="{{auth()->user()->avatar}}">
                                            @else
                                                <img class="header-image"
                                                     src="{{asset('images/blank.png')}}">
                                            @endif
{{--                                            {{auth()->user()->name}}--}}
                                        </a>
                                    </div>
                                    <div class="publisher-name">
                                        <a href="#">{{ucfirst($video->user->username)}}</a>
                                    </div>
                                    @if(!auth()->guest() && ($video->user_id==auth()->user()->id))
                                        <div class="publisher-subscribe-button"><a
                                                href="{{route('dashboard')}}"
                                                class="btn-subscribed pointer"
                                                data-load="?link1=video_studio">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2"
                                                     stroke-linecap="round" stroke-linejoin="round"
                                                     class="feather feather-video">
                                                    <polygon points="23 7 16 12 23 17 23 7"></polygon>
                                                    <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
                                                </svg>
                                                Manage
                                            </a>
                                            </div>
                                    @endif
                                    <div class="clear"></div>
                                </div>
                                <div class="clear"></div>
                                <div class="video-published">
                                    Published on {{$video->created_at}}
                                </div>
                                <div class="watch-video-description">
                                    <p dir="auto" itemprop="description">{{$video->description}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="ads-placment"></div>

                        <div class="comments-content content pt_shadow pt_video_comments">
                            <div class="comments-header">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-message-circle">
                                    <path
                                        d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                                </svg>
                                <span id="comments_count">{{$comments['comments_count']}}</span> Comments
                            </div>
                            <div class="w100 pt_blogcomm_combo">
                                @if(!is_null(auth()->user()->avatar))
                                    <img class="header-image"
                                         src="{{auth()->user()->avatar}}">
                                @else
                                    <img class="header-image"
                                         src="{{asset('images/blank.png')}}">
                                @endif
                                <textarea name="comment" class="form-control" id="comment-textarea"
                                          placeholder="Write your comment.."></textarea>

                                <button class="btn pull-right btn-main" onclick="postComment()"
                                        data-toggle="tooltip" title="Publish">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-arrow-right">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                        <polyline points="12 5 19 12 12 19"></polyline>
                                    </svg>
                                </button>
                            </div>
                            <div class="comment-button">
                                <hr>
                                <div class="user-comments" id="video-pinned-comments">
                                    <div id="pinned-comment">

                                    </div>
                                </div>
                            </div>
                            <div class="comments-loading hidden">
                                <i class="fa fa-circle-o-notch spin"></i>
                            </div>
                            @if(count($comments['comments'])>0)
                                @foreach($comments['comments'] as $comment)
                                    <div class="user-comments" id="video-user-comments">
                                        <div class="main-comment" data-id="2" id="comment-{{$comment->id}}">
                                            <div class="main-comment-data-sp">
                                                <div class="user-avatar pull-left">
                                                    <img
                                                        src="http://localhost/video-homes(old)/beta//upload/photos/d-avatar.jpg">
                                                </div>
                                                @if(isset(auth()->user()->id)&& $comment->user_id==auth()->user()->id)
                                                    <div class="pull-right delete-comment"
                                                         onclick="deleteComment({{$comment->id}});">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                             stroke-width="2"
                                                             stroke-linecap="round" stroke-linejoin="round"
                                                             class="feather feather-trash">
                                                            <polyline points="3 6 5 6 21 6"></polyline>
                                                            <path
                                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                                        </svg>
                                                    </div>
                                                @endif
                                                <div class="user-name">
			                                <span class="pin">
							                </span>
                                                    <a>
                                                        {{$comment->user->username}}
                                                    </a>
                                                    <small>x time ago</small>
                                                </div>
                                                <div class="user-comment">
                                                    <p class="comment-text">{{$comment->comment_text}}</p>
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p>No Comment Found</p>
                            @endif
                            {{--                            <div class="watch-video-show-more comments-load">Show More Comments</div>--}}

                        </div>
                        <input type="hidden" id="video-id" value="1">


                    </div>
                    <div class="col-md-4 no-padding-left pull-right mobile">
                        <div class="content">
                            <div class="next-video">
                                <div class="next-text pull-left pt_mn_wtch_nxttxt">
                                    <h4>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M16,18H18V6H16M6,18L14.5,12L6,6V18Z"></path>
                                        </svg>
                                        Up next
                                    </h4>
                                </div>
                                <div class="pt_mn_wtch_switch pull-right">
                                    <input id="autoplay-2" type="checkbox" class="tgl autoplay-video">
                                    <label class="tgl-btn" for="autoplay-2">Autoplay</label>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="videos-list pt_mn_wtch_rlts_prnt pt_mn_wtch_upnxt_prnt" id="next-video">

                            </div>
                            <br>
                            <div class="related-header">
                            </div>
                            <div class="videos-list related-videos pt_mn_wtch_rlts_prnt">

                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>

                </div>
            </div>
            <style>
                .mejs__offscreen {
                    clip: initial !important;
                    clip-path: inherit !important;
                    -webkit-clip-path: inherit !important;
                    opacity: 0;
                }
            </style>

        </div>
    </div>
@endsection
@section('footer_script')
    <script type="text/javascript">
        function create_links(actions) {
            $.ajax({
                type: 'GET',
                url: '{{route('video_is_played',$view_id)}}',
                dataType: 'json',
                success: function (data) {
                    console.log(data)
                }, error: function (data) {
                    console.log(data);
                }
            })
            let parent = document.getElementById('pt_video_player');
            let a = [];
            let position = 75;
            for (let i = 0; i < actions.length; i++) {
                let temp = i;
                temp = temp * 7.5
                a[i] = document.createElement('a');
                a[i].appendChild(document.createTextNode(`${actions[i].title}`));
                a[i].setAttribute('id', `link-${actions[i].id}`)
                a[i].title = `${actions[i].title}`;
                a[i].href = `${actions[i].url}`;
                a[i].style.zIndex = 99999;
                a[i].style.top = position - temp + '%';
                a[i].style.position = 'absolute';
                a[i].style.marginLeft = '5px';
                a[i].style.visibility = 'hidden';
                parent.appendChild(a[i]);
            }
        }

        function video_player_tracker(actions) {
            let myPlayerTime = document.getElementById('my-video_html5');
            let a=[];
            for (let i = 0; i < actions.length; i++) {
                if (myPlayerTime.currentTime >= actions[i].start_time && myPlayerTime.currentTime <= actions[i].end_time) {
                    a[i] = document.getElementById(`link-${actions[i].id}`);
                    a[i].style.visibility = 'visible';
                }
                if (myPlayerTime.currentTime > actions[i].end_time) {
                    let x = document.getElementById(`link-${actions[i].id}`);
                    if (x != null)
                        x.remove()
                }
            }
        }

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function like() {
                $.ajax({
                    type: 'GET',
                    url: '{{url()->current().'/videos_likes?v='.$video->video_id}}',
                    dataType: 'json',
                    success: function (data) {
                        likes = data.likes
                        dislikes = data.dislikes
                    }, error: function (data) {
                        console.log(data);
                    }
                })
            }

            function dislike() {
                $.ajax({
                    type: 'GET',
                    url: '{{url()->current().'/videos_dislikes?v='.$video->video_id}}',
                    dataType: 'json',
                    success: function (data) {
                        likes = data.likes
                        dislikes = data.dislikes
                    }, error: function (data) {
                        console.log(data);
                    }
                })
            }
        })

        function postComment(data) {
            let comment_text = document.getElementById('comment-textarea');
            if (!comment_text.value) {
                $('#comment-textarea').css('border', '1px solid red');
                return false;
            } else {
                @if(!isset(auth()->user()->id))
                alert('You are not Logged in')
                @else
                $.ajax({
                    type: 'POST',
                    url: '{{route('post_comment')}}',
                    dataType: 'json',
                    data: {
                        comment_text: comment_text.value,
                        video_id:{{$video->id}},
                        user_id:{{auth()->user()->id}}},
                    success: function (data) {
                        $('#comment-textarea').val('');
                        $('#main-comment').prepend(data.success.comment_text);
                    }, error: function (data) {
                        alert(data.responseJSON.message)
                        console.log(data);
                    }
                })
                @endif
            }
        }

        function deleteComment(commentId) {
            $.ajax({
                type: 'POST',
                url: '{{route('delete_comment')}}',
                dataType: 'json',
                data: {id: commentId, video_id:{{$video->id}}},
                success: function (data) {
                    if (data.status) {
                        $('#comment-' + commentId).slideUp('fast');
                        x = document.getElementById('comments_count')
                        let comments = parseInt(x.innerText) - 1
                        x.innerText = comments
                    }
                }, error: function (data) {
                    alert(data.responseJSON.message)
                    console.log(data);
                }
            })
        }
    </script>

    <script type="text/javascript">
        function go_to_duration(duration) {
            window.scrollTo(0, 0);
            var vid = document.querySelector("video");
            vid.currentTime = duration;
            vid.play();
        }
    </script>
    <script type="text/javascript">


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
@stop
