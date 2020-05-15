@extends('layouts.app')
@section('container')
    <div id="main-container" class="main-content  container  watch-container    " data-logged="true">
        <div id="container_content">
            <div class="top-video video-player-page">
                <div class="row">
                    <div id="background" class="hidden"></div>
                    <div class="col-md-8 player-video" style="margin-top: 0 !important">
                        <div class="video-player pt_video_player ">
                            <span class="mejs__offscreen">Video Player</span>
                            <video id="my-video_html5"
                                   style="width: 100%; height: 451.872px; position: relative;"
                                   poster="{{asset("storage/$video->thumbnail")}}"
                                   preload="none"
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
                            <div class="load-related-videos">
                                <button class="btn btn-default" id="load-related-videos">
                                    <span>Load More</span><i class="fa fa-circle-o-notch spin hidden"></i>
                                </button>
                            </div>
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
                                <div>
                                    <div class="video-likes pull-right pt_mn_wtch_liks_prnt">
                                        <div class="like-btn " id="likes-bar"
                                             onclick="Wo_LikeSystem('1', 'like', this, 'is_ajax')" data-likes="0">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="feather feather-thumbs-up"
                                                 width="24" height="24" viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                      d="M23,10C23,8.89 22.1,8 21,8H14.68L15.64,3.43C15.66,3.33 15.67,3.22 15.67,3.11C15.67,2.7 15.5,2.32 15.23,2.05L14.17,1L7.59,7.58C7.22,7.95 7,8.45 7,9V19A2,2 0 0,0 9,21H18C18.83,21 19.54,20.5 19.84,19.78L22.86,12.73C22.95,12.5 23,12.26 23,12V10M1,21H5V9H1V21Z"></path>
                                            </svg>
                                            <span class="likes" id="likes">0</span>
                                        </div>
                                        <div class="pt_mn_wtch_liks">
                                            <div class="video-info-element">
                                                <div class="views-bar" style="width: 100%"></div>
                                                <div class="views-bar blue" style="width: 0%"></div>
                                                <div class="clear"></div>
                                            </div>
                                        </div>
                                        <div class="like-btn text-right " id="dislikes-bar"
                                             onclick="Wo_LikeSystem('1', 'dislike', this, 'is_ajax')" data-likes="0">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="feather feather-thumbs-down"
                                                 width="24" height="24" viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                      d="M19,15H23V3H19M15,3H6C5.17,3 4.46,3.5 4.16,4.22L1.14,11.27C1.05,11.5 1,11.74 1,12V14A2,2 0 0,0 3,16H9.31L8.36,20.57C8.34,20.67 8.33,20.77 8.33,20.88C8.33,21.3 8.5,21.67 8.77,21.94L9.83,23L16.41,16.41C16.78,16.05 17,15.55 17,15V5C17,3.89 16.1,3 15,3Z"></path>
                                            </svg>
                                            <span class="likes" id="dislikes">0</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="video-views">
                                    <span id="video-views-count">{{$totalViews}}</span> {{$totalViews>1?'Views':'View'}}
                                </div>
                                <div class="video-options pt_mn_wtch_opts">
                                    <button class="btn-share" id="share-video">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                  d="M18,16.08C17.24,16.08 16.56,16.38 16.04,16.85L8.91,12.7C8.96,12.47 9,12.24 9,12C9,11.76 8.96,11.53 8.91,11.3L15.96,7.19C16.5,7.69 17.21,8 18,8A3,3 0 0,0 21,5A3,3 0 0,0 18,2A3,3 0 0,0 15,5C15,5.24 15.04,5.47 15.09,5.7L8.04,9.81C7.5,9.31 6.79,9 6,9A3,3 0 0,0 3,12A3,3 0 0,0 6,15C6.79,15 7.5,14.69 8.04,14.19L15.16,18.34C15.11,18.55 15.08,18.77 15.08,19C15.08,20.61 16.39,21.91 18,21.91C19.61,21.91 20.92,20.61 20.92,19A2.92,2.92 0 0,0 18,16.08Z"></path>
                                        </svg>
                                        Share
                                    </button>
                                    <button class="btn-share" id="embed-video">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                  d="M14.6,16.6L19.2,12L14.6,7.4L16,6L22,12L16,18L14.6,16.6M9.4,16.6L4.8,12L9.4,7.4L8,6L2,12L8,18L9.4,16.6Z"></path>
                                        </svg>
                                        Embed
                                    </button>
                                    @if(!auth()->guest())
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
                                    <button class="btn-share btn-report pull-right" onclick=""
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
                                        <a href="#" class="fa fa-facebook"
                                           onclick="OpenShareWindow('https://www.facebook.com/sharer/sharer.php?u={{request()->fullUrl()}}')"></a>
                                        <a href="#" class="fa fa-twitter"
                                           onclick="OpenShareWindow('https://twitter.com/intent/tweet?url={{request()->fullUrl()}}')"></a>
                                        <a href="#" class="fa fa-google"
                                           onclick="OpenShareWindow('https://plus.google.com/share?url={{request()->fullUrl()}}')"></a>
                                        <a href="#" class="fa fa-linkedin"
                                           onclick="OpenShareWindow('https://www.linkedin.com/shareArticle?mini=true&amp;url={{request()->fullUrl()}}&amp;title={{$video->title}}')"></a>
                                        {{--                                        <a href="#" class="fa fa-pinterest"--}}
                                        {{--                                           onclick="OpenShareWindow('https://pinterest.com/pin/create/button/?url=http%3A%2F%2Flocalhost%3A9002%2F%2Fwatch%2F14-march-2020-loom-recording_MVVIbINPjrRSP69.html&amp;media=http://localhost:9002//upload/photos/2020/04/r9iNPbQj4MfaoXFI8ezc_04_1a2e85073c867251df9bc76c985fc37e_image.jpg')"></a>--}}
                                        {{--                                        <a href="#" class="fa fa-tumblr"--}}
                                        {{--                                           onclick="OpenShareWindow('http://www.tumblr.com/share/link?url=http%3A%2F%2Flocalhost%3A9002%2F%2Fwatch%2F14-march-2020-loom-recording_MVVIbINPjrRSP69.html')"></a>--}}
                                        {{--                                        <a href="#" class="fa fa-reddit"--}}
                                        {{--                                           onclick="OpenShareWindow('http://www.reddit.com/submit?url=http%3A%2F%2Flocalhost%3A9002%2F%2Fwatch%2F14-march-2020-loom-recording_MVVIbINPjrRSP69.html')"></a>--}}
                                        <a href="#" onclick="copyToClipboard(this)" class="fa fa-link"
                                           link="{{request()->fullUrl()}}"></a>
                                    </div>
                                </div>
                                <div class="publisher-element pull-left pt_mn_wtch_pub">
                                    <div class="publisher-avatar pull-left hide-in-mobile-720">
                                        <a href="#">
                                            <img class="header-image"
                                                 src="{{asset('upload/photos/d-avatar.jpg')}}">
                                        </a>
                                    </div>
                                    <div class="publisher-name">
                                        <a href="#">{{$video->user->username}}</a>
                                    </div>
                                    @if(!auth()->guest())
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
                                            <span class="subs-amount">0</span></div>
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
                                <div class="watch-video-show-more desc pt_mn_wtch_rdmre">Show more</div>
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
                                <img class="header-image"
                                     src="{{asset('upload/photos/d-avatar.jpg')}}">
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
        window.onload = function () {
            // alert('asd'
            //    asdasd
            //    asd

        };
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
        function setCookie(cname, cvalue, exdays) {
            var d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            var expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }

        var myTimeout;

        function show_gif(self, gif) {
            if (gif && gif != '') {
                myTimeout = setTimeout(function () {
                    $(self).append('<img src="' + gif + '">');
                }, 1000);
            }
        }

        function hide_gif(self) {
            $(self).find('img').remove();
            clearTimeout(myTimeout);
        }

        function PT_OpenStripe(pkg, self, video_id = 0, price = 0, user_id = 0) {

            $('#pay-go-pro').modal('hide');
            $('#stripe_modal').modal('show');
            stripe_array['video_id'] = video_id;
            stripe_array['user_id'] = user_id;
            if (pkg == 'rent') {
                stripe_array['pay_type'] = 'rent';
            } else {
                stripe_array['pay_type'] = '';
            }
        }


        var sources = [];
        for (var i = 0; i < $('video').find('source').length; i++) {
            sources[i] = parseFloat($($('video').find('source')[i]).attr('res'));
        }

        var imageAddr = "http://www.kenrockwell.com/contax/images/g2/examples/31120037-5mb.jpg";
        var downloadSize = 4995374;
        // var imageAddr = site_url + "/upload/photos/speed.jpg";
        // var downloadSize = 1082828;

        function getCookie(name) {
            var value = "; " + document.cookie;
            var parts = value.split("; " + name + "=");
            if (parts.length == 2) return parts.pop().split(";").shift();
        }

        function getQuality() {
            MeasureConnectionSpeed();


            function MeasureConnectionSpeed() {
                if (getCookie('internet_speed') > 0) {
                    showResults(getCookie('internet_speed'));
                } else {
                    var startTime, endTime;
                    var download = new Image();
                    download.onload = function () {
                        endTime = (new Date()).getTime();
                        showResults();
                    }

                    download.onerror = function (err, msg) {
                        ShowProgressMessage(0);
                    }

                    startTime = (new Date()).getTime();
                    var cacheBuster = "?nnn=" + startTime;
                    download.src = imageAddr + cacheBuster;
                }

                //console.log($.cookie("internet_speed"));


                function showResults(speed = 0) {
                    if (speed == 0) {
                        var duration = (endTime - startTime) / 1000;
                        var bitsLoaded = downloadSize * 8;
                        var speedBps = (bitsLoaded / duration).toFixed(2);
                        var speedKbps = (speedBps / 1024).toFixed(2);
                        var speedMbps = (speedKbps / 1024).toFixed(2);
                        setCookie("internet_speed", speedKbps, 1);

                    } else {
                        speedKbps = speed;
                        if (speed < 240) {
                            speedKbps = 250;
                        }
                    }
                    for (var i = 0; i < sources.length; i++) {
                        if (sources[i] < parseFloat(speedKbps)) {
                            is_clicked = true;
                            video_source = sources[i];
                            $('#' + $('.mejs__container').attr('id') + '-qualities-' + video_source + 'p').click();
                            $('.mejs__qualities-button').find('button').text('auto');
                            $('.mejs__qualities-selector-label').removeClass('mejs__qualities-selected');
                            $('#quality__auto').addClass('mejs__qualities-selected');
                            break;
                        }
                    }
                }
            }
        }

        function setAuto(self) {
            $('.mejs__qualities-button').find('button').text('auto');
            $('.mejs__qualities-selector-label').removeClass('mejs__qualities-selected');
            $('#quality__auto').addClass('mejs__qualities-selected');
            getQuality();
            setTimeout(function (argument) {
                setCookie('auto', 'auto', 1);
            }, 1000);

        }

        $(document).ready(function () {
            document.querySelector('video').addEventListener("loadeddata", function () {
                setCookie('auto', '', 1);
            });
        });

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


        if (sources.length > 1) {
            setTimeout(function () {
                $('.mejs__qualities-selector-list').append('<li class="mejs__qualities-selector-list-item" onclick="setAuto(this)"><input class="mejs__qualities-selector-input" type="radio" name="mep_0_qualities" value="auto" id="mep_0-qualities-auto"><label for="mep_0-qualities-auto" class="mejs__qualities-selector-label" id="quality__auto">auto</label></li>');
            }, 1000);
        }


    </script>

    <script>

        jQuery(window).ready(function ($) {
            var width = $('.video-player').width().toString();
            var width = width.substring(0, width.lastIndexOf("."))
            $('.fb-video').attr('data-width', width);
            //$( 'iframe' ).attr( 'src', function ( i, val ) { return val; });
            $("#load-related-videos").click(function (event) {
                let id = 0;
                if ($("div[data-sidebar-video]").length > 0) {
                    id = $("div[data-sidebar-video]").last().attr('data-sidebar-video');
                }

                $("#load-related-videos").find('i.spin').removeClass('hidden');

            });
        });

        $('.ad-link').on('click', function (event) {
            $('.ad-link').remove();
            $('video')[0].play();
        });

        $('.autoplay-video').on('change', function (event) {
            event.preventDefault();
            checked = 1;
            if ($(this).is(":checked")) {
                checked = 2;
            }
            $.post('http://localhost:9002//aj/set-cookies', {name: 'autoplay', value: checked});
        });
        $('.ads-test').on('click', function (event) {
            $(this).remove();
        });


        $(function () {
            $('.rad-transaction').click(function (event) {
                $(this).off("click").removeClass('rad-transaction');
                $.get('http://localhost:9002//aj/ads/rad-transaction', function (data) { /* pass */
                });
            });

            if ($('[data-litsitem-id]').length > 4) {
                var listItemtopPos = $("div[data-litsitem-id=MVVIbINPjrRSP69]").offset();
                $('.play-list-cont').scrollTop((listItemtopPos.top - 170));
            }


            $('#share-video').on('click', function (event) {
                event.preventDefault();
                $('.share-video').toggleClass('hidden');
                if (!$('.embed-placement').hasClass('hidden')) {
                    $('.embed-placement').toggleClass('hidden');
                }
                if (!$('.download-placement').hasClass('hidden')) {
                    $('.download-placement').toggleClass('hidden');
                }
            });
            $('#embed-video').on('click', function (event) {
                event.preventDefault();
                $('.embed-placement').toggleClass('hidden');
                if (!$('.share-video').hasClass('hidden')) {
                    $('.share-video').toggleClass('hidden');
                }
                if (!$('.download-placement').hasClass('hidden')) {
                    $('.download-placement').toggleClass('hidden');
                }
            });
            $('#download-video').on('click', function (event) {
                event.preventDefault();
                $('.download-placement').toggleClass('hidden');
                if (!$('.embed-placement').hasClass('hidden')) {
                    $('.embed-placement').toggleClass('hidden');
                }
                if (!$('.share-video').hasClass('hidden')) {
                    $('.share-video').toggleClass('hidden');
                }
            });

            $('#save-button').on('click', function (event) {
                event.preventDefault();
                var logged = $('#main-container').attr('data-logged');
                if (!logged) {
                    window.location.href = "http://localhost:9002//login?to=http://localhost:9002%2F%2Fpage_loading.php%3Flink1%3Dwatch%26id%3D14-march-2020-loom-recording_MVVIbINPjrRSP69.html%26hash%3D5eb422b39a69f7fec5c053501c62460114fa6e16%26_%3D1587557139927";
                    return false;
                }
                var video_id = $('#video-id').val();
                if ($(this).attr('saved')) {
                    $(this).html('<i class="fa fa-floppy-o fa-fw"></i> Save');
                    $(this).removeAttr('saved');
                } else {
                    $(this).html('<i class="fa fa-check fa-fw"></i> Saved');
                    $(this).attr('saved', 'true');
                }
                $.post('http://localhost:9002//aj/save-video', {video_id: video_id});
            });
            $('.desc').on('click', function (event) {
                event.preventDefault();
                if ($(this).hasClass('expended')) {
                    $('.watch-video-description').css({
                        'max-height': '100px',
                        'height': '100px',
                        'overflow': 'hidden'
                    });
                    $(this).removeClass('expended');
                    $(this).text("Show more");
                } else {
                    $('.watch-video-description').css({
                        'max-height': '4000px',
                        'height': 'auto',
                        'overflow': 'auto'
                    });
                    $(this).addClass('expended');
                    $(this).text("Show less");
                }
            });


            $('.expend-player').on('click', function (event) {
                event.preventDefault();
                var resize = 0;
                if ($('.player-video').hasClass('col-md-12')) {
                    resize = 0;
                } else {
                    resize = 1;
                }
                $.post('http://localhost:9002//aj/set-cookies', {name: 'resize', value: resize});
                PT_Resize();
            });
            $(window).resize(function (event) {
                if ($('body').attr('resized') == 'true') {
                    PT_Resize(true);
                }
            });

        });


        if (document.addEventListener) {
            document.addEventListener('webkitfullscreenchange', exitHandler, false);
            document.addEventListener('mozfullscreenchange', exitHandler, false);
            document.addEventListener('fullscreenchange', exitHandler, false);
            document.addEventListener('MSFullscreenChange', exitHandler, false);
        }

        function exitHandler() {
            if (document.webkitIsFullScreen || document.mozFullScreen || document.msFullscreenElement !== null) {
                setTimeout(function () {
                    PT_Resize(false);
                }, 100);
            }
        }

        function PT_Resize(type) {

            if ($('.player-video').hasClass('col-md-12') && type != true) {
                $('.mejs__layer').css('display', 'none');
                $('.player-video').addClass('col-md-8');
                $('.player-video').removeClass('col-md-12');
                $('.player-video').css('margin-bottom', '0');
                $('.player-video').css('margin-top', '0');
                $('.mejs__container, video, iframe').css('width', '100%');
                $('.mejs__container').css('height', ($('.mejs__container').width() / 1.77176216) + 'px');
                $('video, iframe').css('height', '100%');
                $('.second-header-layout').removeClass('hidden');
                $('.header-layout').css('background', '#fff');
                $('.header-layout').css('border-bottom', '1px solid #f1f1f1');
                $('#search-bar').css('border', '1px solid #f5f5f5');
                $('#search-bar').css('color', '#444');
                $('nav.navbar-findcond ul.navbar-nav.sec_lay_hdr a').css('color', '#3e3e3e');
                $('.hide-resize').removeClass('hidden');
                $('.logo-img').find('img').attr('src', 'http://localhost:9002//themes/default/img/logo.png');
                $('.top-header a').css('color', '#444');
                $('#background').addClass('hidden');
                $('body').attr('resized', 'false');
                $('body').css('padding-top', '0px');
            } else {
                var pixels = ($(window).height() / 100) * 88;
                $('.player-video').removeClass('col-md-8');
                $('.player-video').addClass('col-md-12');
                $('.second-header-layout').addClass('hidden');
                $('.player-video').css('margin-bottom', '10px');
                $('.player-video').css('margin-top', '0px');
                $('body').css('padding-top', '57px !important');
                $('.mejs__container, video, iframe').css('width', '100%');
                $('.mejs__container').css('height', pixels + 'px');
                $('video, iframe').css('height', '100%');
                $('.header-layout').css('background', 'rgb(32,32,32)');
                $('.header-layout').css('border-bottom', 'none');
                $('#search-bar').css('border', '1px solid #555');
                $('#search-bar').css('color', '#fff');
                $('nav.navbar-findcond ul.navbar-nav.sec_lay_hdr a').css('color', '#fff');
                $('.hide-resize').addClass('hidden');
                $('.logo-img').find('img').attr('src', 'http://localhost:9002//themes/default/img/logo-light.png');
                $('.top-header a').css('color', '#fff');
                $('#background').removeClass('hidden');
                $('#background').css('height', '89.4%');
                $('body').attr('resized', 'true');
            }
        }

        $('.player-video').hover(function () {
            $('.icons').removeClass('hidden');
        });
        $('.player-video').mouseleave(function () {
            $('.icons').addClass('hidden');
        });

    </script>
@stop
