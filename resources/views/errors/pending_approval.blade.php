@extends('layouts.oldApp')
@section('container')

    <div id="main-container" style="margin-top:100px" class="container main-content" data-logged="true">
        <div id="container_content">
            <h4 class="text-center alert alert-info">
                <p id="video_status">The Video Has Not Been Approved</p>
                <br>
                You can watch video once admin approves the video
            </h4>
            <div class="content pt_shadow">
                <div class="pt_upload_vdo col">
                    <div class="upload upload-video" data-block="video-drop-zone">
                        <div>
                            <img src="{{asset('/storage/'.$video->thumbnail)}}" width="400">
                            <h2 class="mt-3">{{$video->title}}</h2>
                            <p></p></div>
                    </div>
                <div class="clear"></div>
            </div>
            <br>
        </div>
    </div>
@endsection