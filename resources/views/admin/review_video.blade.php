@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div id="background" class="hidden"></div>
        <div class="col-md-10 player-video" style="margin: 30px 80px !important; height: 0vh">
            <div class="video-player pt_video_player " id="pt_video_player">
                <span class="mejs__offscreen">Video Player</span>
                <video id="my-video_html5"
                       style="width: 100%; height: 451.872px; position: relative;"
                       poster="{{asset("storage/$video->thumbnail")}}"
                       preload="none"
                       controls
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
                <div class="mb-5" style="margin-bottom: 50px !important;">
                    <h2 itemprop="title">{{$video->title}}
                    </h2>
                    <hr>
                    <a href="{{action('AdminController@approve_video',$video->id)}}">
                        <button class="btn btn-success">
                            Approve
                        </button>
                    </a>
                    <a href="{{action('AdminController@decline_video',$video->id)}}">
                        <button class="btn btn-warning">
                            Decline
                        </button>
                    </a>
                </div>
                <div class="icons hidden">
                    <span class="expend-player"><i class="fa fa-expand fa-fw"></i></span>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
@endsection
