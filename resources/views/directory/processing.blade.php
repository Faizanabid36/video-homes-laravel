@extends('layouts.public.app',["title"=>$video->title])
@section('container')

    <div id="main-container" style="margin-top:100px" class="container main-content" data-logged="true">
        <div id="container_content">
            <h4 class="text-center alert alert-info">
                <p id="video_status">Video encoding is in process, Please wait a while.</p> <br>
                The page automatically reloads when the video would be encoded.
            </h4>
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                 style="margin: auto; display: block; shape-rendering: auto;" width="100px"
                 height="80px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                <path d="M15 50A35 35 0 0 0 85 50A35 37 0 0 1 15 50" fill="#3490dc" stroke="none"
                      transform="rotate(267.287 50 51)">
                    <animateTransform attributeName="transform" type="rotate" dur="1s" repeatCount="indefinite"
                                      keyTimes="0;1" values="0 50 51;360 50 51"/>
                </path>
            </svg>
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
    </div>
@endsection
@section('footer_script')
    <script type="text/javascript">
        $(document).ready(function () {
            let isProcessed = false;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            setInterval(function () {
                $.ajax({
                    type: 'GET',
                    url: '{{url()->current().'/is_watchable?v='.$video->video_id}}',
                    dataType: 'json',
                    success: function (data) {
                        isProcessed = data.isProcessed
                    }, error: function (data) {
                        console.log(data);
                    }
                })
                if (isProcessed) {
                    location.reload();
                }
            }, 2500)
        })
    </script>
@endsection
