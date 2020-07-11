<html>
<head>
    <title> {{$title ?? ''}}{{env('APP_NAME')}}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{asset('css/mediaelementplayer.min.css')}}">

    <script>
        window.VIDEO_APP = {
            base_url: '{{url('/')}}',
        }
    </script>
</head>
<body>
<video style="width:100%;height:100vh;"
       poster="{{asset("storage/$video->thumbnail")}}"
       preload="none" autoplay controls>
    @if($video->{'8k'})
        <source src="{{asset("storage/".str_replace('240p','4320p',$video->stream_path))}}"
                type="video/mp4" controls
                data-quality="4320p" title="4320p" label="4320p" rel="4320">
    @endif
    @if($video->{'4K'})
        <source src="{{asset("storage/".str_replace('240p','2160p',$video->stream_path))}}"
                type="video/mp4" controls
                data-quality="2160p" title="2160p" label="2160p" res="2160">
    @endif
    @if($video->{'1440p'})
        <source src="{{asset("storage/".str_replace('240p','1440p',$video->stream_path))}}"
                type="video/mp4" controls
                data-quality="1440p" title="1440p" label="1440p" res="1440">
    @endif
    @if($video->{'1080p'})
        <source src="{{asset("storage/".str_replace('240p','1080p',$video->stream_path))}}"
                type="video/mp4" controls
                data-quality="1080p" title="1080p" label="1080p" res="1080">
    @endif
    @if($video->{'720p'})
        <source src="{{asset("storage/".str_replace('240p','720p',$video->stream_path))}}"
                type="video/mp4" controls
                data-quality="720p" title="720p" label="720p" res="720">
    @endif
    @if($video->{'480p'})
        <source src="{{asset("storage/".str_replace('240p','480p',$video->stream_path))}}"
                type="video/mp4" controls
                data-quality="480p" title="480p" label="480p" res="480">
    @endif

    @if($video->{'360p'})
        <source src="{{asset("storage/".str_replace('240p','360p',$video->stream_path))}}"
                type="video/mp4" controls
                data-quality="360p" title="360p" label="360p" res="360">
    @endif
    <source src="{{asset("storage/$video->stream_path")}}" type="video/mp4" controls
            data-quality="240p" title="240p" label="240p" res="240">
    Your browser does not support HTML5 video.
</video>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{asset('js/jquery-3.min.js')}}"></script>
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.form.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/tag-it.min.js')}}"></script>
<script src="{{asset('js/lib/sweetalert2/dist/sweetalert2.js')}}"></script>
<script src="{{asset('js/lib/notifIt/notifIt/js/notifIt.min.js')}}"></script>
<script src="{{asset('js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('js/owl.carousel.min')}}.js"></script>
<script src="{{asset('js/Fingerprintjs2/fingerprint2.js')}}"></script>
<script src="{{asset('js/emoji/emojionearea/dist/emojionearea.js')}}"></script>
<script src="{{asset('js/mediaelement-and-player.min.js')}}"></script>

<script>
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
</body>
</html>
