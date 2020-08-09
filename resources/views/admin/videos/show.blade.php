@extends('admin.layouts.app')

@section('content')
    <div class="container">
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
                    <div class="my-2" style="margin-bottom: 50px !important;">
                        <h2 itemprop="title">{{$video->title}}</h2>
                        <p>{{ $video->description }}</p>
                        <p>Duration: {{gmdate("i:s", $video->duration)}}</p>
                        <p>Size: {{round((($video->size)/1024)/1024,2)}} MB</p>
                        <form method="POST" id="status"
                              action="{{ url('/admin/videos/' . $video->id) }}" accept-charset="UTF-8"
                              class="form-horizontal d-inline" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label
                                    class="btn btn-sm btn-{{ (isset($video) && 1 == $video->is_video_approved) ? 'info' : 'secondary' }}"><input
                                        onchange="document.getElementById('status').submit();"
                                        name="is_video_approved" type="radio"
                                        value="1" {{ (isset($video) && 1 == $video->is_video_approved) ? 'checked' : '' }}>
                                    Approve</label>
                                <label
                                    class="btn btn-sm btn-{{ (isset($video) && 0 == $video->is_video_approved) ? 'info' : 'secondary' }}"><input
                                        onchange="document.getElementById('status').submit();"
                                        name="is_video_approved" type="radio"
                                        value="0" @if (isset($video)) {{ (0 == $video->is_video_approved) ? 'checked' : '' }} @else {{ 'checked' }} @endif>
                                    Reject</label>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
@endsection
