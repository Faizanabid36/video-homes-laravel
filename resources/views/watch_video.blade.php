@extends('layouts.app')
@section('container')
    <div id="main-container" class="main-content  container  watch-container    " data-logged="true">
        <div id="container_content"><input type="hidden" id="json-data"
                                           value="{&quot;title&quot;:&quot;14 March, 2020 - Loom Recording&quot;,&quot;description&quot;:&quot;sdfas&quot;,&quot;keyword&quot;:&quot;as&quot;,&quot;page&quot;:&quot;watch&quot;,&quot;url&quot;:&quot;http:\/\/localhost:9002\/\/watch\/14-march-2020-loom-recording_MVVIbINPjrRSP69.html&quot;,&quot;is_movie&quot;:false}">
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
                                    <span id="video-views-count">1</span> Views
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
                                        <a class="btn btn-share" href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                      d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z"></path>
                                            </svg>
                                            Edit video
                                        </a>
                                        <a href="#"
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
                                        <textarea name="embed" id="embed" cols="30" rows="3" class="form-control">&lt;iframe src="http://localhost:9002//embed/MVVIbINPjrRSP69" frameborder="0" width="700" height="400" allowfullscreen&gt;&lt;/iframe&gt;</textarea>
                                    </div>
                                    <div class="share-video hidden">
                                        <div class="row share-input">
                                            <div class="col-md-4">
                                                <input type="text" value="{{\request()->fullUrl()}}"
                                                       class="form-control input-md" readonly=""
                                                       onclick="this.select();">
                                            </div>
                                        </div>
                                        <a href="#" class="fa fa-facebook"
                                           onclick="OpenShareWindow('https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Flocalhost%3A9002%2F%2Fwatch%2F14-march-2020-loom-recording_MVVIbINPjrRSP69.html')"></a>
                                        <a href="#" class="fa fa-twitter"
                                           onclick="OpenShareWindow('https://twitter.com/intent/tweet?url=http%3A%2F%2Flocalhost%3A9002%2F%2Fwatch%2F14-march-2020-loom-recording_MVVIbINPjrRSP69.html')"></a>
                                        <a href="#" class="fa fa-google"
                                           onclick="OpenShareWindow('https://plus.google.com/share?url=http%3A%2F%2Flocalhost%3A9002%2F%2Fwatch%2F14-march-2020-loom-recording_MVVIbINPjrRSP69.html')"></a>
                                        <a href="#" class="fa fa-linkedin"
                                           onclick="OpenShareWindow('https://www.linkedin.com/shareArticle?mini=true&amp;url=http%3A%2F%2Flocalhost%3A9002%2F%2Fwatch%2F14-march-2020-loom-recording_MVVIbINPjrRSP69.html&amp;title=14 March, 2020 - Loom Recording')"></a>
                                        <a href="#" class="fa fa-pinterest"
                                           onclick="OpenShareWindow('https://pinterest.com/pin/create/button/?url=http%3A%2F%2Flocalhost%3A9002%2F%2Fwatch%2F14-march-2020-loom-recording_MVVIbINPjrRSP69.html&amp;media=http://localhost:9002//upload/photos/2020/04/r9iNPbQj4MfaoXFI8ezc_04_1a2e85073c867251df9bc76c985fc37e_image.jpg')"></a>
                                        <a href="#" class="fa fa-tumblr"
                                           onclick="OpenShareWindow('http://www.tumblr.com/share/link?url=http%3A%2F%2Flocalhost%3A9002%2F%2Fwatch%2F14-march-2020-loom-recording_MVVIbINPjrRSP69.html')"></a>
                                        <a href="#" class="fa fa-reddit"
                                           onclick="OpenShareWindow('http://www.reddit.com/submit?url=http%3A%2F%2Flocalhost%3A9002%2F%2Fwatch%2F14-march-2020-loom-recording_MVVIbINPjrRSP69.html')"></a>
                                        <a href="#" onclick="copyToClipboard(this)" class="fa fa-link"
                                           link="http://localhost:9002//v/mjBvaU"></a>
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
                                                href="http://localhost:9002//video_studio"
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
                                0 Comments
                                <span class="dropdown sort-comments-dropdown pull-right">
				<span class="dropdown-toggle pointer" type="button" data-toggle="dropdown">
					<i class="material-icons">sort</i> Sort By
				</span>
				<ul class="dropdown-menu">
					<li class="sort-comments" id="1">
						<a href="javascript:void(0);">Top Comments</a>
					</li>
					<li class="sort-comments" id="2">
						<a href="javascript:void(0);">Latest comments</a>
					</li>
				</ul>
            </span>
                            </div>
                            <div class="w100 pt_blogcomm_combo">
                                <img class="header-image"
                                     src="{{asset('upload/photos/d-avatar.jpg')}}">
                                <textarea name="comment" class="form-control" id="comment-textarea"
                                          placeholder="Write your comment.."></textarea>

                                <button class="btn pull-right btn-main" onclick="PT_PostComment(this)"
                                        data-toggle="tooltip" title="Publish">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
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
                            <div class="user-comments" id="video-user-comments">

                            </div>

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

            <div class="modal fade matdialog" id="stripe_modal" role="dialog" data-keyboard="false"
                 style="overflow-y: auto;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="feather feather-x"><line
                                            x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18"
                                                                                       y2="18"></line></svg></span>
                            </button>
                            <h4 class="modal-title">Credit Card</h4>
                        </div>
                        <form class="form form-horizontal" method="post" id="stripe_form" action="#">
                            <div class="modal-body twocheckout_modal">
                                <div id="stripe_alert"></div>
                                <div class="clear"></div>
                                <div class="sun_input col-md-6">
                                    <input class="form-control shop_input" type="text" placeholder="" value="admin"
                                           id="stripe_name">
                                </div>
                                <div class="sun_input col-md-6">
                                    <input class="form-control shop_input" type="email" placeholder=""
                                           value="mamdani.info@gmail.com" id="stripe_email">
                                </div>
                                <div class="clear"></div>
                                <hr>
                                <div class="row two_check_card">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                              d="M20,8H4V6H20M20,18H4V12H20M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4Z"></path>
                                    </svg>
                                    <div class="sun_input col-xs-12">
                                        <input id="stripe_number" class="form-control shop_input" type="text"
                                               placeholder="Card Number">
                                    </div>
                                    <div class="sun_input col-xs-4">
                                        <select id="stripe_month" type="text" class="form-control shop_input"
                                                autocomplete="off" placeholder=" (01)">
                                            <option value="01">01</option>
                                            <option value="02">02</option>
                                            <option value="03">03</option>
                                            <option value="04">04</option>
                                            <option value="05">05</option>
                                            <option value="06">06</option>
                                            <option value="07">07</option>
                                            <option value="08">08</option>
                                            <option value="09">09</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                        </select>
                                    </div>
                                    <div class="sun_input col-xs-4 no-padding-both">
                                        <select id="stripe_year" type="text" class="form-control shop_input"
                                                autocomplete="off" placeholder=" (2019)">
                                            <option value="2020">2020</option>
                                            <option value="2021">2021</option>
                                            <option value="2022">2022</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                            <option value="2027">2027</option>
                                            <option value="2028">2028</option>
                                            <option value="2029">2029</option>
                                            <option value="2030">2030</option>
                                            <option value="2031">2031</option>
                                            <option value="2032">2032</option>
                                            <option value="2033">2033</option>
                                            <option value="2034">2034</option>
                                            <option value="2035">2035</option>
                                        </select>
                                    </div>
                                    <div class="sun_input col-xs-4">
                                        <input id="stripe_cvc" type="text" class="form-control shop_input"
                                               autocomplete="off" placeholder="CVC" maxlength="3"
                                               oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="clear"></div>
                            <div class="modal-footer">
                                <div class="ball-pulse">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                                <button type="button" class="btn btn-main" onclick="SH_StripeCardRequest()"
                                        id="stripe_btn">Purchase
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <style>
                /*.mejs__fullscreen .mejs__container {
                  max-height: 100% !important;
                }
                .mejs__container {
                  max-height: 555px !important;
                }
                .mejs__fullscreen video {
                   max-height: 100% !important;
                }
                .vjs-fullscreen video {
                   max-height: 100% !important;
                }
                .fluid_video_wrapper.fluid_player_layout_default:-webkit-full-screen video{max-height: 100% !important;}
                video {
                  max-height: 555px !important;
                }*/
                .mejs__offscreen {
                    clip: initial !important;
                    clip-path: inherit !important;
                    -webkit-clip-path: inherit !important;
                    opacity: 0;
                }
            </style>


            <div class="modal fade matdialog" id="2checkout_modal" role="dialog" data-keyboard="false"
                 style="overflow-y: auto;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="feather feather-x"><line
                                            x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18"
                                                                                       y2="18"></line></svg></span>
                            </button>
                            <h4 class="modal-title">2Checkout</h4>
                        </div>
                        <form class="form form-horizontal" method="post" id="2checkout_form" action="#">
                            <div class="modal-body twocheckout_modal">
                                <div id="2checkout_alert"></div>
                                <div class="clear"></div>
                                <div class="sun_input col-md-6">
                                    <input id="card_name" type="text" class="form-control input-md" autocomplete="off"
                                           placeholder="Name" value="admin">
                                </div>
                                <div class="sun_input col-md-6">
                                    <input id="card_address" type="text" class="form-control input-md"
                                           autocomplete="off" placeholder="Address" value="">
                                </div>
                                <div class="sun_input col-md-6">
                                    <input id="card_city" type="text" class="form-control input-md" autocomplete="off"
                                           placeholder="City" value="">
                                </div>
                                <div class="sun_input col-md-6">
                                    <input id="card_state" type="text" class="form-control input-md" autocomplete="off"
                                           placeholder="State" value="">
                                </div>
                                <div class="sun_input col-md-6">
                                    <input id="card_zip" type="text" class="form-control input-md" autocomplete="off"
                                           placeholder="Zip" value="0">
                                </div>
                                <div class="sun_input col-md-6">
                                    <select id="card_country" name="card_country" class="form-control">
                                        <option value="0" selected="">Select Country</option>
                                        <option value="1">United States</option>
                                        <option value="2">Canada</option>
                                        <option value="3">Afghanistan</option>
                                        <option value="4">Albania</option>
                                        <option value="5">Algeria</option>
                                        <option value="6">American Samoa</option>
                                        <option value="7">Andorra</option>
                                        <option value="8">Angola</option>
                                        <option value="9">Anguilla</option>
                                        <option value="10">Antarctica</option>
                                        <option value="11">Antigua and/or Barbuda</option>
                                        <option value="12">Argentina</option>
                                        <option value="13">Armenia</option>
                                        <option value="14">Aruba</option>
                                        <option value="15">Australia</option>
                                        <option value="16">Austria</option>
                                        <option value="17">Azerbaijan</option>
                                        <option value="18">Bahamas</option>
                                        <option value="19">Bahrain</option>
                                        <option value="20">Bangladesh</option>
                                        <option value="21">Barbados</option>
                                        <option value="22">Belarus</option>
                                        <option value="23">Belgium</option>
                                        <option value="24">Belize</option>
                                        <option value="25">Benin</option>
                                        <option value="26">Bermuda</option>
                                        <option value="27">Bhutan</option>
                                        <option value="28">Bolivia</option>
                                        <option value="29">Bosnia and Herzegovina</option>
                                        <option value="30">Botswana</option>
                                        <option value="31">Bouvet Island</option>
                                        <option value="32">Brazil</option>
                                        <option value="34">Brunei Darussalam</option>
                                        <option value="35">Bulgaria</option>
                                        <option value="36">Burkina Faso</option>
                                        <option value="37">Burundi</option>
                                        <option value="38">Cambodia</option>
                                        <option value="39">Cameroon</option>
                                        <option value="40">Cape Verde</option>
                                        <option value="41">Cayman Islands</option>
                                        <option value="42">Central African Republic</option>
                                        <option value="43">Chad</option>
                                        <option value="44">Chile</option>
                                        <option value="45">China</option>
                                        <option value="46">Christmas Island</option>
                                        <option value="47">Cocos (Keeling) Islands</option>
                                        <option value="48">Colombia</option>
                                        <option value="49">Comoros</option>
                                        <option value="50">Congo</option>
                                        <option value="51">Cook Islands</option>
                                        <option value="52">Costa Rica</option>
                                        <option value="53">Croatia (Hrvatska)</option>
                                        <option value="54">Cuba</option>
                                        <option value="55">Cyprus</option>
                                        <option value="56">Czech Republic</option>
                                        <option value="57">Denmark</option>
                                        <option value="58">Djibouti</option>
                                        <option value="59">Dominica</option>
                                        <option value="60">Dominican Republic</option>
                                        <option value="61">East Timor</option>
                                        <option value="62">Ecuador</option>
                                        <option value="63">Egypt</option>
                                        <option value="64">El Salvador</option>
                                        <option value="65">Equatorial Guinea</option>
                                        <option value="66">Eritrea</option>
                                        <option value="67">Estonia</option>
                                        <option value="68">Ethiopia</option>
                                        <option value="69">Falkland Islands (Malvinas)</option>
                                        <option value="70">Faroe Islands</option>
                                        <option value="71">Fiji</option>
                                        <option value="72">Finland</option>
                                        <option value="73">France</option>
                                        <option value="74">France, Metropolitan</option>
                                        <option value="75">French Guiana</option>
                                        <option value="76">French Polynesia</option>
                                        <option value="77">French Southern Territories</option>
                                        <option value="78">Gabon</option>
                                        <option value="79">Gambia</option>
                                        <option value="80">Georgia</option>
                                        <option value="81">Germany</option>
                                        <option value="82">Ghana</option>
                                        <option value="83">Gibraltar</option>
                                        <option value="84">Greece</option>
                                        <option value="85">Greenland</option>
                                        <option value="86">Grenada</option>
                                        <option value="87">Guadeloupe</option>
                                        <option value="88">Guam</option>
                                        <option value="89">Guatemala</option>
                                        <option value="90">Guinea</option>
                                        <option value="91">Guinea-Bissau</option>
                                        <option value="92">Guyana</option>
                                        <option value="93">Haiti</option>
                                        <option value="94">Heard and Mc Donald Islands</option>
                                        <option value="95">Honduras</option>
                                        <option value="96">Hong Kong</option>
                                        <option value="97">Hungary</option>
                                        <option value="98">Iceland</option>
                                        <option value="99">India</option>
                                        <option value="100">Indonesia</option>
                                        <option value="101">Iran (Islamic Republic of)</option>
                                        <option value="102">Iraq</option>
                                        <option value="103">Ireland</option>
                                        <option value="104">Israel</option>
                                        <option value="105">Italy</option>
                                        <option value="106">Ivory Coast</option>
                                        <option value="107">Jamaica</option>
                                        <option value="108">Japan</option>
                                        <option value="109">Jordan</option>
                                        <option value="110">Kazakhstan</option>
                                        <option value="111">Kenya</option>
                                        <option value="112">Kiribati</option>
                                        <option value="113">Korea, Democratic People's Republic of</option>
                                        <option value="114">Korea, Republic of</option>
                                        <option value="115">Kosovo</option>
                                        <option value="116">Kuwait</option>
                                        <option value="117">Kyrgyzstan</option>
                                        <option value="118">Lao People's Democratic Republic</option>
                                        <option value="119">Latvia</option>
                                        <option value="120">Lebanon</option>
                                        <option value="121">Lesotho</option>
                                        <option value="122">Liberia</option>
                                        <option value="123">Libyan Arab Jamahiriya</option>
                                        <option value="124">Liechtenstein</option>
                                        <option value="125">Lithuania</option>
                                        <option value="126">Luxembourg</option>
                                        <option value="127">Macau</option>
                                        <option value="128">Macedonia</option>
                                        <option value="129">Madagascar</option>
                                        <option value="130">Malawi</option>
                                        <option value="131">Malaysia</option>
                                        <option value="132">Maldives</option>
                                        <option value="133">Mali</option>
                                        <option value="134">Malta</option>
                                        <option value="135">Marshall Islands</option>
                                        <option value="136">Martinique</option>
                                        <option value="137">Mauritania</option>
                                        <option value="138">Mauritius</option>
                                        <option value="139">Mayotte</option>
                                        <option value="140">Mexico</option>
                                        <option value="141">Micronesia, Federated States of</option>
                                        <option value="142">Moldova, Republic of</option>
                                        <option value="143">Monaco</option>
                                        <option value="144">Mongolia</option>
                                        <option value="145">Montenegro</option>
                                        <option value="146">Montserrat</option>
                                        <option value="147">Morocco</option>
                                        <option value="148">Mozambique</option>
                                        <option value="149">Myanmar</option>
                                        <option value="150">Namibia</option>
                                        <option value="151">Nauru</option>
                                        <option value="152">Nepal</option>
                                        <option value="153">Netherlands</option>
                                        <option value="154">Netherlands Antilles</option>
                                        <option value="155">New Caledonia</option>
                                        <option value="156">New Zealand</option>
                                        <option value="157">Nicaragua</option>
                                        <option value="158">Niger</option>
                                        <option value="159">Nigeria</option>
                                        <option value="160">Niue</option>
                                        <option value="161">Norfork Island</option>
                                        <option value="162">Northern Mariana Islands</option>
                                        <option value="163">Norway</option>
                                        <option value="164">Oman</option>
                                        <option value="165">Pakistan</option>
                                        <option value="166">Palau</option>
                                        <option value="167">Panama</option>
                                        <option value="168">Papua New Guinea</option>
                                        <option value="169">Paraguay</option>
                                        <option value="170">Peru</option>
                                        <option value="171">Philippines</option>
                                        <option value="172">Pitcairn</option>
                                        <option value="173">Poland</option>
                                        <option value="174">Portugal</option>
                                        <option value="175">Puerto Rico</option>
                                        <option value="176">Qatar</option>
                                        <option value="177">Reunion</option>
                                        <option value="178">Romania</option>
                                        <option value="179">Russian Federation</option>
                                        <option value="180">Rwanda</option>
                                        <option value="181">Saint Kitts and Nevis</option>
                                        <option value="182">Saint Lucia</option>
                                        <option value="183">Saint Vincent and the Grenadines</option>
                                        <option value="184">Samoa</option>
                                        <option value="185">San Marino</option>
                                        <option value="186">Sao Tome and Principe</option>
                                        <option value="187">Saudi Arabia</option>
                                        <option value="188">Senegal</option>
                                        <option value="189">Serbia</option>
                                        <option value="190">Seychelles</option>
                                        <option value="191">Sierra Leone</option>
                                        <option value="192">Singapore</option>
                                        <option value="193">Slovakia</option>
                                        <option value="194">Slovenia</option>
                                        <option value="195">Solomon Islands</option>
                                        <option value="196">Somalia</option>
                                        <option value="197">South Africa</option>
                                        <option value="198">South Georgia South Sandwich Islands</option>
                                        <option value="199">Spain</option>
                                        <option value="200">Sri Lanka</option>
                                        <option value="201">St. Helena</option>
                                        <option value="202">St. Pierre and Miquelon</option>
                                        <option value="203">Sudan</option>
                                        <option value="204">Suriname</option>
                                        <option value="205">Svalbarn and Jan Mayen Islands</option>
                                        <option value="206">Swaziland</option>
                                        <option value="207">Sweden</option>
                                        <option value="208">Switzerland</option>
                                        <option value="209">Syrian Arab Republic</option>
                                        <option value="210">Taiwan</option>
                                        <option value="211">Tajikistan</option>
                                        <option value="212">Tanzania, United Republic of</option>
                                        <option value="213">Thailand</option>
                                        <option value="214">Togo</option>
                                        <option value="215">Tokelau</option>
                                        <option value="216">Tonga</option>
                                        <option value="217">Trinidad and Tobago</option>
                                        <option value="218">Tunisia</option>
                                        <option value="219">Turkey</option>
                                        <option value="220">Turkmenistan</option>
                                        <option value="221">Turks and Caicos Islands</option>
                                        <option value="222">Tuvalu</option>
                                        <option value="223">Uganda</option>
                                        <option value="224">Ukraine</option>
                                        <option value="225">United Arab Emirates</option>
                                        <option value="226">United Kingdom</option>
                                        <option value="227">United States minor outlying islands</option>
                                        <option value="228">Uruguay</option>
                                        <option value="229">Uzbekistan</option>
                                        <option value="230">Vanuatu</option>
                                        <option value="231">Vatican City State</option>
                                        <option value="232">Venezuela</option>
                                        <option value="233">Vietnam</option>
                                        <option value="238">Yemen</option>
                                        <option value="239">Yugoslavia</option>
                                        <option value="240">Zaire</option>
                                        <option value="241">Zambia</option>
                                        <option value="242">Zimbabwe</option>
                                    </select>
                                </div>
                                <div class="sun_input col-md-6">
                                    <input id="card_email" type="text" class="form-control input-md" autocomplete="off"
                                           placeholder="E-mail" value="mamdani.info@gmail.com">
                                </div>
                                <div class="sun_input col-md-6">
                                    <input id="card_phone" type="text" class="form-control input-md" autocomplete="off"
                                           placeholder="Phone" value="">
                                </div>
                                <div class="clear"></div>
                                <hr>
                                <div class="row two_check_card">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                              d="M20,8H4V6H20M20,18H4V12H20M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4Z"></path>
                                    </svg>
                                    <div class="sun_input col-xs-12">
                                        <input id="_number_" type="text" class="form-control input-md"
                                               autocomplete="off" placeholder="Card Number">
                                        <input id="card_number" name="card_number" type="hidden"
                                               class="form-control input-md" autocomplete="off">
                                    </div>
                                    <div class="sun_input col-xs-4">
                                        <select id="card_month" name="card_month" type="text"
                                                class="form-control input-md" autocomplete="off"
                                                placeholder="month (01)">
                                            <option value="01">01</option>
                                            <option value="02">02</option>
                                            <option value="03">03</option>
                                            <option value="04">04</option>
                                            <option value="05">05</option>
                                            <option value="06">06</option>
                                            <option value="07">07</option>
                                            <option value="08">08</option>
                                            <option value="09">09</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                        </select>
                                    </div>
                                    <div class="sun_input col-xs-4 no-padding-both">
                                        <select id="card_year" name="card_year" type="text"
                                                class="form-control input-md" autocomplete="off"
                                                placeholder="year (2019)">
                                            <option value="2020">2020</option>
                                            <option value="2021">2021</option>
                                            <option value="2022">2022</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                            <option value="2027">2027</option>
                                            <option value="2028">2028</option>
                                            <option value="2029">2029</option>
                                            <option value="2030">2030</option>
                                            <option value="2031">2031</option>
                                            <option value="2032">2032</option>
                                            <option value="2033">2033</option>
                                            <option value="2034">2034</option>
                                            <option value="2035">2035</option>
                                        </select>
                                    </div>
                                    <div class="sun_input col-xs-4">
                                        <input id="card_cvc" name="card_cvc" type="text" class="form-control input-md"
                                               autocomplete="off" placeholder="CVC" maxlength="3"
                                               oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                    </div>
                                </div>
                                <div class="clear"></div>
                                <input type="text" id="2checkout_type" class="hidden" name="type">
                                <input id="card_token" name="token" type="hidden" value="">
                                <input id="checkout_video_1" name="video_id" type="hidden" value="">
                                <input id="checkout_price_1" name="price" type="hidden" value="">
                                <input id="checkout_user_id" name="user_id" type="hidden" value="">
                                <input class="checkout_pay_type" name="pay_type" type="hidden" value="">
                            </div>
                            <div class="clear"></div>
                            <div class="modal-footer">
                                <div class="ball-pulse">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                                <button type="button" class="btn btn-main" onclick="tokenRequest()" id="2checkout_btn">
                                    Purchase
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="modal fade matdialog" id="bank_transfer_modal_2" role="dialog" data-keyboard="false"
                 style="overflow-y: auto;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="feather feather-x"><line
                                            x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18"
                                                                                       y2="18"></line></svg></span>
                            </button>
                            <h4 class="modal-title">Bank transfer</h4>
                        </div>
                        <form class="form form-horizontal" method="post" id="bank_transfer_form_2" action="#">
                            <div class="modal-body dt_bank_trans_modal">
                                <div id="blog-alert-2"></div>

                                <div class="bank_info">
                                    <div class="dt_settings_header bg_gradient">
                                        <div class="dt_settings_circle-1"></div>
                                        <div class="dt_settings_circle-2"></div>
                                        <div class="bank_info_innr">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                      d="M11.5,1L2,6V8H21V6M16,10V17H19V10M2,22H21V19H2M10,10V17H13V10M4,10V17H7V10H4Z"></path>
                                            </svg>
                                            <h4 class="bank_name">Garanti Bank</h4>
                                            <div class="row">
                                                <div class="col col-md-12">
                                                    <div class="bank_account"><p>4796824372433055</p><span
                                                            class="help-block">Account number / IBAN</span></div>
                                                </div>
                                                <div class="col col-md-12">
                                                    <div class="bank_account_holder"><p>Antoian Kordiyal</p><span
                                                            class="help-block">Account name</span></div>
                                                </div>
                                                <div class="col col-md-6">
                                                    <div class="bank_account_code"><p>TGBATRISXXX</p><span
                                                            class="help-block">Routing code</span></div>
                                                </div>
                                                <div class="col col-md-6">
                                                    <div class="bank_account_country"><p>United States</p><span
                                                            class="help-block">Country</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="dt_user_profile hide_alert_info_bank_trans">
                     <span class="valign-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path
                                fill="currentColor"
                                d="M13,13H11V7H13M13,17H11V15H13M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z"></path></svg> Note:
                     </span>
                                    <ul class="dt_prof_vrfy">
                                        <li>In order to confirm the bank transfer, you will need to upload a receipt or
                                            take a screenshot of your transfer within 1 day from your payment date. If a
                                            bank transfer is made but no receipt is uploaded within this period, your
                                            order will be cancelled. We will verify and confirm your receipt within 3
                                            working days from the date you upload it.
                                        </li>
                                    </ul>
                                </div>
                                <p class="dt_bank_trans_upl_rec"><a href="javascript:void(0);"
                                                                    onclick="$('#bank_transfer_modal_2').addClass('up_rec_active'); return false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                  d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M13.5,16V19H10.5V16H8L12,12L16,16H13.5M13,9V3.5L18.5,9H13Z"></path>
                                        </svg>
                                        Upload</a></p>
                                <div class="upload_bank_receipts">
                                    <div onclick="document.getElementById('thumbnail_2').click(); return false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                  d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M13.5,16V19H10.5V16H8L12,12L16,16H13.5M13,9V3.5L18.5,9H13Z"></path>
                                        </svg>
                                        <p>Browse To Upload</p>
                                        <img class="bank_image_2" src="">
                                    </div>
                                </div>
                                <input type="file" class="hidden" id="thumbnail_2" name="thumbnail" accept="image/*">
                                <input name="image" type="file" id="upload" class="hidden">
                                <input name="type" type="hidden" id="bank_transfer_type_2" class="hidden" value="bank">
                                <input name="description" type="hidden" id="bank_transfer_des_2" class="hidden">
                                <input name="user_id" type="hidden" id="bank_transfer_user" class="hidden">
                                <input type="reset" id="configreset_2" value="Reset" class="hidden">
                            </div>
                            <div class="modal-footer">
                                <div class="ball-pulse">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                                <button type="submit" class="btn btn-main">Publish</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="modal fade matdialog" id="bank_transfer_modal" role="dialog" data-keyboard="false"
                 style="overflow-y: auto;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="feather feather-x"><line
                                            x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18"
                                                                                       y2="18"></line></svg></span>
                            </button>
                            <h4 class="modal-title">Bank transfer</h4>
                        </div>
                        <form class="form form-horizontal" method="post" id="bank_transfer_form" action="#">
                            <div class="modal-body dt_bank_trans_modal">
                                <div id="blog-alert"></div>

                                <div class="bank_info">
                                    <div class="dt_settings_header bg_gradient">
                                        <div class="dt_settings_circle-1"></div>
                                        <div class="dt_settings_circle-2"></div>
                                        <div class="bank_info_innr">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                      d="M11.5,1L2,6V8H21V6M16,10V17H19V10M2,22H21V19H2M10,10V17H13V10M4,10V17H7V10H4Z"></path>
                                            </svg>
                                            <h4 class="bank_name">Garanti Bank</h4>
                                            <div class="row">
                                                <div class="col col-md-12">
                                                    <div class="bank_account"><p>4796824372433055</p><span
                                                            class="help-block">Account number / IBAN</span></div>
                                                </div>
                                                <div class="col col-md-12">
                                                    <div class="bank_account_holder"><p>Antoian Kordiyal</p><span
                                                            class="help-block">Account name</span></div>
                                                </div>
                                                <div class="col col-md-6">
                                                    <div class="bank_account_code"><p>TGBATRISXXX</p><span
                                                            class="help-block">Routing code</span></div>
                                                </div>
                                                <div class="col col-md-6">
                                                    <div class="bank_account_country"><p>United States</p><span
                                                            class="help-block">Country</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="dt_user_profile hide_alert_info_bank_trans">
                     <span class="valign-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path
                                fill="currentColor"
                                d="M13,13H11V7H13M13,17H11V15H13M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z"></path></svg> Note:
                     </span>
                                    <ul class="dt_prof_vrfy">
                                        <li>In order to confirm the bank transfer, you will need to upload a receipt or
                                            take a screenshot of your transfer within 1 day from your payment date. If a
                                            bank transfer is made but no receipt is uploaded within this period, your
                                            order will be cancelled. We will verify and confirm your receipt within 3
                                            working days from the date you upload it.
                                        </li>
                                    </ul>
                                </div>
                                <p class="dt_bank_trans_upl_rec"><a href="javascript:void(0);"
                                                                    onclick="$('#bank_transfer_modal').addClass('up_rec_active'); return false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                  d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M13.5,16V19H10.5V16H8L12,12L16,16H13.5M13,9V3.5L18.5,9H13Z"></path>
                                        </svg>
                                        Upload</a></p>
                                <div class="upload_bank_receipts">
                                    <div onclick="document.getElementById('thumbnail').click(); return false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                  d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M13.5,16V19H10.5V16H8L12,12L16,16H13.5M13,9V3.5L18.5,9H13Z"></path>
                                        </svg>
                                        <p>Browse To Upload</p>
                                        <img id="receipt_img_preview" src="">
                                    </div>
                                </div>
                                <input type="file" class="hidden" id="thumbnail" name="thumbnail" accept="image/*">
                                <input name="image" type="file" id="upload" class="hidden">
                                <input name="type" type="hidden" id="bank_transfer_type" class="hidden">
                                <input name="description" type="hidden" id="bank_transfer_des" class="hidden">
                                <input name="video_id" type="hidden" id="bank_transfer_video" class="hidden">
                                <input name="pay_type" type="hidden" class="bank_pay_type">
                                <input type="reset" id="configreset" value="Reset" class="hidden">
                            </div>
                            <div class="modal-footer">
                                <div class="ball-pulse">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                                <button type="submit" class="btn btn-main">Publish</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_script')
    {{--    --}}
    {{--    <script>--}}
    {{--        jQuery(document).ready(function ($) {--}}

    {{--            var sort_comments_by = 2;--}}

    {{--            $("li.sort-comments").click(function (event) {--}}
    {{--                sort_comments_by = $(this).attr('id');--}}
    {{--                var video_id = $('#video-id').val();--}}
    {{--                var data_obj = {--}}
    {{--                    video_id: video_id,--}}
    {{--                    sort_by: sort_comments_by--}}
    {{--                };--}}

    {{--                $('#video-user-comments').empty();--}}
    {{--                $(".comments-loading").removeClass('hidden');--}}

    {{--                $.post('http://localhost:9002//aj/sort-comments', data_obj, function (data, textStatus, xhr) {--}}
    {{--                    if (data.status == 200) {--}}
    {{--                        PT_Delay(function () {--}}
    {{--                            $(".comments-loading").addClass('hidden');--}}
    {{--                            $('#video-user-comments').html(data.comments);--}}
    {{--                        }, 200);--}}
    {{--                    } else {--}}
    {{--                        PT_Delay(function () {--}}
    {{--                            $(".comments-loading").addClass('hidden');--}}
    {{--                        }, 200);--}}
    {{--                    }--}}
    {{--                });--}}

    {{--            });--}}

    {{--            $.fn.scrollTo = function (speed) {--}}
    {{--                if (typeof (speed) === 'undefined')--}}
    {{--                    speed = 500;--}}

    {{--                $('html, body').animate({--}}
    {{--                    scrollTop: ($(this).offset().top - 100)--}}
    {{--                }, speed);--}}

    {{--                return $(this);--}}
    {{--            };--}}


    {{--            $('#comment-textarea').on('click', function (event) {--}}
    {{--                event.preventDefault();--}}
    {{--                var logged = $('#main-container').attr('data-logged');--}}
    {{--                if (!logged) {--}}

    {{--                    window.location.href = "http://localhost:9002//login?to=http://localhost:9002//watch/14-march-2020-loom-recording_MVVIbINPjrRSP69.html";--}}
    {{--                    return false;--}}
    {{--                }--}}
    {{--                $(this).css('border', '1px solid #888');--}}
    {{--            });--}}

    {{--            $('.comments-load').on('click', function (event) {--}}
    {{--                event.preventDefault();--}}
    {{--                var last_id = $('.main-comment:last').attr('data-id');--}}
    {{--                var video_id = $('#video-id').val();--}}
    {{--                var data_obj = {--}}
    {{--                    last_id: last_id,--}}
    {{--                    video_id: video_id,--}}
    {{--                    sort_by: sort_comments_by--}}
    {{--                };--}}

    {{--                if (sort_comments_by == 1) {--}}
    {{--                    var comment_ids = [];--}}
    {{--                    $('.main-comment').each(function (index, el) {--}}
    {{--                        comment_ids.push($(el).attr('data-id'));--}}
    {{--                    });--}}

    {{--                    data_obj['comments'] = comment_ids.join()--}}
    {{--                }--}}

    {{--                $.post('http://localhost:9002//aj/load-more-comments', data_obj, function (data, textStatus, xhr) {--}}
    {{--                    if (data.status == 200) {--}}
    {{--                        $('#video-user-comments').append(data.comments);--}}
    {{--                    } else {--}}
    {{--                        $('.comments-load').text(data.message);--}}
    {{--                    }--}}
    {{--                });--}}
    {{--            });--}}
    {{--        });--}}


    {{--        function PT_PostComment(button) {--}}
    {{--            var text = $('#comment-textarea').val();--}}
    {{--            if (!text) {--}}
    {{--                $('#comment-textarea').css('border', '1px solid red');--}}
    {{--                return false;--}}
    {{--            }--}}
    {{--            var video_id = $('#video-id').val();--}}
    {{--            if (!video_id) {--}}
    {{--                return false;--}}
    {{--            }--}}
    {{--            $(button).attr('disabled', true);--}}
    {{--            $.post('http://localhost:9002//aj/add-comment', {--}}
    {{--                video_id: video_id,--}}
    {{--                text: text--}}
    {{--            }, function (data, textStatus, xhr) {--}}
    {{--                if (data.status == 200) {--}}
    {{--                    if ($('.no-comments-found').length > 0) {--}}
    {{--                        $('.no-comments-found').remove();--}}
    {{--                    }--}}
    {{--                    $('#comment-textarea').val('');--}}
    {{--                    $('#video-user-comments').prepend(data.comment);--}}
    {{--                }--}}
    {{--                $(button).attr('disabled', false);--}}
    {{--            });--}}
    {{--        }--}}


    {{--        function PT_DeleteComment(id) {--}}
    {{--            if (!id) {--}}
    {{--                return false;--}}
    {{--            }--}}
    {{--            if (!confirm('Are you sure you want to delete your comment?')) {--}}
    {{--                return false;--}}
    {{--            }--}}
    {{--            $('#comment-' + id).slideUp('fast');--}}
    {{--            $.post('http://localhost:9002//aj/delete-comment', {id: id});--}}
    {{--        }--}}

    {{--        function PT_PinComment(id, pin) {--}}
    {{--            if (!id) {--}}
    {{--                return false;--}}
    {{--            }--}}
    {{--            let pinned_comments = $('#pinned-comment');--}}

    {{--            if (pin) {--}}
    {{--                $("#comment-" + id).slideUp(200, function () {--}}
    {{--                    Snackbar.show({text: 'Comment pinned to top'});--}}
    {{--                })--}}
    {{--            } else {--}}
    {{--                pinned_comments.empty();--}}
    {{--                Snackbar.show({text: 'Comment unpinned'});--}}
    {{--            }--}}

    {{--            $.post('http://localhost:9002//aj/pin-comment', {id: id}, function (data) {--}}
    {{--                if (data.status == 200) {--}}

    {{--                    $("#comment-" + id).slideUp(100, function () {--}}
    {{--                        $(this).remove();--}}
    {{--                        pinned_comments.scrollTo();--}}
    {{--                    });--}}

    {{--                    pinned_comments.html(data.html);--}}
    {{--                } else if (data.status == 304) {--}}
    {{--                    $("#video-user-comments").append(data.html);--}}
    {{--                }--}}
    {{--            });--}}
    {{--        }--}}
    {{--    </script>--}}
    {{--    --}}
    <script type="text/javascript">
        function setCookie(cname, cvalue, exdays) {
            var d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            var expires = "expires="+d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }
        var myTimeout;

        function show_gif(self,gif) {
            if (gif && gif != '') {
                myTimeout = setTimeout(function() {
                    $(self).append('<img src="'+gif+'">');
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
            features: ['playpause', 'current', 'progress', 'duration', 'speed', 'skipback', 'jumpforward', 'tracks', 'markers', 'volume', 'chromecast', 'contextmenu', 'flash', 'fullscreen','sourcechooser'],
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

                // $.ajax({
                //     url: 'http://localhost:9002//aj/load-related-videos',
                //     type: 'GET',
                //     dataType: 'json',
                //     data: {id: id, video_id: '1'},
                // })
                //     .done(function (data) {
                //         if (data.status == 200) {
                //             $(".related-videos").append(data.html);
                //         } else {
                //             $("#load-related-videos").find('span').text('No more videos found');
                //         }
                //         $("#load-related-videos").find('i.spin').addClass('hidden');
                //
                //     });
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

            // $('video').mediaelementplayer({
            //   pluginPath: 'https://cdnjs.com/libraries/mediaelement-plugins/',
            //   shimScriptAccess: 'always',
            //   autoplay: true,
            //   features: ['playpause', 'current', 'progress', 'duration', 'speed', 'skipback', 'jumpforward', 'tracks', 'markers', 'volume', 'chromecast', 'contextmenu', 'flash'   , 'fullscreen'],
            //   vastAdTagUrl: '',
            //   vastAdsType: '',
            //   jumpForwardInterval: 20,
            //   adsPrerollMediaUrl: [''],
            //   adsPrerollAdUrl: [''],
            //   adsPrerollAdEnableSkip: false,
            //   adsPrerollAdSkipSeconds: 0,
            //   success: function (media) {
            //       media.addEventListener('ended', function (e) {

            //         if ($('#autoplay').is(":checked")) {
            //            var url = $('#next-video').find('.video-title').find('a').attr('href');
            //            if (url) {
            //               window.location.href = url;
            //            }
            //         }
            //         else{
            //           /* pass */
            //         }
            //       }, false);

            //       media.addEventListener('playing', function (e) {
            //         if (pt_elexists('.ads-overlay-info')) {
            //           $('.ads-overlay-info').remove();
            //         }

            //         $('.ads-test').remove();

            //         if ($('body').attr('resized') == 'true') {
            //             PT_Resize(true);
            //         }
            //         $('.mejs__container').css('height', ($('.mejs__container').width() / 1.77176216) + 'px');
            //         $('video, iframe').css('height', '100%');
            //       });
            //   },
            // });

            // $('.expend-player').on('click', function(event) {
            //  event.preventDefault();
            //  var resize = 0;
            //  if ($('.player-video').hasClass('col-md-12')) {
            //    resize = 0;
            //  } else {
            //    resize = 1;
            //  }
            //  $.post('http://localhost:9002//aj/set-cookies', {name: 'resize', value:resize});
            //  PT_Resize();
            // });
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
    <script type="text/javascript">

        function show_gif(self,gif) {
            if (gif && gif != '') {
                myTimeout = setTimeout(function() {
                    $(self).append('<img src="'+gif+'">');
                }, 1000);
            }
        }

        function hide_gif(self) {
            $(self).find('img').remove();
            clearTimeout(myTimeout);
        }
        $(document).on('change', '#thumbnail', function (event) {
            let imgPath = $(this)[0].files[0].name;
            if (typeof (FileReader) != "undefined") {
                let reader = new FileReader();
                reader.onload = function (e) {
                    $('#receipt_img_preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
            $('#bank_transfer_modal').addClass('up_rec_img_ready');
        });


        $(document).on('change', '#thumbnail_2', function (event) {
            let imgPath = $(this)[0].files[0].name;
            if (typeof (FileReader) != "undefined") {
                let reader = new FileReader();
                reader.onload = function (e) {
                    $('.bank_image_2').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
            $('#bank_transfer_modal_2').addClass('up_rec_img_ready');
        });

        jQuery(document).ready(function ($) {
            $('#bank_transfer_form').ajaxForm({
                url: 'http://localhost:9002//aj/go_pro/bank_pay_to_see',
                beforeSend: function () {
                    $('#bank_transfer_form').find('.ball-pulse').fadeIn(100);
                },
                success: function (data) {
                    if (data['status'] == 200) {
                        $("#blog-alert").html('<div class="alert alert-success">' + data['message'] + '</div>');
                        setTimeout(function () {
                            window.location = "http://localhost:9002/";
                            $(".prv-img").html('<div class="thumbnail-rendderer"><div><div class="error-text-renderer"></div><div><p>http://localhost:9002//browse_to_upload</p></div></div> </div>');
                            $("#blog-alert").html('');
                            $('#configreset').click();

                        }, 3000)
                    } else if (data['message']) {
                        $("#blog-alert").html('<div class="alert alert-danger">' + data['message'] + '</div>');
                    }
                    $('#bank_transfer_form').find('.ball-pulse').fadeOut(100);
                }
            });

            $('#bank_transfer_form_2').ajaxForm({
                url: 'http://localhost:9002//aj/go_pro/subscribe',
                beforeSend: function () {
                    $('#bank_transfer_form_2').find('.ball-pulse').fadeIn(100);
                },
                success: function (data) {
                    if (data['status'] == 200) {
                        $("#blog-alert-2").html('<div class="alert alert-success">' + data['message'] + '</div>');
                        setTimeout(function () {
                            window.location = "http://localhost:9002/";
                            $(".prv-img").html('<div class="thumbnail-rendderer"><div><div class="error-text-renderer"></div><div><p>http://localhost:9002//browse_to_upload</p></div></div> </div>');
                            $("#blog-alert-2").html('');
                            $('#configreset_2').click();

                        }, 3000)
                    } else if (data['message']) {
                        $("#blog-alert-2").html('<div class="alert alert-danger">' + data['message'] + '</div>');
                    }
                    $('#bank_transfer_form_2').find('.ball-pulse').fadeOut(100);
                }
            });


        });

        function PT_OpenBank(pkg, self, video_id = 0, price = 0, user_id) {
            if (!pkg || !self) {
                return false;
            }
            $(self).text("Please wait..").attr('disabled', 'true');
            $('#pay-go-pro').modal('hide');
            if (user_id > 0) {
                $('#bank_transfer_user').val(user_id)
                $('#configreset_2').click();
                $("#blog-alert-2").html('');
                $('#bank_transfer_modal_2').modal({
                    show: true
                });

            } else {
                video = '1';
                $('#bank_transfer_video').val(video)
                $('#configreset').click();
                $("#blog-alert").html('');
                $('.bank_pay_type').val(pkg);
                $('#bank_transfer_modal').modal({
                    show: true
                });
            }


        }
    </script>
@stop
